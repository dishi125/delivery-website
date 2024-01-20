@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Delivery In Hour</title>
@endsection

@section('content')
    <style>
        @media (min-width: 1025px) {
            .suggestionbox_size{
                width: 84%;
            }
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
            overflow-x: auto;
            overflow-y: hidden;
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

    </style>
    <link rel="stylesheet" href="{{ url('public/build/css/intlTelInput.css') }}">
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content container">
                    <section>
                        <div id="error-display"></div>


                        <div class="scrolling-wrapper">
                            <div style="margin-top: 50px;">

                                {{--                                set all location--}}
                                <?php
                                $loc=64;
                                $cnt=0;
                                $cnt_ext=0;
                                $formcnt=0;
                                ?>
                                @foreach($locations as $key => $loc1)
                                    <?php

                                    $tos = chr(++$loc);
                                    $intelid = "ext". ++$cnt_ext;
                                    ?>
                                    <div class="col-sm toloc" id="{{++$cnt}}">
                                        <div class="row">
                                            <div  class="index-div col-lg-8">
                                                <?php
                                                if($key == 0){?>
                                                <div class="request-i"><a href="javascript:void(0)" class="text-center index-button location-button packageloc"><i id="fafa" class="fa fa-plus fa-dest-add faplus" aria-hidden="true"></i> From Location A</a></div>
                                                <?php
                                                }else{
                                                ?>
                                                <div class="request-i"><a href="javascript:void(0)"  class="text-center index-button location-button packageloc"><i class="fa fa-plus faplus fa-dest-add" aria-hidden="true"></i> To Location <?php echo $tos; ?></a></div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                            <div style="display: none" class="add_destination dest-to">
                                                <div class="heading">
                                                    <h4 style="color: black;">Delivery Address <span style="color: black;" id="initialto"></span></h4>
                                                </div>
                                                <div class="form savedplanform">
                                                    <form method="post" role="form" class="MyformTo MyFormReset" id="MyformTo{{++$formcnt}}">
                                                        <input type="hidden" name="formname" value="MyformTo{{$formcnt}}">
                                                        <div class="form-group">
                                                            <input type="text" name="name" class="form-control name"  placeholder="Your Name" value="{{$loc1->name}}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" name="company" class="form-control"  placeholder="Company Name" value="{{$loc1->company_id}}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <select class="form-control country" name="country">
                                                                <option value="" style="color: #6C757D">Country</option>
                                                                @foreach($country as $cnt1)
                                                                    <option value="{{$cnt1->id}}" @if($loc1->country_id == $cnt1->id) selected @endif>{{$cnt1->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <?php
                                                        $name=\App\Models\Country::where('id',$loc1->country_id)->pluck('name')->first();
                                                        $provinces=\App\Models\Province::where('country_name',$name)->pluck('name');
//                                                        $cities=\App\Models\City::where('country_name',$name)->pluck('name');
                                                        ?>
                                                        <div class="form-group">
                                                            <select name="province" id="province" class="form-control">
                                                                <option value="" style="color: #6C757D">Province/Territory/State</option>
                                                                @foreach($provinces as $province)
                                                                    <option value="{{$province}}" @if($loc1->province==$province) selected @endif>{{ $province }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <?php
                                                        $cities=\App\Models\City::where('province_name',$loc1->province)->pluck('name');
                                                        ?>
                                                        <div class="form-group">
                                                           {{-- <select name="city" id="city" class="form-control">
                                                                <option value="" style="color: #6C757D">City</option>
                                                                @foreach($cities as $city)
                                                                    <option value="{{$city}}" @if($loc1->city==$city) selected @endif>{{ $city }}</option>
                                                                @endforeach
                                                            </select>--}}
                                                            <input type="text" class="form-control" name="city" id="city" placeholder="City" value="{{ $loc1->city }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="postalcode" id="postalcode" placeholder="Postal Code" value="{{ $loc1->postalcode }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control address suggestadd" name="address" id="address" placeholder="Street Address" autocomplete="off" onkeypress="handleEnterKey(event)" value="{{$loc1->street_add}}"/>
                                                            <div class="suggesstion-box" hidden="hidden">
                                                                <ul class="country-list suggestionbox_size">
                                                                    <li></li>
                                                                </ul>
                                                            </div>
                                                            <label id="" class="address-error error none-display" for="address"></label>
                                                            <input type="hidden" class="lat" name="lat" value="{{$loc1->lat}}">
                                                            <input type="hidden" class="long" name="long" value="{{$loc1->long}}">
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="text" class="form-control address1" name="address1" placeholder="Apt, Floor, Suite, etc.(Optional)" value="{{$loc1->street_add1}}"/>
                                                        </div>

                                                        <div class="form-group">
                                                            <input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile_number" id="mobile_number"
                                                                   class="form-control phone mobile_number" placeholder="Phone" style="margin-bottom: 0" value="{{$loc1->mobile}}"/>
                                                            <p style="display: inline;  position: absolute;margin-top: 5px;">Ext.</p>
                                                            <input type="tel" name="mobile_number1" class="form-control phone1 mobile_number1 inter_tel" placeholder="(Optional)" id="{{$intelid}}" value="{{$loc1->mobile1}}">
                                                            <label id="mobile_number-error" class="error num_er" for="mobile_number" hidden="hidden"></label>
                                                            {{--<input type="text" pattern="[1-9]{1}[0-9]{9}" name="mobile1" class="form-control phone1" placeholder="(Optional)">--}}
                                                        </div>
                                                        <div class="form-group"style="margin-top: 50px">
                                                            <input type="text" class="form-control sms" name="sms"  placeholder="SMS Verification" value="{{$loc1->sms_verification}}"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <input type="email" class="form-control email" name="email" placeholder="Email" value="{{$loc1->email}}"/>
                                                        </div>
                                                        {{--<input type="submit" style="display: none;">--}}
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="add-div add-package col-lg-8" style="display: none">
                                                <div class="request-i"><a href="javascript:void(0)"  class="text-center package-button" style="color: black;background-color: white;"><i class="fa fa-plus faplus" aria-hidden="true"></i> Add Package</a></div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div style="display: flex;justify-content: center;">
                                <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2 index-rem">
                                    <a href="javascript:void(0)" class="form-control index-footer set-right text-center" id="next-button">Next <i class="fa fa-arrow-right"></i></a>
                                </div>

                            </div><div style="display: flex;justify-content: center;">
                                <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto;margin-bottom: 20px">
                                    <a class="form-control set-right text-center back-button" href="{{url('/home_user')}}" style="width: 100%"><i class="fa fa-arrow-left"></i> Back</a>
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
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCP3oEgZ0L_dSOno0UVkci2sPllCC9gzX4&amp;libraries=places"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script src='https://cdn.jsdelivr.net/gh/FThompson/FormPersistence.js@2.0.6/form-persistence.min.js'></script>
    <script>

        $(document).ready(function () {
            $("input").attr('disabled', true);
            $("select").attr('disabled', true);
            assign_package();

            if ($(window).width() == 1024) {
                $('.index-div').removeClass('col-lg-8');
                $('.index-div').addClass('col-lg-11');
            }



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

        function set_sign(classnm){
            if($(classnm).css('display') == 'block'){
                var $this=$(classnm);
                var elem=$($this).prev().find('.faplus');
                console.log(elem);
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

        $(document).on('click','#next-button',function(){
            var id={{$id}}
            block_ui();
            location.href="{{url('/display_link_plan1')}}/"+id;

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
            }
            else if($(classnm).hasClass("fa fa-minus")){
                $(classnm).removeClass("fa fa-minus");
                $(classnm).addClass("fa fa-plus");
                p=true;
            }
            if(p==true) {
                return true;
            }

        }
        function addremovedest(classnm){
            var p=false;
            if($(classnm).hasClass("fa fa-plus")){
                $(classnm).removeClass("fa fa-plus");
                $(classnm).addClass("fa fa-minus");
                p=true;
            }
            else{
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


        function chechall(){
            $('.signchange').each(function () {
                if($(this).next().css('display')=='none'){
                    var clsnm= $(this).find('.package :nth-child(1)');
                    var chk=$(clsnm).hasClass('fa fa-minus');//change sign after display none
                    if(chk == true){
                        $(clsnm).removeClass("fa fa-minus");
                        $(clsnm).addClass("fa fa-plus");
                    }
                }
            });
        }

        function assign_package(){

                @foreach($pkgall as $pkg)
            var pkgchk="{{$pkg->packagecnt}}";

            var html = `<div class="index-div col-lg-8 packagediv signchange">
                <div class="request-i"><a href="javascript:void(0)" class="text-center package-button package"><i class="fa fa-plus faplus fapackage-add" aria-hidden="true"></i><?php echo $pkg->packagecnt ?> </a></div>
            </div>
            <div class="form frompackage package-data" style="display: none;margin-right: 10px;">
                <div class="heading">
                <h4 style="color: black;text-align: center">Package Details</h4>
            </div>
            <form method="post" role="form" class="package_form" enctype="multipart/form-data">

            <input type="hidden" name="pkgcnt" value="{{$pkg->packagecnt}}">
                <input type="hidden" name="place" value="{{trim($pkg->place)}}">
                <div class="form-group">
                <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 mobile-set mobile-width" style="padding-right: 0px;">
                <input type="text" name="weight" class="form-control" id="weight" style="border-top-right-radius: unset;border-bottom-right-radius: unset;" placeholder="Weight" value="{{$pkg->weight}}"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-set" style="padding-left: 0px">
                <?php $packagekg = \App\Enums\Packagekg::asArray();?>
            <select class="form-control package-control package-weight" style="border-top-left-radius:unset;border-bottom-left-radius: unset;" name="packagekg">
@foreach($packagekg as $key=>$value)
            <option value="{{$value}}" @if($pkg->packagekg==$value) selected @endif >{{$key}}</option>
            @endforeach
            </select>
            </div>

            </div>
            </div>

            <div class="form-group">
                <div class="row">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Dimensions(Optional)</label>--}}
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-set">
            <input type="text" name="dimesionl" class="form-control package-control package-weight " id="dimesionl" placeholder="L" value="{{$pkg->dimesionl}}"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-set">
                <input type="text" name="dimesionw" class="form-control package-control package-weight" id="dimesionw" placeholder="W" value="{{$pkg->dimesionw}}"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-set">
                <input type="text" name="dimesionh" class="form-control package-control package-weight" id="dimesionh" placeholder="H" value="{{$pkg->dimesionh}}"/>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mobile-set">
                <?php $dimension = \App\Enums\Dimensions::asArray();?>
            <select class="form-control package-control package-weight" name="dimensions">
@foreach($dimension as $key=>$value)
            <option value="{{$value}}"  @if($pkg->dimesions==$value) selected @endif>{{$key}}</option>
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
                <option value="{{$pkg->location}}" selected>{{$pkg->location1}}</option>
                        </select>
                        </div>
                        </div>
                        </div>
                        <div class="form-group">
                        <div class="row">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Declared Value</label>--}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <input type="text" name="dvalue" class="form-control dvalue-color" id="dvalue"  placeholder="Declared Value(Optional)" value="{{$pkg->dvalue}}"/>

                {{--                                            <div class="validation"></div>--}}
            </div>
            {{--  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 not-mobile-display" style="margin-left: -25px;">
            <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 27px"></i>
            </div>--}}
            </div>
            </div>
            <div class="form-group">
            <div class="row">
{{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Require Delivery Date & Time</label>--}}
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">

            <input type="text" name="date" class="form-control package-control package-weight " id="date" placeholder="Date" onfocus="(this.type='date')" value="{{$pkg->newdate}}"/>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 mobile-top-margin">
                <input type="text" name="time" class="form-control package-control package-weight" id="time" placeholder="Time" onfocus="(this.type='time')" value="{{$pkg->time}}"/>
                </div>
                </div>
                </div>
                <div class="form-group">
                <div class="row">
                {{--                                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Photo</label>--}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

@if($pkg->image==null)
            <img class="package-img" style="display:none;"/>
@else
            <img class="package-img" src="{{$pkg->Path}}"/>
                                                                @endif
            </div>
            </div>
            </div>


            </form>

            </div>`;

            var data = "{{$pkg->place}}";
            $('.packageloc').each(function () {
                var value = $(this).clone().remove().end().text();
                console.log("data: " + data);
                console.log("value: " + value);
                if ($.trim(data) == $.trim(value)) {
                    $(this).parents('.col-sm').find('.add-package').before(html);
                }
            });
            $("input").attr('disabled', true);
            $("select").attr('disabled', true);
            @endforeach

        }


    </script>

@endsection
