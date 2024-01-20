<?php

namespace App\Http\Controllers;
use App\Helpers\CommonHelper;
use App\Mail\DriverMail;
use App\Mail\Paymentdone;
use App\Models\Delivery_Addresses;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Exception\PayPalConnectionException;
use Symfony\Component\Console\Input\Input;

class PaymentController extends Controller
{
    private $apiContext;
    public function __construct()
    {
        /** setup PayPal api context **/
        $paypal_conf = Config::get('paypal');
        $this->apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET')
            ));
        $this->apiContext->setConfig($paypal_conf['settings']);
    }
    public function payment_delivery(Request $request){
        $pid = $request->PayerID;
        $p_amount=$request->amount;
        Session::forget('p_id');
        Session::put('p_id',$pid);

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($pid) /** item name **/
        ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($p_amount); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item));

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($p_amount);

        $desc = "Delivery In Hour";
        $invoice = uniqid();
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($desc)
            ->setInvoiceNumber($invoice);

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('status')) /** Specify return URL **/
        ->setCancelUrl(url('cancel_transaction/'.$invoice));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));


        try {
            $payment->create($this->apiContext);
            \App\Models\Transaction::create([
                "payment_id" => $payment->id,
                "payer_id" => $pid,
                "amount" => $p_amount,
                "description" => $desc,
                "invoice" => $invoice,
                "status" => 'pending',
            ]);
            foreach ($payment->getLinks() as $link) {
                if ($link->getRel() == 'approval_url') {
                    $redirect_url = $link->getHref();
                    break;
                }
            }
            if (isset($redirect_url)) {
                return redirect($redirect_url);
            }
            Session::put('flashmsg','Unknown error occurred');
            return redirect('approval_request');
        } catch (\PayPal\Exception\PayPalConnectionException  $ex) {
            Session::put('flashmsg', 'Some error occur, sorry for inconvenient');
            return redirect('approval_request');
        }
        catch (\Exception $ex) {
            Session::put('flashmsg','Some error occur, sorry for inconvenient');
            return redirect('approval_request');
        }

    }
    public function getPaymentStatus(Request $request)
    {
        try{
            if (empty($request->query('paymentId'))) {
                Session::put('flashmsg', 'Some error occur, sorry for inconvenient');
                return redirect('approval_request');
            }

            $payment = Payment::get($request->query('paymentId'), $this->apiContext);

            $PayerID1=json_decode($payment,1);
            if(!isset($PayerID1['payer']['payer_info']['payer_id']))
            {
                Session::put('flashmsg', 'Payment Failed');
                return redirect('approval_request');
            }

            $PayerID=$PayerID1['payer']['payer_info']['payer_id'];

            $execution = new PaymentExecution();
            $execution->setPayerId($PayerID);


            $result = $payment->execute($execution, $this->apiContext);

            $transaction = \App\Models\Transaction::where('payment_id', $request->query('paymentId'))->first();
            $payment= json_decode($result,1);
            if (!empty($transaction)) {
                $transaction->status =$payment['state'] ;
                $transaction->transaction_id="TRANSACTION".date('Y').date('m').date('d');
                $transaction->save();
                $p_id=$transaction->payer_id;
                $ddata = Delivery_Addresses::where('id', $p_id)->update(['is_confirmed' => 1]);
                if($ddata){
                    Delivery_Addresses::where('parent_id', $p_id)->update(['is_confirmed' => 1]);
                }

            } else {
                if (isset( $payment['transactions'][0])) {
//                    $pidId = $payment['transactions'][0]['item_list']['items'][0]['name'];
                    $pid=Session::get('p_id');
                    $amount=Delivery_Addresses::where('id',$pid)->pluck('price')->first();
                    $transaction = \App\Models\Transaction::create([
                        "transaction_id"=>"TRANSACTION". date('Y').date('m').date('d'),
                        "payment_id" => $payment['id'],
                        "payer_id" => $pid,
                        "amount" => $amount,
                        "description" => $payment['transactions'][0]['description'],
                        "invoice" => $payment['transactions'][0]['invoice_number'],
                        "status" => $payment['state'],
                    ]);
                    Session::forget('p_id');
                    $p_id=$transaction->payer_id;
                    $ddata = Delivery_Addresses::where('id', $p_id)->update(['is_confirmed' => 1]);
                    if($ddata){
                        Delivery_Addresses::where('parent_id', $p_id)->update(['is_confirmed' => 1]);
                    }

                }

            }
            $details = [
                'title' => 'Mail from Delivery In Hour',
                'Description'=>'Payment of '.$transaction->amount.' Successfully Done',
                'TransactionID' => $transaction->transaction_id,
                'InvoiceID' => $transaction->invoice,
            ];
            $data=Delivery_Addresses::where('id',$transaction->payer_id)->first();
            $datas=$details['Description'].' '."Transaction ID=".$details['TransactionID'].' '."Invoice ID".$details['InvoiceID'];
            try{
                Mail::to($data->email)->send(new Paymentdone($details));
                try{
                    CommonHelper::SuccessfullPayemnt($data->mobile,$datas);
                }
                catch (\Exception $ex) {
                    Session::put('flashmsg', 'Payment Successful.But Message Not Sent On Number.');
                }
            }
            catch (\Exception $ex) {
                Session::put('flashmsg', 'Payment Successful.But Mail Not Send.');
                return redirect('approval_request');
            }
            Session::put('flashmsg', 'Payment Successful');
            return redirect('approval_request');
        } catch (\Exception $ex) {
            Session::put('flashmsg', 'Some error occur, sorry for inconvenient');
            return redirect('approval_request');
        }
    }
    public function cancel_transaction($id, Request $request)
    {
        $transaction = \App\Models\Transaction::where('invoice', $id)->first();
        if (!empty($transaction)) {
            $transaction->status = "failed";
            $transaction->save();
            Session::put('flashmsg', 'Transaction Failed');
            return redirect('approval_request');
        }
    }


}
