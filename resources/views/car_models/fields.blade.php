<!-- Car Make Name Field -->
@php
$carmake=[""=>"Select Car Make"]+\App\Models\CarMake::orderBy('name')->pluck('name',"name")->toarray();
@endphp
<div class="form-group col-sm-6">
    {!! Form::label('car_make_name', 'Car Make Name:') !!}
    {!! Form::select('car_make_name', $carmake, null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('carModels.index') }}" class="btn btn-default">Cancel</a>
</div>
