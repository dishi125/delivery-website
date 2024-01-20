@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sign Up</title>
@endsection
@section('css')
    <style>
        #otp-error
        {
            margin-left: 50% !important;
        }
        @media (max-width: 566px) {

            .send-otp-btn-pre {
                padding-left: 15px !important;
            }

            .mt-sm {

                margin-top: 20px;

            }

            .form-group .set-center {
                margin-bottom: unset !important;
            }

            .col-offset-1 {
                margin-left: 20px;
            }

            .display-none-otp {
                margin-left: -80px;
                padding-left: 0px !important;
            }

            .otp-field-main {
                top: 10px !important;
            }
        }
        input[type='radio']:after {
            width: 25px;
            height: 25px;
            border-radius: 25px;
            top: -2px;
            left: -5px;
            position: relative;
            background-color: white;
            content: '';
            display: inline-block;
            visibility: visible;
            border: 5px solid #ced4da;;
        }

        input[type='radio']:checked:after {
            width: 30px;
            height: 30px;
            border-radius: 25px;
            top: -2px;
            left: -5px;
            position: relative;
            background-color: #ffa500;
            /*content:  "\f00c";*/
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }

    </style>
@endsection
@section('content')
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal" aria-labelledby="exampleModalLabel" aria-hidden="true"
             style="display: block">
            <div class="modal-dialog1  md1" role="document" >
                <div class="modal-content container">


                    <div class="modal-header" style="margin-top: 25px;">
                        <div class="mobile-center col-md-6 col-lg-6 col-sm-6"
                             style="display: inherit;    justify-content: flex-end;">
                            <input type='radio' name="signupradio" value="User" checked/>
                            <p style="margin-left: 30px;font-weight: bold;">User</p>

                        </div>
                        <div class="mobile-center col-md-6 col-lg-6 col-sm-6" style="display: inherit;">
                            <input type='radio' name="signupradio" value="Driver"/>
                            <p style="margin-left: 30px;font-weight: bold;">Driver</p>

                        </div>


                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">

                            <form method="post" role="form" action="{{url('submitotp')}}" id="UsersignUp"
                                  enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field() }}
                                @include('frontend.user_field')
                                <div class="row set-center">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"
                                         style="margin-left: 15px;margin-right: 15px;">
                                        <input type="submit" class="form-control"
                                               style="background-color: #FFC56C;color: white;" value="SIGN UP"/>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="display: flex;justify-content: center;">Already a member ?<a
                                                href="{{url('signin?by=user')}}"
                                                style="color: #ffc107;font-weight: 600;">Log In</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        {{--                        driver sign up--}}
                        <div class="form" id="driver-form" style="display: none;">

                            <form method="post" role="form" action="{{url('driverotp')}}" id="DriversignUp"
                                  enctype="multipart/form-data" autocomplete="off" >
                                {{csrf_field()}}

                                @include('frontend.driver_field')
                                <div class="row set-center">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5"
                                         style="margin-left: 15px;margin-right: 15px;">
                                        <input type="submit" class="form-control"
                                               style="background-color: #FFC56C;color: white;" value="SIGN UP"/>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="display: flex;justify-content: center;">Already a member ?<a
                                                href="{{url('signin?by=driver')}}"
                                                style="color: #ffc107;font-weight: 600;">Log In</a></p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--                      end  driver sign up--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('main_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDk8xJ1I8BiADJ_XWxgNVRuPMdR1GnLMbo"></script>  <!-- autocomplete address api -->
    <script>

        $('.otp-field').focus(function () {
            $(this).val('');
        });

        function getCodeBoxElement(index) {

            return document.getElementById('codeBox' + index);
        }

        function onKeyUpEvent(index, event) {
            const eventCode = event.which || event.keyCode;

            if (getCodeBoxElement(index).value.length === 1) {
                if (index !== 4) {
                    getCodeBoxElement(index + 1).focus();
                } else {

                    getCodeBoxElement(index).blur();
                    var otp = "";
                    $('.otp-field').each(function () {
                        otp += $(this).val();
                    });
                    $("[name=otp]").val(otp);
                    $("[name=otp]").focusout();
                }
            }
            if (getCodeBoxElement(index).value.length > 1) {
                getCodeBoxElement(index).value = getCodeBoxElement(index).value[getCodeBoxElement(index).value.length - 1];

            }
            if (eventCode === 8 && index !== 1) {
                getCodeBoxElement(index - 1).focus();
            }


        }

        function onFocusEvent(index) {
            for (item = 1; item < index; item++) {
                const currentElement = getCodeBoxElement(item);
                if (!currentElement.value) {
                    currentElement.focus();
                    break;
                }
            }
        }

        function getCodeBoxElement1(index) {

            return document.getElementById('codeBox-' + index);
        }

        function onKeyUpEvent1(index, event) {
            const eventCode = event.which || event.keyCode;

            if (getCodeBoxElement1(index).value.length === 1) {
                if (index !== 4) {
                    getCodeBoxElement1(index + 1).focus();
                } else {

                    getCodeBoxElement1(index).blur();
                    var otp = "";
                    $('.otp-field').each(function () {
                        otp += $(this).val();
                    });
                    $("[name=otp1]").val(otp);
                    $("[name=otp1]").focusout();
                }
            }
            if (getCodeBoxElement1(index).value.length > 1) {
                getCodeBoxElement1(index).value = getCodeBoxElement1(index).value[getCodeBoxElement1(index).value.length - 1];

            }
            if (eventCode === 8 && index !== 1) {
                getCodeBoxElement1(index - 1).focus();
            }


        }

        function onFocusEvent1(index) {
            for (item = 1; item < index; item++) {
                const currentElement = getCodeBoxElement(item);
                if (!currentElement.value) {
                    currentElement.focus();
                    break;
                }
            }
        }
    </script>
    <script>

        // $(document).ready(function() {
        //     var searchParams = new URLSearchParams(window.location.search);
        //     var param = searchParams.get('by1');
        //     if(param=='user'){
        //         $("input[value='User']").attr('checked', true);
        //     }
        //     else{
        //         $("input[value='Driver']").attr('checked', true);
        //     }
        //
        // });
        var metch="User";
        $(document).ready(function() {
            $('input[name=signupradio]:radio').change(function(e) {
                var value = e.target.value.trim();
                switch (value) {
                    case 'User':
                        metch='User';
                        $('#driver-form').hide();
                        $('#user-form').show();
                        break;
                    case 'Driver':
                        metch='Driver';
                        $('#user-form').hide();
                        $('#driver-form').show();
                        break;
                    default:
                        break;
                }
            });
        });

        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
            if(!allowedExtensions.exec(file)){
                obj.value="";
                alert('Invalid Image Extension.');

            }
        }

        function getFile() {
            document.getElementById("profile_web").click();
        }

        function getCarFile() {
            document.getElementById("carimage").click();
        }

        function getDriverFile() {
            document.getElementById("profile_driver").click();
        }
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
        jQuery.validator.addMethod("onlyNumbersAlphabets", function (value, element) {
            return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
        }, 'Please enter Alphabets and numbers only');
        jQuery.validator.addMethod("lettersonly", function (value, element) {
            return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
        }, "Please enter alphabets only");
        jQuery.validator.addMethod("address", function (value, element) {
            return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
        }, 'Please enter without special characters.');
        jQuery.validator.addMethod("passwordcheck", function (value, element) {
            return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value);
        }, 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit');

        jQuery.validator.addMethod("isValidEmailAddress", function (value, element) {
            var pattern = /^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i;

            return this.optional(element) || pattern.test(value);
        }, "Please enter a valid email address");
        jQuery.validator.addMethod("mobile", function (value, element) {


            var pattern = /^\d{10}$/i;
            var name = element.name;
            var prent = "#user-form";
            if (name == "mobile1") {
                prent = "#driver-form";
            }
            if (this.optional(element) || pattern.test(value)) {
                $(prent + ' .send-otp').removeAttr('disabled');

                return true
            } else {
                $(prent + ' .send-otp').attr('disabled', 'disabled');
                $(prent + ' .send-otp').val('Send OTP');
                return false;
            }
        }, "Please enter 10 digit mobile number");


        $(".send-otp").click(function () {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: '{{ url('sendOtp') }}',
                data: {mobile1: $("#mobile1").val(),mobile: $("#mobile").val(),"metch":metch,_token:'{{csrf_token()}}'},

                success: function (msg) {
                    if (msg.success) {
                        $('.send-otp').val('Resend');
                        $(".display-none-otp").css('display', "block");
                        $('.mobile-error-class').html('');
                    } else {
                        $(".display-none-otp").css('display', "none");
                        $('.mobile-error-class').html(msg.message);
                    }
                }
            });

            $('.otp-field').each(function () {
                $(this).val("");
            })


        });
        $(document).ready(function () {
            google.maps.event.addDomListener(window, 'load', init1);
            google.maps.event.addDomListener(window, 'load', init2);
            function init1() {
                var input = document.getElementById('address');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                    // $(input).siblings('.lat').val(place.geometry['location'].lat());
                    // $(input).siblings('.long').val(place.geometry['location'].lng());
                });
            }
            function init2() {
                var input = document.getElementById('address1');
                var autocomplete = new google.maps.places.Autocomplete(input);
                autocomplete.addListener('place_changed', function () {
                    var place = autocomplete.getPlace();
                    // place variable will have all the information you are looking for.
                    // $(input).siblings('.lat').val(place.geometry['location'].lat());
                    // $(input).siblings('.long').val(place.geometry['location'].lng());
                });
            }

            $('#UsersignUp').validate({
                onkeyup: function (element) {
                    $(element).valid()
                },
                rules: {
                    fname: {
                        lettersonly: true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    lname: {
                        lettersonly: true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        }
                    },
                    email: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        // email: true,
                        isValidEmailAddress: true,
                        remote: {
                            url: "{{'checkuseremail'}}",
                            type: "post",
                            data: {
                                _token: function () {
                                    return "{{csrf_token()}}";
                                }
                            }
                        },
                    },
                    otp: {
                        required: true,
                        remote: {
                            url: "{{url('otpVerified')}}",
                            type: "post",
                            data: {
                                _token: function () {
                                    return "{{csrf_token()}}";
                                }
                            }
                        },
                    },
                    mobile: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        number: true,
                        mobile: true
                    },
                    password: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        minlength: 8,
                        passwordcheck: true
                    },
                    cpassword: {
                        equalTo: "#password"
                    },
                    address: {
                        required: true,
                        address: true,
                        // minlength: 10
                    }
                },
                messages: {
                    fname: {
                        required: 'First Name is required'
                    },
                    lname: {required: 'Last Name is required'},
                    otp: {
                        "required": "OTP Not Verified",
                        "remote": "Invalid OTP"
                    },
                    email: {
                        required: 'Please enter a valid email address',
                        remote: 'Email already exists'

                    },
                    mobile: {
                        required: 'Mobile Number is required',
                    },
                    address:{
                        required:'Address is required'
                    },
                    password: {
                        minlength: 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit',
                        required:'Password is required'
                    },
                    cpassword: 'Confirm Password must be same as Password'
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function () {
            // $('#modelnm').change(function () {
            // alert(this.value);
            // })
            jQuery.validator.addMethod("exactlength", function (value, element, param) {
                return this.optional(element) || value.length == param;
            }, $.validator.format("Please enter exactly {0} characters."));

            jQuery.validator.addMethod("valnull", function (value, element) {
                return this.optional(element) || value!="Select Model Name";
            },"Model Name is required");

            $('#DriversignUp').validate({
                onkeyup: function (element) {
                    $(element).valid()
                },
                rules: {
                    fname1: {
                        lettersonly: true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    lname1: {
                        lettersonly: true,
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    email1: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        email: true,
                        isValidEmailAddress: true,
                        remote: {
                            url: "{{'checkdriveremail'}}",
                            type: "post",
                            data: {
                                _token: function () {
                                    return "{{csrf_token()}}";
                                }
                            }
                        },
                    },
                    otp1: {
                        required: true,
                        remote: {
                            url: "{{url('otpVerified')}}",
                            type: "post",
                            data: {
                                _token: function () {
                                    return "{{csrf_token()}}";
                                }
                            }
                        },
                    },
                    mobile1: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        mobile: true,
                        number: true
                    },
                    password1: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                        minlength: 8,
                        passwordcheck: true
                    },
                    cpassword1: {
                        equalTo: "#password1"
                    },
                    cmake: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    modelnm: {
                        required: true,
                        valnull: true,
                        normalizer: function (value) {
                            return $.trim(value);
                        },
                    },
                    year: {
                        required: true,
                        normalizer: function (value) {
                            return $.trim(value);
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
                    fname1: {required: 'First Name is required'},
                    lname1: {required: 'Last Name is required'},
                    regno1:{required:'Registration Number is required'},
                    insuranceno1:{required:'Insurance Number is required'},
                    licenceno1:{required:'Licence Number is required'},
                    email1: {
                        required: 'Please enter a valid email address',
                        remote: 'Email already exists'
                    },
                    mobile1: {
                        required: 'Mobile Number is required',
                    },
                    otp1: {
                        "required": "OTP Not Verified",
                        "remote": "Invalid OTP"
                    },
                    password1: {
                        minlength: 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit',
                        required: 'Password is required'
                    },
                    address1:{
                        required:'Address is required'
                    },
                    cpassword1: 'Confirm Password must be same as Password',
                    cmake:{
                        required:'Car Make is required',
                    },
                    modelnm:{
                        required:'Model Name is required',
                    },
                    year:{
                        required:'Select Year is required',
                    }
                },
                submitHandler: function (form) {
                    if($('#otp1-error').html()=="Invalid OTP"){
                        alert("Invalid OTP");
                    }
                    else {
                        form.submit();
                    }
                }
            });
        });

        function getInsuranceFile() {
            document.getElementById("insuranceimage").click();
        }

        function getLicenceFile() {
            document.getElementById("licenceimage").click();
        }
    </script>
@endsection
