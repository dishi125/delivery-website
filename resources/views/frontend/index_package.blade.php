@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Package Detail</title>
@endsection
@section('content')
    <div class="content-div1 container">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document">
                <div class="modal-content">



                    <div class="modal-header" style="display: inline">

                        <center><h1 style="color: black;">Package Details</h1></center>
                    </div>
                    <div class="modal-body">
                        <div class="form">

                            <form method="post" role="form" id="package_form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <div class="row">

                                        <input type="hidden" value="{{ $cnt1_to }}" name="count" id="count">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Package Weight</label>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set" style="padding-right: 0px">
                                            <input type="text" name="weight" class="form-control" id="weight" style="border-top-right-radius: unset;border-bottom-right-radius: unset;"/>
                                            {{--                                            <div class="validation"></div>--}}
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 mobile-set" style="padding-left: 0px">
                                            <?php $packagekg=\App\Enums\Packagekg::asArray();?>
                                            <select class="form-control package-control package-weight" style="border-top-left-radius:unset;border-bottom-left-radius: unset;" name="packagekg">
                                                @foreach($packagekg as $key=>$value)
                                                    <option value="{{$value}}">{{$key}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        Kg/Lbs
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Dimensions(Optional)</label>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">
                                            <input type="text" name="dimesionl" class="form-control package-control package-weight " id="dimesionl" placeholder="L"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">
                                            <input type="text" name="dimesionw" class="form-control package-control package-weight" id="dimesionw" placeholder="W"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">
                                            <input type="text" name="dimesionh" class="form-control package-control package-weight" id="dimesionh" placeholder="H"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">
                                            <?php $dimension=\App\Enums\Dimensions::asArray();?>
                                            <select class="form-control package-control package-weight" name="dimensions">
                                                @foreach($dimension as $key=>$value)
                                                    <option value="{{$value}}">{{$key}}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Declared Value</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <input type="text" name="dvalue" class="form-control dvalue-color" id="dvalue" style="background-color: #FFC56C;color: white;" placeholder="(Optional)"/>

                                            {{--                                            <div class="validation"></div>--}}
                                        </div>
                                        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1">
                                            <i class="fa fa-question-circle-o" aria-hidden="true" style="font-size: 27px"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Photo</label>
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                                            <input type="button" name="photo" class="form-control" id="photo" onclick="getFile()" value="Select Photo" style="background-color: #FFC56C;color: white;"/>
                                            <label id="image-error" class="error" for="image"></label>
                                            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="image" type="file" value="photo" name="image" onchange="sub(this)" /></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <label class="col-lg-3 col-md-3 col-sm-3 col-xs-3 set-right">Require Delivery Date & Time</label>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">

                                            <input type="text" name="date" class="form-control package-control package-weight " id="date" placeholder="Date" onfocus="(this.type='date')"/>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mobile-set">
                                            <input type="text" name="time" class="form-control package-control package-weight" id="time" placeholder="Time" onfocus="(this.type='time')"/>
                                        </div>
                                    </div>
                                </div>


                            </form>
                        </div>

                    </div>
                    <div class="modal-footer" style="justify-content: center;">
                        @if($cnt1_to > 1)
                            <button type="button" class="form-control footer-button" id="validateform">NEXT<i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                        @else
                            <button type="button" class="form-control footer-button" id="validateform">SUBMIT REQUEST</button>
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>

@endsection

@section('main_script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
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

        $(document).ready(function() {

            $('#package_form').validate({
                rules: {
                    weight: {
                        required: true,
                        digits:true,
                    },
                    dimesionl: {
                        digits:true,
                    },
                    dimesionw: {
                        digits:true,
                    },
                    dimesionh: {
                        digits:true,
                    },
                    date: {
                        required: true,
                    },
                    time: {
                        required: true,
                    },
                    image:{
                        required: true
                    }
                },
                submitHandler: function (form) {

                }

            });



            $('#validateform').on('click', function(e) {
                e.preventDefault();
                if($('#package_form').valid()){
                    var form=new FormData($('#package_form')[0]);
                    form.append('_token','{{csrf_token()}}');
                    var Url = "{{ url('store_index_data')}}";
                    $.ajax({
                        type:'POST',
                        url:Url,
                        data:form,
                        contentType: false,
                        cache: false,
                        processData: false,
                        success:function(res){
                            if(res.success==true){
                                console.log(res.message);
                                var url = '{{ url("/index_packages", "cnt_to") }}';
                                var cnt={{$cnt1_to}}-1;

                                if(cnt>0){
                                    url = url.replace('cnt_to', cnt);
                                    window.location=url;
                                }
                                else if(cnt == 0){ //if cnt=0 that means all packages are store so redirect it to home page
                                    if(res.status==1){
                                        window.location='{{url('signin')}}';
                                    }
                                    else if(res.status==0){
                                        window.location='{{url('signup')}}';
                                    }
                                }

                            }
                            else if(res.success==false){
                                console.log(res.message);
                            }
                        }
                    });
                }
            })

        })
    </script>
@endsection
