<div class="table-responsive">
    <table class="table" id="webUsers-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile No</th>
            <th>Address</th>
            <th>Profile Picture</th>
            <th>Action</th>
{{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($webUsers as $webUser)
            <tr>
                <td>{{ ucfirst($webUser->fname) }} {{ ucfirst($webUser->lname) }}</td>
                <td>{{ $webUser->email }}</td>
                <td>{{ $webUser->mobile }}</td>
                <td>{{ ucfirst($webUser->address) }}</td>
                @if($webUser->profile_pic)

                <td><img src="{{$webUser->profile}}" width="100px" height="100px"></td>
                @else
                    <td></td>
                @endif
{{--                <td>--}}
{{--                    {!! Form::open(['route' => ['webUsers.destroy', $webUser->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('webUsers.sh ow', [$webUser->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
{{--                        <a href="{{ route('webUsers.edit', [$webUser->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
{{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
                <td>
                    {!! Form::open(['route' => ['webUsers.destroy', $webUser->id], 'method' => 'delete']) !!}
                        <a href="{{ route('webUsers.edit', $webUser->id) }}" class='btn btn-default btn-xs'>
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
    {!! $webUsers->links() !!}
</div>
