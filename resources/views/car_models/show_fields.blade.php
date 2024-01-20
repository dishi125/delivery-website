<!-- Car Make Name Field -->
<div class="form-group">
    {!! Form::label('car_make_name', 'Car Make Name:') !!}
    <p>{{ $carModel->car_make_name }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $carModel->name }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $carModel->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $carModel->updated_at }}</p>
</div>

