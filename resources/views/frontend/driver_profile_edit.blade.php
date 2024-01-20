@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Profile</title>
@endsection
@section('content')
    <style>
        .otp-field-main
        {
            display: none;
        }
    </style>
    <style>
        *[role="document"] .modal-content{
            height: 500px!important;
        }
    </style>
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1 response-modal md1" role="document">
                <form method="POST" role="form"  action="{{url('update_driver_profile/'.$driver->id.'/')}}" id="DriverEditProfile" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="modal-content container">

                        <div class="modal-header" style="display: inline">
                            @if($driver->profile_pic)
                                <img src="{{$driver->profile}}" height="150px" width="150px" class="img-responsive" id="profile_img">
                            @else
                                <img src="{{url('public/images/avatar.jpg')}}" height="150px" width="150px" class="img-responsive" id="profile_img">
                            @endif
                            {{--                            <img id="profile_img" src="{{$driver->profile}}" height="150px" width="150px" class="img-responsive"/>--}}

                            <div class="row set-center" style="margin-top: 10px">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <input type="button" name="photo" class="form-control" id="photo_pic"  value="Change Profile Picture" style="background-color: #FFC56C;color: white;" onclick="getFile()" />
                                    <div style='height: 0px;width: 0px; overflow:hidden;'><input id="profile" type="file" value="photo" name="profile" onchange="sub(this)"/></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">



                            @include('frontend.driver_field')
                            <div class="row set-center"  style="margin-top: -65px;">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" >
                                    <input type="submit" class="form-control" style="background-color: #FFC56C;color: white;" value="Save Profile"/>
                                </div>

                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" >
                                    <a class="form-control back-button" href="{{url('/home_driver')}}" style="width: 100%"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('main_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDk8xJ1I8BiADJ_XWxgNVRuPMdR1GnLMbo"></script>  <!-- autocomplete address api -->
    <script>
        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
            if(!allowedExtensions.exec(file)){
                obj.value="";
                alert('Invalid Image Extension.');

            }else{
                readURL(obj);
            }

        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile_img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        function getFile() {
            document.getElementById("profile").click();
        }

        function getCarFile1() {
            document.getElementById("carimage1").click();
        }

        function sub1(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
            if(!allowedExtensions.exec(file)){
                obj.value="";
                alert('Invalid Image Extension.');

            }else{
                readURL1(obj);
            }

        }
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#car_img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }
        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            var input = document.getElementById('address1');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                // place variable will have all the information you are looking for.
                // $(input).siblings('.lat').val(place.geometry['location'].lat());
                // $(input).siblings('.long').val(place.geometry['location'].lng());
            });
        }

        $(document).ready(function() {
            jQuery.validator.addMethod("exactlength", function(value, element, param) {
                return this.optional(element) || value.length == param;
            }, $.validator.format("Please enter exactly {0} characters."));
            jQuery.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
            }, "Please enter alphabets only");
            jQuery.validator.addMethod("valnull", function (value, element) {
                return this.optional(element) || value!="Select Model Name";
            },"Model Name is required");
            jQuery.validator.addMethod("address", function (value, element) {
                return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
            }, 'Please enter without special characters.');
            jQuery.validator.addMethod("onlyNumbersAlphabets", function (value, element) {
                return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
            }, 'Please enter Alphabets and numbers only');
            $("#regno1").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    // $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });
            $("#insuranceno1").keypress(function (e) {
                //if the letter is not digit then display error and don't type anything
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    //display error message
                    // $("#errmsg").html("Digits Only").show().fadeOut("slow");
                    return false;
                }
            });


            $('#DriverEditProfile').validate({
                rules: {
                    fname1: {
                        required: true,
                        lettersonly:true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    lname1:{
                        required: true,
                        lettersonly:true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    cmake: {
                        required: true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    modelnm: {
                        required: true,
                        valnull: true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    year: {
                        required: true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                        number: true,
                        exactlength: 4
                    },
                    address1: {
                        required: true,
                        address: true,
                        // minlength: 10
                    },
                    regno1:{
                        required: true,
                    },
                    insuranceno1:{
                        required: true,
                    },
                    licenceno1:{
                        onlyNumbersAlphabets:true,
                        required: true
                    }
                },
                messages: {
                    fname1: {
                        required:'First Name is required',
                    },
                    lname1: {
                        required:'Last Name is required',
                    },
                    modelnm:{
                        required:'Model Name is required',
                    },
                    cmake:{
                        required:'Car Make is required',
                    },
                    year:{
                        required:'Select Year is required',
                    },
                    address1:{
                        required:'Address is required'
                    },
                    regno1:{required:'Registration Number is required'},
                    insuranceno1:{required:'Insurance Number is required'},
                    licenceno1:{required:'Licence Number is required'},
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection

