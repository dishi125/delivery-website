@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
    <style>
        @media (min-width: 1025px) {

            *[role="document"] .modal-body{
                height: unset!important;
                /*overflow: auto*/
            }

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

                            <form method="post" role="form">
                                <div class="form-group">

                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p1"><a href="{{url('new_request')}}" style="display: block;color: white;text-decoration: none;" class="text-center">New Request</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p1"><a href="{{url('approval_request')}}" style="display: block;color: white;text-decoration: none;" class="text-center">Pay For Delivery</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p1"><a href="{{ url('request_list') }}" style="display: block;color: white;text-decoration: none;" class="text-center">Request List</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p1"><a href="{{ url('edit_user_profile/'.$data->id.'/') }}" style="display: block;color: white;text-decoration: none;" class="text-center">Edit Profile Info</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p1"><a href="{{ url('view_plan_list') }}" style="display: block;color: white;text-decoration: none;" class="text-center">View Saved Plan</a></div>
                                            </div>
                                        </div>
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
        $(document).ready(function(){
            setTimeout(function(){
                $(".message").remove();
            }, 3000 );

        });
    </script>
@endsection
