@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Assign Request</title>
@endsection
@section('css')
    <style>
        input[type='radio']:after {
            width: 30px;
            height: 30px;
            border-radius: 25px;
            top: -17px;
            left: -5px;
            position: relative;
            content: '';
            display: inline-block;
            visibility: visible;
            background-color: #BC904D;
            /*border: 5px solid #ced4da;;*/
        }

        input[type='radio']:checked:after {
            width: 30px;
            height: 30px;
            border-radius: 25px;
            top: -17px;
            left: -5px;
            position: relative;
            background-color: #ffa500;
            /*content:  "\f00c";*/
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        @media (min-width: 768px) {
            .response-modal{
                padding-top: 8%
            }
        }
        @media (max-width: 767px) {
            .response-modal{
                padding-top: 30%
            }
            .request-p {
                display: block !important;
            }

        }
        @media (max-width: 1199px) {
            .request-p{
                margin-left: unset!important;
                font-size: 28px;
            }

            input[type='radio']:after{
                top: -15px;
            }
        }

    </style>
@endsection
@section('content')
    <div class="content-div1 container">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document" >
                <div class="modal-content">
                    <div class="modal-header" style="display: inline">

                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">

                            <form method="post" role="form">
                                <div class="form-group">
                                    @for($i=0;$i<4;$i++)
                                        <div class="row set-center">
                                            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                                <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 request-p"><input type='radio' name="signupradio" value="Driver"/></div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  request-p">ABCXY</div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  offset-md-1 offset-lg-1  request-p">Payment Verify</div>
                                                </div>

                                            </div>
                                        </div>
                                    @endfor
                                        <div class="row set-center">
                                        <a href="#" class="request-p" style="color: black;text-decoration: underline;">View More</a>
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
