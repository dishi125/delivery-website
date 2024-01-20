<div class="table-responsive">
    <table class="table" id="deliveryCompletions-table">
        <thead>
        <tr>
            <th>Request Of</th>
            <th>Driver Name</th>
            <th>Plan Name</th>
            <th>Phone</th>
            <th>E-mail</th>
            <th colspan="3">View Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($fromArray1 as $fromAr)

            <tr>
                <td><a href="{{url('admin/webUsers')}}?search={{ ucfirst($fromAr['fname'])}} {{ ucfirst($fromAr['lname']) }}">{{ucfirst($fromAr['fname'])}} {{ucfirst($fromAr['lname'])}}</a></td>
                <td><a href="javascript:void(0)" data-id="{{$fromAr['driverid']}}" class="userdata">{{ucfirst($fromAr['driverfname'])}} {{ucfirst($fromAr['driverlname'])}}</a></td>
                <td>{{ucfirst($fromAr['planname'])}}</td>
                <td>{{$fromAr['mobile']}}</td>
                <td>{{$fromAr['email']}}</td>
                <td>
                    {{--                    {!! Form::open(['route' => ['deliveryCompletions.destroy', $deliveryCompletion->id], 'method' => 'delete']) !!}--}}
                    <div class='btn-group'>
                        <a class='btn btn-default btn-xs modaldata' data-name1="{{$fromAr['id']}}" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i></a>
                        {{--                        <a href="{{ route('deliveryCompletions.edit', [$deliveryCompletion->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                        {{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                    </div>
                    {{--                    {!! Form::close() !!}--}}
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>
<div class="text-center">
    {!! $fromArray1->links() !!}
</div>
<div class="modal fade" id="DeliveryCompleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>--}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div style="text-align: center;background-color: deepskyblue;font-size: x-large;font-weight: 600;">
                <div><p style="background-color: #3c8dbc;color: white;margin-bottom: auto">Total Complete <span id="com"></span> from <span id="all"></span></p></div>
            </div>
            <div class="modal-body" id="modal-body">
                <div class="table-responsive scroll-class">

                    <table class="table" id="deliveryAddresses-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Address</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Delivery Complete Image</th>
                            <th>Date Time</th>
                        </tr>
                        </thead>
                        <tbody  id="tbody-data">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                {{--                    <input type="text" name="price" placeholder="Enter price" class="center-block">--}}
                {{--<div class="form-group col-xs-5 col-sm-5 col-md-5 col-lg-5">
                    <input class="form-control input-lg" id="inputlg" type="text" style="border-color: lightskyblue;border-radius: 10px;" placeholder="Enter Price">
                <button type="button" class="btn btn-success" data-dismiss="modal">Submit</button>
                </div>--}}
                <button type="button" class="btn btn-secondary" style="background-color: #3d7ca1;color: white;" data-dismiss="modal">Close</button>
                {{--                    <button type="button" class="btn btn-primary">Send message</button>--}}
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="UserdataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div class="modal-body">
                <div class="table-responsive scroll-class">

                    <table class="table" id="deliveryAddresses-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Address</th>
                            <th>Profile Picture</th>
                            <th>Car Company Name</th>
                            <th>Car Model</th>
                            <th>Car Image</th>
                        </tr>
                        </thead>
                        <tbody  id="driver-data">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" style="background-color: #3d7ca1;color: white;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>--}}


