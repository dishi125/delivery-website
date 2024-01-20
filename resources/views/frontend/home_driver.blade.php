@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
@endsection
@section('css')
    <style>
        @media (max-width: 1089px) {
            .request-p{
                font-size: 23px;
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
    <div class="content-div1 container-fluid">
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
                                                <div class="request-p"><a href="{{ url('assign_request/') }}" style="display: block;color: white;text-decoration: none;" class="text-center">View Assigned Request</a></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                            <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                <div class="request-p"><a href="{{ url('edit_driver_profile/'.$data->id.'/') }}" style="display: block;color: white;text-decoration: none;" class="text-center">Edit Profile Info</a></div>
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
