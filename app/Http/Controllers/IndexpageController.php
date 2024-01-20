<?php

namespace App\Http\Controllers;

use App\Enums\Dimensions;
use App\Enums\Packagekg;
use App\Models\Country;
use App\Models\Delivery_Addresses;
use App\Models\Package_Detail;
use App\Models\Temp_delivery_addresses;
use App\Models\Temp_packages;
use App\Models\Web_User;
use Faker\Provider\cs_CZ\DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class IndexpageController extends Controller
{
    public function edit_index($id){
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

        return view ('frontend/editindex',compact('fromdata','country','todata','pkgfirst','allloc','pkgall','pkgcount'));
    }
    public function edit_index_data1(Request $request){
        $maindata=$request->all();
        $id=$request->fromid;
        if(Session::has('Userid')){
            $uid=Session::get('Userid')[0];
        }
        else{
            $uid=null;
        }
        //first delete old record
        $data=Temp_delivery_addresses::where('id',$id)->delete();

        if($data){
            Temp_packages::where('to_address_id',$id)->delete();
            $data1=Temp_delivery_addresses::with('getPackage')->where('parent_id',$id)->get();
            foreach ($data1 as $d) {
                foreach ($d->getPackage as $p) {
                    $p->delete();
                }
            }
        }
        $res=Temp_delivery_addresses::where('parent_id',$id)->delete();
        if($res){

            $input1=array();
            $input1['to_form'] =$request->formname;
            $input1['user_id'] =$uid;
            $input1['name'] =$request->name1;
            $input1['company_id'] = $request->company1;
            $input1['country_id'] = $request->country1;
            $input1['province'] = $request->province1=="Province/Territory/State"?null:$request->province1;
            $input1['city'] = $request->city1=="City"?null:$request->city1;
//            $input1['city'] = isset($request->city1)?$request->city1:null;
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
            Session::put('new_request_id',$pid);
            $myValue=  array();
            if($data){

                for($i=1;$i<=$loccnt;$i++){
                    $input=array();
                    $ind="toform".$i;
                    parse_str($maindata[$ind],$myValue);
                    $input['parent_id'] =$pid;
                    $input['user_id'] =$uid;
                    $input['to_form'] =$myValue['formname'];
                    $input['name'] =$myValue['name'];
                    $input['company_id'] = $myValue['company']==''? null : $myValue['company'];
                    $input['country_id'] = $myValue['country'];
//                    return $myValue['province'];
                    if($myValue['province']=="Province/Territory/State"){
                        $myValue['province']=null;
                    }
                    elseif ($myValue['province']==""){
                        $myValue['province']=null;
                    }

                    if($myValue['city']=="City"){
                        $myValue['city']=null;
                    }
                    elseif ($myValue['city']==""){
                        $myValue['city']=null;
                    }

                    $input['province'] = $myValue['province'];
                    $input['city'] = $myValue['city'];
//                    dd($input['province'],$input['city']);
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
                        $input1['image'] = $myValue['hiddenimg'];
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
                    $input1['time'] =date("h:i", strtotime($myValue['time']));

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
    }
    public function saveplan(Request $request){
        $fromid=Session::get('index_userid');
        if($request->req=="save"){
            $data=Temp_delivery_addresses::where('id',$fromid)->update(['planname' => $request->planname]);
        }else if($request->req=="request"){
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
    public function view_plan_list(){
        //display only saved plan where is_sent_req=0
        $userid=Session::get('Userid')[0];
        $listdata=Delivery_Addresses::where('user_id',$userid)->where('parent_id',0)->where('is_sent_req',0)->orderBy('id','desc')->get();
        $data=Web_User::where('id',$userid)->first();

        return view('frontend/planlist',compact('data','listdata'));
    }

    public function displayplan1(Request $request){
        $id=$request->plan_radio;


        $locations=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->get();
        $country=Country::get();

        $allloc=Delivery_Addresses::where('parent_id',$id)->get();

        $pkg=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->pluck('id');
        $pkgall=Package_Detail::whereIn('to_address_id',$pkg)->get();


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



        foreach ($pkgall as $pkg){
            if (array_key_exists($pkg->location,$toarr)) {
                $pkg->location1=$toarr[$pkg->location];
            }
            $pkg->time = date("g:i a", strtotime($pkg->time));

            $pkg->newdate = \DateTime::createFromFormat('Y-m-d', $pkg->date)->format('d-m-Y');
        }

        return view ('frontend/displayplan1',compact('locations','country','pkgall','allloc','id'));
    }
    public function display_link_plan1($id){
        $pid=$id;
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
        $data=Delivery_Addresses::where('parent_id',$pid)->orwhere('id',$pid)->with('getPackage')->get();
        $nda=Delivery_Addresses::where('parent_id',$pid)->get();
        $fromdata=Delivery_Addresses::where('id',$pid)->first();
        $tempitems=array();
        array_push($tempitems,"Name: ".$fromdata->name);
        array_push($tempitems,"Country : ".$fromdata->Country);
        array_push($tempitems,"Address: ".$fromdata->street_add);
        array_push($tempitems,"Mobile: ".$fromdata->mobile);
        array_push($tempitems,"Email: ".$fromdata->email);

        $fromloc=array();
        $fromloc['key']="From Location A";
        $fromloc['isGroup']=true;
        $fromloc['items']=$tempitems;
        $fromloc['color']="#FFC56C";
        array_push($arr,$fromloc);

        foreach ($nda as $nd){
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

        foreach ($data as $d){
            foreach ($d->getPackage as $p){
                $temp=array();
                $tempitems=array();
                $packagekg=isset($p->packagekg) ? array_search($p->packagekg,Packagekg::asArray()) : '-';
                $dimensions=isset($p->dimensions) ? array_search($p->dimensions,Dimensions::asArray()) : '-';

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



        foreach ($data as $d) {
            foreach ($d->getPackage as $p) {
                $temp1=array();
                if (array_key_exists($p->location,$toarr)) {
                    if (array_key_exists($toarr[$p->location],$colorarr)) {
                        $togrp = $toarr[$p->location];
                        $temp1['from'] = $p->packagecnt;
                        $temp1['to'] = $togrp;
                        $temp1['color']=$colorarr[$togrp];
                        array_push($arr1, $temp1);
                    }
                }
            }
        }

        $ndadata=json_encode($arr,true);
        $ndadata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$ndadata);
        $linkdata=json_encode($arr1,true);
        $linkdata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$linkdata);

        return view('frontend/display_link_plan1',compact('ndadata','linkdata','pid'));
    }
    public function gmapsdata1($id){
        $fromdata=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->withCount('getPackage')->orderBy('id')->get();
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
        return view('frontend/displaymap',compact('fromdata','id','alldata'));
    }

    public function displayplan(Request $request){
        $id=$request->plan_radio;

        $locations=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->get();
        $country=Country::get();

        $allloc=Delivery_Addresses::where('parent_id',$id)->get();

        $pkg=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->pluck('id');
        $pkgall=Package_Detail::whereIn('to_address_id',$pkg)->get();



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

        foreach ($pkgall as $pkg){
            if (array_key_exists($pkg->location,$toarr)) {
                $pkg->location1=$toarr[$pkg->location];
            }
            $pkg->time = date("g:i a", strtotime($pkg->time));

            $pkg->newdate = \DateTime::createFromFormat('Y-m-d', $pkg->date)->format('d-m-Y');
        }

        return view ('frontend/displayplan',compact('locations','country','pkgall','allloc','id'));
    }

    public function display_request_plan($id){
        $pid=$id;
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
        $data=Delivery_Addresses::where('parent_id',$pid)->orwhere('id',$pid)->with('getPackage')->get();
        $nda=Delivery_Addresses::where('parent_id',$pid)->get();
        $fromdata=Delivery_Addresses::where('id',$pid)->first();
        $tempitems=array();
        array_push($tempitems,"Name: ".$fromdata->name);
        array_push($tempitems,"Country : ".$fromdata->Country);
        array_push($tempitems,"Address: ".$fromdata->street_add);
        array_push($tempitems,"Mobile: ".$fromdata->mobile);
        array_push($tempitems,"Email: ".$fromdata->email);

        $fromloc=array();
        $fromloc['key']="From Location A";
        $fromloc['isGroup']=true;
        $fromloc['items']=$tempitems;
        $fromloc['color']="#FFC56C";
        array_push($arr,$fromloc);

        foreach ($nda as $nd){
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

        foreach ($data as $d){
            foreach ($d->getPackage as $p){
                $temp=array();
                $tempitems=array();
                $packagekg=isset($p->packagekg) ? array_search($p->packagekg,Packagekg::asArray()) : '-';
                $dimensions=isset($p->dimensions) ? array_search($p->dimensions,Dimensions::asArray()) : '-';

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



        foreach ($data as $d) {
            foreach ($d->getPackage as $p) {
                $temp1=array();
                if (array_key_exists($p->location,$toarr)) {
                    if (array_key_exists($toarr[$p->location],$colorarr)) {
                        $togrp = $toarr[$p->location];
                        $temp1['from'] = $p->packagecnt;
                        $temp1['to'] = $togrp;
                        $temp1['color']=$colorarr[$togrp];
                        array_push($arr1, $temp1);
                    }
                }
            }
        }

        $ndadata=json_encode($arr,true);
        $ndadata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$ndadata);
        $linkdata=json_encode($arr1,true);
        $linkdata = preg_replace('/"([a-zA-Z]+[a-zA-Z0-9_]*)":/','$1:',$linkdata);

        return view('frontend/display_request_plan',compact('ndadata','linkdata','pid'));
    }
    public function requestgmapsdata($id){
        $fromdata=Delivery_Addresses::where('id',$id)->orwhere('parent_id',$id)->withCount('getPackage')->orderBy('id')->get();
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

        $listdata=Delivery_Addresses::where('id',$id)->orderBy('id','desc')->get();


        foreach ($listdata as $list){
            $ids=app(\App\Http\Controllers\PagesController::class)->only_to_address_data($list->id);

            $chkdata=Delivery_Addresses::whereIn('id',$ids)->pluck('is_complete');
            if (count($ids) == 1) {
                if ($list->is_confirmed == 1 && $list->is_assign == 0) {
                    $list->status = "Payment Done";
                }
                elseif ($list->is_confirmed == 1 && $list->is_assign == 1 && $list->is_complete == 0) {
                    if (in_array(0, $chkdata->toArray(), true)) {
                        $list->status = "Running";
                    } else {
                        $list->status = "Completed";
                    }
                }
                else{
                    $list->status = "Pending";
                }
            }else{
            if($list->is_confirmed==1 && $list->is_assign==0){
                $list->status="Payment Done";
            }
            elseif ($list->is_confirmed==1 && $list->is_assign==1 && $list->is_complete==1){

                if (in_array(0, $chkdata->toArray(), true)) {
                    $list->status="Running";
                }
                else{
                    $list->status="Completed";
                    $status=$list->status;
                    return view('frontend/displayrequestmap',compact('fromdata','alldata','status','id'));
                }
            }
            elseif ($list->is_confirmed==1 && $list->is_assign==1){
                $list->status="Running";
            }
            else{
                $list->status="Pending";
            }
        }

        }
      $status=$list->status;
        return view('frontend/displayrequestmap',compact('fromdata','alldata','status','id'));
    }

    public function sendrequest(Request $request){
        $id=$request->reqid;
        $data=Delivery_Addresses::where('id',$id)->update(['is_sent_req' => true]);
        if($data){
            $message= 'Request For Payment Successfully Sent!!!.';
            Session::forget('flashmsg');
            Session::put('flashmsg',$message);
            return response()->json(['success' => true, 'message' => 'Request Sent Successfully']);
        }
        else{
            return response()->json(['success' => false, 'message' => 'Request Cant Sent']);
        }

    }


}
