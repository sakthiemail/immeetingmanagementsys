@extends('layouts.app')

@section('title', '| {{ $imevent->subject}}')

@section('content')
<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> {{ $imevent->subject}}</h1>
    <hr>
 <div>
   {{ $imevent->description }}
 </div>
  <hr>
 <div class="form-group">
     {{ Form::label('message', 'Message') }}
     {{ Form::textarea('message', '', array('class' => 'form-control')) }}
 </div>
  @php
  if(Auth::user()->id !=1 ){
  @endphp
  {{ Form::open(array('url' => 'calendar/event/'.$imevent->id.'/accept-status')) }}
   <div class="form-group">
       {{ Form::label('accept_status_label', 'Accepted Or Declained') }}
       <br/>
       {{ Form::label('accept_status', 'Accept') }}
       {{ Form::radio('accept_status', '1' , true) }}
       {{ Form::label('accept_status', 'Declain') }}
       {{ Form::radio('accept_status', '2' , false) }}
   </div>
       {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
   @php
    }else{
   @endphp
   <div class="form-group">
       {{ Form::open(array('url' => 'calendar/event/'.$imevent->id.'/cancel')) }}
       {{ Form::submit('Cancel this event', array('class' => 'btn btn-primary')) }}
   </div>
   @php
   }
   @endphp

   {{ Form::close() }}
</div>
@endsection
