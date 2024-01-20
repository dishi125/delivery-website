<!-- Country Name Field -->
@php
    $country=[""=>"Select Country"]+\App\Models\Country::orderBy('name')->pluck('name',"name")->toarray();
@endphp
<div class="form-group col-sm-6">
    {!! Form::label('country_name', 'Country Name:') !!}
    {!! Form::select('country_name',$country, null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('provinces.index') }}" class="btn btn-default">Cancel</a>
</div>
