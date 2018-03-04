@extends('layouts.app')

@section('title', '| {{ $imevent->subject}}')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> {{ $imevent->subject}}</h1>
    <hr>
 <div>
   {{ $imevent->description }}
 </div>
   {{ Form::open(array('url' => 'calendar/event/store')) }}

   <div class="form-group">
       {{ Form::label('type', 'Type') }}
       <br/>
       {{ Form::label('type', 'Meeting') }}
       {{ Form::radio('type', '1' , true) }}
       {{ Form::label('type', 'Event') }}
       {{ Form::radio('type', '2' , false) }}
   </div>

   <div class="form-group">
       {{ Form::label('message', 'Event Description') }}
       {{ Form::textarea('message', '', array('class' => 'form-control')) }}
   </div>

   {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

   {{ Form::close() }}
</div>
@endsection
