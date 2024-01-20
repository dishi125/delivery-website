@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Pending Deliveries</h1>
        <h1 class="pull-right">
{{--           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('pendingDeliveries.create') }}">Add New</a>--}}
        </h1>
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
{{--                    @include('pending_deliveries.table')--}}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection
@section('scripts')
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script>
        var page=1;
        var search='';
        var per_page = "{{ $filter['per_page'] }}";
        $(document).ready(function() {

            // Load data for first time
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
                var id=$(this).attr("data-name1");

                $.ajax({
                    type: 'get',
                    url:  "{{url('/admin/deliverypendingmodaldata')}}"+"/"+id,
                    success: function (res) {
                        if (res.success == true) {
                            // alert(res.message);
                            $('#tbody-data').html(res.message);
                            $('#pen').html(res.pending);
                            $('#all').html(res.all);
                            $('#DeliverypendingModal').modal('show');
                        }
                    }
                });
            });

            $(document).on('click', '.userdata', function(event){
                var id=$(this).attr("data-id");

                $.ajax({
                    type: 'get',
                    url:  "{{url('/admin/driver_data')}}"+"/"+id,
                    success: function (res) {
                        if (res.success == true) {
                            // alert(res.message);
                            $('#driver-data').html(res.message);
                            $('#UserdataModal').modal('show');
                        }
                    }
                });
            });

            $(document).on('shown.bs.modal', '#DeliverypendingModal', function(event){
                $('.scroll-class').scrollLeft(0);
            });
        });

        function is_enter(event){
            var keycode = (event.keyCode ? event.keyCode : event.which);
            if(keycode == '13'){
                $('.search').click();
            }
        }

        var jqxhr = {abort: function () {}};
        function fetch_data()
        {
            search = $('.inputSearch').val();
            jqxhr.abort();
            jqxhr=$.ajax({
                url:"{{ url('admin/deliverypending/fetch_data') }}",
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
    </script>
@endsection
