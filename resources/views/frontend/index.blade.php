@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Delivery In Hour</title>
@endsection

@section('content')
    <style>
        @media (max-width: 1440px) {
            .full-1024 {
                max-width: 100%;
                flex: unset;
            }
            .mobile-top-margin
            {
                margin-top: 0px !important;
            }
        }
        @media (max-width: 1280px) {
            .phone {
                width: 46%!important;
            }
            .iti--allow-dropdown {
                margin-left: 0px;
            }
        }
        @media (min-width: 1025px) {
            .suggestionbox_size {
                width: 84%;
            }

        }
        .padding-left-0 {
            padding-left: 0px;
        }

        .padding-0 {
            padding: 0px;
        }

        .padding-right-0 {
            padding-right: 0px;
        }
        @media(width: 768px) {
            .padding-0{
                margin-top: 1rem;
            }
            .phone {
                width: 58%!important;
            }
        }

        @media(width: 768px), (max-width: 1024px) {
            .iti--allow-dropdown {
                margin-left: -1px !important;
            }
            /*.padding-0{*/
            /*    margin-top: 1rem;*/
            /*    !*padding-left: 15px;*!*/
            /*    !*padding-right: 15px;*!*/
            /*}*/
            .padding-right-0-1024
            {
                padding-right: 0px;
            }
            .phone {
                width: 64%!important;
            }

        }


        @media (max-width: 425px) {
            .phone {
                width: 65% !important;
            }
            .padding-0{
                margin-top: 1rem !important;
            }
        }
        @media (max-width: 360px) {
            .phone {
                width: 60% !important;
            }
        }
        @media(max-width: 320px){
            .mobile-top-margin{
                margin-top: unset!important;
            }
            .iti--allow-dropdown {
                margin-left: -8px !important;
            }
            .padding-0{
                margin-top: 1rem;
                padding-left: 0px;
                padding-right: 0px;
            }
            .phone {
                width: 60%!important;
            }
            .padding-left-0
            {
                padding-left: 15px;
            }
            .mobile-set {
                width: 40%!important;
            }
            .mobile-top-margin {
                margin-top: unset;
            }
            .mobile-width {
                width: 60%!important;
            }

        }





        .otp-field-main {
            width: 90%;
            top: -21px;
            height: 0;
            padding: 0;
            position: absolute;
            opacity: 0;
        }

        .country-list {
            float: left;
            list-style: none;
            margin-top: -3px;
            padding: 0;
            /*width: 190px;*/
            position: absolute;
            z-index: 50;
            background-color: white;
            /*change for fix width li*/
            display: block;
            word-break: break-word;
            white-space: normal;
        }
        .country-list li {
            /*line-height: 1.45;*/
            /*padding: 10px;*/
            /*background: #f0f0f0;*/
            border: #e9eef3  1px ridge;
        }
        .country-list li:hover {
            background: #eaeaea;
            cursor: pointer;
        }
        a:hover{
            color: unset;
            text-decoration: unset;
        }
        .scrolling-wrapper {
            /*overflow-x: auto;*/
            /*overflow-y: hidden;*/
            white-space: nowrap;
        }
        .col-sm {
            display: inline-block;
        }
        @media (min-width: 576px){
            .col-sm {
                max-width: 35%;
            }
        }
        #mobile-error, #mobile-error, .num_er{
            display: table!important;
        }
        .row{
            margin-right: unset!important;
        }
        @media (width: 320px){
            .space_loginbutton{
                margin-left: 33px!important;
            }

        }
        @media (max-width:1066px) {
            .phone1{
                width: 103px!important;
            }
        }

        @media (min-width: 738px) and (max-width: 1024px){
            .phone1{
                width: 82px!important;
            }
        }

        @media (min-width: 576px) and (max-width: 767px){
            .phone1 {
                width: 80px!important;
            }
        }

        @media (width: 1024px) {
            .wewidth_1024{
                max-width: 68%!important;
            }
            .kgwidth_1024{
                padding-right: 0px!important;
                max-width: 55%;
            }
        }
        @media (min-width: 768px) {
            .pc_modal{
                padding: 60px;margin-top: 130px!important;
            }
            .pc_modal_top_space{
                margin-top: 466px;
            }
        }
        @media (min-width: 1025px) {
            .size_modal_pc{
                /*height: 500px;*/
            }
            .space_modal_pc{
                /*margin-top: 100px;margin-bottom: 195px;*/
            }
        }
        @media (min-width: 1024px) {
            .space_top_modal_mobile{
                margin-top: 80px!important; /*50*/
                margin-bottom: 314px; /*custom*/
            }
            .content-div{
                background-image:url(../delivery-website/public/images/firstbg.png);
                /*background-repeat: no-repeat;*/
                background-size: 100%;
                -webkit-mask-size: cover;
                margin-top: 130px;
                height: 810px; /*custom*/
            }
            .md1 {
                margin: unset;
                overflow: auto;
                padding-bottom: 15px; /*custom*/
                padding-top: 15px; /*custom*/
            }
        }
    </style>
    <link rel="stylesheet" href="{{ url('public/build/css/intlTelInput.css') }}">
    <div class="content-div container-fluid" >
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document" style="overflow: auto">
                <div class="modal-content container-fluid size_modal_pc" style="overflow-y: auto;">
                    <section>
                        <div id="error-display"></div>


                        <div class="scrolling-wrapper">
                            <div style="" class="space_modal_pc space_top_modal_mobile">
                                <div class="col-sm">
                                    <div class="row fromloc pkg-div" data-id="0">
                                        <div class="index-div col-lg-8">
                                            <div class="request-i"><a href="javascript:void(0)"
                                                                      class="text-center index-button show_hide packageloc"><i id="fafa" class="fa fa-plus faplus" aria-hidden="true"></i> From Location A</a></div>
                                        </div>

                                        <div class="content" style="display: none">
                                            <div class="heading">
                                                <h4 style="color: black;text-align: center">From Address</h4>
                                            </div>
                                            <div class="form">
                                                <div id="errormessage"></div>
                                                {{\Illuminate\Support\Facades\Session::forget('index_userid')}}
                                                <form method="post" role="form" id="MyformFrom" action=""
                                                      class="MyformFrom" autocomplete="off">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="formname" value="MyformFrom">
                                                    <div class="form-group">
                                                        <input type="text" name="name1" class="form-control " id="name1"
                                                               placeholder="Your Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="company1" class="form-control "
                                                               id="company1" placeholder="Company Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control" id="country1" name="country1">
                                                            <option value="" style="color: #6C757D">Country</option>
                                                            @foreach($country as $cnt)
                                                                <option value="{{$cnt->id}}">{{$cnt->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="province1" id="province1" class="form-control">
                                                            <option value="" disabled selected style="color: #6C757D">Province/Territory/State</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        {{--<select name="city1" id="city1" class="form-control">
                                                            <option value="" disabled selected style="color: #6C757D">City</option>
                                                        </select>--}}
                                                        <input type="text" class="form-control" name="city1" id="city1" placeholder="City">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="postalcode1" id="postalcode1" placeholder="Postal Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control uniqueadd" name="toaddress" id="toaddress" placeholder="Street Address" onkeypress="handleEnterKey(event)"/>
                                                        <input type="hidden" name="lat" class="lat">
                                                        <input type="hidden" name="long" class="long">
                                                        {{--                                                    <input type="hidden" id="lat">--}}
                                                        {{--                                                    <input type="hidden" id="long">--}}
                                                        {{--<div class="suggesstion-box" hidden="hidden">
                                                            <ul class="country-list suggestionbox_size">
                                                                <li></li>
                                                            </ul>
                                                        </div>--}}
                                                        <label id="toaddress-error" class="error none-display"
                                                               for="toaddress"></label>
                                                        {{--<input type="hidden" class="lat" name="lat">
                                                        <input type="hidden" class="long" name="long">--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="toaddress1"
                                                               id="toaddress1"
                                                               placeholder="Apt, Floor, Suite, etc.(Optional)"/>

                                                    </div>

                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 padding-0">
                                                        <div class="form-group">
                                                            <input type="tel" id="mobile1" name="mobile1"
                                                                   class="form-control phone1 inter_tel "
                                                                   placeholder="(Optional)" disabled="disabled">
                                                            <input type="text"
                                                                   {{--pattern="[1-9]{1}[0-9]{9}"--}} name="mobile"
                                                                   id="mobile"
                                                                   class="form-control phone phone-main input-number"
                                                                   placeholder="Phone"
                                                                   style="margin-bottom: 0px"
                                                                   value=""/>
                                                            <label id="mobile-error" class="error" for="mobile"
                                                                   hidden="hidden"></label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-sm-12 col-xs-12 col-lg-12 padding-0">
                                                        <div class="form-group">

                                                            <input type="button" name="sendotp" class="btn send-otp"
                                                                   value="Send OTP"
                                                                   style="background-color: #FFC56C;color: white;width: 100%  "
                                                                   disabled/>
                                                            <span class="mobile-error-class"></span>

                                                            {{--                                                           <p style="display: inline;  position: absolute;margin-top: 5px;">Ext.</p>--}}

                                                            {{--<input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile1" class="form-control phone1" placeholder="(Optional)">--}}
                                                        </div>
                                                    </div>
                                                    <div class="form-inline">
                                                        <div class="col-md-12 col-sm-12 col-lg-12 col-xs-12"
                                                             style="padding: 0px">
                                                            <div class="row">
                                                                <div class="col-md-12 col-sm-8 col-lg-7 col-xs-8 padding-right-0-1024">
                                                                    <input type="text" class="form-control input-number" name="sms1"
                                                                           id="sms1" style="width: 100%"
                                                                           placeholder="SMS Code"/>

                                                                    <div class="validation"></div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-4 col-lg-5 col-xs-4 padding-0">
                                                                    <input type="button" name="sendotp"
                                                                           class="btn send-verification"
                                                                           value="Verify OTP"
                                                                           style="background-color: #FFC56C;color: white;width: 100%;  "
                                                                           disabled/>
                                                                    <br>
                                                                    <span class="verify-otp" style="color: red"></span>
{{--                                                                    <input type="text" name="otp" class="otp-field-main">--}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="form-group">
                                                        <input type="email" class="form-control" name="email1"
                                                               id="email1" placeholder="Email"/>
                                                    </div>
                                                    {{--                                                    <input type="submit" style="display: none;">--}}
                                                </form>
                                            </div>
                                        </div>

                                        <div class="index-div col-lg-8  signchange">
                                            <div class="request-i"><a href="javascript:void(0)" class="text-center index-button package uniqpackage"><i class="fa fa-plus faplus packageplus" aria-hidden="true"></i> Package 1</a></div>
                                        </div>
                                        <div class="form uniqfrompackage package-data" style="display: none;margin-right: 10px;">
                                            <div class="heading">
                                                <h4 style="color: black;text-align: center">Package Details</h4>
                                            </div>
                                            <form method="post" role="form" class="package_form" novalidate="novalidate"
                                                  enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <input type="hidden" name="pkgcnt" value="Package 1">
                                                <input type="hidden" name="place" value="From Location A">
                                                <div class="row">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set  col-6">
                                                        <div class="form-group">
                                                        <input type="text" name="weight" class="form-control allow_decimal"
                                                               id="weight"
                                                               style="border-top-right-radius: unset;border-bottom-right-radius: unset;"
                                                               required placeholder="Weight"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
                                                        <div class="form-group">
                                                        <?php $packagekg = \App\Enums\Packagekg::asArray();?>
                                                        <select class="form-control package-control package-weight" name="packagekg">
                                                            @foreach($packagekg as $key=>$value)
                                                                <option value="{{$value}}" <?php if ($key == "Kg") {
                                                                    echo 'selected';
                                                                } ?> >{{$key}}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set col-6 ">
                                                        <div class="form-group">
                                                            <input type="text" name="dimesionl"
                                                                   class="form-control package-control package-weight allow_decimal"
                                                                   id="dimesionl" placeholder="L"/>
                                                        </div>
                                                    </div>


                                                    <div
                                                        class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
                                                        <div class="form-group">
                                                            <input type="text" name="dimesionw"
                                                                   class="form-control package-control package-weight allow_decimal"
                                                                   id="dimesionw" placeholder="W"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set  col-6">
                                                        <div class="form-group">
                                                            <input type="text" name="dimesionh"
                                                                   class="form-control package-control package-weight allow_decimal"
                                                                   id="dimesionh" placeholder="H"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
                                                        <div class="form-group">
                                                            <?php $dimension = \App\Enums\Dimensions::asArray();?>
                                                            <select class="form-control package-control package-weight input-number"
                                                                    name="dimensions">
                                                                @foreach($dimension as $key=>$value)
                                                                    <option
                                                                        value="{{$value}}" <?php if ($key == "Centimeter") {
                                                                        echo 'selected';
                                                                    } ?>>{{$key}}</option>
                                                                @endforeach
                                                            </select>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="form-group uniqlocation">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <select class="form-control package-control package-weight location" required name="location">
                                                                <option value="">Location</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        {{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Declared Value</label>--}}
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <input type="text" name="dvalue"
                                                                   class="form-control dvalue-color" id="dvalue"
                                                                   placeholder="Declared Value(Optional)"/>

                                                            {{--                                            <div class="validation"></div>--}}
                                                        </div>
                                                        {{--                                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 not-mobile-display" style="margin-left: -25px;">--}}
                                                        {{--                                                            <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 27px"></i>--}}
                                                        {{--                                                        </div>--}}
                                                    </div>
                                                </div>
                                                <div class="row pkgdatetime">
                                                    {{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Require Delivery Date & Time</label>--}}
                                                    <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6 full-1024">
                                                        <div class="form-group">
                                                            <input type="text" required name="date"
                                                                   class="form-control package-control package-weight "
                                                                   id="date" placeholder="Date" onfocus="(this.type='date')"/>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="col-lg-6 col-md-12 col-sm-6 col-xs-6 mobile-top-margin full-1024">
                                                        <div class="form-group">
                                                            <input type="text" required name="time"
                                                                   class="form-control package-control package-weight"
                                                                   id="time" placeholder="Time"
                                                                   onfocus="(this.type='time')"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="row">
                                                        {{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Photo</label>--}}
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <input type="button" name="photo" class="form-control"
                                                                   onclick="getFile(this)" value="Select Photo"/>
                                                            <div style='height: 0px;width: 0px; overflow:hidden;'><input
                                                                    type="file" class="image" value="photo"
                                                                    name="pkgimage" onchange="sub(this)"/></div>
                                                            <img class="package-img" style="display: none">
                                                        </div>
                                                    </div>
                                                </div>


                                            </form>
                                        </div>
                                        <div class="add-div add-package col-lg-8">
                                            <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button" style="color: black;background-color: white;"><i class="fa fa-plus faplus" aria-hidden="true"></i> Add Package</a></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="row pkg-div" data-id="1">
                                        <div  class="index-div col-lg-8">
                                            <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button to-show_hide packageloc"><i class="fa fa-plus faplus" aria-hidden="true"></i> To Location B</a></div>
                                        </div>
                                        <div class="tocontent dest-to" style="display: none">
                                            <div class="heading">
                                                <h4 style="color: black;">Delivery Address <span style="color: black;" id="initialto"></span></h4>
                                            </div>
                                            <div class="form">
                                                <form method="post" role="form" class="MyformTo" id="MyformTo0">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="formname" value="MyformTo0">

                                                    <div class="form-group">
                                                        <input type="text" name="name" class="form-control name"  placeholder="Your Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" name="company" class="form-control " id="company" placeholder="Company Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <select class="form-control country" name="country">
                                                            <option value="" style="color: #6C757D">Country</option>
                                                            @foreach($country as $cnt)
                                                                <option value="{{$cnt->id}}">{{$cnt->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <select name="province" id="province" class="form-control">
                                                            <option value="" disabled selected style="color: #6C757D">Province/Territory/State</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                       {{-- <select name="city" id="city" class="form-control">
                                                            <option value="" disabled selected style="color: #6C757D">City</option>
                                                        </select>--}}
                                                        <input type="text" class="form-control" name="city" id="city" placeholder="City">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postal Code">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control address uniqueadd" name="address" id="address" placeholder="Street Address" onkeypress="handleEnterKey(event)"/>
                                                        <input type="hidden" name="lat" class="lat">
                                                        <input type="hidden" name="long" class="long">
                                                       {{-- <div class="suggesstion-box" hidden="hidden">
                                                            <ul class="country-list suggestionbox_size">
                                                                --}}{{--                                                                <li></li>--}}{{--
                                                            </ul>
                                                        </div>--}}
                                                        <label id="address-error" class="error none-display" for="address"></label>
                                                        <span id="checkaddress-error" style="color: red"></span>
                                                       {{-- <input type="hidden" class="lat" name="lat">
                                                        <input type="hidden" class="long" name="long">--}}
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control address1" name="address1" placeholder="Apt, Floor, Suite, etc.(Optional)"/>
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile_number" id="mobile_number"
                                                               class="form-control phone mobile_number input-number" placeholder="Phone" style="margin-bottom: 0"/>
                                                        <p style="display: inline;  position: absolute;margin-top: 5px;">Ext.</p>
                                                        <input type="tel" id="mobile_number1" name="mobile_number1" class="form-control phone1 mobile_number1 inter_tel" placeholder="(Optional)" disabled="disabled">
                                                        <label id="mobile_number-error" class="error num_er" for="mobile_number" hidden="hidden"></label>
                                                        {{--<input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile1" class="form-control phone1" placeholder="(Optional)">--}}
                                                    </div>

                                                    <div class="form-group">
                                                        <input type="email" class="form-control email" name="email" placeholder="Email"/>
                                                    </div>
                                                    {{--                                                    <div class="form-group">--}}
                                                    {{--                                                        <input type="text" class="form-control sms" name="sms"  placeholder="SMS Verification"/>--}}
                                                    {{--                                                    </div>--}}
                                                    {{--                                                    <input type="submit" style="display: none;">--}}
                                                </form>
                                            </div>
                                        </div>
                                        <div class="add-div add-package col-lg-8" data-id="1">
                                            <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button" style="color: black;background-color: white;"><i class="fa fa-plus faplus" aria-hidden="true"></i> Add Package</a></div>
                                        </div>


                                    </div>
                                </div>
                                <div class="col-sm add-loc">
                                    <div class="row">
                                        <div  class="add-div col-lg-8">
                                            <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button" id="add-loc" style="color: black;background-color: white;"><i class="fa fa-plus faplus" aria-hidden="true"></i> Add New Location</a></div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div style="display: flex;justify-content: center;">
                                <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2 index-rem space_loginbutton">
                                    <a href="{{url('signin')}}" class="form-control index-footer set-right text-center">LOGIN</a>
                                </div>
                                <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2 index-rem">
                                    <a href="{{url('signup')}}" class="form-control index-footer set-right text-center">SIGN UP</a>
                                </div>
                                <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2 index-rem">
                                    <a href="javascript:void(0)" class="form-control index-footer set-right text-center" id="next-button">Next <i class="fa fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('main_script')
    <script src="{{url('public/js/jquery-ui.min.js')}}"></script>
    <script src="{{url('public/build/js/intlTelInput.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
{{--    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCP3oEgZ0L_dSOno0UVkci2sPllCC9gzX4&amp;libraries=places"></script>--}}
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDk8xJ1I8BiADJ_XWxgNVRuPMdR1GnLMbo"></script>  <!-- autocomplete address api -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>--}}
    <script>
        var loc=66;
        var cnt=0;
        var formcnt=0;
        var cnt_ext=0;
        var cnt_autoadd=0;
        var packagecnt=1;
        var dataidcnt=1;
        $(document).ready(function () {

            google.maps.event.addDomListener(window, 'load', initialize);
            google.maps.event.addDomListener(window, 'load', initialize1);
            function initialize() {
                var input = document.getElementById('toaddress');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                    $(input).siblings('.lat').val(place.geometry['location'].lat());
                    $(input).siblings('.long').val(place.geometry['location'].lng());
                });
            }
            function initialize1() {
                var input = document.getElementById('address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                    $(input).siblings('.lat').val(place.geometry['location'].lat());
                    $(input).siblings('.long').val(place.geometry['location'].lng());
                });
            }

            if ($(window).width() == 1024) {
                $('.index-div').removeClass('col-lg-8');
                $('.index-div').addClass('col-lg-11');
            }


            $('.col-sm').each(function () {//make all exist col-sm class droppable
                $(this).droppable();
            });


            $(".show_hide").on("click", function () {//change sign

                var res=addremove(".show_hide");
                if(res==true){
                    $('.content').slideToggle(200);
                }
            });
            $(".to-show_hide").on("click", function () {//change sign
                var res=addremove(".to-show_hide");
                if(res==true){
                    $('.tocontent').slideToggle(200);
                }

            });
            $(".packageplus").on("click", function () {//change sign
                var res=addremove(".uniqpackage");
                if(res==true){
                    $('.uniqfrompackage').slideToggle(200);
                }
            });

        });

        $(".col-sm").droppable({
            accept: ".packagediv, .package-data ",
            drop: function(event, ui) {
                var ele=ui.draggable;
                var $this=event.target;

                $('.ui-draggable-handle').removeAttr('style');

                $($this).children().find('.add-package').before(ele);
                var pkgno=$(ele).find('.package-button').clone().remove().end().text();//fetch current location
                var targetpkg=$($this).find('.packageloc').clone().remove().end().text();//to fetch in location package will drop

                pkgno=$.trim(pkgno.split("  ").join(" "));//for spacing issue

                $("input[name=pkgcnt]").each(function() {
                    var $this2=$(this);
                    var value=$(this).val();

                    if(value == pkgno){
                        var ele2=$($this2).parents('.package-data').first();
                        var locatondd=$(ele2).children('.package_form').first().find('.uniqlocation :nth-child(1)').children("option:selected").text();//to fetch value of location element of current draggable form

                        if(locatondd == targetpkg) {//to check if package will drop to the location which is given to its location element
                            $(ele2).children('.package_form').first().find('.uniqlocation :nth-child(1)').children("option:selected").remove();//if both match then remove that selected
                        }

                        $(ele).after(ele2);

                        var place=setpackage_place(this);//fetch place of location where package move.

                        $(this).next('input[name="place"]').val(place);//assign place to the form  element

                        $('.package-data').css('display','none');
                        var clsnm=$(ele).find('.package-button :nth-child(1)');
                        var chk=$(clsnm).hasClass('fa fa-minus');
                        if(chk == true){
                            $(clsnm).removeClass("fa fa-minus");
                            $(clsnm).addClass("fa fa-plus");
                        }
                        chechall();
                    }
                });

            }
        });


        $("#add-loc").on("click", function () {
            if ($('.toloc').length > 12) {
                // alert("Sorry You can enter only 15 Location at a time");
                display_error("You can enter only 15 locations at a time.");
                $('#add-loc').css('display','none');
            } else {
                var tos = String.fromCharCode(++loc);
                var intelid = "ext" + ++cnt_ext;
                var addid = "address" + ++cnt_autoadd;
                var html = `<div class="col-sm toloc" id="` + ++cnt + `">
                            <div class="row pkg-div" data-id="`+ ++dataidcnt+`">
                                <div  class="index-div col-lg-8" data-id="">
                                    <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button location-button packageloc"><i class="fa fa-plus faplus fa-dest-add" aria-hidden="true"></i> To Location ` + tos + ` <i class="fa fa-close loc-close loc1-close"  aria-hidden="true"></i></a></div>
                                </div>
                                <div style="display: none" class="add_destination dest-to">
                                    <div class="heading">
                                        <h4 style="color: black;">Delivery Address <span style="color: black;" id="initialto"></span></h4>
                                    </div>
                                    <div class="form">
                                        <form method="post" role="form" class="MyformTo MyFormReset" id="MyformTo`+ ++formcnt +`">
                                         {{csrf_field()}}
                <input type="hidden" name="formname" value="MyformTo`+ formcnt +`">
                                            <div class="form-group">
                                                <input type="text" name="name" class="form-control name"  placeholder="Your Name"/>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="company" class="form-control"  placeholder="Company Name"/>
                 </div>
            <div class="form-group">
                <select class="form-control country" name="country">
                    <option value="" style="color: #6C757D">Country</option>
@foreach($country as $cnt)
                <option value="{{$cnt->id}}">{{$cnt->name}}</option>
                                                        @endforeach
                </select>
            </div>
             <div class="form-group">
                <select name="province" id="province" class="form-control">
                    <option value="" disabled selected style="color: #6C757D">Province/Territory/State</option>
                </select>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="city" id="city" placeholder="City">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postal Code">
            </div>
            <div class="form-group">
                <input type="text" class="form-control address uniqueadd" name="address" id="`+addid+`" placeholder="Street Address" onkeypress="handleEnterKey(event)"/>
                                            <input type="hidden" class="lat" name="lat">
                                            <input type="hidden" class="long" name="long">
                                            <label id="" class="address-error error none-display" for="address"></label>
                                            <span id="checkaddress-error" style="color: red"></span>

            </div>
            <div class="form-group">
                <input type="text" class="form-control address1" name="address1" placeholder="Apt, Floor, Suite, etc.(Optional)"/>
            </div>

            <div class="form-group">
                <input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile_number" id="mobile_number"
                    class="form-control phone mobile_number input-number" placeholder="Phone" style="margin-bottom: 0"/>
                   <p style="display: inline;  position: absolute;margin-top: 5px;">Ext.</p>
                <input type="tel" name="mobile_number1" class="form-control phone1 mobile_number1 inter_tel" placeholder="(Optional)" id="`+intelid+`" disabled="disabled">
                            <label id="mobile_number-error" class="error num_er" for="mobile_number" hidden="hidden"></label>
{{--<input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile1" class="form-control phone1" placeholder="(Optional)">--}}
                </div>

                <div class="form-group">
                    <input type="email" class="form-control email" name="email" placeholder="Email"/>
                </div>
           {{--     <div class="form-group">
                    <input type="text" class="form-control sms" name="sms"  placeholder="SMS Verification"/>
                </div>
<input type="submit" style="display: none;">--}}
                </form>
            </div>
        </div>
        <div class="add-div add-package col-lg-8">
           <div class="request-i"><a href="javascript:void(0)"  class="text-center package-button" style="color: black;background-color: white;"><i class="fa fa-plus faplus" aria-hidden="true"></i> Add Package</a></div>
        </div>
</div>
</div>`;
                $('.add-loc').before(html);
                if(tos=="O"){
                    $(this).css('display','none');
                }
                if ($(window).width() == 1024) {
                    $('.index-div').removeClass('col-lg-8');
                    $('.index-div').addClass('col-lg-11');
                }

                $("select[name=country]").change(function () {
                    var con=$(this);
                    $.ajax({
                        type: 'GET',
                        url: '{{ url('getprovinces') }}',
                        data: {id: $(this).val(),"select":a},
                        success: function (data) {
                            // var form1=$(con).parentsUntil('.MyformTo');
                            console.log(con.closest('form').find("[name=province]"));
                            var p=con.closest('form').find("[name=province]");
                            p.html(data.provincedata);
                        }
                    });
                })

                /*$("select[name=province]").change(function () {
                    var con=$(this);
                    $.ajax({
                        type: 'GET',
                        url: '{{ url('getcities') }}',
                        data: {name: $(this).val(),"select":a},
                        success: function (data) {
                            // var form1=$(con).parentsUntil('.MyformTo');
                            var c=con.closest('form').find("[name=city]");
                            c.html(data.citydata);
                        }
                    });
                })*/
                initialize2();
                function initialize2() {
                    var input = document.getElementById(addid);
                    var autocomplete = new google.maps.places.Autocomplete(input);
                    autocomplete.addListener('place_changed', function () {
                        var place = autocomplete.getPlace();
                        // place variable will have all the information you are looking for.
                        $(input).siblings('.lat').val(place.geometry['location'].lat());
                        $(input).siblings('.long').val(place.geometry['location'].lng());
                    });
                }
            }

            var input2 = document.querySelector('#'+intelid);
            window.intlTelInput(input2, {
                // any initialisation options go here
                {{--utilsScript: "{{url('public/build/js/utils.js')}}",--}}
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/utils.js",
                autoPlaceholder: true,
                initialCountry: "ca",
                allowExtensions: true,
                autoFormat: false,
                autoHideDialCode: false,
                // geoIpLookup: "auto",
                defaultCountry: "ca",
                ipinfoToken: "yolo",
                nationalMode: false,
                numberType: "MOBILE",
                preventInvalidNumbers: true,

                geoIpLookup: function (success, failure) {
                    $.get("https://ipinfo.io", function () {
                    }, "jsonp").always(function (resp) {
                        var countryCode = (resp && resp.country) ? resp.country : "";
                        success(countryCode);
                    });
                },
            });

            $(".col-sm").droppable({
                accept: ".packagediv, .package-data ",
                drop: function(event, ui) {

                    var ele=ui.draggable;
                    var $this=event.target;

                    $('.ui-draggable-handle').removeAttr('style');

                    $($this).children().find('.add-package').before(ele);
                    var pkgno=$(ele).find('.package-button').clone().remove().end().text();//fetch current location
                    var targetpkg=$($this).find('.packageloc').clone().remove().end().text();//to fetch in location package will drop


                    pkgno=$.trim(pkgno.split("  ").join(" "));//for space issue

                    $("input[name=pkgcnt]").each(function() {
                        var $this2=$(this);
                        var value=$(this).val();


                        if(value == pkgno){
                            var ele2=$($this2).parents('.package-data').first();
                            var locatondd=$(ele2).children('.package_form').first().find('.uniqlocation :nth-child(1)').children("option:selected").text();//to fetch value of location element of current draggable form

                            if(locatondd == targetpkg) {//to check if package will drop to the location which is given to its location element
                                $(ele2).children('.package_form').first().find('.uniqlocation :nth-child(1)').children("option:selected").remove();//if both match then remove that selected
                            }

                            $(ele).after(ele2);

                            var place=setpackage_place(this);//fetch place of location where package move.

                            $(this).next('input[name="place"]').val(place);//assign place to the form  element

                            $('.package-data').css('display','none');
                            var clsnm=$(ele).find('.package-button :nth-child(1)');
                            var chk=$(clsnm).hasClass('fa fa-minus');//change sign after display none
                            if(chk == true){
                                $(clsnm).removeClass("fa fa-minus");
                                $(clsnm).addClass("fa fa-plus");
                            }
                            chechall();
                        }
                    });
                }
            });

            // });
            $(".suggestadd").on('input',function(e){
                if($(this).val()==""){
                    $(this).next('.suggesstion-box').hide();
                }
                addresssuggestion(this);
            });

            function addresssuggestion(suggestadd) {
                var toadd=$(suggestadd).val();
                var $this=$(suggestadd);
                var url="{{ url('setaddresssuggestion') }}"+"/"+toadd;
                $.ajax({
                    type: 'get',
                    url: url,
                    success: function (res) {
                        if (res.success == true) {
                            $($this).next('.suggesstion-box').show();
                            $($this).next('.suggesstion-box').removeAttr('hidden');
                            // $($this).next('.suggesstion-box').find('.country-list li').html(res.message);
                            $($this).next('.suggesstion-box').find('.country-list').html(res.message);
                            // $($this).parents('.form-group').first().find('.lat').val(res.lat);
                            // $($this).parents('.form-group').first().find('.long').val(res.lon);
                            $($this).css("background","#E0E0E0");
                        }
                    }
                });
            }

            function selectCountry(val) {
                $(".suggestadd").val(val);
                $(".suggesstion-box").hide();
            }

            $(document).on('click','.country-list li',function(){
                var content=$(this).clone().remove().end().text();
                $(this).parents('.form-group').first().find('.suggestadd').val(content);
                var latval=$(this).find('input[name="suggestlat"]').val();
                var longval=$(this).find('input[name="suggestlong"]').val();
                $(this).parents('.form-group').first().find('.lat').val(latval);
                $(this).parents('.form-group').first().find('.long').val(longval);
                $(this).parents('.suggesstion-box').hide();
                $(this).parents('.suggestadd').css('color','#495057');
            });

        });

        function set_sign(classnm){
            if($(classnm).css('display') == 'block'){
                var $this=$(classnm);
                var elem=$($this).prev().find('.faplus');

                if(elem.hasClass('fa-plus')){
                    elem.removeClass('fa-plus');
                    elem.addClass('fa-minus');
                }
            }
        }

        $(document).on('click','.fa-dest-add',function(){
            var res=addremovedest(this);
            if(res==true){
                $(this).parents('.index-div').next('.add_destination').slideToggle(200);
            }

        });

        $(document).on('click', '#next-button', function () {
            $('#mobile-error').removeAttr('hidden');
            $('#mobile_number-error').removeAttr('hidden');
            $('.num_er').removeAttr('hidden');
            $('#toaddress-error').removeClass('none-display');
            $('#address-error').removeClass('none-display');
            $('.address-error').removeClass('none-display');
            validateLoactions();
            validate_Dest_Loactions();

            $('.big-date-error').html("");
            $('.big-time-error').html("");

            $('.package_form').each(function () { //for validate packages
                PackageValidate(this);
                $(this).valid();
            });

            var v = false;
            var v1 = false;
            var v2 = false;
            var v3= true;
            var v4= true;
            var v5= true;
            var v6= true;
            var a3 = [];
            var a2 = [];
            var a1 = [];

            if ($('.MyformFrom').valid()) {  //for validate from location
                v = true;
                a3.push(v);
            }
            else {
                $('.content').css("display", "block");
                set_sign('.content');
                v=false;
                a3.push(v);
                var msg=" Kindly Fill All Location!!!";
                display_error(msg);
            }

            if(a3.includes(false)){
                v=false;
            }
            else{
                v=true;
            }

            $('[class^="MyformTo"]').each(function () { //for validate all two locations

                if ($(this).valid()) {
                    v1=true;
                    a2.push(v1);
                }
                else{
                    $(this).parents('.dest-to').css("display", "block");
                    set_sign('.dest-to');

                    v1=false;
                    a2.push(v1);
                    var msg=" Kindly Fill All Location!!!";
                    display_error(msg);
                }
            });
            if(a2.includes(false)){//for check all form are properly filled up or not
                v1=false;
            }
            else{
                v1=true;
            }

            if(v1 == true){

                $('.package_form').each(function () { //for validate packages

                    PackageValidate(this);
                    if ($(this).valid()) {
                        v2=true;
                        a1.push(v2);
                    }
                    else{
                        $(this).parents('.package-data').css("display", "block");
                        set_sign('.package-data');
                        v2=false;
                        a1.push(v2);
                        var msg=" Kindly Fill All Packages!!!";
                        display_error(msg);
                    }
                });
            }

            if(a1.includes(false)){
                v2=false;
            }
            else{
                v2=true;
            }
            /*$("input[name=address]").each(function () {
                $(this).parent().find('#checkaddress-error').html("");
            });
            $("input[name=address]").each(function () {   //check for different address of "to locations" from "from location"
                if($(this).val()!="") {
                    if ($(this).val() == $("input[name=toaddress]").val()) {
                        // alert($(this).parent().find('#address-error').length);
                        $(this).parent().find('#checkaddress-error').html("Please enter different  address to From location.");
                        v3=false;
                    }
                }
            });*/
            $(".uniqueadd").each(function () {
                $(this).parent().find('#checkaddress-error').html("");
            });
            $('.uniqueadd').each(function () {
                var thisadd=$(this).val();
                var thisloc=$(this).parents('.col-sm').find('.index-div').first().find('a').clone().remove().text();
                if(thisadd!="") {
                    $('.uniqueadd').each(function () {
                        if ($(this).parents('.col-sm').find('.index-div').first().find('a').clone().remove().text() != thisloc) {
                            if($(this).val()!="") {
                                if ($(this).val() == thisadd) {
                                    display_error("Please enter different street address in each location.");
                                    v6 = false;
                                    $(this).parent().find('#checkaddress-error').html("Please enter different address");
                                }
                            }
                        }
                    })
                }
            })

            if($('#sms1').next('.fa-close').length>0){
                // console.log("not validate")
                v4=false;
                display_error("Please verify your mobile number");
            }

            $("input[name=date]").each(function() {
                var $this=$(this);
                var thisdate=$(this).val();
                var $this2=$(this).parentsUntil('form').find("input[name=time]");
                var thistime=$(this).parentsUntil('form').find("input[name=time]").val();
                var currloc=$(this).parents('.col-sm').find('a.packageloc').clone().remove().end().text();
                if (currloc!=" From Location A"){
                    $('.fromloc').find('.package-data').each(function() {
                        var frompkgdate=$(this).children('form').find("input[name=date]").val();
                        var frompkgtime=$(this).children('form').find("input[name=time]").val();
                        if(frompkgdate!=undefined && thisdate!=undefined && frompkgdate!='' && thisdate!='') {
                            if (frompkgdate == thisdate) {
                                if(frompkgtime!=undefined && thistime!=undefined && frompkgtime!='' && thistime!='') {
                                    if (frompkgtime >= thistime) {
                                        v5 = false;
                                        $($this2).parentsUntil('.row').find('.big-time-error').html("Please enter valid time.");
                                    }
                                }
                            }
                            if (frompkgdate > thisdate) {
                                v5 = false;
                                $($this).parentsUntil('.row').find('.big-date-error').html("Please enter valid date.");
                                display_error("Please enter to location packages date-time after from location packages date-time");
                            }
                        }
                    })
                }
            })

            if(v==true && v2==true && v1==true && v3==true && v4==true && v5==true && v6==true){
                // var theForm = $('#MyformTo2');

                // sessionStorage.setItem('formHTML', JSON.stringify(theForm.clone(true).html()));
                //
                // theForm.find('input,select').each(function() {
                //     sessionStorage.setItem(this.name, this.value);
                // });
                window.addEventListener('load', () => {
                    let form1 = document.getElementById('MyformTo1')
                    FormPersistence.persist(form1);

                });


                var loccnt=$('.MyformTo').length;
                var pkgcnt=$('.package_form').length;
                var form;

                form=new FormData($('#MyformFrom')[0]);
                form.append('loccnt', loccnt);
                form.append('pkgcnt', pkgcnt);
                var j=1;
                $('.MyformTo').each(function () {
                    var formto = $(this).serialize();
                    form.append("toform" + j, formto);
                    j++;
                });
                var p=1;

                $('.package_form').each(function () {
                    var packagedata = $(this).serialize();
                    form.append("packagedata" + p, packagedata);
                    $.each($(this).find('input[name=pkgimage]')[0].files, function(i, file) {
                        form.append('pkgimage' + p, file);
                    });
                    p++;
                });
                block_ui();
                var Url="{{ url('store_index_data1')}}";

                $.ajax({
                    type: 'POST',
                    url: Url,
                    data: form,
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (res) {
                        unblock_ui();
                        if (res.success == true) {
                            location.href="{{url('display_link_plan')}}";
                        }
                        else if(res.success == false){
                            console.log(res.message);
                        }
                    }
                });

            }
        });

        $(document).on('click','.add-package',function(){
            var pnumber=0;
            var lastpkg_curloc=$(this).parents('.pkg-div').find('.index-div').last().find('a').clone().remove().end().text().split(" ");
            // var arr=$(lastpkg_curloc).split(" ");
            console.log("lastpkg_curloc:",lastpkg_curloc);
            if(lastpkg_curloc[1]=="Package"){
                pnumber=lastpkg_curloc[2];
            }

            if (($(this).parents('.row').find('.package').length) > 14) {
                // alert("you only enter 15 package at particular loacation");
                $(this).css('display','none');
                display_error("You can only enter 15 packages at particular location");
            } else {
                var html = `<div class="index-div col-lg-8 packagediv signchange">
                <div class="request-i"><a href="javascript:void(0)" class="text-center package-button package"><i class="fa fa-plus faplus fapackage-add" aria-hidden="true"></i> Package ` + ++pnumber + ` <i class="fa fa-close package-close"  aria-hidden="true"></i></a></div>
                </div>
                <div class="form frompackage package-data" style="display: none;margin-right: 10px;">
                    <div class="heading">
                        <h4 style="color: black;text-align: center">Package Details</h4>
                    </div>
                    <form method="post" role="form" class="package_form" enctype="multipart/form-data">
                     {{csrf_field()}}
                <input type="hidden" name="pkgcnt" value="Package ` + ++packagecnt + `">
                        <input type="hidden" name="place" value="">

        <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set  col-6">
                   <div class="form-group">
                   <input type="text" name="weight" class="form-control allow_decimal" id="weight" style="border-top-right-radius: unset;border-bottom-right-radius: unset;" placeholder="Weight"/>
                   </div>
                </div>
               <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
               <div class="form-group">
<?php $packagekg = \App\Enums\Packagekg::asArray();?>
                <select class="form-control package-control package-weight" style="border-top-left-radius:unset;border-bottom-left-radius: unset;" name="packagekg">
@foreach($packagekg as $key=>$value)
                <option value="{{$value}}" <?php if ($key == "Kg") {
                    echo 'selected';
                } ?> >{{$key}}</option>
                                                                @endforeach
                </select>
                </div>
            </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set  col-6">
                <div class="form-group">
                    <input type="text" name="dimesionl" class="form-control package-control package-weight allow_decimal" id="dimesionl" placeholder="L"/>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
                <div class="form-group">
                    <input type="text" name="dimesionw" class="form-control package-control package-weight allow_decimal" id="dimesionw" placeholder="W"/>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set  col-6">
                <div class="form-group">
                    <input type="text" name="dimesionh" class="form-control package-control package-weight allow_decimal" id="dimesionh" placeholder="H"/>
                </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-set padding-left-0  col-6">
                <div class="form-group">
<?php $dimension = \App\Enums\Dimensions::asArray();?>
                <select class="form-control package-control package-weight input-number" name="dimensions">
@foreach($dimension as $key=>$value)
                <option value="{{$value}}" <?php if ($key == "Centimeter") {
                    echo 'selected';
                } ?>>{{$key}}</option>
                                        @endforeach
                </select>

                </div>
            </div>
    </div>
     <div class="form-group uniqlocation">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                     <select class="form-control package-control package-weight location" name="location">
                          <option value="">Location</option>
                     </select>
                </div>
            </div>
        </div>
    <div class="form-group">
        <div class="row">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Declared Value</label>--}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="text" name="dvalue" class="form-control dvalue-color" id="dvalue"  placeholder="Declared Value(Optional)"/>

{{--                                            <div class="validation"></div>--}}
                </div>
       {{--          <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 not-mobile-display" style="margin-left: -25px;">
                    <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 27px"></i>
                </div>--}}
                </div>
            </div>
                 <div class="row pkgdatetime">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Require Delivery Date & Time</label>--}}
                <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6 full-1024">
 <div class="form-group">
                    <input type="text" name="date" class="form-control package-control package-weight " id="date" placeholder="Date" onfocus="(this.type='date')"/>
                    <span class="big-date-error" style="color:red;"></span>
                </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-6 col-xs-6 mobile-top-margin full-1024">
                 <div class="form-group">
                    <input type="text" name="time" class="form-control package-control package-weight" id="time" placeholder="Time" onfocus="(this.type='time')"/>
                    <span class="big-time-error" style="color:red;"></span>
                </div>
         </div>
     </div>
            <div class="form-group">
                <div class="row">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Photo</label>--}}
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <input type="button" name="photo" class="form-control"  onclick="getFile(this)" value="Select Photo" />
                    <div style='height: 0px;width: 0px; overflow:hidden;'><input type="file" class="image" value="photo" name="pkgimage" onchange="sub(this)" /></div>
                <img class="package-img" style="display: none">
                    </div>
                </div>
            </div>


</form>

</div>`;
                var place=setpackage_place(this);
                // alert($(this).parents().find('input[name="place"]').length);
                $(this).before(html);
                if(pnumber==15){
                    $(this).css('display','none');
                }
                if ($(window).width() == 1024) {
                    $('.index-div').removeClass('col-lg-8');
                    $('.index-div').addClass('col-lg-11');
                }
                $(this).parents().first().find('input[name="place"]').val(place); //giv value to the current place element for arrangment in plan page

                $(".packagediv").draggable({
                    // obstacle: ".scrolling-wrapper",
                    // preventCollision: true,
                    // containment: ".col-sm",
                    helper: 'clone',
                    revert: 'invalid'
                });
                var $this=$('.packagediv');

                $('.packagediv').bind("drag", function(event, masterdrag) {
                    // alert($($this).next().find('.package-data').length);
                    $($this).next('.package-data').draggable();
                });

                var dtToday = new Date();
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if(month < 10)
                    month = '0' + month.toString();
                if(day < 10)
                    day = '0' + day.toString();
                var maxDate = year + '-' + month + '-' + day;
                $('input[name=date]').attr('min', maxDate);

                $(".allow_decimal").on("input", function(evt) {
                    var self = $(this);
                    self.val(self.val().replace(/[^0-9\.]/g, ''));
                    if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57))
                    {
                        evt.preventDefault();
                    }
                });

            }

        });

        $(document).on('click','.fapackage-add',function(){
            var res=addremove1(this);
            if(res==true){
                $(this).parents('.packagediv').next('.frompackage').slideToggle(200);
                // $(this).find('.frompackage').slideToggle(200);
            }

        });

        function setpackage_place(divclass){
            var placenm=$(divclass).parents('.col-sm').find('.index-button').first().text();
            return placenm;
        }

        function addremove1(classnm){
            var p=false;
            if($(classnm).hasClass("fa fa-plus")){
                $(classnm).removeClass("fa fa-plus");
                $(classnm).addClass("fa fa-minus");
                p=true;
            } else if ($(classnm).hasClass("fa fa-minus")) {
                $(classnm).removeClass("fa fa-minus");
                $(classnm).addClass("fa fa-plus");
                p = true;
            }
            if (p == true) {
                return true;
            }

        }

        var moold = "";


        function addremovedest(classnm) {
            var p = false;
            if ($(classnm).hasClass("fa fa-plus")) {
                $(classnm).removeClass("fa fa-plus");
                $(classnm).addClass("fa fa-minus");
                p = true;
            } else {
                $(classnm).removeClass("fa fa-minus");
                $(classnm).addClass("fa fa-plus");
                p=true;
            }
            if(p==true){
                return true;
            }

        }
        function addremove(classnm){
            var p=false;
            if($(classnm + "> i").hasClass("fa fa-plus")){
                $(classnm + "> i").removeClass("fa fa-plus");
                $(classnm + "> i").addClass("fa fa-minus");
                p=true;
            }
            else{
                $(classnm + "> i").removeClass("fa fa-minus");
                $(classnm + "> i").addClass("fa fa-plus");
                p=true;
            }
            if(p==true) {
                return true;
            }
        }

        $(document).on('click','.loc-close',function(){
            $('#add-loc').css('display','unset');
            var ab = 66;
            var text = $(this).parent().clone().remove().end().text();

            // var value = $(this).parents('.index-div').next('.dest-to').find('.MyformTo').attr('id');
            var last=$('.packageloc').last().clone().remove().end().text();

            $(this).parents('.toloc').remove();
            $('.toloc').each(function () {
                var abc = String.fromCharCode(++ab);
                $($(this).find('.location-button').html("<i class='fa fa-plus faplus fa-dest-add' aria-hidden='true'></i>To Location " + abc + "<i class='fa fa-close loc-close loc1-close'  aria-hidden='true'></i>")); ////reset all location counter of (a,b,c,d)
            });

            loc=ab;

            var cnt1=0;
            $('.MyFormReset').each(function () {
                $(this).attr('id', "MyformTo" + ++cnt1);
                $(this).find('input[name="formname"]').attr('value',"MyformTo"+ cnt1);
            });


            $(".package-data").each(function () {
                var optext=$(this).find('.location option:selected').text();
                var opvalue=$(this).find('.location option:selected').val();

                if(text == optext){//if text match then remove
                    $(this).find('.location option[value='+ opvalue +']').remove();
                }

                if(optext == last){//to remove last location
                    $(this).find('.location option[value='+ opvalue +']').remove();
                }
            });
            formcnt=cnt1;
        });

        $(document).on('click', '.package-close', function () {
            $(this).parents('.row').find('.add-package').css('display','unset');
            var $this=$(this).parents('.pkg-div');
            var pcnt = 1;
            var p=0;
            var currloc=$(this).parents('.pkg-div').find('.index-div').first().find('a').clone().remove().end().text();
            if(currloc==" From Location A"){
                var p=1;
            }
            $(this).parents('.packagediv').next('.frompackage').remove(); //first remove form
            $(this).parents('.packagediv').remove(); //remove that package div
            $($this).find('.packagediv').each(function() {
                $($(this).find('.package-button').html("<i class='fa fa-plus fapackage-add faplus' aria-hidden='true'></i> Package " + ++p + "<i class='fa fa-close package-close'  aria-hidden='true'></i>"));
                $(this).next('.frompackage').find('input[name="pkgcnt"]').val('Package ' + p);
            })
            $('.packagediv').each(function () {
            //     $($(this).find('.package-button').html("<i class='fa fa-plus fapackage-add faplus' aria-hidden='true'></i> Package " + ++pcnt + "<i class='fa fa-close package-close'  aria-hidden='true'></i>")); //reset all packages counter of (1,2,3,4)
                $(this).next('.frompackage').find('input[name="pkgcnt"]').val('Package ' + pcnt);
            });
            packagecnt = pcnt; //to continue counter which define above
        });

        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z ]+$/i.test(value);
        }, "Please enter alphabets only");
        jQuery.validator.addMethod("mobile", function (value, element) {


            var pattern = /^\d{10}$/i;
            var name = element.name;
            // if(value != ( moold ?? ""))
            // {
            //
            // }


            if (this.optional(element) || pattern.test(value)) {
                if (name == "mobile" && (value != (moold ?? ""))) {
                    $('.send-otp').removeAttr('disabled');
                    $('.send-otp').css('display','unset');
                    // $(".otp-field-main").val('');
                    $('.send-verification').removeAttr('readonly');
                    $('.send-verification').css('display','unset');
                    $('#sms1').removeAttr('readonly');
                    $('#sms1').val('');
                    $('.fa-check').remove();
                    $('.fa-close').remove();
                }
                return true
            } else {
                if (name == "mobile" && (value != (moold ?? ""))) {
                    $('.send-otp').attr('disabled', 'disabled');
                    $('.send-verification').css('display', 'block');
                    $('.send-otp').val('Send OTP');
                }
                return false;
            }
        }, "Please enter 10 digit mobile number");
        jQuery.validator.addMethod("mobile1", function (value, element) {


            var pattern = /^\d{10}$/i;
            var name = element.name;
            // if(value != ( moold ?? ""))
            // {
            //
            // }


            if (this.optional(element) || pattern.test(value)) {

                return true
            } else {

                return false;
            }
        }, "Please enter 10 digit mobile number");
        jQuery.validator.addMethod("isValidEmailAddress", function (value, element) {
            var pattern = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;

            return this.optional(element) || pattern.test(value);
        }, "Enter valid Email");
        jQuery.validator.addMethod("validateaddress", function (value, element) {
            return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
        }, 'Please enter without special characters.');
        jQuery.validator.addMethod("onlyNumbersAlphabets", function (value, element) {
            return this.optional(element) || /^[a-zA-Z0-9 ]+$/i.test(value);
        }, "Please enter Alphabets and numbers only");

        function validateLoactions() {
            $('#mobile-error').removeAttr('hidden');
            $('#mobile_number-error').removeAttr('hidden');
            $('.num_er').removeAttr('hidden');
            $.validator.setDefaults({
                ignore: []
            });
            var temp = 0;
            $('.MyformFrom').validate({
                onkeyup: function (element) {
                    $(element).valid()
                },
                rules: {
                    name1: {
                        "lettersonly": true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    "company1": {"required": true},
                    country1: 'required',
                    email1: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        email: true,
                        isValidEmailAddress: true
                    },
                    mobile: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        number: true,
                        mobile: true
                    },
                   /* otp: {
                        required: true,
                        remote: {
                            url: "{{url('otpVerified')}}",
                            type: "post",
                            data: {
                                _token: function () {
                                    return "{{csrf_token()}}";
                                }
                            }
                        }
                    },*/
                    sms1: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        number: true
                    },
                    toaddress: {
                        // address: true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    toaddress1: {
                        validateaddress: true,
                        // required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    city1:{
                        lettersonly: true,
                    },
                    postalcode1:{
                        onlyNumbersAlphabets:true,
                    }
                },
                messages: {
                    name1: {"required": 'Please enter Your Name'},
                    company1:{
                        required:'Please enter Your Company Name'
                    },
                    country1:{
                        required:'Please Select Country',
                    },
                    toaddress:{
                        required:'Please Enter Correct Street Address',
                    },
                    mobile:{
                        required:'Please enter 10 digit mobile number'
                    },
                    email1:{
                        required:'Please Enter Valid Email'
                    },
                    sms1:{
                        required:'Please Enter Valid OTP'
                    }
                },
            });
        }

        function validate_Dest_Loactions() {
            $('#mobile-error').removeAttr('hidden');
            $('#mobile_number-error').removeAttr('hidden');
            $('.num_er').removeAttr('hidden');
            var fromaddress=$("input[name=toaddress]").val();
            $('.MyformTo').each(function () {
                $(this).validate({
                    onkeyup: function (element)
                    {
                        $(element).valid()
                    },
                    rules: {
                        address: {
                            // address: true,
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        } ,
                        address1: {
                            validateaddress: true,
                            // required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        name: {
                            "lettersonly": true,
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        email: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                            email: true,
                            isValidEmailAddress: true
                        },
                        company: {
                            required:true,
                            // lettersonly: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                        },
                        country: {
                            required: true,
                        },
                        mobile_number: {
                            required: true,
                            normalizer: function (value) {
                                return $.trim(value);
                            },
                            number: true,
                            mobile1: true
                        },
                        city:{
                            lettersonly: true,
                        },
                        postalcode:{
                            onlyNumbersAlphabets:true,
                        }
                    },
                    messages: {
                        mobile_number: 'Please enter 10 digit mobile number',
                        name :{
                            required:'Please enter Your Name',
                        },
                        company:{
                            required:'Please enter Your Company Name',
                        },
                        country:{
                            required:'Please Select Country',
                        },
                        address:{
                            required:'Please Enter Correct Street Address',
                        },
                        email:{
                            required:'Please Enter Valid Email'
                        }
                    },
                });
            });
            // jQuery.validator.addClassRules({
            //
            //     address: {
            //         address: true,
            //         required: true,
            //         normalizer: function (value) {
            //             return $.trim(value);
            //         },
            //     } ,
            //     address1: {
            //         lettersonly: true,
            //         required: true,
            //         normalizer: function (value) {
            //             return $.trim(value);
            //         },
            //     },
            //     name: {
            //         "lettersonly": true,
            //         required: true,
            //         normalizer: function (value) {
            //             return $.trim(value);
            //         },
            //     },
            //     email: {
            //         required: true,
            //         normalizer: function (value) {
            //             return $.trim(value);
            //         },
            //         email: true,
            //         isValidEmailAddress: true
            //     },
            //     country: {
            //         required: true,
            //     },
            //     mobile_number: {
            //         required: true,
            //         normalizer: function (value) {
            //             return $.trim(value);
            //         },
            //         number: true,
            //         mobile1: true
            //     },
            //     messages: {
            //         mobile_number: 'Please enter 10 digit mobile number....',
            //     },
            // });
            $('[class^="MyformTo"]').each(function () {
                $(this).valid();
            });
        }

        function PackageValidate(form) {

            $(form).validate({
                onkeyup: function (element) {
                    $(element).valid()
                },
                rules: {
                    weight: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        // digits: true,
                    },
                    dimesionl: {
                        // digits: true,
                    },
                    dimesionw: {
                        // digits:true,
                    },
                    dimesionh: {
                        // digits:true,
                    },

                    dvalue: {
                        digits:true,
                    },
                    date: {
                        required: true,
                    },
                    location: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                },
                messages:{
                    weight:{
                        required:'Please Enter Weight'
                    },
                    location:{
                        required:'Please Select Location'
                    },
                    date:{
                        required:'Please Select Date'
                    },
                    time:{
                        required:'Please Select Time'
                    }
                },
            }).settings.ignore = [];


        }

        $(document).on('click','.location',function(ev){
            if(ev.offsetY < 0){
                console.log("hello");//when user click on option
            }else {
                var $loc = $(this);
                var loc1=[];
                var current=$(this).parents('.col-sm').find('.packageloc').clone().remove().end().text();//fetch current location

                $($loc).find('option').not(':first').remove();
                $(".packageloc").each(function () {
                    var id = $(this).parents('.index-div').next('.dest-to').find('.MyformTo').attr('id');//find id of form
                    if(id==undefined){
                        id="MyformFrom";
                    }
                    var value = $(this).clone().remove().end().text(); //find value of location
                    if(current != value){ //not display curent location
                        var html = `<option value="` + id + `">` + value + `</option>`;
                        loc1.push(html);
                        // $(loc1).append(html);
                    }

                });
                $($loc).append(loc1);

            }
        });


        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
            if(!allowedExtensions.exec(file)){
                obj.value="";
                display_error('Invalid Image Extension.');

            }else{
                readURL(obj);
            }
        }
        function getFile(ele) {
            $(ele).next('div').children('.image').click();
            // document.getElementsByClassName("image").click();
        }

        $(".suggestadd").on('input',function(e){
            if($(this).val()==""){
                $(this).next('.suggesstion-box').hide();
            }
            addresssuggestion(this);
        });

        function addresssuggestion(suggestadd) {
            var toadd=$(suggestadd).val();
            var $this=$(suggestadd);
            var url="{{ url('setaddresssuggestion') }}"+"/"+toadd;
            $.ajax({
                type: 'get',
                url: url,
                success: function (res) {
                    if (res.success == true) {
                        $($this).next('.suggesstion-box').show();
                        $($this).next('.suggesstion-box').removeAttr('hidden');
                        // $($this).next('.suggesstion-box').find('.country-list li').html(res.message);
                        $($this).next('.suggesstion-box').find('.country-list').empty();
                        $($this).next('.suggesstion-box').find('.country-list').html(res.message);
                        // $($this).parents('.form-group').first().find('.lat').val(res.lat);
                        // $($this).parents('.form-group').first().find('.long').val(res.lon);
                        $($this).css("background","#E0E0E0");
                    }
                }
            });
        }

        function selectCountry(val) {
            $(".suggestadd").val(val);
            $(".suggesstion-box").hide();
        }

        $(document).on('click','.country-list li',function(){
            var content=$(this).clone().remove().end().text();
            $(this).parents('.form-group').first().find('.suggestadd').val(content);
            var latval=$(this).find('input[name="suggestlat"]').val();
            var longval=$(this).find('input[name="suggestlong"]').val();
            $(this).parents('.form-group').first().find('.lat').val(latval);
            $(this).parents('.form-group').first().find('.long').val(longval);
            $(this).parents('.suggesstion-box').hide();
            $(this).parents('.suggestadd').css('color','#495057');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {

                var reader = new FileReader();
                reader.onload = function (e) {
                    $(input).parent().next('.package-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
            $(input).parent().next('.package-img').css('display','block');
        }

        var input1 = document.querySelector("#mobile1");
        window.intlTelInput(input1, {
            // any initialisation options go here
            {{--utilsScript: "{{url('public/build/js/utils.js')}}",--}}
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/utils.js",
            autoPlaceholder: true,
            initialCountry: "ca",
            allowExtensions: true,
            autoFormat: false,
            autoHideDialCode: false,
            // geoIpLookup: "auto",
            defaultCountry: "ca",
            ipinfoToken: "yolo",
            nationalMode: false,
            numberType: "MOBILE",
            preventInvalidNumbers: true,
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });

        var input = document.querySelector("#mobile_number1");
        window.intlTelInput(input, {
            // any initialisation options go here
            {{--utilsScript: "{{url('public/build/js/utils.js')}}",--}}
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/12.1.5/js/utils.js",
            autoPlaceholder: true,
            initialCountry: "ca",
            allowExtensions: true,
            autoFormat: false,
            autoHideDialCode: false,
            // geoIpLookup: "auto",
            // defaultCountry: "ca",
            ipinfoToken: "yolo",
            nationalMode: false,
            numberType: "MOBILE",
            preventInvalidNumbers: true,
            geoIpLookup: function(success, failure) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    success(countryCode);
                });
            },
        });

        function handleEnterKey(e){
            if(e.keyCode == 13){ // enter pressed
                try{
                    e.preventDefault ? e.preventDefault() : (e.returnValue = false);
                }catch(err){
                    console.log(err.message);
                }
            }
        }
        //first
        $(document).on('click','#mobile1',function(){
            $(this).attr('disabled',true);
        });
        $(document).on('click','.mobile_number1',function(){
            $(this).attr('disabled',true);
        });
        $(document).on('click','.iti__country-list',function(){
            $('#mobile1').attr('disabled',true);
            $('.mobile_number1').attr('disabled',true);
        });
        $(document).on('click','.iti__flag-container',function(){
            $('#mobile1').removeAttr('disabled');
            $('.mobile_number1').removeAttr('disabled');
        });
        $("#mobile1").attr("tabindex", "-1");
        $(".mobile_number1").attr("tabindex", "-1");


        function block_ui()
        {
            $.blockUI({ message: '<img src="{{url('public/images/loader.gif')}}" />',
                css: {
                    border: 'none',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    backgroundColor: 'unset',
                }});
        }

        function unblock_ui()
        {
            $.unblockUI();
        }

        function display_error(msg){
            var html=`<div class="alert alert-danger remove-error" style="margin-top: 10px;">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>`+msg+`</strong>
                        </div>`;
            $('#error-display').empty();
            $('#error-display').html(html);
            timeout();
            scrollToTop();
        }
        function scrollToTop() {
            // window.scrollTo(0, 0);
            $(".scrolling-wrapper").animate({scrollTop:$('div#error-display').offset().top}, 500);

        }

        function timeout(){
            setTimeout(function(){
                $(".remove-error").remove();
            }, 8000 );
        }

        function chechall(){
            $('.signchange').each(function () {
                if ($(this).next().css('display') == 'none') {
                    var clsnm = $(this).find('.package :nth-child(1)');
                    var chk = $(clsnm).hasClass('fa fa-minus');//change sign after display none
                    if (chk == true) {
                        $(clsnm).removeClass("fa fa-minus");
                        $(clsnm).addClass("fa fa-plus");
                    }
                }
            });
        }

        var tmp = 0;

        $("#mobile").focus(function () {
            if (tmp == 0) {
                validateLoactions();
                tmp = 1;
            }

            $(this).select();
        });
        $("#mobile").click(function () {

            $(this).focusout();

        })


        $(".send-otp").click(function () {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ url('sendOtp') }}',
                data: {mobile1: $("#mobile1").val(),mobile: $("#mobile").val(),_token:'{{csrf_token()}}'},

                success: function (msg) {
                    if (msg.success) {
                        $('.send-otp').val('Resend');
                        $('.send-verification').removeAttr('disabled');
                        $('.mobile-error-class').html('');
                    } else {
                        $('.send-verification').attr('disabled', "disabled");
                        $('.mobile-error-class').html(msg.message);
                    }
                }
            });

            $('#sms1').val("");
            $('.fa-close').remove();
            $('.fa-check').remove();

        });
        var x = 0;

        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }

        $('.send-verification').click(async function () {
            moold = $('#mobile').val();

            $x = $('#sms1').val();
            $(".otp-field-main").val($x);
            $(".otp-field-main").keyup();
            $(".otp-field-main").keypress();
            await sleep(1000);
            // alert();
            /*if ($('.otp-field-main').hasClass('valid')) {
                console.log("verified");
                jQuery.noConflict();
                $('#verifiedmodal').modal('show');
                // $(".otp-field-main").attr('type',"hidden");
                $('.send-verification').css('display', 'none');
                $('#sms1').attr('readonly', 'readonly');
                // $('.send-otp').attr('disabled', 'disabled');
                $('.send-otp').css('display', 'none');
                $('.send-verification').attr('disabled', 'disabled');
            }*/
            $.ajax({
                type: 'POST',
                url: '{{ url('verifyotp') }}',
                data: {otp:$('#sms1').val(),_token:'{{csrf_token()}}'},
                success: function (data) {
                    if (data.success==true) {
                        // jQuery.noConflict();
                        // $('#verifiedmodal').modal('show');
                        $('.send-verification').css('display', 'none');
                        $('#sms1').attr('readonly', 'readonly');
                        $('.fa-close').remove();
                        $("<i class='fa fa-check' aria-hidden='true' style='color: green;font-size: x-large;position: relative;left:-32px;top:5px;'></i>").insertAfter($("#sms1"));
                        $('.send-otp').css('display', 'none');
                        $('.send-verification').attr('disabled', 'disabled');
                        // $('.verify-otp').removeClass("error");
                        $('.verify-otp').html("");
                    } else {
                        // jQuery.noConflict();
                        // $('#unverifiedmodal').modal('show');
                        // $('.verify-otp').addClass("error");
                        $('.verify-otp').html("Invalid OTP");
                        $('.fa-check').remove();
                        if($('#sms1').nextAll('.fa-close:first').length==0){
                            $("<i class='fa fa-close' aria-hidden='true' style='color: red;font-size: x-large;position: relative;left:-32px;top:5px;'></i>").insertAfter($("#sms1"));
                        }
                    }
                }
            });
        });

        $('.number-only').keydown(function (event) {
            if (event.shiftKey == true) {
                event.preventDefault();
            }

            if ((event.keyCode >= 48 && event.keyCode <= 57) ||
                (event.keyCode >= 96 && event.keyCode <= 105) ||
                event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 ||
                event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190) {

            } else {
                event.preventDefault();
            }

            if ($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();
            //if a decimal has been added, disable the "."-button

        });

        function valid_input_number(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (
                (charCode != 46 || $(element).val().indexOf('.') != -1) &&      // “.” CHECK DOT, AND ONLY ONE.
                (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

        /*$('#fafa').click(function () {

            if ($(this).hasClass('fa-minus') == false) {
                validateLoactions();
                $('.MyformFrom').valid();
                validate_Dest_Loactions();
                $('.package_form').each(function () { //for validate packages

                    PackageValidate(this);
                    $(this).valid();
                });
            }
        })*/
        $(document).on("focus",".location",async  function () {
             $(this).click();
             await sleep(500);
        })

        var chk=0;
        $("#name1").focusout(async  function () {
            validateLoactions();
            await sleep(300);
            if( $(this).hasClass('error') )
            {
                if(chk==0) {
                    $(this).focus();
                    chk=1;
                }
            }
        })

        $(document).ready(function () {
            var dtToday = new Date();
            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;
            // alert(maxDate);
            $('input[name=date]').attr('min', maxDate);
        })

        var a="";
        $('#country1').change(function () {
            $.ajax({
                type: 'GET',
                url: '{{ url('getprovinces') }}',
                data: {id: $(this).val(),"select":a},
                success: function (data) {
                    $('#province1').html(data.provincedata);
                }
            });
        })

        /*$('#province1').change(function () {
            $.ajax({
                type: 'GET',
                url: '{{ url('getcities') }}',
                data: {name: $(this).val(),"select":a},
                success: function (data) {
                    $('#city1').html(data.citydata);
                }
            });
        })*/


        $("select[name=country]").change(function () {
            var con=$(this);
            $.ajax({
                type: 'GET',
                url: '{{ url('getprovinces') }}',
                data: {id: $(this).val(),"select":a},
                success: function (data) {
                    // var form1=$(con).parentsUntil('.MyformTo');
                    console.log(con.closest('form').find("[name=province]"));
                    var p=con.closest('form').find("[name=province]");
                    p.html(data.provincedata);
                }
            });
        })

        /*$("select[name=province]").change(function () {
            var con=$(this);
            $.ajax({
                type: 'GET',
                url: '{{ url('getcities') }}',
                data: {name: $(this).val(),"select":a},
                success: function (data) {
                    // var form1=$(con).parentsUntil('.MyformTo');
                    var c=con.closest('form').find("[name=city]");
                    c.html(data.citydata);
                }
            });
        })*/
        $(".allow_decimal").on("input", function(evt) {
            var self = $(this);
            self.val(self.val().replace(/[^0-9\.]/g, ''));
            if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57))
            {
                evt.preventDefault();
            }
        });


    </script>

@endsection
