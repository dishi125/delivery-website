<?php

namespace App\Http\Controllers;

use App\Enums\Dimensions;
use App\Enums\Packagekg;
use App\Http\Requests\CreateDelivery_AddressesRequest;
use App\Http\Requests\UpdateDelivery_AddressesRequest;
use App\Models\Delivery_Addresses;
use App\Models\Package_Detail;
use App\Repositories\Delivery_AddressesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Response;
use App\Mail\PriceMail;
use Illuminate\Support\Facades\Mail;
use Twilio\Rest\Client;


class Delivery_AddressesController extends AppBaseController
{
    /** @var  Delivery_AddressesRepository */
    private $deliveryAddressesRepository;

    public function __construct(Delivery_AddressesRepository $deliveryAddressesRepo)
    {
        $this->deliveryAddressesRepository = $deliveryAddressesRepo;
    }

    /**
     * Display a listing of the Delivery_Addresses.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $deliveryAddresses = $this->deliveryAddressesRepository->all();
        $deliveryAddresses=Delivery_Addresses::where('parent_id',0)->where('price',null)->where('is_sent_req',1)->with('getPackage')->orderby('id','desc')->paginate(10);
        $session_filter = session('newrequest_filter');

        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
      return view('delivery_addresses.index',compact('filter'))
            ->with('deliveryAddresses', $deliveryAddresses);
    }

    /**
     * Show the form for creating a new Delivery_Addresses.
     *
     * @return Response
     */
    public function create()
    {
        return view('delivery_addresses.create');
    }

    /**
     * Store a newly created Delivery_Addresses in storage.
     *
     * @param CreateDelivery_AddressesRequest $request
     *
     * @return Response
     */
    public function store(CreateDelivery_AddressesRequest $request)
    {
        $input = $request->all();

        $deliveryAddresses = $this->deliveryAddressesRepository->create($input);

        Flash::success('Delivery  Addresses saved successfully.');

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Display the specified Delivery_Addresses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {

//        $deliveryAddresses = $this->deliveryAddressesRepository->find($id);
        $deliveryAddresses=Delivery_Addresses::where('parent_id',0)->orderby('id','desc');

        if (empty($deliveryAddresses)) {
            Flash::error('Delivery  Addresses not found');

            return redirect(route('deliveryAddresses.index'));
        }

        return view('delivery_addresses.show')->with('deliveryAddresses', $deliveryAddresses);
    }

    /**
     * Show the form for editing the specified Delivery_Addresses.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliveryAddresses = $this->deliveryAddressesRepository->find($id);

        if (empty($deliveryAddresses)) {
            Flash::error('Delivery  Addresses not found');

            return redirect(route('deliveryAddresses.index'));
        }

        return view('delivery_addresses.edit')->with('deliveryAddresses', $deliveryAddresses);
    }

    /**
     * Update the specified Delivery_Addresses in storage.
     *
     * @param int $id
     * @param UpdateDelivery_AddressesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDelivery_AddressesRequest $request)
    {
        $deliveryAddresses = $this->deliveryAddressesRepository->find($id);

        if (empty($deliveryAddresses)) {
            Flash::error('Delivery  Addresses not found');

            return redirect(route('deliveryAddresses.index'));
        }

        $deliveryAddresses = $this->deliveryAddressesRepository->update($request->all(), $id);

        Flash::success('Delivery  Addresses updated successfully.');

        return redirect(route('deliveryAddresses.index'));
    }

    /**
     * Remove the specified Delivery_Addresses from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliveryAddresses = $this->deliveryAddressesRepository->find($id);

        if (empty($deliveryAddresses)) {
            Flash::error('Delivery  Addresses not found');

            return redirect(route('deliveryAddresses.index'));
        }

        $this->deliveryAddressesRepository->delete($id);

        Flash::success('Delivery  Addresses deleted successfully.');

        return redirect(route('deliveryAddresses.index'));
    }
    public function modaldataset($id){
        $data=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->with('getPackage')->withCount('getPackage')->get();

        Session::forget('from_id');
        Session::put('from_id',$id);
        $output="";
        if($data){
            foreach ($data as $d)
            {
                $add1=isset($d->street_add1) ? $d->street_add1 : '';
                     $output.='<tr>'.

                            '<td>'.ucfirst($d->name).'</td>'.

                            '<td>'.ucfirst($d->country).'</td>'.

                            '<td>'.ucfirst($d->street_add).' '.$add1.'</td>'.

                            '<td>'.$d->email.'</td>'.

                            '<td>'.$d->mobile.'</td>'.

                            '<td>'.$d->get_package_count.'</td>'.

                            '<td><a class="btn btn-default btn-xs packagedata" data-id="'.$d->id.'" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i></a></td>'.

                            '</tr>';


            }

            return response()->json(['success' => true, 'message' => $output]);
        }
    }

    public function packagedataset($id){
        $data=Package_Detail::where('to_address_id',$id)->get();
        $output="";
        if($data){
            foreach ($data as $d)
            {
                $dimensions=isset($d->dimensions) ? array_search($d->dimensions,Dimensions::asArray()) : '-';
                $packagekg=isset($d->packagekg) ? array_search($d->packagekg,Packagekg::asArray()) : '-';
                $dimesionl=isset($d->dimesionl) ? $d->dimesionl .''.ucfirst($dimensions) :'-';
                $dimesionw=isset($d->dimesionw) ? $d->dimesionw .''.ucfirst($dimensions) :'-';
                $dimesionh=isset($d->dimesionh) ? $d->dimesionh .''.ucfirst($dimensions) :'-';

                $dvalue=isset($d->dvalue) ? $d->dvalue :'-';
                if($d->image==''){
                $img='';
                }
                else{
                    $img='<img src="'.$d->path .'" height="50px" width="50px">';
                }
                $output.='<tr>'.

                    '<td>' . $d->weight .' '.$packagekg. '</td>' .

                    '<td>' . $dimesionl .'</td>' .

                    '<td>' . $dimesionw.'</td>' .

                    '<td>' . $dimesionh .'</td>' .

                    '<td>' . $dvalue . '</td>' .

                    '<td>'.$img.'</td>' .

                    '<td>' . $d->date . '</td>' .

                    '<td>' . $d->time . '</td>' .

                    '</tr>';


            }

            return response()->json(['success' => true, 'message' => $output]);
        }
    }

    public function storeprice(Request $request)
    {
        $id = Session::get('from_id');
        $price = $request->price;

        $deliveryaddress = Delivery_Addresses::where('id', $id)->update(['price' => $price]);
//        if ($deliveryaddress) {
//            $sendemail = Delivery_Addresses::where('id', $id)->pluck('email');
//
//            $details = [
//                'title' => 'Mail  from vasundhara vision',
//                'price' => $price
//            ];
//            Mail::to($sendemail)->send(new PriceMail($details));
//
//            $sendsms = Delivery_Addresses::where('id', $id)->pluck('mobile')->first();
//            if (env('APP_ENV') == 'local') {
//                return true;
//            }
//            $account_sid = env('ACCOUNT_SID');
//            $auth_token = env('ACCOUNT_TOKEN');
//            $twilio_number = env('MOBILE_NO');
//
//            $phone_no='+91'.$sendsms;
//
//            $client = new Client($account_sid, $auth_token);
//            $client->messages->create(
//                $phone_no,
//                array(
//                    'from' => $twilio_number,
//                    'body' => "Price for your delivery package is ".$price.". Please pay soon."
//                )
//            );

            return response()->json(['success' => true, 'message' => $deliveryaddress]);
//        }
    }
    public function fetch_data(Request $request){
        $deliveryAddresses=Delivery_Addresses::where('parent_id',0)->where('price',null)->where('is_sent_req',1)->with('getPackage')->orderby('id','desc');
        if (isset($request->search) && $request->search != '') {
            $q = $request->search;
            $deliveryAddresses->where(function ($query) use ($q) {
                $query->orwhere('planname', 'LIKE', '%' . $q . '%');
                  $query->orwhereHas('users', function ($val) use ($q) {
                      $val->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$q."%");
                      $val->orwhere('fname', 'LIKE', '%' . $q . '%');
                      $val->orwhere('lname', 'LIKE', '%' . $q . '%');
                  });
            });
        }

        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['newrequest_filter' => array($filter)]);
        $deliveryAddresses = $deliveryAddresses->paginate($request->per_page);

        return view('delivery_addresses.table',compact('filter'))
            ->with('deliveryAddresses', $deliveryAddresses)->render();


    }

}
