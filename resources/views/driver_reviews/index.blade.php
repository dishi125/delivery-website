@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Driver Reviews</h1>
        <h1 class="pull-right">
{{--           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('driverReviews.create') }}">Add New</a>--}}
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

                    </div>
                </div>
                <div class="content_table">
{{--                    @include('driver_reviews.table')--}}
                </div>
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@section('scripts')

    <script>
        var page=1;
        var search='';
        var per_page = "{{ $filter['per_page'] }}";
        $(document).ready(function () {

            fetch_data();

            $('#per_page').val(per_page);

            $('#per_page').change(function(){
                per_page = $(this).val();
                page = 1;
                fetch_data();
            });

            $(document).on('click', '.pagination a', function(event){
                event.preventDefault();
                page = $(this).attr('href').split('page=')[1];
                fetch_data();
            });


        });
        var jqxhr = {abort: function () {}};
        function fetch_data()
        {
            search = $('.inputSearch').val();
            jqxhr.abort();

            jqxhr=$.ajax({
                url:"{{ url('admin/deliverreview/fetch_data') }}",
                data:{
                    page:page,
                    per_page:per_page,
                },
                beforeSend: function(){
                    block_ui();
                },

                success:function(data)
                {
                    $('.content_table').html(data);
                    setstar();
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
        function setstar() {

            $(".rateYo").rateYo({
                starWidth: "35px",
                spacing: "10px",
                fullStar: true,
                readOnly: true
            });
        }
    </script>
@endsection
