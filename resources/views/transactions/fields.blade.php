<!-- Payment Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_id', 'Payment Id:') !!}
    {!! Form::text('payment_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Payer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payer_id', 'Payer Id:') !!}
    {!! Form::text('payer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Amount Field -->
<div class="form-group col-sm-6">
    {!! Form::label('amount', 'Amount:') !!}
    {!! Form::text('amount', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Invoice Field -->
<div class="form-group col-sm-6">
    {!! Form::label('invoice', 'Invoice:') !!}
    {!! Form::text('invoice', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('transactions.index') }}" class="btn btn-default">Cancel</a>
</div>
