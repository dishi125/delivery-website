<!-- To Address Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_address_id', 'To Address Id:') !!}
    {!! Form::text('to_address_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Weight Field -->
<div class="form-group col-sm-6">
    {!! Form::label('weight', 'Weight:') !!}
    {!! Form::text('weight', null, ['class' => 'form-control']) !!}
</div>

<!-- Packagekg Field -->
<div class="form-group col-sm-6">
    {!! Form::label('packagekg', 'Packagekg:') !!}
    {!! Form::text('packagekg', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimensionl Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimensionl', 'Dimensionl:') !!}
    {!! Form::text('dimensionl', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimensionw Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimensionw', 'Dimensionw:') !!}
    {!! Form::text('dimensionw', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimensionh Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimensionh', 'Dimensionh:') !!}
    {!! Form::text('dimensionh', null, ['class' => 'form-control']) !!}
</div>

<!-- Dimensions Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dimensions', 'Dimensions:') !!}
    {!! Form::text('dimensions', null, ['class' => 'form-control']) !!}
</div>

<!-- Dvalue Field -->
<div class="form-group col-sm-6">
    {!! Form::label('dvalue', 'Dvalue:') !!}
    {!! Form::text('dvalue', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('image', 'Image:') !!}
    {!! Form::text('image', null, ['class' => 'form-control']) !!}
</div>

<!-- Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date', 'Date:') !!}
    {!! Form::text('date', null, ['class' => 'form-control']) !!}
</div>

<!-- Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('time', 'Time:') !!}
    {!! Form::text('time', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tempPackages.index') }}" class="btn btn-default">Cancel</a>
</div>
