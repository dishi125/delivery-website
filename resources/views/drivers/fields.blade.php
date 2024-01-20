<!-- Fname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('fname', 'Fname:') !!}
    {!! Form::text('fname', null, ['class' => 'form-control']) !!}
</div>

<!-- Lname Field -->
<div class="form-group col-sm-6">
    {!! Form::label('lname', 'Lname:') !!}
    {!! Form::text('lname', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::email('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', 'Mobile:') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('address', 'Address:') !!}
    {!! Form::textarea('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('profile image', 'Profile Image:') !!}
    {!! Form::file('image') !!}
</div>


<!-- Car Make Field -->
<div class="form-group col-sm-6">
    {!! Form::label('car_make', 'Car Make:') !!}
    {!! Form::text('car_make', null, ['class' => 'form-control']) !!}
</div>

<!-- Car Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('car_model', 'Car Model:') !!}
    {!! Form::text('car_model', null, ['class' => 'form-control']) !!}
</div>

<!-- Car Image Field -->
<div class="form-group col-sm-6">
    {!! Form::label('car_image', 'Car Image:') !!}
    {!! Form::file('car_images') !!}
</div>
<div class="clearfix"></div>

@if(\Request::route()->getName() == 'drivers.create')
<!-- Password Field -->
<div class="form-group col-sm-6">
    {!! Form::label('password', 'Password:') !!}
    {!! Form::password('password', ['class' => 'form-control']) !!}
</div>
@endif
<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('drivers.index') }}" class="btn btn-default">Cancel</a>
</div>
