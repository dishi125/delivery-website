@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Car Model
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($carModel, ['route' => ['carModels.update', $carModel->id], 'method' => 'patch']) !!}

                        @include('car_models.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection