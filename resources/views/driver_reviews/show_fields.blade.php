<!-- Driver Id Field -->
<div class="form-group">
    {!! Form::label('driver_id', 'Driver Id:') !!}
    <p>{{ $driverReview->driver_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $driverReview->user_id }}</p>
</div>

<!-- Rate Field -->
<div class="form-group">
    {!! Form::label('rate', 'Rate:') !!}
    <p>{{ $driverReview->rate }}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    <p>{{ $driverReview->comment }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $driverReview->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $driverReview->updated_at }}</p>
</div>

