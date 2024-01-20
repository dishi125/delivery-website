<?php

namespace App\Http\Controllers;

use App\Enums\Dimensions;
use App\Enums\Packagekg;
use App\Helpers\CommonHelper;
use App\Mail\DeliveryCompleteMail;
use App\Models\assign_driver;
use App\Models\CarModel;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Driver;
use App\Models\Delivery_Addresses;
use App\Models\Driver_review;
use App\Models\Package_Detail;
use App\Models\Province;
use App\Models\Temp_delivery_addresses;
use App\Models\Temp_packages;
use App\Models\User_review;
use App\Models\Web_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Psy\Util\Json;
use function Sodium\compare;
use Illuminate\Support\Facades\Http;

class PagesController extends Controller
{
    public function signup(Request $request){
        return view ('frontend/signup');
    }

    public function sendOtp(Request $request){
        try {
            $input=$request->all();
            $ct=null;
            if($request->metch=="User")
            {
                $input['mobile']= $input['mobile'];
            }elseif ($request->metch=="Driver")
            {
                $input['mobile']= $input['mobile1'];
            }else{
                $ct=$input['mobile1']??null;
//                $input['mobile']= $input['mobile1'].$input['mobile'];
            }

            $otp = CommonHelper::sendOtp( $input['mobile'],$ct);
            $input['otp']=$otp;
            Session::put('OTP', $otp);
            return response()->json(['success' => true, 'message' => 'OTP Sent Successfully.']);

        }catch (\Exception $e)
        {
            return response()->json(['success' => false, 'message' => '<br><p style="color:red">Please check mobile number.</p>']);
        }

    }
    public function otpVerified(Request $request)
        {
               $otp= Session::get('OTP');

               if( ($request->otp ?? $request->otp1 + 0) == $otp)
               {
                   die('true');
               }
            die('false');
        }

    public function verifyotp(Request $request)
    {
        $otp= Session::get('OTP');

        if( ($request->otp ?? $request->otp1 + 0) == $otp)
        {
//            die('true');
            return ['success'=>true];
        }
//        die('false');
        return ['success'=>false];
    }

    public function index(Request $request){
        $country=Country::get();
        $company=Company::get();
        return view ('frontend/index',compact('country','company'));
    }
    public function signin(Request $request){
        return view ('frontend/signin');
    }

    public function home_user(Request $request){
        $id=Session::get('Userid')[0];

        $data=Web_User::where('id',$id)->get();
        $data=$data[0];
        return view ('frontend/home_user',compact('data'));
    }

    public function home_driver(Request $request){
        $id=Session::get('Driverid')[0];
        $data=Driver::where('id',$id)->get();
        $data=$data[0];
        return view ('frontend/home_driver',compact('data'));
    }

    public function otp(Request $request){
        return view ('frontend/otp');
    }

    public function request_list(Request $request){
        //display requested plan where is_sent_req=1
        $userid=Session::get('Userid')[0];
        $listdata=Delivery_Addresses::where('user_id',$userid)->where('parent_id',0)->where('is_sent_req',1)->orderBy('id','desc')->get();

        foreach ($listdata as $list) {

            $ids = $this->only_to_address_data($list->id);
            $chkdata = Delivery_Addresses::whereIn('id', $ids)->pluck('is_complete'); //accept only that data where delivery of package will done.

            if (count($ids) == 1) { //when there is only 1 package exists
                if ($list->is_confirmed == 1 && $list->is_assign == 0) {//is_confirmed=1 means payment done,is_assign=0 means driver not assign.
                    $list->status = "Payment Done";
                }
                elseif ($list->is_confirmed == 1 && $list->is_assign == 1 && $list->is_complete == 0) {//when payment done,driver assign,but request not complete in from 2 delivery address
                    if (in_array(0, $chkdata->toArray(), true)) {//check if complete status 1 or not from chkdata
                        $list->status = "Running"; //if 0 found then running status apply
                    } else {
                        $list->status = "Completed"; //if 1 found then complete status apply
                    }
                }
                else{
                    $list->status = "Pending";
                }
            } else { //when more than 1 package exists

                if ($list->is_confirmed == 1 && $list->is_assign == 0) {
                    $list->status = "Payment Done";
                } elseif ($list->is_confirmed == 1 && $list->is_assign == 1 && $list->is_complete == 1) {

                    if (in_array(0, $chkdata->toArray(), true)) {
                        $list->status = "Running";
                    } else {
                        $list->status = "Completed";
                    }
                } elseif ($list->is_confirmed == 1 && $list->is_assign == 1 ) {
                    $list->status = "Running";
                } else {
                    $list->status = "Pending";
                }

            }
        }

        $data=Web_User::where('id',$userid)->first();

        return view ('frontend/request_list',compact('data','listdata'));
    }

    public function forgot_otp(Request $request){
        return view ('frontend/forgot_otp');
    }

    public function reset_password(Request $request){
        return view ('frontend/reset_password');
    }

    public function approval_request(Request $request){
        $id=Session::get('Userid')[0];

        $data=Web_User::where('id',$id)->with(['addresses'=>function($q){
            $q->where('is_confirmed',false)->where('parent_id',0)->where('price','!=',null)->orderby('id');
        }])->first();

        return view ('frontend/approval_request',compact('data'));
    }

    public function new_request(Request $request){
        $id=Session::get('Userid')[0];
        $country=Country::get();
        $company=Company::get();
        $fromdata=Web_User::where('id',$id)->first();
        return view ('frontend/new_request',compact('country','company','fromdata'));
    }

    public function packages($cnt_to){ //not in use
        $cnt1_to=$cnt_to;
        return view ('frontend/package_detail',compact('cnt1_to'));
    }

    public function index_packages($cnt_to){ //not in use
        $cnt1_to=$cnt_to;
        return view ('frontend/index_package',compact('cnt1_to'));
    }

    public function payment_approval_form(Request $request){
        $data=Delivery_Addresses::where('id',$request->payment_radio)->get();
        $data=$data[0];
        return view ('frontend/approval_payment',compact('data'));
    }

    public function assign_request(Request $request){
        $driverid=Session::get('Driverid')[0];

        //is_delivery_complete define where all delivery by particular driver id done or not
        $fromid=assign_driver::where('driver_id',$driverid)->where('is_delivery_complete',0)->pluck('from_user_id')->first();

        $ids1=$this->only_to_address_data($fromid);

        $todata=Delivery_Addresses::whereIn('id',$ids1)->where('is_complete',0)->with('getPackage')->get();//fetch delivery data ,will display to driver

        if(!$todata->isEmpty()) {
            $fromdata = Delivery_Addresses::where('id', $fromid)->get();
        }
        else{
            $fromdata=array();
        }
        return view('frontend/assign_request',compact('fromdata','todata'));
    }
    public function assign_requestdata($id){
        $todata=Delivery_Addresses::where('is_complete',0)->where('id',$id)->orwhere('parent_id',$id)->where('is_complete',0)->with('getPackage')->withcount('getPackage')->get();
        return view('frontend/assign_requestdata',compact('todata'));
    }

    public function delivery_complete_form($id){
        $data=Delivery_Addresses::where('id',$id)->first();
        $parentid=$data->parent_id;
        if($parentid==0){
            $pid=$id;//if parent_id is 0 then the parent of it will be itself
        }
        else{
            $pid=$parentid;
        }
        return view('frontend/request_driver',compact('data','id','pid'));
    }

    public function delivery_complete(Request $request){
        $input=array();
        if (!empty($request->file('image'))) {
            $image = $request->file('image');
            $destinationPath = public_path('images/complete_photo');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['delivery_cmppic'] = $imagePath;
        }
        $input['is_complete']=1;//update status
        $data = Delivery_Addresses::where('id', $request->toid)->update($input);
        $to = Delivery_Addresses::where('id', $request->toid)->first();

        //update status is_delivery_complete=1 ,if all delivery completed
        if($to->parent_id==0 ){
            $fid=$to->id;
        }
        else{
            $fid=Delivery_Addresses::where('id', $to->parent_id)->pluck('id')->first();
        }
        $ids=$this->only_to_address_data($fid);
        $cnt=Delivery_Addresses::whereIn('id',$ids)->count();

        $cmpcnt=Delivery_Addresses::whereIn('id',$ids)->where('is_complete',1)->count();

        if($cnt==$cmpcnt) { //if all is_complete status =1 then update status
            assign_driver::where('from_user_id', $fid)->update(['is_delivery_complete' => 1]);
        }

        if($to->parent_id==0){ //parent_id is 0 then no need to send mail to 2 person
            $emails=[$to->email];
        }
        else {
            $fromid = Delivery_Addresses::where('id', $to->parent_id)->first();//parent_id is not 0 then send mail to parent user and user itself
            $emails = [$fromid->email, $to->email];
        }
        $details = [
            'title' => 'Mail from Delivery In Hour',
            'name' => $to->name,
            'address' => $to->street_add,
            'contact_no' => $to->mobile
        ];
        Mail::to($emails)->send(new DeliveryCompleteMail($details));

        if($data){
            $pid=Delivery_Addresses::where('id',$request->toid)->pluck('parent_id')->first();
            if($pid==0){
                $pid=$request->toid;
                $did=Delivery_Addresses::where('id',$request->toid)->pluck('user_id')->first();
            }
            else{
                $did=Delivery_Addresses::where('id',$pid)->pluck('user_id')->first();
            }
            $data=Web_User::where('id',$did)->first();
            $id=assign_driver::where('from_user_id',$pid)->pluck('driver_id')->first();
            $to_id=$request->toid;

            return view('frontend/comment_by_driver',compact('data','id','to_id'));//after delivery complete redirect to review page with parent user data
        }
    }

    public function review($id){
        $did=assign_driver::where('from_user_id',$id)->pluck('driver_id')->first();
        $data=Driver::where('id',$did)->get();
        $data=$data[0];
        return view('frontend/comment',compact('data','id'));
    }


    public function submitreview(Request $request)
    {
        $input=array();
        $uid=Delivery_Addresses::where('id',$request->id)->pluck('user_id')->first();
        $input['driver_id']=$request->reviewid;
        $input['user_id']=$uid;
        $input['rate']=$request->val;
        $input['comment']=$request->comment;
        $data=Driver_review::create($input);
        if($data){
            $message="Thanks For Your Review";
        }
        else{
            $message="Sorry Your Review Can't Send";
        }
        Session::forget('flashmsg');
        Session::put('flashmsg',$message);
        return redirect('/request_list');
    }

    public function driver_submit_review(Request $request)
    {
        $input=array();
        $input['user_id']=$request->reviewid;
        $input['driver_id']=$request->id;
        $input['to_user_id']=$request->to_id;
        $input['rate']=$request->val;
        $input['comment']=$request->comment;
        $data=User_review::create($input);
        if($data){
            $message="Thanks For Your Review";
        }
        else{
            $message="Sorry Your Review Can't Send";
        }
        Session::forget('flashmsg');
        Session::put('flashmsg',$message);
        return redirect('/assign_request');
    }

    public function store_data(Request $request){
        $userid=Session::get('Userid')[0];
        $maindata=$request->all();

        $input1=array();
        $input1['to_form'] =$request->formname;
        $input1['name'] =$request->name1;
        $input1['user_id'] =$userid;
        $input1['company_id'] = $request->company1;
        $input1['country_id'] = $request->country1;
        $input1['province'] = $request->province1=="Province/Territory/State"?null:$request->province1;
//        $input1['city'] = $request->city1=="City"?null:$request->city1;
        $input1['city'] = isset($request->city1)?$request->city1:null;
        $input1['postalcode'] = $request->postalcode1;
        $input1['street_add'] = $request->toaddress;
        $input1['street_add1'] = $request->toaddress1;
        $input1['mobile'] = $request->mobile;
        $input1['mobile1'] = $request->mobile1;
        $input1['email'] = $request->email1;
        $input1['sms_verification'] = $request->sms1;
        $input1['lat'] = $request->lat;
        $input1['long'] = $request->long;
        $data=Temp_delivery_addresses::create($input1);//insert from data first

        $loccnt=$request->loccnt;
        $pkgcnt=$request->pkgcnt;
        $pid=$data->id;
        //new request session
        Session::put('new_request_id',$pid);

        $myValue=  array();
        if($data){

            for($i=1;$i<=$loccnt;$i++){//insert to data
                $input=array();
                $ind="toform".$i;
                parse_str($maindata[$ind],$myValue);
                $input['parent_id'] =$pid;
                $input['to_form'] =$myValue['formname'];
                $input['name'] =$myValue['name'];
                $input['user_id'] =$userid;
                $input['company_id'] = $myValue['company']==''? null : $myValue['company'];
                $input['country_id'] = $myValue['country'];
                $input['province'] = $myValue['province']=="Province/Territory/State"?null:$myValue['province'];
//                $input['city'] = $myValue['city']=="City"?null:$myValue['city'];
                $input['city'] = isset($myValue['city'])?$myValue['city']:null;
                $input['postalcode'] = $myValue['postalcode']==''?null:$myValue['postalcode'];
                $input['street_add'] = $myValue['address'];
                $input['street_add1'] = $myValue['address1']==''? null : $myValue['address1'];
                $input['mobile'] = $myValue['mobile_number'];
                $input['mobile1'] = isset($myValue['mobile_number1']) ? $myValue['mobile_number1'] : null;
                $input['email'] = $myValue['email'];
                $input['sms_verification'] = $myValue['sms'] ?? "0000";
                $input['lat'] = $myValue['lat'];
                $input['long'] = $myValue['long'];
                $data1=Temp_delivery_addresses::create($input);
            }
        }

        if($data1){
            for($p=1;$p<=$pkgcnt;$p++){ //insert package data
                $input1=array();
                $ind="packagedata".$p;
                parse_str($maindata[$ind],$myValue);
                $pkgimg="pkgimage".$p;
                if(isset($maindata[$pkgimg])){
                    $file = $maindata[$pkgimg];
                    $destinationPath = public_path('images/packageimg');
                    $imagePath = rand(000, 999) . time() . "." . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $imagePath);
                    $input1['image'] = $imagePath;
                } else {
                    $input1['image'] = "";
                }

                if($myValue['location']=="MyformFrom"){
                    $to_id=Temp_delivery_addresses::where('id',$pid)->pluck('id')->first();//if location is from then fetch id from temp table
                }
                else{
                    $to_id=Temp_delivery_addresses::where('parent_id',$pid)->where('to_form',$myValue['location'])->pluck('id')->first();
                }
                $input1['to_address_id'] = $to_id;
                $input1['location'] = $myValue['location'];
                $input1['place'] = $myValue['place'];
                $input1['packagecnt'] = $myValue['pkgcnt'];
                $input1['weight'] = $myValue['weight'];
                $input1['packagekg'] = $myValue['packagekg'];
                $input1['dimesionl'] = $myValue['dimesionl']==''? null : $myValue['dimesionl'];
                $input1['dimesionw'] = $myValue['dimesionw']==''? null : $myValue['dimesionw'];
                $input1['dimesionh'] = $myValue['dimesionh']==''? null : $myValue['dimesionh'];
                $input1['dimesions'] = $myValue['dimensions'];
                $input1['dvalue'] = $myValue['dvalue']==''? null : $myValue['dvalue'];
                $input1['date'] = $myValue['date'];
                $input1['time'] = $myValue['time'];

                $data2=Temp_packages::create($input1);
            }
        }
        if($data2){
            return response()->json(['success' => true, 'message' => 'Package Data Inserted successfully']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'From Data Not Inserted']);
        }

    }

    public function setaddresssuggestion($add){
        $response =  Http::get('https://nominatim.openstreetmap.org/search?q='.$add.'&format=json');//call address api
        $jsonData = $response->json();
        $output="";
        foreach ($jsonData as $jdata){
            $output.='<li><i class="fa fa-map-marker" aria-hidden="true" style="padding-right: 5px"></i>'.$jdata['display_name'].'<input type="text" name="suggestlat" style="display:none;" value="'.$jdata['lat'].'"><input type="text" name="suggestlong" style="display:none;" value="'.$jdata['lon'].'"></li>';
        }
        return response()->json(['success' => true, 'message' => $output]);
    }

    public function store_index_data1(Request $request){
        $maindata=$request->all();
        $input1=array();
        $input1['to_form'] =$request->formname;
        $input1['name'] =$request->name1;
        $input1['company_id'] = $request->company1;
        $input1['country_id'] = $request->country1;
        $input1['province'] = $request->province1=="Province/Territory/State"?null:$request->province1;
//        $input1['city'] = $request->city1=="City"?null:$request->city1;
        $input1['city'] = isset($request->city1)?$request->city1:null;
        $input1['postalcode'] = $request->postalcode1;
        $input1['street_add'] = $request->toaddress;
        $input1['street_add1'] = $request->toaddress1;
        $input1['mobile'] = $request->mobile;
        $input1['mobile1'] = $request->mobile1;
        $input1['email'] = $request->email1;
        $input1['sms_verification'] = $request->sms1;
        $input1['lat'] = $request->lat;
        $input1['long'] = $request->long;
        $data=Temp_delivery_addresses::create($input1);

        $loccnt=$request->loccnt;
        $pkgcnt=$request->pkgcnt;
        $pid=$data->id;
        Session::put('index_userid',$pid);
        $myValue=  array();
        if($data){

            for($i=1;$i<=$loccnt;$i++){
                $input=array();
                $ind="toform".$i;
                parse_str($maindata[$ind],$myValue);
                $input['parent_id'] =$pid;
                $input['to_form'] =$myValue['formname'];
                $input['name'] =$myValue['name'];
                $input['company_id'] = $myValue['company']==''? null : $myValue['company'];
                $input['country_id'] = $myValue['country'];
                $input['province'] = $myValue['province']=="Province/Territory/State"?null:$myValue['province'];
//                $input['city'] = $myValue['city']=="City"?null:$myValue['city'];
                $input['city'] = isset($myValue['city'])?$myValue['city']:null;
                $input['postalcode'] = $myValue['postalcode']==''?null:$myValue['postalcode'];
                $input['street_add'] = $myValue['address'];
                $input['street_add1'] = $myValue['address1']==''? null : $myValue['address1'];
                $input['mobile'] = $myValue['mobile_number'];
                $input['mobile1'] = isset($myValue['mobile_number1']) ? $myValue['mobile_number1'] : null;
                $input['email'] = $myValue['email'];
                $input['sms_verification'] = $myValue['sms'] ?? 0000;
                $input['lat'] = $myValue['lat'];
                $input['long'] = $myValue['long'];
                $data1=Temp_delivery_addresses::create($input);
            }
        }

        if($data1){
            for($p=1;$p<=$pkgcnt;$p++){
                $input1=array();
                $ind="packagedata".$p;
                parse_str($maindata[$ind],$myValue);
                $pkgimg="pkgimage".$p;
                if(isset($maindata[$pkgimg])){
                    $file = $maindata[$pkgimg];
                    $destinationPath = public_path('images/packageimg');
                    $imagePath = rand(000, 999) . time() . "." . $file->getClientOriginalExtension();
                    $file->move($destinationPath, $imagePath);
                    $input1['image'] = $imagePath;
                } else {
                    $input1['image'] = "";
                }

                if($myValue['location']=="MyformFrom"){
                    $to_id=Temp_delivery_addresses::where('id',$pid)->pluck('id')->first();//if location is from then fetch id from temp table
                }
                else{
                    $to_id=Temp_delivery_addresses::where('parent_id',$pid)->where('to_form',$myValue['location'])->pluck('id')->first();
                }
                $input1['to_address_id'] = $to_id;
                $input1['location'] = $myValue['location'];
                $input1['place'] = $myValue['place'];
                $input1['packagecnt'] = $myValue['pkgcnt'];
                $input1['weight'] = $myValue['weight'];
                $input1['packagekg'] = $myValue['packagekg'];
                $input1['dimesionl'] = $myValue['dimesionl']==''? null : $myValue['dimesionl'];
                $input1['dimesionw'] = $myValue['dimesionw']==''? null : $myValue['dimesionw'];
                $input1['dimesionh'] = $myValue['dimesionh']==''? null : $myValue['dimesionh'];
                $input1['dimesions'] = $myValue['dimensions'];
                $input1['dvalue'] = $myValue['dvalue']==''? null : $myValue['dvalue'];
                $input1['date'] = $myValue['date'];
                $input1['time'] = $myValue['time'];

                $data2=Temp_packages::create($input1);
            }
        }
        if($data2){
            return response()->json(['success' => true, 'message' => 'Package Data Inserted successfully']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'From Data Not Inserted']);
        }

    }


    public function display_link_plan(){
//        dd("hello");
        $pid=Session::get('index_userid');
//        $pid=7;
        $data=$this->manual_plan_data($pid);
        $ndadata=$data[0];
        $linkdata=$data[1];


        return view('frontend/display_link_plan',compact('ndadata','linkdata','pid'));
    }

    public function new_manual_plan(){
        $pid=Session::get('new_request_id');
        $data=$this->manual_plan_data($pid);
        $ndadata=$data[0];
        $linkdata=$data[1];
        return view('frontend/display_manual_plan',compact('ndadata','linkdata','pid'));
    }

    public function gmapsdata(){
        $fromid=Session::get('index_userid');
//        $fromid=11;
        $fromdata=Temp_delivery_addresses::where('id',$fromid)->orwhere('parent_id',$fromid)->withCount('getPackage')->orderBy('id')->get();
//        $fromdata=Delivery_Addresses::where('id',$fromid)->orwhere('parent_id',$fromid)->withCount('getPackage')->with('getPackage')->get();

        $toarr = array(
            "From Location A" => 0,
            "To Location B" => 1,
            "To Location C" => 2,
            "To Location D" => 3,
            "To Location E" => 4,
            "To Location F" => 5,
            "To Location G" => 6,
            "To Location H" => 7,
            "To Location I" => 8,
            "To Location J" => 9,
            "To Location K" => 10,
            "To Location L" => 11,
            "To Location M" => 12,
            "To Location N" => 13,
            "To Location O" => 14,
        );
        $fromto = array(
            "MyformFrom" => "Location A",
            "MyformTo0"  => "Location B",
            "MyformTo1"  => "Location C",
            "MyformTo2"  => "Location D",
            "MyformTo3"  => "Location E",
            "MyformTo4"  => "Location F",
            "MyformTo5"  => "Location G",
            "MyformTo6"  => "Location H",
            "MyformTo7"  => "Location I",
            "MyformTo8"  => "Location J",
            "MyformTo9"  => "Location K",
            "MyformTo10"  => "Location L",
            "MyformTo11"  => "Location M",
            "MyformTo12"  => "Location N",
            "MyformTo13"  => "Location O"
        );

        $arrindex=array();
        foreach ($fromdata as $frm){
            array_push($arrindex,$frm->id);
        }
        $alldata=array();
        foreach ($fromdata as $frm){

            foreach ($frm->getPackage as $f) {

                $temarr=array();
                $togrp = $toarr[trim($f->place)];
                $toid = $arrindex[$togrp];
                $from=$fromdata->where('id',$toid)->first();

                $tempatob = $fromto[trim($frm->to_form)];
                $tempbtoa = $fromto[trim($from->to_form)];
                $color=  '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);

                $temarr['location_id']=$toid;//placeid
                $temarr['package_id']=$f->id;
                $temarr['to_address_id']=$f->to_address_id;
                $temarr['location']=$f->location;
                $temarr['place']=$f->place;
                $temarr['packagecnt']=$f->packagecnt;
                $temarr['color']=$color;
                $temarr['fromlat']=$from->lat;
                $temarr['fromlong']=$from->long;
                $temarr['tolat']=$frm->lat;
                $temarr['tolong']=$frm->long;
                $temarr['atobdata']=$tempbtoa.'->'.$tempatob;

                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$temarr['fromlat'].",".$temarr['fromlong']."&destinations=".$temarr['tolat'].",".$temarr['tolong']."&mode=driving&key=".env('GOOGLE_API_KEY');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response, true);
                if(!isset($response_a['rows'][0]['elements'][0]['status']) || $response_a['rows'][0]['elements'][0]['status']=='ZERO_RESULTS'){
                    $time=0;
                    $km=0;
                }else{
                    // time in second
                    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
                    $km= $response_a['rows'][0]['elements'][0]['distance']['text'];
                }
                $temarr['time']=$time;
                $temarr['km']=$km;

                array_push($alldata,$temarr);
            }
        }


        return view('frontend/gmap',compact('fromdata','alldata'));
    }

    public function newgmapsdata(){
        $fromid=Session::get('new_request_id');

        $fromdata=Temp_delivery_addresses::where('id',$fromid)->orwhere('parent_id',$fromid)->withCount('getPackage')->orderBy('id')->get();

        $toarr = array(
            "From Location A" => 0,
            "To Location B" => 1,
            "To Location C" => 2,
            "To Location D" => 3,
            "To Location E" => 4,
            "To Location F" => 5,
            "To Location G" => 6,
            "To Location H" => 7,
            "To Location I" => 8,
            "To Location J" => 9,
            "To Location K" => 10,
            "To Location L" => 11,
            "To Location M" => 12,
            "To Location N" => 13,
            "To Location O" => 14,
        );
        $fromto = array(
            "MyformFrom" => "Location A",
            "MyformTo0"  => "Location B",
            "MyformTo1"  => "Location C",
            "MyformTo2"  => "Location D",
            "MyformTo3"  => "Location E",
            "MyformTo4"  => "Location F",
            "MyformTo5"  => "Location G",
            "MyformTo6"  => "Location H",
            "MyformTo7"  => "Location I",
            "MyformTo8"  => "Location J",
            "MyformTo9"  => "Location K",
            "MyformTo10"  => "Location L",
            "MyformTo11"  => "Location M",
            "MyformTo12"  => "Location N",
            "MyformTo13"  => "Location O"
        );
        $arrindex=array();
        foreach ($fromdata as $frm){
            array_push($arrindex,$frm->id);
        }

        $alldata=array();
        foreach ($fromdata as $frm){

            foreach ($frm->getPackage as $f) {

                $temarr=array();
                $togrp = $toarr[trim($f->place)];
                $toid = $arrindex[$togrp];
                $from=$fromdata->where('id',$toid)->first();

                $tempatob = $fromto[trim($frm->to_form)];
                $tempbtoa = $fromto[trim($from->to_form)];
                $color=  '#' . substr(str_shuffle('ABCDEF0123456789'), 0, 6);

                $temarr['location_id']=$toid;//placeid
                $temarr['package_id']=$f->id;
                $temarr['to_address_id']=$f->to_address_id;
                $temarr['location']=$f->location;
                $temarr['place']=$f->place;
                $temarr['packagecnt']=$f->packagecnt;
                $temarr['color']=$color;
                $temarr['fromlat']=$from->lat;
                $temarr['fromlong']=$from->long;
                $temarr['tolat']=$frm->lat;
                $temarr['tolong']=$frm->long;
                $temarr['atobdata']=$tempbtoa.'->'.$tempatob;

                $url = "https://maps.googleapis.com/maps/api/distancematrix/json?origins=".$temarr['fromlat'].",".$temarr['fromlong']."&destinations=".$temarr['tolat'].",".$temarr['tolong']."&mode=driving&key=".env('GOOGLE_API_KEY');
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                $response = curl_exec($ch);
                curl_close($ch);
                $response_a = json_decode($response, true);
                if(!isset($response_a['rows'][0]['elements'][0]['status']) || $response_a['rows'][0]['elements'][0]['status']=='ZERO_RESULTS'){
                    $time=0;
                    $km=0;
                }else{
                    // time in second
                    $time = $response_a['rows'][0]['elements'][0]['duration']['text'];
                    $km= $response_a['rows'][0]['elements'][0]['distance']['text'];
                }
                $temarr['time']=$time;
                $temarr['km']=$km;

                array_push($alldata,$temarr);
            }
        }
//        dd($alldata);
        return view('frontend/newgmap',compact('fromdata','alldata'));
    }

    public function edit_index_data($id){
        return view('edit_index');
    }

    public function store_main_data(Request $request){
        $pid=Session::get('index_userid');
        if($pid!=null){
            $data=Temp_delivery_addresses::where('id',$pid)->first();
            $chkuser=Web_User::where('email',$data->email)->count();
            if($chkuser==1){
                return redirect('signin');
            }
            else{
                return redirect('signup');
            }

        }
    }
    public function getmodels(Request $request){
        $name=$request->name;
        $select=$request->select;
        $models =[""=>"Select Model Name"] + CarModel::where('car_make_name',$name)->pluck('name','name')->toarray();
        $html="";
        foreach ($models as $k=>$model)
        {
            $html= $html." <option    val='".$k."' ".  ((isset($select) && $k==$select)  ? 'selected' : '') .">".$model."</option>";
        }
        return $html;
    }
    public function manual_plan_data($pid){
        $cnt=0;
        $asc=66;
        $arr=array();
        $arr1=array();

        $toarr = array(
            "MyformFrom" => "From Location A",
            "MyformTo0"  => "To Location B",
            "MyformTo1"  => "To Location C",
            "MyformTo2"  => "To Location D",
            "MyformTo3"  => "To Location E",
            "MyformTo4"  => "To Location F",
            "MyformTo5"  => "To Location G",
            "MyformTo6"  => "To Location H",
            "MyformTo7"  => "To Location I",
            "MyformTo8"  => "To Location J",
            "MyformTo9"  => "To Location K",
            "MyformTo10"  => "To Location L",
            "MyformTo11"  => "To Location M",
            "MyformTo12"  => "To Location N",
            "MyformTo13"  => "To Location O"
        );

        $colorarr = array(
            "From Location A" => 'maroon',
            "To Location B" => 'red',
            "To Location C" => 'green',
            "To Location D" => 'blue',
            "To Location E" => 'pink',
            "To Location F" => 'black',
            "To Location G" => 'brown',
            "To Location H" => 'grey',
            "To Location I" => 'Burgundy',
            "To Location J" => 'Copper',
            "To Location K" => 'Chocolate',
            "To Location L" => 'Orange',
            "To Location M" => 'Rose',
            "To Location N" => 'Taupe',
            "To Location O" => 'Violet'
        );


        $data=Temp_delivery_addresses::where('parent_id',$pid)->orwhere('id',$pid)->with('getPackage')->get();
        $nda=Temp_delivery_addresses::where('parent_id',$pid)->get();
        $fromdata=Temp_delivery_addresses::where('id',$pid)->first();//for store array of fromdata

        $tempitems=array();//for store array of fromdata
        array_push($tempitems,"Name: ".$fromdata->name);
        array_push($tempitems,"Country : ".$fromdata->Country);
        array_push($tempitems,"Address: ".$fromdata->street_add);
        array_push($tempitems,"Mobile: ".$fromdata->mobile);
        array_push($tempitems,"Email: ".$fromdata->email);


        $fromloc=array();//for store array of fromdata
        $fromloc['key']="From Location A";
        $fromloc['isGroup']=true;
        $fromloc['items']=$tempitems;
        $fromloc['color']="#FFC56C";
        array_push($arr,$fromloc);

        foreach ($nda as $nd){//for store array of todata
            $temp=array();
            $tempitems=array();
            array_push($tempitems,"Name: ".$nd->name);
            array_push($tempitems,"Country : ".$nd->Country);
            array_push($tempitems,"Address: ".$nd->street_add);
            array_push($tempitems,"Mobile: ".$nd->mobile);
            array_push($tempitems,"Email: ".$nd->email);

            $to_form="To Location ".chr($asc);
            $temp['key']=$to_form;
            $temp['isGroup']=true;
            $temp['items']=$tempitems;
            $temp['color']="#FFC56C";
            array_push($arr,$temp);
            $cnt++;
            $asc++;
        }

        foreach ($data as $d){//array for package data
            foreach ($d->getPackage as $p){
                $temp=array();
                $tempitems=array();
                $packagekg=isset($p->packagekg) ? array_search($p->packagekg,Packagekg::asArray()) : '-';
                $dimensions=isset($p->dimesions) ? array_search($p->dimesions,Dimensions::asArray()) : '-';

                array_push($tempitems,"Weight: ".$p->weight." ".$packagekg);
                array_push($tempitems,"DeliverTo: ". $toarr[$p->location]);

                if($p->dimesionl!=null){
                    array_push($tempitems,"Length: ". $p->dimesionl." ".$dimensions);
                }
                if($p->dimesionw!=null){
                    array_push($tempitems,"Width: ". $p->dimesionw." ".$dimensions);
                }
                if($p->dimesionh!=null){
                    array_push($tempitems,"Height: ". $p->dimesionh." ".$dimensions);
                }
                if($p->dvalue!=null){
                    array_push($tempitems,"Dvalue: ". $p->dvalue);
                }

                $temp['key']=$p->packagecnt;
                $temp['group']=trim($p->place);
                $temp['items']=$tempitems;
                $temp['color']="#FFC56C";
                array_push($arr,$temp);
            }
        }

        foreach ($data as $d) { //array for linkdata of diagram
            foreach ($d->getPackage as $p) {
                $temp1=array();
                if (array_key_exists($p->location,$toarr)) {//ex:- $p->location=MyformFrom, then will check in toarr MyformFrom exists or not
                    if (array_key_exists($toarr[$p->location],$colorarr)) {//ex:- $toarr[$p->location]=From Location A, then will check in $colorarr, "From Location A" exists or not
                        $togrp = $toarr[$p->location];
                        $temp1['from'] = $p->packagecnt;
                        $temp1['to'] = $togrp;
                        $temp1['color']=$colorarr[$togrp];
                        array_push($arr1, $temp1);
                    }
                }
            }
        }

        $returndata=array();
        $ndadata=json_encode($arr,true);
        $ndadata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$ndadata);
        $linkdata=json_encode($arr1,true);
        $linkdata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$linkdata);
        array_push($returndata,$ndadata);
        array_push($returndata,$linkdata);

        return $returndata;
    }
    public function save_request_plan(Request $request){
        $fromid=Session::get('new_request_id');
        if($request->req=="save"){ //if request only save then on save
            $data=Temp_delivery_addresses::where('id',$fromid)->update(['planname' => $request->planname]);
        }else if($request->req=="request"){//if request for sent to admin then save plan and sent request to admin
            $data=Temp_delivery_addresses::where('id',$fromid)->update(['planname' => $request->planname,'is_sent_req' => true]);
        }

        if($data){
            if($request->req=="save"){
                return response()->json(['success' => true, 'message' => 'Plan Saved Successfully']);
            }
            else{
                return response()->json(['success' => true, 'message' => 'Plan Request Sent Successfully']);
            }

        }
        else{
            return response()->json(['success' => false, 'message' => 'Plan Not Saved']);
        }

    }
    public function editrequest($id){
        $country=Country::get();
        $fromdata=Temp_delivery_addresses::where('id',$id)->with('getPackage')->first();
        $todata=Temp_delivery_addresses::where('parent_id',$id)->with('getPackage')->first();

        $allloc=Temp_delivery_addresses::where('parent_id',$id)->get();

        $pkg=Temp_delivery_addresses::where('id',$id)->orwhere('parent_id',$id)->pluck('id');
        $pkgall=Temp_packages::whereIn('to_address_id',$pkg)->get();
        $idm=Temp_packages::whereIn('to_address_id',$pkg)->where('packagecnt','Package 1')->pluck('id');
        $pkgfirst=Temp_packages::where('packagecnt','Package 1')->where('id',$idm)->first();
        $pkgcount=$pkgall->count();


        $toarr = array(
            "MyformFrom" => "From Location A",
            "MyformTo0"  => "To Location B",
            "MyformTo1"  => "To Location C",
            "MyformTo2"  => "To Location D",
            "MyformTo3"  => "To Location E",
            "MyformTo4"  => "To Location F",
            "MyformTo5"  => "To Location G",
            "MyformTo6"  => "To Location H",
            "MyformTo7"  => "To Location I",
            "MyformTo8"  => "To Location J",
            "MyformTo9"  => "To Location K",
            "MyformTo10"  => "To Location L",
            "MyformTo11"  => "To Location M",
            "MyformTo12"  => "To Location N",
            "MyformTo13"  => "To Location O"
        );

        if (array_key_exists($pkgfirst->location,$toarr)) {
            $pkgfirst->location1=$toarr[$pkgfirst->location];
            $pkgfirst->time = date("g:i a", strtotime($pkgfirst->time));
            $pkgfirst->newdate = \DateTime::createFromFormat('Y-m-d h:i:s', $pkgfirst->date)->format('d-m-Y');
        }

        foreach ($pkgall as $pkg){
            if (array_key_exists($pkg->location,$toarr)) {
                $pkg->location1=$toarr[$pkg->location];
            }
            $pkg->time = date("g:i a", strtotime($pkg->time));
            $pkg->newdate = \DateTime::createFromFormat('Y-m-d h:i:s', $pkg->date)->format('d-m-Y');
        }

        return view ('frontend/editrequest',compact('fromdata','country','todata','pkgfirst','allloc','pkgall','pkgcount'));

    }
    public function only_to_address_data($fromid){
        $alldata=Delivery_Addresses::where('id',$fromid)->orwhere('parent_id',$fromid)->get();

        $ids=array();
        foreach ($alldata as $t){
            array_push($ids,$t->id);
        }
        $mids=Package_Detail::whereIn('to_address_id',$ids)->get();

        $ids1=array();
        foreach ($mids as $t){
            if(!in_array($t->to_address_id, $ids1, true)) {
                array_push($ids1, $t->to_address_id);
            }
        }
        //it will return only that delivery address id where package delivery will be done
        return $ids1;
    }

    public function getprovinces(Request $request){
        $id=$request->id;
        $name=Country::where('id',$id)->pluck('name')->first();
        $select=$request->select;
        $models =[""=>"Province/Territory/State"] + Province::where('country_name',$name)->pluck('name','name')->toarray();
        $html="";
        foreach ($models as $k=>$model)
        {
            $html= $html." <option val='".$k."' ".  ((isset($select) && $k==$select)  ? 'selected' : '') .">".$model."</option>";
        }

        return ["provincedata"=>$html];
    }

    public function getcities(Request $request){
//        $id=$request->id;
//        $name=Country::where('id',$id)->pluck('name')->first();
        $select=$request->select;

        $models1 =[""=>"City"] + City::where('province_name',$request->name)->pluck('name','name')->toarray();
        $html1="";
        foreach ($models1 as $k1=>$model1)
        {
            $html1= $html1." <option val='".$k1."' ".  ((isset($select) && $k1==$select)  ? 'selected' : '') .">".$model1."</option>";
        }
        return ["citydata"=>$html1];
    }

    public function addcountries(){
        ini_set('max_execution_time', -1);
        $all_countries=DB::table('all_countries')->pluck('name');
        foreach ($all_countries as $ac){
            $country=new Country();
            $country->name=$ac;
            $country->save();
        }
        return "done";
    }

    public function addprovinces(){
        ini_set('max_execution_time', -1);
        $all_states=DB::table('states')->get(['name','country_id']);
        foreach ($all_states as $as){
            $cname=DB::table('all_countries')->where('id',$as->country_id)->pluck('name')->first();
            $province=new Province();
            $province->country_name=$cname;
            $province->name=$as->name;
            $province->save();
        }
        return "done";
    }

}


