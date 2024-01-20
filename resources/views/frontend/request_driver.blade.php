@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Home</title>
@endsection
@section('css')
    <style>
        #image-error{
            position: absolute;
        }
        @media (max-width: 332px){
        .set-size{
            font-size: 27px;
        }
        }
        @media (min-width: 333px){
            .set-size{
                font-size: 30px;
            }
        }

    </style>
@endsection
@section('content')
    <div class="content-div1 container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content container">

                    <div class="modal-header" style="display: inline">
                    </div>
                    <div class="modal-body">
                        <div class="form">

                            <form method="post" role="form" id="Complete_delivery" action="{{url('delivery_complete')}}" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <input type="hidden" name="toid" value="{{$data->id}}">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 set-left set-font">User Name:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p class="set-font">{{$data->name}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 set-left set-font">Address:</label>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <p class="set-font">{{$data->street_add}} {{$data->street_add1}} {{$data->Country}} </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-6 col-md-6 col-sm-6 col-xs-6 set-left set-font">Add Photo:</label>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                            <button type="button" name="photo" class="form-control" id="photo" onclick="getFile()" style="background-color: #FFC56C;color: white;font-size: 23px;"><i class="fa fa-paperclip" aria-hidden="true"></i> Attach Photo</button>
                                            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="image" type="file" value="photo" name="image" onchange="sub(this)" /></div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12  offset-sm-6">
                                            <p class="set-mobile-center">Attach Photo after Complete*</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row set-center">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <button type="submit" class="form-control set-size" style="background-color: #FFC56C;color: white;">Delivery Complete</button>
                                        </div>
                                    </div>
                                    <div class="row set-center">
                                        <a class="form-control back-button" href="{{url('/assign_requestdata/'.$pid)}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
{{--                    <div class="modal-footer" style="justify-content: center;">--}}
{{--                        <button type="button" class="form-control footer-button" style="font-size: 30px;">Delivery Complete</button>--}}
{{--                    </div>--}}

                </div>
            </div>
        </div>
    </div>
@endsection
@section('main_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script>
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
            document.getElementById("image").click();
        }
        $(document).ready(function () {
            $('#Complete_delivery').validate({
                rules: {
                    image: {
                        required: true,
                    },
                },
                submitHandler: function () {
                    $('#Complete_delivery').submit();
                }
            });
        });
    </script>
@endsection
