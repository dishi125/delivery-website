<!-- Payment Id Field -->
<div class="form-group">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    <p>{{ $transaction->payment_id }}</p>
</div>

<!-- Payer Id Field -->
<div class="form-group">
    {!! Form::label('payer_id', 'Payer Id:') !!}
    <p>{{ $transaction->payer_id }}</p>
</div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <p>{{ $transaction->amount }}</p>
</div>

<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', 'Description:') !!}
    <p>{{ $transaction->description }}</p>
</div>

<!-- Invoice Field -->
<div class="form-group">
    {!! Form::label('invoice', 'Invoice:') !!}
    <p>{{ $transaction->invoice }}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{{ $transaction->status }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $transaction->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $transaction->updated_at }}</p>
</div>

