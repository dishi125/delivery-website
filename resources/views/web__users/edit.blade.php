@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Web  User
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($webUser, ['route' => ['webUsers.update', $webUser->id], 'method' => 'patch', 'files' => true]) !!}

                        @include('web__users.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
