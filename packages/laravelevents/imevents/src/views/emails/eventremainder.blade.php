@extends('layouts.app')
@section('title', '| Events')
@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel">
            <div class=panel-heading">
               <h4 class="panel-title" id="event_name">{{ $imevent->subject }}</h4>
            </div>
            <div class="panel-body">
                <div><span>Start Date:</span>{{ $imevent->start_date }}</div>
                <div><span>End Date:</span>{{ $imevent->end_date }}</div>
                <div><span>Status:</span>{{  $imevent->eventstatus}}</div>
                <hr>
                <div>{{ $imevent->description}}</div>
                <hr>
            </div>
        </div> <!-- /.col-lg-10 -->
    </div><!-- /.col-lg-10 -->
@endsection