<div class="table-responsive">
    <table class="table" id="assignDrivers-table">
        <thead>
        <tr>
            <th>Requested By</th>
            <th>Plan Name</th>
            <th>Country</th>

            <th>Phone</th>
            <th>E-mail</th>
            <th colspan="3">View drivers</th>
        </tr>
        </thead>
        <tbody>
        @foreach($assignDrivers as $assignDriver)
            <?php
            $cntnm=\App\Models\Country::where('id',$assignDriver->country_id)->pluck('name')->first();
            $cmpnm=\App\Models\Company::where('id',$assignDriver->company_id)->pluck('name')->first();
            ?>
            <tr>
                <td><a href="{{url('admin/webUsers')}}?search={{$assignDriver->FirstName}} {{ ucfirst($assignDriver->LastName) }}">{{ ucfirst($assignDriver->FirstName) }} {{ ucfirst($assignDriver->LastName) }}</a></td>
                <td>{{ ucfirst($assignDriver->planname) }}</td>
                <td>{{ ucfirst($cntnm) }}</td>
                <td>{{ $assignDriver->mobile }}</td>
                <td>{{ $assignDriver->email }}</td>
                <td>
                    {{--                    {!! Form::open(['route' => ['assignDrivers.destroy', $assignDriver->id], 'method' => 'delete']) !!}--}}
                    <div class='btn-group'>
                        <a class='btn btn-default btn-xs modaldata' data-toggle="modal" data-name1="{{$assignDriver->id}}"><i class="glyphicon glyphicon-eye-open"></i></a>
                        {{--                        <a href="{{ route('assignDrivers.edit', [$assignDriver->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
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
    {!! $assignDrivers->links() !!}
</div>
<div class="modal fade" id="drivermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" name="drivermodal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            {{--            <div class="modal-header">--}}
            {{--                <h3 class="modal-title" id="exampleModalLabel" style="text-align: center">Assign Driver</h3>--}}

            {{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
            {{--                    <span aria-hidden="true">&times;</span>--}}
            {{--                </button><br>--}}
            {{--            </div>--}}
            <input type="hidden" name="fromid" id="fromid" value="">
            <div class="modal-body" id="modal-body">
                <div class="table-responsive scroll-class">
                    <table class="table" id="deliveryAddresses-table">
                        <thead>
                        <tr>
                            <th></th>
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
                        <tbody>

                        @foreach($driverar as $d)
                            <tr>
                                <td><input type="radio" name="radiodriver" id="{{$d['id']}}" class="radioclass" value="{{$d['id']}}"></td>
                                <td>{{ucfirst($d['fname'])}} {{ucfirst($d['lname'])}}</td>
                                <td>{{$d['email']}}</td>
                                <td>{{$d['mobile']}}</td>
                                <td>{{ucfirst($d['address'])}}</td>
                                @if($d['profile_pic'])
                                    <td><img src="{{url('public/images/profile/'.$d['profile_pic'])}}" height="50px" width="50px"></td>
                                @else
                                    <td></td>
                                @endif
                                <td>{{ucfirst($d['car_make'])}}</td>
                                <td>{{ucfirst($d['car_model'])}}</td>
                                @if($d['car_image'])
                                    <td><img src="{{url('public/images/car_images/'.$d['car_image'])}}" height="50px" width="50px"></td>
                                @else
                                    <td></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<div id="ConfirmModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-confirm">
        <div class="modal-content">
            <div class="modal-header">
                <div class="icon-box">
                    <i class="material-icons">check</i>
                </div>
                <h4 class="modal-title">Are you sure?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="assign_form" action="javascript:void(0);">
                    {{csrf_field()}}
                    <input type="hidden" value="" name="driverid" class="driverdata">
                    <input type="hidden" value="" name="fromuserid" class="fromuserid">
                    <p>Do you really want to Assign request to this driver? This process cannot be undone.</p>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info" id="assign-driver">Yes</button>
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">No</button>
            </div>
        </div>
    </div>
</div>


