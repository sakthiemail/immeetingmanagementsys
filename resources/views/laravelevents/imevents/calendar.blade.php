@extends('layouts.app')

@section('title', '| Create New Pack')

@section('content')
<div class="container">

    <div class="panel panel-primary">

        <div class="panel-heading">

            MY Calender

        </div>

        <div class="panel-body" >

            {!! $calendar->calendar() !!}

            {!! $calendar->script() !!}

        </div>

    </div>

</div>
@endsection