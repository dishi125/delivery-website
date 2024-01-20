<div class="table-responsive">
    <table class="table" id="tempDeliveryAddresses-table">
        <thead>
            <tr>
                <th>Parent Id</th>
        <th>User Id</th>
        <th>To Form</th>
        <th>Name</th>
        <th>Company Id</th>
        <th>Country Id</th>
        <th>Street Add</th>
        <th>Street Add1</th>
        <th>Mobile</th>
        <th>Mobile1</th>
        <th>Email</th>
        <th>Sms Verification</th>
        <th>Price</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tempDeliveryAddresses as $tempDeliveryAddresses)
            <tr>
                <td>{{ $tempDeliveryAddresses->parent_id }}</td>
            <td>{{ $tempDeliveryAddresses->user_id }}</td>
            <td>{{ $tempDeliveryAddresses->to_form }}</td>
            <td>{{ $tempDeliveryAddresses->name }}</td>
            <td>{{ $tempDeliveryAddresses->company_id }}</td>
            <td>{{ $tempDeliveryAddresses->country_id }}</td>
            <td>{{ $tempDeliveryAddresses->street_add }}</td>
            <td>{{ $tempDeliveryAddresses->street_add1 }}</td>
            <td>{{ $tempDeliveryAddresses->mobile }}</td>
            <td>{{ $tempDeliveryAddresses->mobile1 }}</td>
            <td>{{ $tempDeliveryAddresses->email }}</td>
            <td>{{ $tempDeliveryAddresses->sms_verification }}</td>
            <td>{{ $tempDeliveryAddresses->price }}</td>
                <td>
                    {!! Form::open(['route' => ['tempDeliveryAddresses.destroy', $tempDeliveryAddresses->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tempDeliveryAddresses.show', [$tempDeliveryAddresses->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tempDeliveryAddresses.edit', [$tempDeliveryAddresses->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
