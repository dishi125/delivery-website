<style>
    input[type=number] {
        height: 45px;
        width: 45px;
        font-size: 25px;
        text-align: center;
    }

    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .display-none-otp {
        display: none;
    }

    .otp-field-main {
        /*width: 90%;*/
        top: -21px;
        height: 0;
        padding: 0;
        position: absolute;
        opacity: 0;
    }

    .less-height {
        max-height: 10px;
        min-height: 0px;
        height: 0;
        padding: 0;
        margin: 0;
    }
</style>
<div class="form-group">
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="text" name="fname" class="form-control" id="fname" placeholder="First Name"
                   value="{{ isset($user->fname) ? $user->fname : '' }}"/>
        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="text" name="lname" class="form-control" id="lname" placeholder="Last Name"
                   value="{{ isset($user->lname) ? $user->lname : '' }}"/>
        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email"
                   value="{{ isset($user->email) ? $user->email : '' }}" @if(isset($user)) disabled="disabled" @endif/>
        </div>
    </div>
    <div class="row set-center">
        <div
            class="@if(isset($user)) col-lg-5 col-md-5 col-sm-5 col-xs-5 @else col-lg-3 col-md-3 col-sm-4 col-xs-4 @endif mt-sm">
            <input type="text" name="mobile" class="form-control input-number" id="mobile" placeholder="Mobile Number"
                   value="{{ isset($user->mobile) ? $user->mobile : '' }}"
                   @if(isset($user)) disabled="disabled" @endif/>


        </div>
        @if(!isset($user))
            <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1 send-otp-btn-pre mt-sm"
                 style="margin-left: 0;padding-left: 0">
                <input type="button" name="sendotp" class="form-control send-otp" value="Send OTP"
                       style="background-color: #FFC56C;color: white;" disabled/>
                <span class="mobile-error-class"></span>
            </div>
        @endif

    </div>
    @if(!isset($user))
        <div class="display-none-otp set-center">
            <div class="row set-center mt-sm">
                <p class="mobile-error-class text-center"></p>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1  ">
                    <input id="codeBox1" class="form-control otp-field input-number" type="number" maxlength="1"
                           onkeyup="onKeyUpEvent(1, event)"
                           onfocus="onFocusEvent(1)"/>

                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1 ">
                    <input id="codeBox2" class="form-control otp-field input-number" type="number" maxlength="1"
                           onkeyup="onKeyUpEvent(2, event)"
                           onfocus="onFocusEvent(2)"/>

                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1 ">
                    <input id="codeBox3" class="form-control otp-field input-number" type="number" maxlength="1"
                           onkeyup="onKeyUpEvent(3, event)"
                           onfocus="onFocusEvent(3)"/>

                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1 col-1 col-offset-1">
                    <input id="codeBox4" class="form-control otp-field input-number" type="number" maxlength="1"
                           onkeyup="onKeyUpEvent(4, event)"
                    />

                </div>
                <div class="col-12">
                    <input type="text" name="otp" class="otp-field-main">
                </div>
            </div>


        </div>

    @endif


    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="text" name="otp" class="otp-field-main ">
            <input type="text" name="address" class="form-control" id="address" placeholder="Address"
                   value="{{ isset($user->address) ? $user->address : '' }}"/>
        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="password" name="password" class="form-control" id="password" placeholder="Password"
                   @if(isset($user)) hidden="hidden" @endif/>
        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5 mt-sm">
            <input type="password" name="cpassword" class="form-control" id="cpassword" placeholder="Confirm Password"
                   @if(isset($user)) hidden="hidden" @endif/>
        </div>
    </div>
    <div class="row set-center">
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3 mt-sm">
            <input type="button" name="photo" class="form-control" id="photo" onclick="getFile()"
                   value="Profile Picture" style="background-color: #FFC56C;color: white;"
                   @if(isset($user)) hidden="hidden" @endif/><br>
            <img src="" alt="" id="profile" width="100%" style="display: none;border:1px solid black">
            <div style='height: 0px;width: 0px; overflow:hidden;'><input id="profile_web" data-preview="#profile"
                                                                         type="file" value="photo" class="img-preview"
                                                                         name="profile_web" onchange="sub(this)"
                                                                         @if(isset($user)) hidden="hidden" @endif/>
            </div>
        </div>
    </div>
</div>
