@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Payment</title>
@endsection
@section('css')
    <style>
        @media (max-width: 767px) {
            .payment-class{
                width: 50%!important;
            }
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
    <div class="content-div3 container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content container">
                    @if ($message = \Illuminate\Support\Facades\Session::get('success'))
                        <div class="messages">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong>  {!! $message !!}
                            </div>
                        </div>
                        <?php \Illuminate\Support\Facades\Session::forget('success');?>
                    @endif

                    @if ($message = \Illuminate\Support\Facades\Session::get('error'))
                        <div class="messages">
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong>  {!! $message !!}
                            </div>
                        </div>
                        <?php \Illuminate\Support\Facades\Session::forget('error');?>
                    @endif

                    <div class="modal-header" style="display: inline">
                        <center><h1 style="color: black;">Payment</h1></center>
                    </div>
                    <form method="post" role="form" id="payment_form" action="{{url('payment_delivery')}}">

                        <div class="modal-body">
                            <div class="form">

                                {{csrf_field()}}
                                <input type="hidden" value="{{$data->id}}" name="PayerID">
                                <input type="hidden" value="{{$data->price}}" name="amount">

                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 set-right payment-class set-font">Total</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 payment-class set-font">
                                            <p><i class="fa fa-inr" aria-hidden="true"></i>{{ $data->price }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 set-right payment-class set-font">PayPal</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 payment-class set-font">
                                            <p><img src="{{url('public/images/paypal.png')}}"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <input type="submit" class="form-control footer-button  color-white" style="font-size: 25px;" id="payment_button" value="Pay Now">
                        </div>
                    </form>

                    <div class="modal-footer" style="justify-content: center;">
                        <a class="form-control back-button" href="{{url('/approval_request')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('main_script')
    <script>
        $(document).ready(function(){
            setTimeout(function(){
                $(".message").remove();
            }, 10000 );

        });
        // $('#payment_button').click(function () {
        //     $('#payment_form').submit();
            /* var form=new FormData($('#payment_form')[0]);
             $.ajax({
                 type: 'POST',
{{--                url: "{{ url('payment_delivery') }}",--}}
            data: form,
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.success == true) {

{{--                        window.location='{{'home_user'}}';--}}
            // $('body').html(res.message);

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

});*/
        // });

    </script>
@endsection
