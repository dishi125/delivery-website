@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Assign Driver
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($assignDriver, ['route' => ['assignDrivers.update', $assignDriver->id], 'method' => 'patch']) !!}

                        @include('assign_drivers.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection