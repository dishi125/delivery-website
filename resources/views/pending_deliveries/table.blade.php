<div class="table-responsive">
    <table class="table" id="pendingDeliveries-table">
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
                    <div class='btn-group'>
                        <a class='btn btn-default btn-xs modaldata' data-name1="{{$fromAr['id']}}" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i></a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {!! $fromArray1->links() !!}
</div>

<div class="modal fade" id="DeliverypendingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--                                    <h3 class="modal-title" id="exampleModalLabel" style="display: inline-block">Delivery Addresses</h3>--}}
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button><br>
            </div>
            <div style="text-align: center;background-color: deepskyblue;font-size: x-large;font-weight: 600;">
                <div><p style="background-color: #3c8dbc;color: white;margin-bottom: auto">Total Pending <span id="pen"></span> from <span id="all"></span></p></div>
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
                        </tr>
                        </thead>
                        <tbody  id="tbody-data">
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


