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
                   {!! Form::model($pendingDelivery, ['route' => ['pendingDeliveries.update', $pendingDelivery->id], 'method' => 'patch']) !!}

                        @include('pending_deliveries.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection