<div class="table-responsive">
    <table class="table" id="carMakes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($carMakes as $carMake)
            <tr>
                <td>{{ $carMake->name }}</td>
                <td>
                    {!! Form::open(['route' => ['carMakes.destroy', $carMake->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('carMakes.show', [$carMake->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('carMakes.edit', [$carMake->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    <div class="text-center">
        {!! $carMakes->links() !!}
    </div>
</div>
