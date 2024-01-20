<div class="form-group">
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 set-mobile-margin">
            <input type="text" name="fname1" class="form-control" id="fname1" placeholder="First Name"
                   value="{{ isset($driver->fname) ? $driver->fname : '' }}"/>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 set-mobile-margin">
            <input type="text" name="lname1" class="form-control" id="lname1" placeholder="Last Name"
                   value="{{ isset($driver->lname) ? $driver->lname : '' }}"/>
        </div>

    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
            {{--            <input type="text" name="cmake" class="form-control" id="cmake" placeholder="Car Make"--}}
            {{--                   value="{{ isset($driver->car_make) ? $driver->car_make : '' }}"/>--}}
            <select name="cmake" id="cmake" class="form-control">
                <option value="" disabled selected>Select Car Make</option>
                @php
                    $carmakes=\App\Models\CarMake::all();

                @endphp


                @foreach($carmakes as $carmake)
                    <option
                        value="{{$carmake->name}}" {{ (isset($driver->car_make) && $carmake->name==$driver->car_make)  ? "selected" : '' }}>{{$carmake->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            {{--            <input type="text" name="modelnm" class="form-control" id="modelnm" placeholder="Model Name"--}}
            {{--                   value="{{ isset($driver->car_model) ? $driver->car_model : '' }}"/>--}}
            <select name="modelnm" id="modelnm" class="form-control">
                <option value="" disabled selected>Select Model Name</option>
            </select>

        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            {{--            <input type="text" name="year" class="form-control" id="year" placeholder="Year"--}}
            {{--                   value="{{ isset($driver->year) ? $driver->year : '' }}"/>--}}
            <select name="year" id="year" class="form-control">
                <option disabled selected value="">Select Year</option>
                @for($i=1990;$i<=date('Y');$i++)
                    <option
                        {{ (isset($driver->year) && $i==$driver->year) ? "selected":""  }} value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 set-mobile-margin mt-sm">
            <input type="email" name="email1" class="form-control" id="email1" placeholder="Email"
                   value="{{ isset($driver->email) ? $driver->email : '' }}"
                   @if(isset($driver)) disabled="disabled" @endif/>
        </div>
    </div>
    <div class="row set-center">
    {{--            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-bottom: 20px">--}}
    <!--Nested rows within a column-->
        <div
            class="@if(isset($driver)) col-lg-5 col-md-5 col-sm-5 col-xs-5 @else col-lg-3 col-md-3 col-sm-4 col-xs-4 mt-sm @endif set-mobile-margin">
            <input type="text" name="mobile1" class="form-control input-number" id="mobile1" placeholder="Mobile Number"
                   value="{{ isset($driver->mobile) ? $driver->mobile : '' }}"
                   @if(isset($driver)) disabled="disabled" @endif/>
            <span class="mobile-error-class"></span>
        </div>
        @if(!isset($driver))
            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1 send-otp-btn-pre    "
                 style="margin-left: 0;padding-left: 0">
                <input type="button" name="sendotp" class="form-control send-otp" value="Send OTP"
                       style="background-color: #FFC56C;color: white;" disabled/>
                <span class="mobile-error-class"></span>
            </div>
        @endif
        @if(isset($driver))
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
                <input type="text" name="address1" class="form-control" id="address1" placeholder="Address"
                       value="{{ isset($driver->address) ? $driver->address : '' }}"/>
            </div>
            {{--            </div>--}}
            {{--            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-bottom: 20px">--}}
            {{--                <img id="car_img" src="{{$driver->carimg}}" height="150px" width="150px" class="img-responsive" style="margin-bottom: 20px"/>--}}
            {{--                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="padding-left: 0px">--}}
            {{--                    <input type="button" name="carimg1" class="form-control" id="carimg1"  value="Change Car Picture" style="background-color: #FFC56C;color: white;" onclick="getCarFile1()" />--}}
            {{--                    <div style='height: 0px;width: 0px; overflow:hidden;'><input id="carimage1" type="file" value="photo" name="carimage1" onchange="sub1(this)"/></div>--}}
            {{--                </div>--}}
            {{--            </div>--}}

        @else

            {{--        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 set-mobile-margin">--}}
            {{--            <input type="text" name="mobile1" class="form-control" id="mobile1" placeholder="Mobile Number" value="{{ isset($driver->mobile) ? $driver->mobile : '' }}" @if(isset($driver)) disabled="disabled" @endif/>--}}
            {{--        </div>--}}
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5  order-first">
                <input type="password" name="password1" class="form-control" id="password1" placeholder="Password"
                       @if(isset($driver)) hidden="hidden" @endif/>

            </div>
        @endif

    </div>
   {{-- @if(isset($driver))
        <div class="modal-header" style="display: inline">
            --}}{{--            <div class="row set-center">--}}{{--
            --}}{{--            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">--}}{{--
            @if($driver->car_image)
                <img src="{{$driver->carimg}}" height="150px" width="150px" class="img-responsive" id="car_img"
                     style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @else
                <img src="{{url('public/images/car_avtar.jpg')}}" height="150px" width="150px" class="img-responsive"
                     id="car_img" style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @endif
            --}}{{--            <img id="car_img" src="{{$driver->carimg}}" height="150px" width="150px" class="img-responsive" style="margin-bottom: 20px;border-radius: unset;margin-top: unset"/>--}}{{--
            --}}{{--            </div>--}}{{--
            --}}{{--        </div>--}}{{--
        </div>
        <div class="row set-center">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
                <input type="button" name="carimg1" class="form-control" id="carimg1" value="Change Car Picture"
                       style="background-color: #FFC56C;color: white;" onclick="getCarFile1()"/>
                <div style='height: 0px;width: 0px; overflow:hidden;'><input id="carimage1" type="file" value="photo"
                                                                             name="carimage1" onchange="sub1(this)"/>
                </div>
            </div>
        </div>
    @endif--}}
</div>
@if(!isset($driver))
    <div class="display-none-otp mt-sm">
        <div class="row set-center ">
            <p class="mobile-error-class text-center"></p>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1  ">
                <input id="codeBox-1" class="form-control otp-field" type="number" maxlength="1"
                       onkeyup="onKeyUpEvent1(1, event)"
                       onfocus="onFocusEvent1(1)"/>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1 ">
                <input id="codeBox-2" class="form-control otp-field" type="number" maxlength="1"
                       onkeyup="onKeyUpEvent1(2, event)"
                       onfocus="onFocusEvent1(2)"/>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1 ">
                <input id="codeBox-3" class="form-control otp-field" type="number" maxlength="1"
                       onkeyup="onKeyUpEvent1(3, event)"
                       onfocus="onFocusEvent1(3)"/>

            </div>
            <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1">
                <input id="codeBox-4" class="form-control otp-field" type="number" maxlength="1"
                       onkeyup="onKeyUpEvent1(4, event)"
                />

            </div>
            <input type="text" name="otp1" class="otp-field-main">
        </div>


    </div>
    <div class="row set-center">
    <input type="text" name="otp1" class="otp-field-main">
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 set-mobile-margin mt-sm">

            <input type="text" name="address1" class="form-control" id="address1" placeholder="Address"
                   value="{{ isset($driver->address) ? $driver->address : '' }}"/>
        </div>
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 order-first mt-sm">
            <input type="password" name="cpassword1" class="form-control" id="cpassword1" placeholder="Confirm Password"
                   @if(isset($driver)) hidden="hidden" @endif/>
        </div>
    </div>
@endif
<div class="row set-center">
    <div class=" col-lg-2 col-md-2 col-sm-4 col-xs-4 mt-sm  set-mobile-margin">
        <input type="text" name="insuranceno1" class="form-control" id="insuranceno1" placeholder="Insurance Number"
               value="{{ isset($driver->insuranceno) ? $driver->insuranceno : '' }}"/>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-1 col-xs-1" style="margin-left: 0;padding-left: 0">
        @if(isset($driver))
            <input type="button" name="insuranceimg1" class="form-control" id="insuranceimg1"
                   value="Change Insurance Picture"
                   style="background-color: #FFC56C;color: white;" onclick="getInsuranceFile1()"/>
            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="insuranceimage1" type="file" value="photo"
                                                                         name="insuranceimage1" onchange="sub2(this)"/>
            </div>
        @endif
        <input type="button" name="insuranceimg" class="form-control" id="insuranceimg" onclick="getInsuranceFile()"
               value="Add Insurance Image" style="background-color: #FFC56C;color: white;"
               @if(isset($driver)) hidden="hidden" @endif/>
        <br>
        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="insuranceimage" class="img-preview"
                                                                     data-preview="#insurance-preview" type="file"
                                                                     value="photo" name="insuranceimage"
                                                                     onchange="sub(this)"
                                                                     @if(isset($driver)) hidden="hidden" @endif/></div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5  order-first">
        <input type="text" name="regno1" class="form-control" id="regno1" placeholder="Registration Number"
               value="{{ isset($driver->regno) ? $driver->regno : '' }}"/>
    </div>
    @if(isset($driver))
        <div class="modal-header" style="display: inline">
            @if($driver->insuranc_image)
                <img src="{{$driver->insuranceimg}}" height="220px" width="220px" class="img-responsive"
                     id="insuranc_img" style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @else
                <img src="{{url('public/images/insurance_avtar.jpg')}}" height="220px" width="220px"
                     class="img-responsive" id="insuranc_img"
                     style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @endif
        </div>
    @endif
    <img src="" alt="" id="insurance-preview" width="100%"
         style="display: none;border:1px solid black;alignment: center;height: 220px;width: 220px">
</div>
<div class="row set-center">
    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-4 mt-sm set-mobile-margin">
        <input type="text" name="licenceno1" class="form-control" id="licenceno1" placeholder="Licence Number"
               value="{{ isset($driver->licenceno) ? $driver->licenceno : '' }}"/>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-1 col-xs-1" style="margin-left: 0;padding-left: 0">
        @if(isset($driver))
            <input type="button" name="licenceimg1" class="form-control" id="licenceimg1" value="Change Licence Picture"
                   style="background-color: #FFC56C;color: white;" onclick="getLicenceFile1()"/>
            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="licenceimage1" type="file" value="photo"
                                                                         name="licenceimage1" onchange="sub3(this)"/>
            </div>
        @endif
        <input type="button" name="licenceimg" class="form-control" id="licenceimg" onclick="getLicenceFile()"
               value="Add Licence Image" style="background-color: #FFC56C;color: white;"
               @if(isset($driver)) hidden="hidden" @endif/>
        @if(isset($driver))
            <div class="modal-header" style="display: inline">
                @if($driver->licence_image)
                    <img src="{{$driver->licenceimg}}" height="220px" width="220px" class="img-responsive" id="licence_img"
                         style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
                @else
                    <img src="{{url('public/images/Driving-licence.jpg')}}" height="220px" width="220px"
                         class="img-responsive" id="licence_img"
                         style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
                @endif
            </div>
        @endif
            <br>
        <img src="" alt="" id="licence-preview" width="100%"
                 style="display: none;border:1px solid black;alignment: center;height: 220px;width: 220px">
        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="licenceimage" class="img-preview"
                                                                     data-preview="#licence-preview" type="file"
                                                                     value="photo" name="licenceimage"
                                                                     onchange="sub(this)"
                                                                     @if(isset($driver)) hidden="hidden" @endif/></div>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 ">
        <input type="button" name="carimg" class="form-control" id="carimg" onclick="getCarFile()"
               value="Add Car Picture" style="background-color: #FFC56C;color: white;"
               @if(isset($driver)) hidden="hidden" @endif/>
        @if(isset($driver))
            <input type="button" name="carimg1" class="form-control" id="carimg1" value="Change Car Picture"
                   style="background-color: #FFC56C;color: white;" onclick="getCarFile1()"/>
            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="carimage1" type="file" value="photo" name="carimage1" onchange="sub1(this)"/>
            </div>
            <div class="modal-header" style="display: inline">
                {{--            <div class="row set-center">--}}
                {{--            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">--}}
                @if($driver->car_image)
                    <img src="{{$driver->carimg}}" height="220px" width="220px" class="img-responsive" id="car_img"
                         style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
                @else
                    <img src="{{url('public/images/car_avtar.jpg')}}" height="220px" width="220px" class="img-responsive"
                         id="car_img" style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
                @endif
                {{--            <img id="car_img" src="{{$driver->carimg}}" height="150px" width="150px" class="img-responsive" style="margin-bottom: 20px;border-radius: unset;margin-top: unset"/>--}}
                {{--            </div>--}}
                {{--        </div>--}}
            </div>
        @endif
        <br>
        <img src="" alt="" id="car-preview" width="100%" style="display: none;border:1px solid black">
        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="carimage" class="img-preview"
                                                                     data-preview="#car-preview" type="file"
                                                                     value="photo" name="carimage" onchange="sub(this)"
                                                                     @if(isset($driver)) hidden="hidden" @endif/></div>
    </div>
    {{--@if(isset($driver))
        <div class="modal-header" style="display: inline">
            @if($driver->licence_image)
                <img src="{{$driver->licenceimg}}" height="220px" width="220px" class="img-responsive" id="licence_img"
                     style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @else
                <img src="{{url('public/images/Driving-licence.jpg')}}" height="220px" width="220px"
                     class="img-responsive" id="licence_img"
                     style="margin-bottom: 20px;border-radius: unset;margin-top: unset">
            @endif
        </div>
    @endif
    <img src="" alt="" id="licence-preview" width="100%"
         style="display: none;border:1px solid black;alignment: center;height: 220px;width: 220px">--}}
</div>
{{--<div class="row set-center">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
        <input type="button" name="carimg" class="form-control" id="carimg" onclick="getCarFile()"
               value="Add Car Picture" style="background-color: #FFC56C;color: white;"
               @if(isset($driver)) hidden="hidden" @endif/>
        <br>
        <img src="" alt="" id="car-preview" width="100%" style="display: none;border:1px solid black">
        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="carimage" class="img-preview"
                                                                     data-preview="#car-preview" type="file"
                                                                     value="photo" name="carimage" onchange="sub(this)"
                                                                     @if(isset($driver)) hidden="hidden" @endif/></div>
    </div>
</div>--}}
<div class="row set-center">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
        <input type="button" name="photo1" class="form-control" id="photo1" onclick="getDriverFile()"
               value="Profile Picture" style="background-color: #FFC56C;color: white;"
               @if(isset($driver)) hidden="hidden" @endif/>
        <br>
        <img src="" alt="" id="diriver-preview" width="100%" style="display: none;border:1px solid black">
        <div style='height: 0px;width: 0px; overflow:hidden;'><input id="profile_driver" class="img-preview"
                                                                     data-preview="#diriver-preview" type="file"
                                                                     value="photo" name="profile_driver"
                                                                     onchange="sub(this)"
                                                                     @if(isset($driver)) hidden="hidden" @endif/></div>
    </div>
</div>


{{--<div class="row set-center">
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5" style="margin-left: 15px;margin-right: 15px;">
        <input type="submit" class="form-control" style="background-color: #FFC56C;color: white;" value="SIGN UP"/>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <p style="display: flex;justify-content: center;">Already a member ?<a href="{{url('signin?by=driver')}}" style="color:#FFC56C; ">Log In</a></p>
    </div>


</div>--}}

<script>
    function getCarFile1() {
        document.getElementById("carimage1").click();
    }

    function sub1(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(file)) {
            obj.value = "";
            alert('Invalid Image Extension.');

        } else {
            readURL1(obj);
        }

    }

    function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#car_img').attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $('[name="signupradio"]').change(function () {
        $('.display-none-otp').css('display', "none");
        $('.send-otp').val('Send OTP');
    });
    var a = "";
    $('#cmake').change(function () {

        $.ajax({
            type: 'GET',
            url: '{{ url('getmodels') }}',
            data: {name: $(this).val(), "select": a},

            success: function (msg) {
                $('#modelnm').html(msg);
            }
        });
    })
    @if(isset($driver->car_model))
        a = `{{$driver->car_model}}`;
    $('#cmake').change();

    @endif

    function getInsuranceFile1() {
        document.getElementById("insuranceimage1").click();
    }

    function sub2(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(file)) {
            obj.value = "";
            alert('Invalid Image Extension.');

        } else {
            readURL2(obj);
        }

    }

    function readURL2(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#insuranc_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    function getLicenceFile1() {
        document.getElementById("licenceimage1").click();
    }

    function sub3(obj) {
        var file = obj.value;
        var fileName = file.split("\\");
        var allowedExtensions = /(\.jpg|\.jpe|\.jif|\.jfif|\.jfi|\.tiff|\.tif|\.raw|\.arw|\.svg|\.svgz|\.bmp|\.dib|\.jpeg|\.png|\.gif)$/i;
        if (!allowedExtensions.exec(file)) {
            obj.value = "";
            alert('Invalid Image Extension.');

        } else {
            readURL3(obj);
        }

    }

    function readURL3(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#licence_img').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

</script>

