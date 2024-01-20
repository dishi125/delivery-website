
<div class="table-responsive">
    <table class="table" id="deliveryAddresses-table">
        <thead>
            <tr>
                <th>Request By</th>
                <th>Plan Name</th>
                <th colspan="3">View Details</th>
            </tr>
        </thead>
        <tbody>
        @foreach($deliveryAddresses as $deliveryAddress)
            <tr>
                <td><a href="{{url('admin/webUsers')}}?search={{$deliveryAddress->FirstName}} {{ ucfirst($deliveryAddress->LastName) }}">{{ ucfirst($deliveryAddress->FirstName) }} {{ ucfirst($deliveryAddress->LastName) }}</a></td>
                <td>{{ $deliveryAddress->planname }}</td>
                <td>
{{--                    {!! Form::open(['route' => ['deliveryAddresses.destroy', $deliveryAddresses->id], 'method' => 'delete']) !!}--}}
                    <div class='btn-group'>
                        {!! Form::open(['route' => ['deliveryAddresses.destroy', $deliveryAddress->id], 'method' => 'delete']) !!}

                        {{--                        <a href="{{ route('deliveryAddresses.show', [$deliveryAddress->id]) }}" class='btn btn-default btn-xs' data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                        <a class='btn btn-default btn-xs modaldata' data-name1="{{$deliveryAddress->id}}" data-toggle="modal"><i class="glyphicon glyphicon-eye-open"></i></a>
                        {{--                        <a href="{{ route('deliveryAddresses.edit', [$deliveryAddresses->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
{{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                        <a href="{{ route('deliveryAddresses.edit', $deliveryAddress->id) }}" class='btn btn-default btn-xs'>
                            <i class="glyphicon glyphicon-edit"></i>
                        </a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                            'type' => 'submit',
                             'class' => 'btn btn-danger btn-xs',
                            'onclick' => "return confirm('Are you sure?')"
                         ]) !!}
                        {!! Form::close() !!}
                    </div>
{{--                    {!! Form::close() !!}--}}
                </td>
            </tr>



        @endforeach
        </tbody>
    </table>

</div>
<div class="text-center">
    {!! $deliveryAddresses->links() !!}
</div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
{{--                    <h5 class="modal-title" id="exampleModalLabel">New message</h5>--}}

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button><br>
                    <form method="post" id="pricefrm">
                        <div class="input-group col-xs-5 col-sm-5 col-md-5 col-lg-5">
                            <input class="form-control" type="text"  name="price" style="border-color: lightskyblue;" placeholder="Enter Price">
                            <span class="input-group-btn"><button type="button" class="btn btn-info" name="submitpr" id="submitpr">Submit</button></span>
                        </div>
                        <label id="price-error" class="error" for="price" style="color: red"></label>
                    </form>
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
                            <th>Total Package</th>
                            <th>View Packages</th>
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

                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
{{--                    <button type="button" class="btn btn-primary">Send message</button>--}}
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h2 style="display: inline-block">Package Details</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="display: inline-block">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body" id="modal-body">
                <div class="table-responsive scroll-class">
                    <table class="table" id="deliveryAddresses-table">
                        <thead>
                        <tr>
                            <th>weight</th>
                            <th>Length</th>
                            <th>Width</th>
                            <th>Height</th>
                            <th>dvalue</th>
                            <th>image</th>
                            <th>date</th>
                            <th>time</th>
                        </tr>
                        </thead>
                        <tbody  id="tbody-data1">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" style="background-color: #5a6268;color: white;" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
