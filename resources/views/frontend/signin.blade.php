@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sign In</title>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ url('public/css/model.main.css') }}">
    <style>
        .form-control-sm:focus{
            border-bottom: 1px solid #FFC56C!important;
            -webkit-box-shadow: 0 1px 0 0 #FFC56C;
            box-shadow: 0 1px 0 0 #FFC56C!important;
        }
        .md-form input[type="email"]:not(.browser-default):focus:not([readonly])+label,.md-form .prefix.active{
            color:#FFC56C;
        }
        .btn-outline-info {
            color: #FFC56C !important;
            border: 2px solid #FFC56C !important;
            transition-duration: 0.5s ;
        }
        .btn-outline-info:not([disabled]):not(.disabled):active,.btn-outline-info:not([disabled]):not(.disabled):hover  {
            border-color: #FFC56C !important;
            background:  #FFC56C !important;

            color: white !important;
        }
        .light-orange{
            background-color: #FFC56C;
            color: white;
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
        @media (min-width: 1025px) {

            *[role="document"] .modal-body{
                height: unset!important;
                /*overflow: auto*/
            }

        }
    </style>
@endsection
@section('content')
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content container">
{{--                    @if(session()->has('error'))--}}
{{--                        <div class="alert alert-danger">--}}
{{--                            <p> {{session()->get('error')}}</p>--}}
{{--                        </div>--}}
{{--                    @endif--}}
                    <div class="messages"></div>

                    <div class="modal-header" style="margin-top: 25px;">
                        <div class="mobile-center col-md-6 col-lg-6 col-sm-6" style="display: inherit;    justify-content: flex-end;">
                            <input type='radio' name="signupradio" value="User" checked/><p style="margin-left: 30px;font-weight: bold;">User</p>

                        </div>
                        <div class="mobile-center col-md-6 col-lg-6 col-sm-6" style="display: inherit;">
                            <input type='radio' name="signupradio" value="Driver"/><p style="margin-left: 30px;font-weight: bold;">Driver</p>

                        </div>



                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">

                            <form  role="form" id="SigninForm" method="post" action="javascript:void(0);">

                                <div class="form-group">
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <input type="email" name="email" class="form-control" id="email" placeholder="User Name" autocomplete="off"/>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" autocomplete="off"/>
                                        </div>
                                    </div>
                                </div>
                                {{--                    footer--}}
                                <div class="row set-center">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-left: 15px;margin-right: 15px;">
                                        <input type="submit" class="form-control" style="background-color: #FFC56C;color: white;" value="SIGN IN">
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="display: flex;justify-content: center;">Don't Have An Account ?<a href="{{url('signup')}}" style="color: #ffc107;font-weight: 600; ">Register</a></p>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="display: flex;justify-content: center;"><a  onmouseover="this.style.cursor='pointer'" style="color: #ffc107;font-weight: 600;" id="forgotpassword" data-target="#pwdModal" data-toggle="modal" >Forgot Password?</a></p>
                                    </div>

                                </div>
                                {{--                    footer end--}}
                            </form>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="pwdModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <form action="" id="forget-form">
            <div class="modal-content">

                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs md-tabs tabs-2 light-orange darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i>
                                User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#panel8" role="tab"><i class="fa fa-user-plus mr-1"></i>
                                Driver</a>
                        </li>
                    </ul>

                    <!-- Tab panels -->
                    <div class="tab-content">
                        <div class="messages1">

                        </div>
                        <!--Panel 7-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">

                            <!--Body-->
                            <div class="modal-body mb-1">
                                <div class="md-form form-sm mb-5">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" name="email" id="modalLRInput10" class="form-control form-control-sm validate" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                    <label data-error="wrong" data-success="right" for="modalLRInput10" >Your User Name Or Email</label>
                                </div>


                                <div class="text-center mt-2">
                                    <button type="button" class="btn light-orange forgotpassword" data-page="User">SUBMIT<i class="fa fa-sign-in ml-1"></i></button>
                                </div>
                            </div>
                            <!--Footer-->
                            <div class="modal-footer">

                                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                        <!--/.Panel 7-->

                        <!--Panel 8-->
                        <div class="tab-pane fade" id="panel8" role="tabpanel">

                            <!--Body-->
                            <div class="modal-body">
                                <div class="md-form form-sm mb-5">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="email" id="modalLRInput12" name="email1" class="form-control form-control-sm validate" pattern="^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
                                    <label data-error="wrong" data-success="right" for="modalLRInput12" >Your User Name Or Email</label>
                                </div>



                                <div class="text-center form-sm mt-2">
                                    <button type="button" class="btn  light-orange forgotpassword" data-page="Driver">SUBMIT<i class="fa fa-sign-in ml-1"></i></button>
                                </div>

                            </div>
                            <!--Footer-->
                            <div class="modal-footer">

                                <button type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                        <!--/.Panel 8-->
                    </div>

                </div>
            </div>
            </form>
            <!--/.Content-->
        </div>
    </div>
@endsection
@section('main_script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    {{--    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>--}}
    <script>
        $(document).ready(function() {
            var searchParams = new URLSearchParams(window.location.search);
            var param = searchParams.get('by');
          if(param=='user'){
              $("input[value='User']").attr('checked', true);
          }
          else if(param=='driver'){
              $("input[value='Driver']").attr('checked', true);
          }

        });

        $(document).ready(function() {
            jQuery.validator.addMethod("passwordcheck", function (value, element) {
                return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value);
            }, 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit');

            $('#SigninForm').validate({
                rules: {
                    email: {
                        required: true,
                        email: true,
                    },
                    password: {
                        required: true,
                        minlength: 8,
                        passwordcheck:true
                    },
                },
                messages: {
                    // email: 'Enter a valid email',
                    password: {
                        minlength: 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit'
                    },
                },
                submitHandler: function () {
                    event.preventDefault();
                    var form = new FormData($('#SigninForm')[0]);
                    form.append('_token', '{{csrf_token()}}');
                    var Url;
                    var chk= $("input[name='signupradio']:checked"). val();

                    if(chk=="User"){
                        Url = "{{ url('login_user')}}";
                    }
                    else if(chk=="Driver"){
                        Url = "{{ url('login_driver')}}";
                    }


                    $.ajax({
                        type: 'post',
                        url:  Url,
                        data: form,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (res) {
                            if (res.success == true) {
                                if(res.User == 'Web_user'){
                                    location.href = "{{url('home_user')}}";
                                }
                                else if(res.User=='Driver'){
                                    location.href = "{{url('home_driver')}}";
                                }
                            }
                            if(res.success == false){
                                var messages = $('.messages');
                                var successHtml = '<div class="alert alert-danger">'+
                                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                                    '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> '+ res.message +
                                    '</div>';
                                $(messages).html(successHtml);
                            }
                        },

                    });
                }
            });
        });

        $(".forgotpassword").click(function () {
            var chk= $(this). data('page');
            var Url;
            if(chk=="User"){
                Url = "{{ url('forget_user_password')}}";
            }
            else if(chk=="Driver"){
                Url = "{{ url('forget_driver_password')}}";
            }

            var form = new FormData($('#forget-form')[0]);
            form.append('_token', '{{csrf_token()}}');

            $.ajax({
                type: 'POST',
                url: Url,
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                success: function (res) {
                    if (res.success == true) {
                        window.location='{{'forgot_otp'}}';
                        // $('body').html(res.message);

                    }
                    if (res.success == false) {
                        var messages = $('.messages1');
                        var successHtml = '<div class="alert alert-danger">' +
                            '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                            '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> ' + res.message +
                            '</div>';
                        $(messages).html(successHtml);
                    }
                },

            });

        });

        {{--function redirecturl() {--}}
        {{--    var Url;--}}
        {{--    var radioValue = $("input[name='signupradio']:checked"). val();--}}

        {{--    if(radioValue == 'User'){--}}
        {{--        Url="{{url('signup?by1=user')}}";--}}
        {{--    }--}}
        {{--    else if(radioValue == 'Driver'){--}}
        {{--        Url="{{url('signup?by1=driver')}}";--}}
        {{--    }--}}

        {{--    location.href=Url;--}}
        {{--}--}}

    </script>
    <script src="{{url('public/js/model.min.js')}}"></script>
@endsection
