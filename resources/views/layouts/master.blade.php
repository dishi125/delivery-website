<!DOCTYPE html>
<html lang="en">

<head>
@yield('meta_script')

<!-- add icon link -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel = "icon" href="{{url('public/images/logo.png')}}"
          type = "image/x-icon">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i">

    <!-- Bootstrap CSS File -->
    <link rel="stylesheet" href="{{ url('public/lib/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/lib/rateyo/jquery.rateyo.css') }}">
    <link rel="stylesheet" href="{{ url('public/lib/rateyo/jquery.rateyo.min.css') }}">

    <!-- Libraries CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ url('public/lib/animate/animate.min.css') }}">
    <link rel="stylesheet" href="{{url('public/lib/ionicons/css/ionicons.min.css')}}">
    <link rel="stylesheet" href="{{url('public/lib/owlcarousel/assets/owl.carousel.min.css')}}">

    <!-- Datatables CSS Files -->
    <link rel="stylesheet" href="{{url('public/css/main_css.css')}}">
    <link rel="stylesheet" href="{{ url('public/css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('public/css/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    @yield('css')
    <style>
        @media (min-width: 1025px) {
            /*.pc_scrollbar{
                overflow-y: hidden;
            }*/
           *[role="document"] .modal-body, *[role="document"] .scrolling-wrapper{
               height: 770px; /*500*/
                overflow: auto
            }
           .size_modal_pc{
               overflow: hidden!important;
           }
        }

    </style>
</head>

<body class="pc_scrollbar">


<!--========================== Header ============================-->
<header id="header" class="container-fluid">
    <div id="logo"  style="" class="">
        <a href="{{url('/')}}" class="scrollto"><img
                class="img-responsive prevent" style="margin-top: 11px;"
                src="{{url('public/images/logo.png')}}"
                alt="Delivery in hour"></a>
    </div>

    <div style="float: right;" class="@if(\Illuminate\Support\Facades\Request::is('/') or \Illuminate\Support\Facades\Request::is('display_link_plan') or \Illuminate\Support\Facades\Request::is('gmapsdata') or \Illuminate\Support\Facades\Request::is('signin') or  \Illuminate\Support\Facades\Request::is('signup') or  \Illuminate\Support\Facades\Request::is('forgot_otp') or  \Illuminate\Support\Facades\Request::is('reset_password') or  \Illuminate\Support\Facades\Request::is('otp')) none-display @endif logout-center">
        <a href="{{url('logout')}}" style="color: black"><i class="fa fa-sign-out hidden1" aria-hidden="true" style="font-size: 30px">Logout</i></a>
        <a href="{{url('logout')}}" style="color: black"><i class="fa fa-sign-out hidden2" aria-hidden="true" style="font-size: 30px"></i></a>
    </div>

    @yield('navbar')
</header><!-- #header -->

@yield('content')


<!--==========================
      Footer
    ============================-->
@yield('footer')

<!-- #footer -->
<!-- JavaScript Libraries -->

<script src="{{url('public/lib/jquery/jquery.min.js')}}"></script>
<script src="{{url('public/lib/jquery/jquery-migrate.min1.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>--}}
<script src="https://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="{{url('public/lib/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
{{--<script src="{{url('public/lib/superfish/hoverIntent.js')}}></script>--}}
{{--<script src="{{url('public/lib/superfish/superfish.min.js')}}></script>--}}
{{--<script src="{{url('public/lib/wow/wow.min.js')}}></script>--}}
{{--<script src="{{url('public/lib/waypoints/waypoints.min.js')}}></script>--}}
{{--<script src="{{url('public/lib/counterup/counterup.min.js')}}></script>--}}
{{--<script src="{{url('public/lib/owlcarousel/owl.carousel.min.js')}}></script>--}}
{{--<script src="{{url('public/lib/isotope/isotope.pkgd.min.js')}}></script>--}}
<script src="{{url('public/lib/rateyo/jquery.min.js')}}"></script>
<script src="{{url('public/lib/rateyo/jquery.rateyo.js')}}"></script>
<script src="{{url('public/lib/rateyo/jquery.rateyo.min.js')}}"></script>
<script src="{{url('public/lib/touchSwipe/jquery.touchSwipe.min.js')}}"></script>
<script src="{{url('public/lib/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('public/lib/datatables/dataTables.responsive.min.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-hover-dropdown/2.2.1/bootstrap-hover-dropdown.min.js"></script>
<!-- Contact Form JavaScript File -->
<script src="{{url('public/js/sweetalert.min.js')}}"></script>
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/DragDrop/0.3.0/drag-drop.min.js" integrity="sha256-RPEDU53tLgngA9v7SONMdfvfZMidY67NE5NC5sHCN28=" crossorigin="anonymous"></script>--}}
<script>
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
        } else {
            $('#header').removeClass('header-scrolled');
        }
    });


    $(window).load(function () {
        if ($(this).scrollTop() > 100) {
            $('#header').addClass('header-scrolled');
        }else {
            $('#header').removeClass('header-scrolled');
        }
    });
    function readURL(input,preview) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $(preview).css('display',"block");
                $(preview).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $(".img-preview").change(function() {
        var preview=$(this).data('preview');
        readURL(this,preview);

    });

    $(document).on('keydown',".input-number",function(event) {

        if(event.shiftKey && ((event.keyCode >=48 && event.keyCode <=57)
            || (event.keyCode >=186 &&  event.keyCode <=222))){
            // Ensure that it is a number and stop the Special chars
            event.preventDefault();
        }
        else if ((event.shiftKey || event.ctrlKey) && (event.keyCode > 34 && event.keyCode < 40)){
            // let it happen, don't do anything
        }
        else{
            // Allow only backspace , delete, numbers
            if (event.keyCode == 9 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 39 ||event.keyCode == 37
                || (event.keyCode >=48 && event.keyCode <=57) || event.keyCode >=96 && event.keyCode <=105) {
                // let it happen, don't do anything
            }
            else {
                // Ensure that it is a number and stop the key press
                event.preventDefault();
            }
        }
    });
</script>

@yield('main_script')

</body>
</html>
