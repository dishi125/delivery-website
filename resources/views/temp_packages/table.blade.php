<div class="table-responsive">
    <table class="table" id="tempPackages-table">
        <thead>
            <tr>
                <th>To Address Id</th>
        <th>Weight</th>
        <th>Packagekg</th>
        <th>Dimensionl</th>
        <th>Dimensionw</th>
        <th>Dimensionh</th>
        <th>Dimensions</th>
        <th>Dvalue</th>
        <th>Image</th>
        <th>Date</th>
        <th>Time</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($tempPackages as $tempPackages)
            <tr>
                <td>{{ $tempPackages->to_address_id }}</td>
            <td>{{ $tempPackages->weight }}</td>
            <td>{{ $tempPackages->packagekg }}</td>
            <td>{{ $tempPackages->dimensionl }}</td>
            <td>{{ $tempPackages->dimensionw }}</td>
            <td>{{ $tempPackages->dimensionh }}</td>
            <td>{{ $tempPackages->dimensions }}</td>
            <td>{{ $tempPackages->dvalue }}</td>
            <td>{{ $tempPackages->image }}</td>
            <td>{{ $tempPackages->date }}</td>
            <td>{{ $tempPackages->time }}</td>
                <td>
                    {!! Form::open(['route' => ['tempPackages.destroy', $tempPackages->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('tempPackages.show', [$tempPackages->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('tempPackages.edit', [$tempPackages->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
