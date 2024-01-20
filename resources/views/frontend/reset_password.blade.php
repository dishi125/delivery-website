@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Sign In</title>
@endsection
@section('css')
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
                    <div class="modal-header" style="display: inline;margin-top: 60px;">
                        <center><h1 style="color: black;">Reset Password</h1></center>
                    </div>

                    <div class="modal-body">
                        <div class="form">

                            <form  role="form" id="ResetPasswordForm" method="post" action="javascript:void(0);">

                                <div class="form-group">
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <input type="password" name="password" class="form-control" id="password" placeholder="New Password"/>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password"/>
                                        </div>
                                    </div>
                                </div>
                                {{--                    footer--}}
                                <div class="row set-center">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-left: 15px;margin-right: 15px;">
                                        <input type="submit" class="form-control" style="background-color: #FFC56C;color: white;" value="RESET">
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

@endsection
@section('main_script')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    {{--    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>--}}
   <script>
       $(document).ready(function() {
           jQuery.validator.addMethod("passwordcheck", function (value, element) {
               return this.optional(element) || /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[#$@!%&*?])[A-Za-z\d#$@!%&*?]{6,30}$/.test(value);
           }, 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit');

           $('#ResetPasswordForm').validate({
               rules: {
                   password: {
                       required: true,
                       minlength: 8,
                       passwordcheck:true
                   },
                   cpassword: {
                       equalTo: "#password"
                   },
               },
               messages: {
                   // email: 'Enter a valid email',
                   password: {
                       minlength: 'Password must contain atleast 8 characters, including one uppercase letter, one lowercase letter, one special character and one digit'
                   },
                   cpassword: 'Confirm Password must be same as Password'
               },
               submitHandler: function () {
                   var form = new FormData($('#ResetPasswordForm')[0]);
                   form.append('_token','{{csrf_token()}}');
                   block_ui();
                   $.ajax({
                       type: 'post',
                       url:  '{{"reset_password_data"}}',
                       data: form,
                       contentType: false,
                       cache: false,
                       processData: false,
                       success: function (res) {
                           unblock_ui();
                           if (res.success == true) {
                               window.location='{{'signin'}}';
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

       });
    </script>
@endsection
