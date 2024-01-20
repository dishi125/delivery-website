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
                   {!! Form::model($deliveryCompletion, ['route' => ['deliveryCompletions.update', $deliveryCompletion->id], 'method' => 'patch']) !!}

                        @include('delivery_completions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection