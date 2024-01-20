<div class="table-responsive">
    <table class="table" id="carModels-table">
        <thead>
            <tr>
                <th>Car Make Name</th>
        <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($carModels as $carModel)
            <tr>
                <td>{{ $carModel->car_make_name }}</td>
            <td>{{ $carModel->name }}</td>
                <td>
                    {!! Form::open(['route' => ['carModels.destroy', $carModel->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('carModels.show', [$carModel->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('carModels.edit', [$carModel->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
