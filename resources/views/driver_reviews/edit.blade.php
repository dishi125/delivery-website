@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Driver Review
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($driverReview, ['route' => ['driverReviews.update', $driverReview->id], 'method' => 'patch']) !!}

                        @include('driver_reviews.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection