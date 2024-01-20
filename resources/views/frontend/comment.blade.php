@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
@endsection
@section('css')
<style>

</style>
@endsection
@section('content')
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1 response-modal  md1" role="document" style="">
                <div class="modal-content container">
                    <div class="modal-header" style="display: inline">
                        <center><h1 style="color: black;">Rate Your Driver</h1></center>
                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">

                            <form method="post" role="form" id="ReviewForm" action="{{url('submitreview')}}">
                                {{csrf_field()}}
                                <input type="hidden" name="reviewid" value="{{$data->id}}">
                                <input type="hidden" name="id" value="{{$id}}">

                                <div class="form-group">

                                    <div class="row set-center">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex;justify-content: center;">
                                            @if($data->profile_pic)
                                                <img src="{{$data->Profile}}" height="70px" width="70px" class="img-responsive">
                                            @else
                                                <img src="{{url('public/images/avatar.jpg')}}" height="150px" width="150px" class="img-responsive">
                                            @endif
                                        </div>
                                        <h3>{{$data->fname}} {{$data->lname}}</h3>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" id="rateYo" style="display: table;margin: 0 auto;">
                                        </div>
                                        <input type="hidden" name="val" id="val" value="">
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                                            <textarea class="form-control" placeholder="Write a comment" rows="7" name="comment" ></textarea>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="display: flex;justify-content: center;">
                                            <input type="submit" class="form-control footer-button" style="color:white" value="Submit">
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7" style="display: flex;justify-content: center;">
                                            <a class="form-control back-button" href="{{url('/request_list')}}">Cancel</a>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>


        $(document).ready(function () {
            $(function () {

                $("#rateYo").rateYo({
                    starWidth: "40px",
                    spacing   : "15px",
                    fullStar: true
                });

            });

            $('#ReviewForm').validate({
                rules: {
                    comment: {
                        required: true,
                        maxlength: 500,
                    },
                },
                submitHandler: function () {
                    var rating = $('#rateYo').rateYo("rating");
                    $('#val').val(rating);
                    $('#ReviewForm').submit();
                }
            });
        });
    </script>
@endsection
