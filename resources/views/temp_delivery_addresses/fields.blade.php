<!-- Parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', 'Parent Id:') !!}
    {!! Form::text('parent_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- To Form Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_form', 'To Form:') !!}
    {!! Form::text('to_form', null, ['class' => 'form-control']) !!}
</div>

<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Company Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_id', 'Company Id:') !!}
    {!! Form::text('company_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country Id:') !!}
    {!! Form::text('country_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Street Add Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street_add', 'Street Add:') !!}
    {!! Form::text('street_add', null, ['class' => 'form-control']) !!}
</div>

<!-- Street Add1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('street_add1', 'Street Add1:') !!}
    {!! Form::text('street_add1', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile1', 'Mobile1:') !!}
    {!! Form::text('mobile1', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Sms Verification Field -->
<div class="form-group col-sm-6">
    {!! Form::label('sms_verification', 'Sms Verification:') !!}
    {!! Form::text('sms_verification', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('tempDeliveryAddresses.index') }}" class="btn btn-default">Cancel</a>
</div>
