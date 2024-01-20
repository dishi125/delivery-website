@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Delivery  Addresses
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($deliveryAddresses, ['route' => ['deliveryAddresses.update', $deliveryAddresses->id], 'method' => 'patch']) !!}

                        @include('delivery_addresses.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
