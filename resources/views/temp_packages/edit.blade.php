@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Temp Packages
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($tempPackages, ['route' => ['tempPackages.update', $tempPackages->id], 'method' => 'patch']) !!}

                        @include('temp_packages.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection