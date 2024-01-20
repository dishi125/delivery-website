<!-- Driver Id Field -->
<div class="form-group">
    {!! Form::label('driver_id', 'Driver Id:') !!}
    <p>{{ $userReview->driver_id }}</p>
</div>

<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{{ $userReview->user_id }}</p>
</div>

<!-- To User Id Field -->
<div class="form-group">
    {!! Form::label('to_user_id', 'To User Id:') !!}
    <p>{{ $userReview->to_user_id }}</p>
</div>

<!-- Rate Field -->
<div class="form-group">
    {!! Form::label('rate', 'Rate:') !!}
    <p>{{ $userReview->rate }}</p>
</div>

<!-- Comment Field -->
<div class="form-group">
    {!! Form::label('comment', 'Comment:') !!}
    <p>{{ $userReview->comment }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $userReview->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $userReview->updated_at }}</p>
</div>

