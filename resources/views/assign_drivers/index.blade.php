@extends('layouts.app')
@section('css')
<style>
    input[type='radio']:after {
        width: 25px;
        height: 25px;
        border-radius: 25px;
        top: -2px;
        left: -5px;
        position: relative;
        background-color: white;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 5px solid #ced4da;;
    }

    input[type='radio']:checked:after {
        width: 30px;
        height: 30px;
        border-radius: 25px;
        top: -2px;
        left: -5px;
        position: relative;
        background-color: #3c8dbc;
        /*content:  "\f00c";*/
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }
    .modal-confirm {
        color: #636363;
        width: 400px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }
    .modal-confirm .modal-header {
        border-bottom: none;
        position: relative;
    }
    .modal-confirm h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }
    .modal-confirm .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }
    .modal-confirm .modal-body {
        color: #999;
    }
    .modal-confirm .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }
    .modal-confirm .modal-footer a {
        color: #999;
    }
    .modal-confirm .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }
    .modal-confirm .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
        outline: none !important;
    }
    .modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
</style>
    @endsection
@section('content')
    <section class="content-header">
        <h1 class="pull-left">Assign Drivers</h1>
        {{--        <h1 class="pull-right">--}}
        {{--           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('assignDrivers.create') }}">Add New</a>--}}
        {{--        </h1>--}}
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-1">
                            <label for="per_page">Per Page:</label>
                            <select name="per_page" id="per_page" class="form-control">
                                <option value="20">20</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="">Search</label>
                            <div style="display: -webkit-inline-box;">
                                <input type="text" class="form-control inputSearch" placeholder="Search" onKeyPress="is_enter(event)">
                                <a class="btn btn-primary search">Search</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content_table">
{{--                @include('assign_drivers.table')--}}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script>
        var page=1;
        var search='';
        var per_page = "{{ $filter['per_page'] }}";
        $(document).ready(function() {
            fetch_data();

            $('#per_page').val(per_page);

            $('#per_page').change(function(){
                per_page = $(this).val();
                page = 1;
                fetch_data();
            });

            $(".search").click(function(){
                search = $('.inputSearch').val();
                page = 1;
                fetch_data();
            });


            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                fetch_data();
            });


            $(document).on('click', '.modaldata', function(event){
                var fid=$(this).attr("data-name1");
                $('#fromid').val(fid);
                $('#drivermodal').modal('show');
            });

            $(document).on('change', 'input[name=radiodriver]:radio', function(event){
                var value = $("input[name=radiodriver]:checked").val();
                var fid=$('#fromid').val();
                $('.driverdata').val(value);
                $('.fromuserid').val(fid);
                $('#ConfirmModal').modal('show');
            });

            $(document).on('hidden.bs.modal', '#ConfirmModal', function(event){
                $("input[name=radiodriver]:radio"). prop("checked", false);
            });



        });
        var jqxhr = {abort: function () {}};
        function fetch_data()
        {
            search = $('.inputSearch').val();
            jqxhr.abort();
            jqxhr=$.ajax({
                url:"{{ url('admin/assigndriver/fetch_data') }}",
                data:{
                    page:page,
                    per_page:per_page,
                    search:search,
                },
                beforeSend: function(){
                    block_ui();
                },
                success:function(data)
                {
                    $('.content_table').html(data);
                    unblock_ui();
                }
            });
        }

        function is_enter(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.search').click();
            }
        }

        $(document).on('click','#assign-driver',function(){
            var form=new FormData($('#assign_form')[0]);
            $('#ConfirmModal').hide();
            window.swal({
                title: "Submitting...",
                text: "Please wait",
                imageUrl: "{{url('public/images/Glowing_ring.gif')}}",
                showConfirmButton: false,
                allowOutsideClick: false
            });
            $.ajax({
                type: 'POST',
                url: "{{ url('admin/assign_driver_data') }}",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                success: function (res) {
                    if (res.success == true) {
                        {{--window.location="{{route('assignDrivers.index')}}";--}}
                        setTimeout(function() {
                            window.swal({
                                title: "Finished!",
                                text: "Driver assigned Successfully.",
                                type: "success",
                                showConfirmButton: true,
                                timer: 5000
                            }, function () {
                                {{\Illuminate\Support\Facades\Session::forget('from_id')}}
                                    window.location = "{{route('assignDrivers.index')}}";
                            });
                        },1000);
                    }
                    if (res.success == false) {
                        // console.log("something went wrong");
                        setTimeout(function() {
                            window.swal({
                                title: "Failed!",
                                text: "Driver Not assigned.",
                                type: "error",
                                showConfirmButton: true,
                                timer: 5000
                            }, function () {
                                {{\Illuminate\Support\Facades\Session::forget('from_id')}}
                                    window.location = "{{route('assignDrivers.index')}}";
                            });
                        },1000);
                    }
                },

            });
        });

    </script>
@endsection
