<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createpending_deliveryRequest;
use App\Http\Requests\Updatepending_deliveryRequest;
use App\Models\assign_driver;
use App\Models\Delivery_Addresses;
use App\Models\Driver;
use App\Repositories\pending_deliveryRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\DB;
use Response;

class pending_deliveryController extends AppBaseController
{
    /** @var  pending_deliveryRepository */
    private $pendingDeliveryRepository;

    public function __construct(pending_deliveryRepository $pendingDeliveryRepo)
    {
        $this->pendingDeliveryRepository = $pendingDeliveryRepo;
    }

    /**
     * Display a listing of the pending_delivery.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $pendingDeliveries = $this->pendingDeliveryRepository->all();
        $froms=Delivery_Addresses::where('parent_id',0)->get();
        $fromArray=array();
        foreach ($froms as $from){
            $ids=app(\App\Http\Controllers\PagesController::class)->only_to_address_data($from->id);

            $tos1=Delivery_Addresses::whereIn('id',$ids)->where('is_assign',1)->count();
            $tos2=Delivery_Addresses::whereIn('id',$ids)->where('is_assign',1)->where('is_complete',1)->count();
            if($tos1!=$tos2){
                $driver=assign_driver::where('from_user_id',$from->id)->first();
                $ddata=Driver::where('id',$driver->driver_id)->first();

                $tempar=array();
                $tempar['id']=$from->id;
                $tempar['fname']=$from->FirstName;
                $tempar['lname']=$from->LastName;
                $tempar['planname']=$from->planname;
                $tempar['driverid']=$ddata->id;
                $tempar['driverfname']=$ddata->fname;
                $tempar['driverlname']=$ddata->lname;
                $tempar['company']=$from->company_id;
                $tempar['country']=$from->country;
                $tempar['street_add']=$from->street_add;
                $tempar['mobile']=$from->mobile;
                $tempar['email']=$from->email;
                array_push($fromArray,$tempar);
            }
        }
        $session_filter = session('deliverypending_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        $fromArray1 = $this->paginate($fromArray);
        return view('pending_deliveries.index',compact('fromArray1','filter'));
    }
    public function paginate($items,$perPage=10)
    {
        $pageStart = \Illuminate\Support\Facades\Request::get('page', 1);
        // Start displaying items from this number;
        $offSet = ($pageStart * $perPage) - $perPage;
        // Get only the items you need using array_slice
        $itemsForCurrentPage = array_slice($items, $offSet, $perPage, true);
        return new LengthAwarePaginator($itemsForCurrentPage, count($items), $perPage,Paginator::resolveCurrentPage(), array('path' => Paginator::resolveCurrentPath()));
    }
    /**
     * Show the form for creating a new pending_delivery.
     *
     * @return Response
     */
    public function create()
    {
        return view('pending_deliveries.create');
    }

    /**
     * Store a newly created pending_delivery in storage.
     *
     * @param Createpending_deliveryRequest $request
     *
     * @return Response
     */
    public function store(Createpending_deliveryRequest $request)
    {
        $input = $request->all();

        $pendingDelivery = $this->pendingDeliveryRepository->create($input);

        Flash::success('Pending Delivery saved successfully.');

        return redirect(route('pendingDeliveries.index'));
    }

    /**
     * Display the specified pending_delivery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $pendingDelivery = $this->pendingDeliveryRepository->find($id);

        if (empty($pendingDelivery)) {
            Flash::error('Pending Delivery not found');

            return redirect(route('pendingDeliveries.index'));
        }

        return view('pending_deliveries.show')->with('pendingDelivery', $pendingDelivery);
    }

    /**
     * Show the form for editing the specified pending_delivery.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $pendingDelivery = $this->pendingDeliveryRepository->find($id);

        if (empty($pendingDelivery)) {
            Flash::error('Pending Delivery not found');

            return redirect(route('pendingDeliveries.index'));
        }

        return view('pending_deliveries.edit')->with('pendingDelivery', $pendingDelivery);
    }

    /**
     * Update the specified pending_delivery in storage.
     *
     * @param int $id
     * @param Updatepending_deliveryRequest $request
     *
     * @return Response
     */
    public function update($id, Updatepending_deliveryRequest $request)
    {
        $pendingDelivery = $this->pendingDeliveryRepository->find($id);

        if (empty($pendingDelivery)) {
            Flash::error('Pending Delivery not found');

            return redirect(route('pendingDeliveries.index'));
        }

        $pendingDelivery = $this->pendingDeliveryRepository->update($request->all(), $id);

        Flash::success('Pending Delivery updated successfully.');

        return redirect(route('pendingDeliveries.index'));
    }

    /**
     * Remove the specified pending_delivery from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $pendingDelivery = $this->pendingDeliveryRepository->find($id);

        if (empty($pendingDelivery)) {
            Flash::error('Pending Delivery not found');

            return redirect(route('pendingDeliveries.index'));
        }

        $this->pendingDeliveryRepository->delete($id);

        Flash::success('Pending Delivery deleted successfully.');

        return redirect(route('pendingDeliveries.index'));
    }

    public function deliverypendingmodaldata($id){
        $ids=app(\App\Http\Controllers\PagesController::class)->only_to_address_data($id);
        $data=Delivery_Addresses::whereIn('id',$ids)->where('is_complete',0)->orderby('id','desc')->get();
        $output="";
        $pending=$data->count();
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

                    '</tr>';

            }
            $alldata=Delivery_Addresses::whereIn('id',$ids)->count();

//            $pending=$alldata-$complete;
            return response()->json(['success' => true, 'message' => $output,'pending' => $pending,'all' => $alldata]);
        }
    }

    public function driver_data($id){
        $data=Driver::where('id',$id)->first();
        $output="";
        if($data->profile_pic==''){
            $profile_pic='';
        }
        else{
            $profile_pic='<img src="'.$data->Profile .'" height="50px" width="50px">';
        }

        if($data->car_image==''){
            $car_image='';
        }
        else{
            $car_image='<img src="'.$data->Carimg.'" height="100px" width="100px">';
        }

        $output.='<tr>'.

            '<td>'.ucfirst($data->fname).' '.ucfirst($data->lname).'</td>'.

            '<td>'.$data->email.'</td>'.

            '<td>'.$data->mobile.'</td>'.

            '<td>'.$data->address.'</td>'.

            '<td>'.$profile_pic.'</td>'.

            '<td>'.ucfirst($data->car_make).'</td>'.

            '<td>'.ucfirst($data->car_model).'</td>'.

            '<td>'.$car_image.'</td>'.

            '</tr>';
        if($output){
            return response()->json(['success' => true, 'message' => $output]);
        }
        else{
            return response()->json(['success' => false, 'message' => "Data not found"]);
        }

    }

    public function fetch_data(Request $request){
        $fromsdata=Delivery_Addresses::where('parent_id',0);

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
            $ids=app(\App\Http\Controllers\PagesController::class)->only_to_address_data($from->id);

            $tos1=Delivery_Addresses::whereIn('id',$ids)->where('is_assign',1)->count();
            $tos2=Delivery_Addresses::whereIn('id',$ids)->where('is_assign',1)->where('is_complete',1)->count();
            if($tos1!=$tos2){
                $driver=assign_driver::where('from_user_id',$from->id)->first();
                $ddata=Driver::where('id',$driver->driver_id)->first();

                $tempar=array();
                $tempar['id']=$from->id;
                $tempar['fname']=$from->FirstName;
                $tempar['lname']=$from->LastName;
                $tempar['planname']=$from->planname;
                $tempar['driverid']=$ddata->id;
                $tempar['driverfname']=$ddata->fname;
                $tempar['driverlname']=$ddata->lname;
                $tempar['company']=$from->company_id;
                $tempar['country']=$from->country;
                $tempar['street_add']=$from->street_add;
                $tempar['mobile']=$from->mobile;
                $tempar['email']=$from->email;
                array_push($fromArray,$tempar);
            }
        }
        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['deliverypending_filter' => array($filter)]);

        $fromArray1 = $this->paginate($fromArray,$request->per_page);
        return view('pending_deliveries.table',compact('fromArray1','filter'));
    }
}
