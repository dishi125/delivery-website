@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Pending Delivery
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'pendingDeliveries.store']) !!}

                        @include('pending_deliveries.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
