@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Edit Profile</title>
    <style>
        *[role="document"] .modal-content{
            height: 500px!important;
        }
    </style>
@endsection
@section('content')
    <div class="content-div container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1 response-modal md1" role="document">
                <form method="POST" role="form"  action="{{url('update_user_profile/'.$user->id.'/')}}" id="UsersignUp" enctype="multipart/form-data">
                    @method('PATCH')
                    {{csrf_field()}}
                    <div class="modal-content container">

                        <div class="modal-header" style="display: inline">
                            @if($user->profile_pic)
                                <img id="profile_img" src="{{$user->Profile}}" height="150px" width="150px" class="img-responsive"/>
                            @else
                                <img id="profile_img" src="{{url('public/images/avatar.jpg')}}" height="150px" width="150px" class="img-responsive">
                            @endif
                            <div class="row set-center" style="margin-top: 10px">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                    <input type="button" name="photo" class="form-control" id="photo_pic"  value="Change Profile Picture" style="background-color: #FFC56C;color: white;" onclick="getFile()" />
                                    <div style='height: 0px;width: 0px; overflow:hidden;'><input id="profile" type="file" value="photo" name="profile" onchange="sub(this)"/></div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-body">
                            {{--                        <div class="form" id="user-form">--}}

                            @include('frontend.user_field')
                            <div class="row set-center">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-top: -62px;">
                                    <input type="submit" class="form-control" style="background-color: #FFC56C;color: white;" value="Save Profile"/>
                                </div>
                            </div>
                            <div class="row set-center">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-top: -24px;">
                                    <a class="form-control back-button" href="{{url('/home_user')}}" style="width: 100%"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>

                            {{--                        </div>--}}
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@section('main_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyDk8xJ1I8BiADJ_XWxgNVRuPMdR1GnLMbo"></script>  <!-- autocomplete address api -->
    <script>
        google.maps.event.addDomListener(window, 'load', init);
        function init() {
            var input = document.getElementById('address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                // place variable will have all the information you are looking for.
                // $(input).siblings('.lat').val(place.geometry['location'].lat());
                // $(input).siblings('.long').val(place.geometry['location'].lng());
            });
        }
        $(document).ready(function() {
            jQuery.validator.addMethod("lettersonly", function (value, element) {
                return this.optional(element) || /^[a-zA-Z]+$/i.test(value);
            }, "Please enter alphabets only");
            jQuery.validator.addMethod("address", function (value, element) {
                return this.optional(element) || /^[0-9a-zA-Z, -]+[.]{0,1}$/i.test(value);
            }, 'Please enter without special characters.');

            $('#UsersignUp').validate({
                rules: {
                    fname:{
                        required: true,
                        lettersonly:true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    lname:{
                        required: true,
                        lettersonly:true,
                        normalizer: function( value ) {
                            return $.trim( value );
                        },
                    },
                    address: {
                        // minlength: 10,
                        required: true,
                        address: true,
                    }
                },
                messages: {
                    fname: {
                        required:'First Name is required',
                    },
                    lname:{
                        required:'Last Name is required',
                    },
                    address:{
                        required:'Address is required'
                    },
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
        function sub(obj) {
            var file = obj.value;
            var fileName = file.split("\\");
            var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
            if(!allowedExtensions.exec(file)){
                obj.value="";
                alert('Invalid Image Extension.');

            }else{
                readURL(obj);
            }

        }
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#profile_img').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }


        function getFile() {
            document.getElementById("profile").click();
        }
    </script>
@endsection

