<div class="table-responsive">
    <table class="table" id="drivers-table">
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
            <th>Action</th>
            {{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($drivers as $driver)
            <tr>
                <td>{{ ucfirst($driver->fname) }} {{ ucfirst($driver->lname) }}</td>
                <td>{{ $driver->email }}</td>
                <td>{{ $driver->mobile }}</td>
                <td>{{ ucfirst($driver->address) }}</td>
                @if($driver->profile_pic)
                    <td><img src="{{$driver->Profile }}" height="100px" width="100px"></td>
                @else
                    <td></td>
                @endif
                <td>{{ ucfirst($driver->car_make) }}</td>
                <td>{{ ucfirst($driver->car_model) }}</td>
                @if($driver->car_image)
                    <td><img src="{{ $driver->Carimg }}" height="100px" width="100px"></td>
                @else
                    <td></td>
                @endif


                {{--                <td>--}}
                {{--                    {!! Form::open(['route' => ['drivers.destroy', $driver->id], 'method' => 'delete']) !!}--}}
                {{--                    <div class='btn-group'>--}}
                {{--                        <a href="{{ route('drivers.show', [$driver->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
                {{--                        <a href="{{ route('drivers.edit', [$driver->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
                {{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
                {{--                    </div>--}}
                {{--                    {!! Form::close() !!}--}}
                {{--                </td>--}}
                <td style="display: inline">
                    {!! Form::open(['route' => ['drivers.destroy', $driver->id], 'method' => 'delete']) !!}
                    <a href="{{ route('drivers.edit', $driver->id) }}" class='btn btn-default btn-xs'>
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', [
                        'type' => 'submit',
                         'class' => 'btn btn-danger btn-xs',
                        'onclick' => "return confirm('Are you sure?')"
                     ]) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div class="text-center">
    {!! $drivers->links() !!}
</div>
