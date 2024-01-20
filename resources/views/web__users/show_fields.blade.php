<!-- Fname Field -->
<div class="form-group">
    {!! Form::label('fname', 'Fname:') !!}
    <p>{{ ucfirst($webUser->fname) }}</p>
</div>

<!-- Lname Field -->
<div class="form-group">
    {!! Form::label('lname', 'Lname:') !!}
    <p>{{ ucfirst($webUser->lname) }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $webUser->email }}</p>
</div>

<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', 'Mobile:') !!}
    <p>{{ $webUser->mobile }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $webUser->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $webUser->updated_at }}</p>
</div>

