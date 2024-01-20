@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Car Make
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($carMake, ['route' => ['carMakes.update', $carMake->id], 'method' => 'patch']) !!}

                        @include('car_makes.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection