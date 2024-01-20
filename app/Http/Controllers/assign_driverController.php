<?php

namespace App\Http\Controllers;

use App\Http\Requests\Createassign_driverRequest;
use App\Http\Requests\Updateassign_driverRequest;
use App\Models\assign_driver;
use App\Models\Company;
use App\Models\Country;
use App\Models\Delivery_Addresses;
use App\Models\Driver;
use App\Models\Package_Detail;
use App\Repositories\assign_driverRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Response;
use Illuminate\Support\Facades\Mail;
use App\Mail\DriverMail;

class assign_driverController extends AppBaseController
{
    /** @var  assign_driverRepository */
    private $assignDriverRepository;

    public function __construct(assign_driverRepository $assignDriverRepo)
    {
        $this->assignDriverRepository = $assignDriverRepo;
    }

    /**
     * Display a listing of the assign_driver.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
//        $assignDrivers = $this->assignDriverRepository->all();
//        $assignDrivers=Delivery_Addresses::where('is_confirmed',1)->where('is_assign',0)->orderby('id','desc')->get();

        $assignDrivers=Delivery_Addresses::where('is_assign',0)->where('is_confirmed',1)->where('parent_id',0)->paginate(10);
        $driverar1=$this->get_driver();

        $driverar = array();

        foreach($driverar1 as $value) {
            if(!in_array($value, $driverar)) {
                $driverar[] = $value;
            }
        }


        $session_filter = session('assigndriver_filter');
        if (!isset($session_filter)) {
            $filter['per_page'] = 20;
        } else {
            $filter['per_page'] = $session_filter[0]['per_page'];
        }
        return view('assign_drivers.index',compact('driverar','filter'))
            ->with('assignDrivers', $assignDrivers);
    }


    public function get_driver(){
        $drivers=Driver::get();
        $driverar=array();
        foreach ($drivers as $driver){
            $chk=assign_driver::where('driver_id',$driver->id)->where('is_delivery_complete',0)->count();
            if($chk==0){
                $assign_drivers=assign_driver::where('driver_id',$driver->id)->get();

                $assign_drivers_cnt=$assign_drivers->count();

                if($assign_drivers_cnt>0){

                    foreach ($assign_drivers as $assign_driver) {

                        $delivery_addresses = Delivery_Addresses::where('parent_id',$assign_driver->from_user_id)->get();
                        $delivery_addresses1=$delivery_addresses->count();
                        $delivery_addresses= Delivery_Addresses::where('parent_id',$assign_driver->from_user_id)->where('is_complete',1)->get();
                        $delivery_addresses2=$delivery_addresses->count();

                        if($delivery_addresses1==$delivery_addresses2){
                            $driverArray=array();
                            $driverArray['id']=$driver->id;
                            $driverArray['fname']=$driver->fname;
                            $driverArray['lname']=$driver->lname;
                            $driverArray['email']=$driver->email;
                            $driverArray['mobile']=$driver->mobile;
                            $driverArray['address']=$driver->address;
                            $driverArray['password']=$driver->password;
                            $driverArray['profile_pic']=$driver->profile_pic;
                            $driverArray['car_make']=$driver->car_make;
                            $driverArray['car_model']=$driver->car_model;
                            $driverArray['year']=$driver->year;
                            $driverArray['car_image']=$driver->car_image;
                            array_push($driverar,$driverArray);
                        }
                    }
                }
                else{
                    $driverArray=array();
                    $driverArray['id']=$driver->id;
                    $driverArray['fname']=$driver->fname;
                    $driverArray['lname']=$driver->lname;
                    $driverArray['email']=$driver->email;
                    $driverArray['mobile']=$driver->mobile;
                    $driverArray['address']=$driver->address;
                    $driverArray['password']=$driver->password;
                    $driverArray['profile_pic']=$driver->profile_pic;
                    $driverArray['car_make']=$driver->car_make;
                    $driverArray['car_model']=$driver->car_model;
                    $driverArray['year']=$driver->year;
                    $driverArray['car_image']=$driver->car_image;
                    array_push($driverar,$driverArray);
                }
            }

        }
        return $driverar;

    }

    /**
     * Show the form for creating a new assign_driver.
     *
     * @return Response
     */
    public function create()
    {
        return view('assign_drivers.create');
    }

    /**
     * Store a newly created assign_driver in storage.
     *
     * @param Createassign_driverRequest $request
     *
     * @return Response
     */
    public function store(Createassign_driverRequest $request)
    {
        $input = $request->all();

        $assignDriver = $this->assignDriverRepository->create($input);

        Flash::success('Assign Driver saved successfully.');

        return redirect(route('assignDrivers.index'));
    }

    /**
     * Display the specified assign_driver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $assignDriver = $this->assignDriverRepository->find($id);

        if (empty($assignDriver)) {
            Flash::error('Assign Driver not found');

            return redirect(route('assignDrivers.index'));
        }

        return view('assign_drivers.show')->with('assignDriver', $assignDriver);
    }

    /**
     * Show the form for editing the specified assign_driver.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $assignDriver = $this->assignDriverRepository->find($id);

        if (empty($assignDriver)) {
            Flash::error('Assign Driver not found');

            return redirect(route('assignDrivers.index'));
        }

        return view('assign_drivers.edit')->with('assignDriver', $assignDriver);
    }

    /**
     * Update the specified assign_driver in storage.
     *
     * @param int $id
     * @param Updateassign_driverRequest $request
     *
     * @return Response
     */
    public function update($id, Updateassign_driverRequest $request)
    {
        $assignDriver = $this->assignDriverRepository->find($id);

        if (empty($assignDriver)) {
            Flash::error('Assign Driver not found');

            return redirect(route('assignDrivers.index'));
        }

        $assignDriver = $this->assignDriverRepository->update($request->all(), $id);

        Flash::success('Assign Driver updated successfully.');

        return redirect(route('assignDrivers.index'));
    }

    /**
     * Remove the specified assign_driver from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $assignDriver = $this->assignDriverRepository->find($id);

        if (empty($assignDriver)) {
            Flash::error('Assign Driver not found');

            return redirect(route('assignDrivers.index'));
        }

        $this->assignDriverRepository->delete($id);

        Flash::success('Assign Driver deleted successfully.');

        return redirect(route('assignDrivers.index'));
    }

    public function assign_driver_data(Request $request){
        $input=array();
        $input['driver_id']=$request->driverid;
        $input['from_user_id']=$request->fromuserid;
        $pkgid=Delivery_Addresses::where('id',$request->fromuserid)->orwhere('parent_id',$request->fromuserid)->pluck('id');
        $pkgdata=Package_Detail::whereIn('to_address_id',$pkgid)->get();
        $toarr = array(
            "From Location A" => "MyformFrom",
            "To Location B" => "MyformTo0" ,
            "To Location C" => "MyformTo1" ,
            "To Location D" => "MyformTo2" ,
            "To Location E" => "MyformTo3" ,
            "To Location F" => "MyformTo4" ,
            "To Location G" => "MyformTo5" ,
            "To Location H" => "MyformTo6" ,
            "To Location I" => "MyformTo7" ,
            "To Location J" => "MyformTo8" ,
            "To Location K" => "MyformTo9" ,
            "To Location L" => "MyformTo10",
            "To Location M" => "MyformTo11",
            "To Location N" => "MyformTo12",
            "To Location O" => "MyformTo13",
        );

        //only that addresses from where packages will be take
        $ids=array();
        foreach ($pkgdata as $p) {
            $p->place=trim($p->place);
            if (array_key_exists($p->place,$toarr)) {        //check there are all addresses from where package has to be taken
                $form=$toarr[$p->place];
                $id=Delivery_Addresses::whereIn('id',$pkgid)->where('to_form',$form)->pluck('id')->first();
                array_push($ids, $id);
            }
        }

        $deliveryadd=Delivery_Addresses::whereIn('id',$ids)->get();

        $data=assign_driver::create($input);
        if($data){

            Delivery_Addresses::where('id', $data->from_user_id)->update(['is_assign' => true]);
            Delivery_Addresses::where('parent_id', $data->from_user_id)->update(['is_assign' => true]);
            $myEmail = Driver::where('id',$input['driver_id'])->pluck('email')->first();
            $fromdata=Delivery_Addresses::where('id',$input['from_user_id'])->get();
//            $todata=Delivery_Addresses::where('parent_id',$input['from_user_id'])->orderby('id')->get();

            $details = [
                'title' => 'Mail from Delivery In Hour',
                'fromdata' => $fromdata->toArray(),
                'todata' => $deliveryadd->toArray()
            ];

            Mail::to($myEmail)->send(new DriverMail($details));

            return response()->json(['success' => true, 'message' => 'Driver Assign Successfully']);
        }else{
            return response()->json(['success' => false, 'message' => 'Driver Not Assign']);
        }
    }
    public function getCountry($countryid)
    {
        return Country::where('id',$countryid)->pluck('name')->first();
    }
    public function getCompany($companyid)
    {
        return Company::where('id',$companyid)->pluck('name')->first();
    }

    public function fetch_data(Request $request){
        $assignDrivers=Delivery_Addresses::where('is_assign',0)->where('is_confirmed',1)->where('parent_id',0);
        $driverar1=$this->get_driver();

        $driverar = array();

        foreach($driverar1 as $value) {
            if(!in_array($value, $driverar)) {
                $driverar[] = $value;
            }
        }

        if (isset($request->search) && $request->search != '') {
            $q = $request->search;
            $assignDrivers->where(function ($query) use ($q) {
                $query->orwhere('planname', 'LIKE', '%' . $q . '%');
                $query->orwhere('mobile', 'LIKE', '%' . $q . '%');
                $query->orwhere('email', 'LIKE', '%' . $q . '%');
                $query->orwhereHas('users', function ($val) use ($q) {
                    $val->where(DB::raw("CONCAT(`fname`, ' ', `lname`)"), 'LIKE', "%".$q."%");
                    $val->orwhere('fname', 'LIKE', '%' . $q . '%');
                    $val->orwhere('lname', 'LIKE', '%' . $q . '%');
                });;
            });
        }

        $filter = array();
        $filter['per_page'] = $request->per_page;
        session(['assigndriver_filter' => array($filter)]);
        $assignDrivers = $assignDrivers->paginate($request->per_page);
        return view('assign_drivers.table',compact('driverar','filter'))
            ->with('assignDrivers', $assignDrivers);
    }

}
