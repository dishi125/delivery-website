@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>OTP</title>
@endsection
@section('content')
    <div class="content-div1 container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content container">
                    <div class="messages"></div>
                    <div class="modal-header" style="display: inline;margin-top: 60px;">
                        <center><h1 style="color: black;">Enter Pin</h1></center>
                    </div>
                    <div class="modal-body">
                        <div class="form">

                            <form method="post" role="form" id="OtpForm">
                                <div class="form-group">

                                    <div class="row digit-group">
{{--                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">--}}
                                            <input type="text" name="digit1" class="form-control otp-field " id="digit-1" data-next="digit-2" style="background-color: white" maxlength="1"/>
{{--                                        </div>--}}
{{--                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">--}}
                                            <input type="text" name="digit2" class="form-control otp-field" id="digit-2" data-next="digit-3" style="background-color: white" data-previous="digit-1" maxlength="1"/>
{{--                                        </div>--}}
{{--                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">--}}
                                            <input type="text" name="digit3" class="form-control otp-field" id="digit-3" data-next="digit-4" style="background-color: white" data-previous="digit-2" maxlength="1"/>
{{--                                        </div>--}}
{{--                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">--}}
                                            <input type="text" name="digit4" class="form-control otp-field" id="digit-4" style="background-color: white" data-previous="digit-3" maxlength="1"/>
{{--                                        </div>--}}
                                    </div>
                                </div>
                                <div class="row set-center" style="margin-bottom: 80px;margin-top: 50px">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-left: 15px;margin-right: 15px;">
                                        <button type="button" id="verify" class="form-control" style="background-color: #FFC56C;color: white;font-weight: bold;font-size: x-large;">Verify</button>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <p style="display: flex;justify-content: center;font-weight: bold;margin-top: 20px;">Don't Receive The OTP ?<a onmouseover="this.style.cursor='pointer'"  style="color:#FFC56C; " id="resendotp">Resend OTP</a></p>
                                    </div>


                                </div>
                            </form>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@section('main_script')

<script>
    $('.digit-group').find('input').each(function() {

        $(this).on('keyup', function(e) {
            var parent = $($(this).parent());


            if(e.keyCode === 8 || e.keyCode === 37) {
                var prev = parent.find('input#' + $(this).data('previous'));

                if(prev.length) {
                    $(prev).select();
                }
            } else if((e.keyCode >= 48 && e.keyCode <= 57) || (e.keyCode >= 65 && e.keyCode <= 90) || (e.keyCode >= 96 && e.keyCode <= 105) || e.keyCode === 39) {
                var next = parent.find('input#' + $(this).data('next'));

                if(next.length) {
                    $(next).select();
                }
            }
        });
    });
    $("#resendotp").click(function () {
        var searchParams = new URLSearchParams(window.location.search);
        var param = searchParams.get('of');
        var Url="";
        if(param == 'driver'){
            Url="{{'resend_otp_to_driver'}}";
        }
        else{
            Url="{{'resend_otp_to_user'}}";
        }
        $.ajax({
            type: 'GET',
            url: Url,

            success: function (res) {
                if (res.success == true) {
                    var messages = $('.messages');
                    var successHtml = '<div class="alert alert-success">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> ' + res.message +
                        '</div>';
                    $(messages).html(successHtml);
                }
                if (res.success == false) {
                    var messages = $('.messages');
                    var successHtml = '<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> ' + res.message +
                        '</div>';
                    $(messages).html(successHtml);
                }
            },

        });

    });

    $("#verify").click(function() {
        var searchParams = new URLSearchParams(window.location.search);
        var param = searchParams.get('of');
        var Url;
        if(param == 'driver'){
            Url="{{'driverotp'}}";
        }
        else{
            Url="{{'submitotp'}}";
        }
        var form = new FormData($('#OtpForm')[0]);
        form.append('_token','{{csrf_token()}}');
        $.ajax({
            type: 'post',
            url: Url,
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.success == true) {
                    location.href = "{{url('signin')}}";
                }
                if (res.success == false) {
                    var messages = $('.messages');
                    var successHtml = '<div class="alert alert-danger">' +
                        '<button type="button" class="close" data-dismiss="alert">&times;</button>' +
                        '<strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong> ' + res.message +
                        '</div>';
                    $(messages).html(successHtml);
                }
            },

        });
    });
</script>
@endsection
