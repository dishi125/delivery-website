<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createdelivery_completionRequest;
use App\Http\Requests\Updatedelivery_completionRequest;
use App\Models\assign_driver;
use App\Models\Delivery_Addresses;
use App\Models\Driver;
use App\Repositories\delivery_completionRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Object_;
use Response;

class delivery_completionController extends AppBaseController
{
    /** @var  delivery_completionRepository */
    private $deliveryCompletionRepository;

    public function __construct(delivery_completionRepository $deliveryCompletionRepo)
    {
        $this->deliveryCompletionRepository = $deliveryCompletionRepo;
    }

    /**
     * Display a listing of the delivery_completion.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $deliveryCompletions = $this->deliveryCompletionRepository->all();
        $froms=Delivery_Addresses::where('parent_id',0)->where('is_sent_req',1)->get();
        $fromArray=array();
        foreach ($froms as $from){
            $tos1=Delivery_Addresses::where('id',$from->id)->orwhere('parent_id',$from->id)->count();
            $tos2=Delivery_Addresses::where('is_complete',0)->where('id',$from->id)->orwhere('parent_id',$from->id)->where('is_complete',0)->count();
//            dd($from->toArray(),$tos1,$tos2);
            if($tos1!=$tos2){
                $driver=assign_driver::where('from_user_id',$from->id)->first();
                $ddata=Driver::where('id',$driver->driver_id)->first();

                $tempar=array();
                $tempar['id']=$from->id;
                $tempar['fname']=$from->FirstName;
                $tempar['lname']=$from->LastName;
                $tempar['company']=$from->company_id;
                $tempar['planname']=$from->planname;
                $tempar['driverid']=$ddata->id;
                $tempar['driverfname']=$ddata->fname;
                $tempar['driverlname']=$ddata->lname;
                $tempar['country']=$from->country;
                $tempar['street_add']=$from->street_add;
                $tempar['mobile']=$from->mobile;
                $tempar['email']=$from->email;
                array_push($fromArray,$tempar);
            }
        }
        $session_filter = session('deliverycomplete_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        $fromArray1 = $this->paginate($fromArray,20);
        return view('delivery_completions.index',compact('fromArray1','filter'));
    }
    public function paginate($items,$perPage)
    {
        $pageStart = \Illuminate\Support\Facades\Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
    /**
     * Show the form for creating a new delivery_completion.
     *
     * @return Response
     */
    public function create()
    {
        return view('delivery_completions.create');
    }

    /**
     * Store a newly created delivery_completion in storage.
     *
     * @param Createdelivery_completionRequest $request
     *
     * @return Response
     */
    public function store(Createdelivery_completionRequest $request)
    {
        $input = $request->all();

        $deliveryCompletion = $this->deliveryCompletionRepository->create($input);

        Flash::success('Delivery Completion saved successfully.');

        return redirect(route('deliveryCompletions.index'));
    }

    /**
     * Display the specified delivery_completion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $deliveryCompletion = $this->deliveryCompletionRepository->find($id);

        if (empty($deliveryCompletion)) {
            Flash::error('Delivery Completion not found');

            return redirect(route('deliveryCompletions.index'));
        }

        return view('delivery_completions.show')->with('deliveryCompletion', $deliveryCompletion);
    }

    /**
     * Show the form for editing the specified delivery_completion.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $deliveryCompletion = $this->deliveryCompletionRepository->find($id);

        if (empty($deliveryCompletion)) {
            Flash::error('Delivery Completion not found');

            return redirect(route('deliveryCompletions.index'));
        }

        return view('delivery_completions.edit')->with('deliveryCompletion', $deliveryCompletion);
    }

    /**
     * Update the specified delivery_completion in storage.
     *
     * @param int $id
     * @param Updatedelivery_completionRequest $request
     *
     * @return Response
     */
    public function update($id, Updatedelivery_completionRequest $request)
    {
        $deliveryCompletion = $this->deliveryCompletionRepository->find($id);

        if (empty($deliveryCompletion)) {
            Flash::error('Delivery Completion not found');

            return redirect(route('deliveryCompletions.index'));
        }

        $deliveryCompletion = $this->deliveryCompletionRepository->update($request->all(), $id);

        Flash::success('Delivery Completion updated successfully.');

        return redirect(route('deliveryCompletions.index'));
    }

    /**
     * Remove the specified delivery_completion from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $deliveryCompletion = $this->deliveryCompletionRepository->find($id);

        if (empty($deliveryCompletion)) {
            Flash::error('Delivery Completion not found');

            return redirect(route('deliveryCompletions.index'));
        }

        $this->deliveryCompletionRepository->delete($id);

        Flash::success('Delivery Completion deleted successfully.');

        return redirect(route('deliveryCompletions.index'));
    }

    public function deliverycompletemodaldata($id){
        $ids=app(\App\Http\Controllers\PagesController::class)->only_to_address_data($id);
//        $data=Delivery_Addresses::where('is_complete',1)->where('id',$id)->orwhere('parent_id',$id)->where('is_complete',1)->orderby('id','asc')->get();
        $data=Delivery_Addresses::whereIn('id',$ids)->where('is_complete',1)->orderby('id','asc')->get();
        $output="";
        $complete=$data->count();

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

                    '<td><img src="'.$d->deliverycompic .'" height="50px" width="50px"></td>' .

                    '<td>'.$d->updated_at.'</td>'.

                    '</tr>';

            }
            $alldata=Delivery_Addresses::whereIn('id',$ids)->count();
//            $pending=$alldata-$complete;
            return response()->json(['success' => true, 'message' => $output,'complete' => $complete,'all' => $alldata]);
        }
    }

    public function fetch_data(Request $request){
        $fromsdata=Delivery_Addresses::where('parent_id',0)->where('is_sent_req',1);

        if (isset($request->search) && $request->search != '') {
            $q = $request->search;
            $froms=$fromsdata->where(function ($query) use ($q) {
                $query->orwhere('planname', 'LIKE', '%' . $q . '%');
                $query->orwhereHas('users', function ($val) use ($q) {
                    $val->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$q."%");
                    $val->orwhere('fname', 'LIKE', '%' . $q . '%');
                    $val->orwhere('lname', 'LIKE', '%' . $q . '%');
                });
                $query->orwhereHas('assigndrivers.drivers', function ($val) use ($q) {
                    $val->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$q."%");
                    $val->orwhere('fname', 'LIKE', '%' . $q . '%');
                    $val->orwhere('lname', 'LIKE', '%' . $q . '%');
                });
            })->get();

        }
        else {
            $froms = $fromsdata->get();
        }

        $fromArray=array();

        foreach ($froms as $from){
            $tos1=Delivery_Addresses::where('id',$from->id)->orwhere('parent_id',$from->id)->count();
            $tos2=Delivery_Addresses::where('is_complete',0)->where('id',$from->id)->orwhere('parent_id',$from->id)->where('is_complete',0)->count();

            if($tos1!=$tos2){
                $driver=assign_driver::where('from_user_id',$from->id)->first();
                $ddata=Driver::where('id',$driver->driver_id)->first();


                $tempar=array();
                $tempar['id']=$from->id;
                $tempar['fname']=$from->FirstName;
                $tempar['lname']=$from->LastName;
                $tempar['company']=$from->company_id;
                $tempar['planname']=$from->planname;
                $tempar['driverid']=$ddata->id;
                $tempar['driverfname']=$ddata->fname;
                $tempar['driverlname']=$ddata->lname;
                $tempar['country']=$from->country;
                $tempar['street_add']=$from->street_add;
                $tempar['mobile']=$from->mobile;
                $tempar['email']=$from->email;
                array_push($fromArray,$tempar);

            }
        }
        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['deliverycomplete_filter' => array($filter)]);

        $fromArray1 = $this->paginate($fromArray,$request->per_page);
        return view('delivery_completions.table',compact('fromArray1','filter'))->render();

    }
}
