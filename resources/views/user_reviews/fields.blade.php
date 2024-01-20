<!-- Driver Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('driver_id', 'Driver Id:') !!}
    {!! Form::text('driver_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', 'User Id:') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- To User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_user_id', 'To User Id:') !!}
    {!! Form::text('to_user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', 'Rate:') !!}
    {!! Form::text('rate', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('userReviews.index') }}" class="btn btn-default">Cancel</a>
</div>
