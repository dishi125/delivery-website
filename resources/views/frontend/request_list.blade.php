@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Plan List</title>
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

        @media (max-width: 767px) {

            .request-p{
                display: block!important;
            }
        }
        @media (max-width: 1199px) {
            .request-p{
                margin-left: unset!important;
            }
        }

    </style>
    <style>
        *[role="document"] .modal-content{
            height: 500px!important;
        }
    </style>
@endsection
@section('content')
    <div class="content-div2 container-fluid">
        <div class="message" style="padding-top: 25px">
            @if(session()->has('flashmsg'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong>{{session()->get('flashmsg')}}

                </div>
                <?php session()->forget('flashmsg'); ?>
            @endif
        </div>
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1 response-modal  md1" role="document" style="">
                <div class="modal-content container">

                    <div class="modal-header" style="display: inline">
                        @if($data->profile_pic)
                            <img src="{{$data->Profile}}" height="150px" width="150px" class="img-responsive">
                        @else
                            <img src="{{url('public/images/avatar.jpg')}}" height="150px" width="150px" class="img-responsive">
                        @endif
                        <center><h1 style="color: black;">{{$data->fname}} {{$data->lname}}</h1></center>
                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">
                            <form method="post" role="form" name="displayplan" action="{{url('/displayplan')}}" class="approval-form">
                                {{csrf_field()}}
                                <div class="form-group">

                                    @foreach($listdata as $d)
                                        <div class="row set-center">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 request-p"><input type='radio' name="plan_radio" value="{{$d->id}}"/><input type='hidden' name="status1" value="{{$d->status}}"/></div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  request-p">{{$d->planname}}</div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  request-p">{{$d->status}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        <a class="form-control back-button" href="{{url('/home_user')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('main_script')
    <script>
        $(document).ready(function() {
            $('input[type=radio]').on('click', function(){
                $('.approval-form').submit();
            });
            setTimeout(function(){
                $(".message").remove();
            }, 5000 );


        });



    </script>
@endsection
