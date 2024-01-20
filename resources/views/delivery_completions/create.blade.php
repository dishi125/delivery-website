@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Delivery Completion
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'deliveryCompletions.store']) !!}

                        @include('delivery_completions.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
