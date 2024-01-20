<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Mail\DriverEmailVerification;
use App\Mail\ForgotPassword;
use App\Mail\UserEmailVerification;
use App\Models\Delivery_Addresses;
use App\Models\Driver;
use App\Models\Package_Detail;
use App\Models\Temp_delivery_addresses;
use App\Models\Temp_packages;
use App\Models\Web_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Laracasts\Flash\Flash;

class LoginRegisterController extends Controller
{
    public function register_user(Request $request)
    {
        $input = array();
        $input['fname'] = $request->fname;
        $input['lname'] = $request->lname;
        $input['email'] = $request->email;
        $input['mobile'] = $request->mobile;
        $input['address'] = $request->address;
        $input['password'] = Hash::make($request['password']);


        if (!empty($request->file('profile_web'))) {

            $image = $request->file('profile_web');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profile');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['profile_pic'] = $imagePath;
        } else {
            $input['profile_pic'] = "";
        }
        $otp = CommonHelper::sendOtp( $input['mobile']);
        $input['otp']=$otp;
        Session::put('registerdata', $input);//store data in session and store it permanently after user enter correct otp

        if ($otp!=null) {
            return redirect('otp');
        }


    }

    public function register_driver(Request $request)
    {
        $input = array();

        $input['fname'] = $request->fname1;
        $input['lname'] = $request->lname1;
        $input['email'] = $request->email1;
        $input['mobile'] = $request->mobile1;
        $input['address'] = $request->address1;
        $input['password'] = Hash::make($request->password1);



        if (!empty($request->file('profile_driver'))) {

            $image = $request->file('profile_driver');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profile');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['profile_pic'] = $imagePath;
        } else {
            $input['profile_pic'] = "";
        }

        $input['car_make'] = $request->cmake;
        $input['car_model'] = $request->modelnm;
        $input['year'] = $request->year;

        if (!empty($request->file('carimage'))) {

            $image = $request->file('carimage');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/car_images');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['car_image'] = $imagePath;
        } else {
            $input['car_image'] = "";
        }

        $otp = CommonHelper::sendOtp( $input['mobile']);
        $input['otp']=$otp;
        session()->forget('dregisterdata');
        Session::put('dregisterdata', $input);//store data in session and store it permanently after driver enter correct otp
        if ($otp!=null) {
            return redirect('otp?of=driver');
        }
    }

    public function login_driver(Request $request)
    {
        $cnt = Driver::where('email', $request->email)->count();
        $id = Driver::where('email', $request->email)->pluck('id');
        if ($cnt == 1) {
            $user = Driver::where('id', $id)->get();

            if (Hash::check($request->password, $user[0]->password)) {
                Session::put('Driverid', $id);
                return response()->json(['success' => true, 'User' => 'Driver', 'message' => 'Login Successful.']);
            } else {
                return response()->json(['success' => false, 'message' => 'The password is incorrect.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Email Id Not Registered.']);
        }
    }

    public function login_user(Request $request)
    {
        $cnt = Web_User::where('email', $request->email)->count();
        $id = Web_User::where('email', $request->email)->pluck('id');
        if ($cnt == 1) {
            $user = Web_User::where('id', $id)->get();

            if (Hash::check($request->password, $user[0]->password)) {
                Session::put('Userid', $id);
                if(Session::has('index_userid')){ //if user insert data before login from index page then check session nd store all data
                    $sessionid=Session::get('index_userid');
                    $data=Temp_delivery_addresses::where('id',$sessionid)->first();
                    $email=$data->email;
                    $chk=Web_User::where('email',$email)->count();
                    if($chk==1){
                        if($request->email==$email) {
                            $userid = $user[0]->id;
                            if ($data->is_sent_req == 1) {
                                $message = 'Plan Request Sent Successfully.';
                            } else {
                                $message = 'Plan Saved Successfully.';
                            }
                            $res = $this->store_temp_data($userid, $sessionid);
                            if ($res == true) {
                                Session::forget('flashmsg');
                                Session::put('flashmsg', $message);
                            }
                        }
                        else{
                            return response()->json(['success' => true, 'User' => 'Web_user', 'message' => 'Login Successful.']);
                        }
                    }
                }

                return response()->json(['success' => true, 'User' => 'Web_user', 'message' => 'Login Successful.']);
            } else {
                return response()->json(['success' => false, 'message' => 'The password is incorrect.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Email Id Not Registered.']);
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/signin');
    }

    public function submitotp(Request $request)
    {
        /* --@yogita
        $otp=Session::get('registerdata')['otp'];
        $input=$request->all();
        $input1=array();
        $inputotp=$this->otpcheck($input);*/
        $otp = Session::get('OTP');
        $input = $request->all();
        $input1 = array();
        $inputotp = $request->otp;

        if ($otp == $inputotp) {//compare otp


            if (!empty($request->file('profile_web'))) {

                $image = $request->file('profile_web');
//            $ext = $image->getClientOriginalExtension();
                $destinationPath = public_path('images/profile');
                $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $input1['profile_pic'] = $imagePath;
            } else {
                $input1['profile_pic'] = "";
            }
            $input1['fname'] = $request->fname; // Session::get('registerdata')['fname'];
            $input1['lname'] = $request->lname; //Session::get('registerdata')['lname'];
            $input1['email'] = $request->email; //Session::get('registerdata')['email'];
            $input1['mobile'] = $request->mobile; //Session::get('registerdata')['mobile'];
            $input1['address'] = $request->address; //Session::get('registerdata')['address'];
            $input1['password'] = Hash::make($request->password); //Session::get('registerdata')['password'];
            //   $input1['profile_pic'] = Session::get('registerdata')['profile_pic'];
            $data = Web_User::create($input1);//if otp same then store data of user
            Mail::to($request->email)->send(new UserEmailVerification($data));
            session()->forget('registerdata');
            if ($data) {
                if (Session::has('index_userid')) {//if user insert data before registration from index page then store that data in permanent table
                    $sessionid = Session::get('index_userid');
                    $chkdata = Temp_delivery_addresses::where('id', $sessionid)->first();
                    $email = $chkdata->email;
                    $chk = Web_User::where('email', $email)->count();
                    if ($chk == 1) {
                        if($data->email==$email) {
                            $userid = $data->id;
                            if ($chkdata->is_sent_req == 1) {
                                $message = 'Plan Request Sent Successfully.';
                            } else {
                                $message = 'Plan Saved Successfully.';
                            }
                            $res = $this->store_temp_data($userid, $sessionid);

                            if ($res == true) {
                                Session::forget('flashmsg');
                                Session::put('flashmsg', $message);
                                return redirect('home_user');
                            }
                        }
                        else{
                            return redirect('home_user');
                        }
                    }
                    else{

                        return redirect('signin');
                    }
                }
                else{
                    return redirect('signin');
                }
            }
        }
        else{
            return redirect()->back();
        }
    }
    public function set_package($userid){ //not in use
        $input1=array();
        $input1['user_id'] = $userid;
        $input1['name'] = Session::get('index_from_address')['name1'];
        $input1['company_id'] = Session::get('index_from_address')['company1'];
        $input1['country_id'] = Session::get('index_from_address')['country1'];
        $input1['street_add'] = Session::get('index_from_address')['toaddress'];
        $input1['street_add1'] = Session::get('index_from_address')['toaddress1'];
        $input1['mobile'] = Session::get('index_from_address')['mobile'];
        $input1['mobile1'] = Session::get('index_from_address')['mobile1'];
        $input1['email'] = Session::get('index_from_address')['email1'];
        $input1['sms_verification'] = Session::get('index_from_address')['sms1'];

        $fromdata=Delivery_Addresses::create($input1);
        $fromid=$fromdata->id;
        $count=Session::get('index_from_address')['cnt_to'];
        $todata=Session::get('index_to_address');
        $pkgcnt=$count;

        //insert data from "index_to_address" session and insert with corresponding package of it
        foreach ($todata as $to){
            $input2=array();
            $input3=array();

            $input2['user_id'] = $userid;
            $input2['parent_id'] = $fromid;
            $input2['name'] = $to['name'];
            $input2['company_id'] = $to['company'];
            $input2['country_id'] = $to['country'];
            $input2['street_add'] = $to['address'];
            $input2['street_add1'] = $to['address1'];
            $input2['mobile'] = $to['mobile_number'];
            $input2['mobile1'] = $to['mobile_number1'];
            $input2['email'] = $to['email'];
            $input2['sms_verification'] = $to['sms'];
            $todata=Delivery_Addresses::create($input2);
            $to_id=$todata->id;


            //fetch package data from session.which store in reverse number ,so fetch maximum first and store it first.
            if($pkgcnt>0){
                $pkdata=null;
                $pkdata=Session::get('store_packagedata'.$pkgcnt);

                $input3['to_address_id'] = $to_id;
                $input3['weight'] = $pkdata['weight'];
                $input3['packagekg'] = $pkdata['packagekg'];
                $input3['dimesionl'] = $pkdata['dimesionl'];
                $input3['dimesionw'] = $pkdata['dimesionw'];
                $input3['dimesionh'] = $pkdata['dimesionh'];
                $input3['dimensions'] = $pkdata['dimensions'];
                $input3['dvalue'] = $pkdata['dvalue'];
                $input3['image'] = $pkdata['image'];
                $input3['date'] = $pkdata['date'];
                $input3['time'] = $pkdata['time'];

                $pkg=Package_Detail::create($input3);
                $pkgcnt=$pkgcnt-1;
            }

        }
        if($pkg){
            return true;
        }
        else{
            return false;
        }

    }

    public function driverotp(Request $request)
    {
//        $otp=Session::get('dregisterdata');
//        $input=$request->all();
//        $input1=array();
//        $inputotp=$this->otpcheck($input);
        $otp = Session::get('OTP');
        $input = $request->all();
        $input1 = array();
        $inputotp = $request->otp1 + 0;
        if ($otp == $inputotp) {//compare otp
            if (!empty($request->file('profile_driver'))) {

                $image = $request->file('profile_driver');
//            $ext = $image->getClientOriginalExtension();
                $destinationPath = public_path('images/profile');
                $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $input1['profile_pic'] = $imagePath;
            } else {
                $input1['profile_pic'] = "";
            }



            if (!empty($request->file('carimage'))) {

                $image = $request->file('carimage');
//            $ext = $image->getClientOriginalExtension();
                $destinationPath = public_path('images/car_images');
                $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $input1['car_image'] = $imagePath;
            } else {
                $input1['car_image'] = "";
            }
            if (!empty($request->file('insuranceimage'))) {
                $image = $request->file('insuranceimage');
                $destinationPath = public_path('images/insurance_images');
                $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $input1['insuranc_image'] = $imagePath;
            } else {
                $input1['insuranc_image'] = "";
            }
            if (!empty($request->file('licenceimage'))) {
                $image = $request->file('licenceimage');
                $destinationPath = public_path('images/licence_images');
                $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $input1['licence_image'] = $imagePath;
            } else {
                $input1['licence_image'] = "";
            }
            $input1['fname'] = $request->fname1;//Session::get('dregisterdata')['fname'];
            $input1['lname'] = $request->lname1;//Session::get('dregisterdata')['lname'];
            $input1['email'] = $request->email1;//Session::get('dregisterdata')['email'];
            $input1['mobile'] = $request->mobile1;//Session::get('dregisterdata')['mobile'];
            $input1['address'] = $request->address1;//Session::get('dregisterdata')['address'];
            $input1['password'] = Hash::make($request->password1);//Session::get('dregisterdata')['password'];
            $input1['car_make'] =$request->cmake; //Session::get('dregisterdata')['car_make'];
            $input1['car_model'] = $request->cmake;//Session::get('dregisterdata')['car_model'];
            $input1['year'] = $request->year;//Session::get('dregisterdata')['year'];
            $input1['regno'] = $request->regno1;
            $input1['insuranceno'] = $request->insuranceno1;
            $input1['licenceno'] = $request->licenceno1;
            $data = Driver::create($input1);

            Mail::to($request->email1)->send(new DriverEmailVerification($data));
//            session()->forget('dregisterdata');
            if($data){
                return  redirect('signin');
            }

        }
        else{
            return redirect()->back()->withInput($input);
        }

    }

    public function verified_email(Request $request){
        if($request->driver) {
            $data = Driver::find($request->id);
        }else
        {
            $data =Web_User::find($request->id);
        }
        $user=1;
        if(!$data)
        {
            $user=0;
        }
        if( strtotime($data->created_at) ==$request->token)
        {
            if( $data->is_email_verified==1)
            {
                return  redirect('signin');
            }
            $data->is_email_verified=1;
            $data->save();

        }else {
            $user = 0;
        }
        return view('verified_email')->with('user',$user);
    }


    public function otpcheck($otparray){
        $input=array();
        array_push($input,$otparray['digit1']);
        array_push($input,$otparray['digit2']);
        array_push($input,$otparray['digit3']);
        array_push($input,$otparray['digit4']);
        $digit=implode("",$input);
        $inputotp=((integer)$digit);//convert otp page input value into integer
        return $inputotp;
    }
    public function checkuseremail(Request $request)
    {
        $chk=Web_User::where('email',$request->email)->first();

        if ($chk) {
            die('false');
        } else {
            die('true');
        }
    }
    public function checkdriveremail(Request $request)
    {
        $chk=Driver::where('email',$request->email1)->first();

        if ($chk) {
            die('false');
        } else {
            die('true');

        }
    }
    public function resend_otp_to_user()
    {
        $mobile=Session::get('registerdata')['mobile'];

        $otp = CommonHelper::sendOtp( $mobile);

        if($otp){
            $registerdata=Session::get('registerdata');
            $registerdata['otp'] = $otp;
            Session::put('registerdata', $registerdata);
            return response()->json(['success' => true, 'message' => 'OTP Sent Successfully.']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'OTP Dont Sent.']);
        }
    }
    public function resend_otp_to_driver()
    {
        $mobile=Session::get('dregisterdata')['mobile'];

        $otp = CommonHelper::sendOtp( $mobile);

        if($otp){
            $dregisterdata=Session::get('dregisterdata');
            $dregisterdata['otp'] = $otp;
            Session::put('dregisterdata', $dregisterdata);

            return response()->json(['success' => true, 'message' => 'OTP Sent Successfully.']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'OTP Dont Sent.']);
        }
    }
    public function forget_user_password(Request $request){
        $email=$request->email;

        if(!empty($email)){
            $cnt = Web_User::where('email', $email)->count();
            if($cnt==1){
                $input=array();

                $user="web_user";
                $mno=Web_User::where('email',$email)->pluck('mobile')->first();
                $id=Web_User::where('email',$email)->pluck('id')->first();

                $otp=CommonHelper::sendOtp($mno);
                if($otp){
//                $view=view('frontend/forgot_otp',compact('id','user','otp'))->render();
                    array_push($input,$user);
                    array_push($input,$id);
                    array_push($input,$otp);
                    Session::put('forgot_pdata',$input);
                    return response()->json(['success' => true, 'message' => 'OTP Sent Successfully']);
                }
            }
            else{
                return response()->json(['success' => false, 'message' => 'Email Id Not Registered.']);
            }
        }
        else{
            return response()->json(['success' => false, 'message' => 'Kindly enter email id for reset password!!!']);
        }
    }
    public function forget_driver_password(Request $request){
        $email=$request->email1;
        if (!empty($email)) {
            $cnt = Driver::where('email', $email)->count();

            if($cnt==1) {
                $input = array();

                $user = "driver";
                $mno = Driver::where('email', $email)->pluck('mobile')->first();
                $id = Driver::where('email', $email)->pluck('id')->first();

                $otp = CommonHelper::sendOtp($mno);
                if ($otp) {
//                $view=view('frontend/forgot_otp',compact('id','user','otp'))->render();
                    array_push($input, $user);
                    array_push($input, $id);
                    array_push($input, $otp);
                    Session::put('forgot_pdata', $input);
                    return response()->json(['success' => true, 'message' => 'OTP Sent Successfully']);
                }
            }else{
                return response()->json(['success' => false, 'message' => 'Email Id Not Registered.']);
            }

        }
        else {
            return response()->json(['success' => false, 'message' => 'Kindly enter email id for reset password!!!.']);
        }

    }
    public function check_forget_otp(Request $request){
        $input=array();
        array_push($input,$request->digit1);
        array_push($input,$request->digit2);
        array_push($input,$request->digit3);
        array_push($input,$request->digit4);
        $digit=implode("",$input);
        $inputotp=((integer)$digit);

        $otp=Session::get('forgot_pdata')[2];

        if($inputotp==$otp){
            return response()->json(['success' => true, 'message' => 'OTP Matched!!!']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Invalid OTP Entry!!!.']);
        }

    }
    public function reset_password_data(Request $request){
        $user=Session::get('forgot_pdata')[0];
        $id=Session::get('forgot_pdata')[1];
        $password=Hash::make($request->password);
        if($user=='web_user') {
            $data = Web_User::where('id', $id)->update(['password' => $password]);
            if($data){
                Session::forget('forgot_pdata');
                $web_user=Web_User::where('id',$id)->first();
                $details=[
                    'email' => $web_user->email,
                    'fname' => $web_user->fname,
                    'lname' => $web_user->lname
                ];
                Mail::to($details['email'])->send(new ForgotPassword($details));
                return response()->json(['success' => true, 'message' => 'Password Change Successfully.']);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Something Went Wrong!!!.']);
            }
        }
        else if($user=='driver') {
            $data = Driver::where('id', $id)->update(['password' => $password]);
            if($data){
                Session::forget('forgot_pdata');
                $driver=Driver::where('id',$id)->first();
                $details=[
                    'email' => $driver->email,
                    'fname' => $driver->fname,
                    'lname' => $driver->lname
                ];
                Mail::to($details['email'])->send(new ForgotPassword($details));
                return response()->json(['success' => true, 'message' => 'Password Change Successfully.']);
            }
            else{
                return response()->json(['success' => false, 'message' => 'Something Went Wrong!!!.']);
            }
        }
    }

    public function forget_resend_otp(Request $request){
        $user=Session::get('forgot_pdata')[0];
        $id=Session::get('forgot_pdata')[1];
        if($user=='web_user'){
            $mno = Web_User::where('id', $id)->pluck('mobile')->first();
        }
        elseif($user=='driver'){
            $mno = Driver::where('id', $id)->pluck('mobile')->first();
        }
        $otp = CommonHelper::sendOtp($mno);
        if ($otp) {
            $forgot_pdata=Session::get('forgot_pdata');
            $forgot_pdata[2] = $otp;
            Session::put('forgot_pdata', $forgot_pdata);
            return response()->json(['success' => true, 'message' => 'OTP Sent Successfully']);
        }
        else {
            return response()->json(['success' => false, 'message' => 'OTP Cant Send.']);
        }
    }
    public function edit_user_profile($id)
    {
        $user = Web_User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect::back();
        }

        return view('frontend/user_profile_edit',compact('user'));
    }

    public function update_user_profile($id,Request $request)
    {
        $user = Web_User::find($id);
        $input['fname']=$request->fname;
        $input['lname']=$request->lname;
        $input['address']=$request->address;
        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('signin'));
        }


        if (!empty($request->file('profile'))) {

            $image = $request->file('profile');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profile');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['profile_pic'] = $imagePath;
        }
        $user = Web_User::where('id', $id)->update($input);
        if($user){
            Flash::success('User updated successfully.');
            return redirect('home_user');
        }

    }

    public function edit_driver_profile($id)
    {
        $driver = Driver::find($id);

        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect::back();
        }

        return view('frontend/driver_profile_edit',compact('driver'));
    }

    public function update_driver_profile($id,Request $request)
    {
//        return $request->all();
        $driver = Driver::find($id);
        $input['fname']=$request->fname1;
        $input['lname']=$request->lname1;
        $input['address']=$request->address1;
        $input['car_make']=$request->cmake;
        $input['car_model']=$request->modelnm;
        $input['year']=$request->year;
        $input['regno'] = $request->regno1;
        $input['insuranceno'] = $request->insuranceno1;
        $input['licenceno'] = $request->licenceno1;
        if (empty($driver)) {
            Flash::error('Driver not found');

            return redirect(route('signin'));
        }


        if (!empty($request->file('profile'))) {

            $image = $request->file('profile');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/profile');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['profile_pic'] = $imagePath;
        }

        if (!empty($request->file('carimage1'))) {

            $image = $request->file('carimage1');
//            $ext = $image->getClientOriginalExtension();
            $destinationPath = public_path('images/car_images');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['car_image'] = $imagePath;
        }

        if (!empty($request->file('insuranceimage1'))) {
            $image = $request->file('insuranceimage1');
            $destinationPath = public_path('images/insurance_images');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['insuranc_image'] = $imagePath;
        }

        if (!empty($request->file('licenceimage1'))) {
            $image = $request->file('licenceimage1');
            $destinationPath = public_path('images/licence_images');
            $imagePath = rand(000, 999) . time() . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $imagePath);
            $input['licence_image'] = $imagePath;
        }

        $driver = Driver::where('id', $id)->update($input);
        if($driver){
            Flash::success('User updated successfully.');
            return redirect('home_driver');
        }

    }
    public function store_temp_data($uid,$sessionid){
        //it will store data in permenent table
        $fromdata=Temp_delivery_addresses::where('id',$sessionid)->first();
        $todata=Temp_delivery_addresses::where('parent_id',$sessionid)->get();

        $input1=array();

        //store from address
        $input1['user_id'] = $uid;
        $input1['to_form'] = $fromdata->to_form;
        $input1['name'] = $fromdata->name;
        $input1['company_id'] = $fromdata->company_id;
        $input1['country_id'] = $fromdata->country_id;
        $input1['province'] = $fromdata->province;
        $input1['city'] = $fromdata->city;
        $input1['postalcode'] = $fromdata->postalcode;
        $input1['street_add'] = $fromdata->street_add;
        $input1['lat'] = $fromdata->lat;
        $input1['long'] = $fromdata->long;
        $input1['street_add1'] = $fromdata->street_add1;
        $input1['mobile'] = $fromdata->mobile;
        $input1['mobile1'] = $fromdata->mobile1;
        $input1['email'] = $fromdata->email;
        $input1['sms_verification'] = $fromdata->sms_verification;
        $input1['planname'] = $fromdata->planname;
        $input1['is_sent_req'] = $fromdata->is_sent_req;

        $sfdata=Delivery_Addresses::create($input1);//store fromdata
        $fromid=$sfdata->id;
        //store from package

        $pkgdatas=Temp_packages::where('to_address_id',$sessionid)->get();
        foreach ($pkgdatas as $pkgdata ){
            $input2=array();
            $input2['to_address_id'] = $fromid;
            $input2['location'] = $pkgdata->location;
            $input2['place'] = $pkgdata->place;
            $input2['packagecnt'] = $pkgdata->packagecnt;
            $input2['weight'] = $pkgdata->weight;
            $input2['packagekg'] = $pkgdata->packagekg;
            $input2['dimesionl'] = $pkgdata->dimesionl;
            $input2['dimesionw'] = $pkgdata->dimesionw;
            $input2['dimesionh'] = $pkgdata->dimesionh;
            $input2['dimensions'] = $pkgdata->dimesions;
            $input2['dvalue'] = $pkgdata->dvalue;
            $input2['image'] = $pkgdata->image;
            $input2['date'] = $pkgdata->date;
            $input2['time'] = $pkgdata->time;
            $pkg=Package_Detail::create($input2);//store package data of fromid
        }

        foreach ($todata as $tod){
            $temp_to_id=$tod->id;
            $input=array();
            $input['parent_id'] = $fromid;
            $input['user_id'] = $uid;
            $input['to_form'] = $tod->to_form;
            $input['name'] = $tod->name;
            $input['company_id'] = $tod->company_id;
            $input['country_id'] = $tod->country_id;
            $input['province'] = $tod->province;
            $input['city'] = $tod->city;
            $input['postalcode'] = $tod->postalcode;
            $input['street_add'] = $tod->street_add;
            $input['lat'] = $tod->lat;
            $input['long'] = $tod->long;
            $input['street_add1'] = $tod->street_add1;
            $input['mobile'] = $tod->mobile;
            $input['mobile1'] = $tod->mobile1;
            $input['email'] = $tod->email;
            $input['sms_verification'] = $tod->sms_verification;

            $ftodata=Delivery_Addresses::create($input);//store todata
            $to_id=$ftodata->id;

            $packagedata=Temp_packages::where('to_address_id',$temp_to_id)->get();
            foreach ($packagedata as $pdata){
                $input2=array();
                $input2['to_address_id'] = $to_id;
                $input2['location'] = $pdata->location;
                $input2['place'] = $pdata->place;
                $input2['packagecnt'] = $pdata->packagecnt;
                $input2['weight'] = $pdata->weight;
                $input2['packagekg'] = $pdata->packagekg;
                $input2['dimesionl'] = $pdata->dimesionl;
                $input2['dimesionw'] = $pdata->dimesionw;
                $input2['dimesionh'] = $pdata->dimesionh;
                $input2['dimensions'] = $pdata->dimesions;
                $input2['dvalue'] = $pdata->dvalue;
                $input2['image'] = $pdata->image;
                $input2['date'] = $pdata->date;
                $input2['time'] = $pdata->time;
                $pkg=Package_Detail::create($input2);//store data of package of toid
            }
        }
        if($pkg){
            $data=Temp_delivery_addresses::where('id',$sessionid)->delete();//delete data from temp table

            if($data){
                Temp_packages::where('to_address_id',$sessionid)->delete();
                $data1=Temp_delivery_addresses::with('getPackage')->where('parent_id',$sessionid)->get();
                foreach ($data1 as $d) {
                    foreach ($d->getPackage as $p) {
                        $p->delete();
                    }
                }
            }
            $res=Temp_delivery_addresses::where('parent_id',$sessionid)->delete();
            if($res){
                Session::forget('index_userid');
                return true;
            }
        }
        else{
            return false;
        }

    }

    public function store_plan_data(Request $request){
        $fromid=Session::get('new_request_id');
        $userid=Temp_delivery_addresses::where('id',$fromid)->pluck('user_id')->first();
        $chksetreq=Temp_delivery_addresses::where('id',$fromid)->pluck('is_sent_req')->first();

        $res=$this->store_temp_data($userid,$fromid);

        if($res==true){
            Session::forget('new_request_id');
            if($chksetreq==1){
                $message= 'Delivery Request Successfully Sent.';
            }
            else{
                $message= 'Delivery Plan Saved Successfully.';
            }
            Session::forget('flashmsg');
            Session::put('flashmsg',$message);
            return redirect('home_user');
        }
    }

}
