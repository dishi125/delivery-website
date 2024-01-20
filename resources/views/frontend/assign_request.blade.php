@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Assign Request</title>
@endsection
@section('css')
    <style>
        input[type='radio']:after {
            width: 30px;
            height: 30px;
            border-radius: 25px;
            top: -18px;
            left: -5px;
            position: relative;
            content: '';
            display: inline-block;
            visibility: visible;
            background-color: white;
            border: 5px solid #ced4da;
        }

        input[type='radio']:checked:after {
            width: 30px;
            height: 30px;
            border-radius: 25px;
            top: -18px;
            left: -5px;
            position: relative;
            background-color: #ffa500;
            /*content:  "\f00c";*/
            display: inline-block;
            visibility: visible;
            border: 2px solid white;
        }
        @media (min-width: 768px) {
            .response-modal{
                padding-top: 8%
            }
        }
        @media (max-width: 767px) {
            .response-modal{
                padding-top: 30%
            }
            .request-p {
                display: block !important;
            }

        }
        @media (max-width: 1199px) {
            .request-p{
                margin-left: unset!important;
                font-size: 28px;
            }


        }
        input[type='radio']{
            /*top: -15px;*/
            margin-left: 18px;
        }
        table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>td:first-child:before, table.dataTable.dtr-inline.collapsed>tbody>tr[role="row"]>th:first-child:before {
            background-color:#FFC56C!important;
            line-height: 18px!important;
            top: 15px;
            left: 4px;
            height: 18px;
            width: 18px;

        }
        table.dataTable{
            border-collapse:collapse!important;
        }
        [type=search] {
            -webkit-appearance: button;
            border-radius: .25rem;
        }
        .dataTables_length{
            display: inline-block;
        }
        .dataTables_filter{
            display: inline-block;

        }
        @media (min-width: 517px) {
            .dataTables_filter{
                float: right;
            }

        }
        @media (min-width: 1025px) {

            #user-form{
                min-height: 300px;
                /*overflow: auto*/
            }

        }
    </style>

@endsection
@section('content')
    <div class="content-div1 container-fluid">
        <div class="fade show" id="exampleModal"  aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: block">
            <div class="modal-dialog1  md1" role="document" >
                <div class="modal-content container">
                    <div class="message">
                        @if(session()->has('flashmsg'))
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                <strong><i class="fa fa-exclamation-triangle" aria-hidden="true"></i></strong>{{session()->get('flashmsg')}}

                            </div>
                            <?php session()->forget('flashmsg'); ?>
                        @endif
                    </div>
                    <div class="modal-header" style="display: block;border-bottom: 1px solid #e9ecef;">
                         <center><h1 class="modal-title" id="exampleModalLabel">Delivery Details</h1></center>
                    </div>
                    <div class="modal-body">
                        <div class="form" id="user-form">
                                <div class="form-group">
                                    @foreach($fromdata as $d)
                                        <div class="row set-center">
                                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                                <div style="background-color: #FFC56C;color: white;border-radius: 5px;">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 request-p"><input type='radio' name="assign_radio" value="{{$d->id}}"/></div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2  request-p">{{$d->planname}}</div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                        </div>
                        <div class="modal-footer" style="justify-content: center;">
                            <a class="form-control back-button" href="{{url('/home_driver')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
@section('main_script')

{{--    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>--}}

    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                responsive: true,
                paging: false,
                ordering: false,
                searching: false,
                info: false,
                columnDefs: [
                    {responsivePriority: 0, targets: 0},
                    {responsivePriority: 1, targets: 1},
                ],
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate
                },
            });
            $('#example2').DataTable({
                responsive: true,
                paging: false,
                ordering: false,
                info: false,
                searching: false,
                pageLength: 5,
                columnDefs: [
                    {responsivePriority: 0, targets: 0},
                    {responsivePriority: 1, targets: 1},
                ],
                details: {
                    display: $.fn.dataTable.Responsive.display.childRowImmediate
                },
            });
        });

        $(document).ready(function() {
            $('input[name=assign_radio]:radio').change(function (e) {
                var value = $( this ).val();
                window.location="{{url('assign_requestdata/')}}"+"/"+value;
            });
            setTimeout(function(){
                $(".message").remove();
            }, 5000 );


        });

    </script>
@endsection
