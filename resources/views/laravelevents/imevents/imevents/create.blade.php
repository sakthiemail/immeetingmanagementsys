@extends('layouts.app')

@section('title', '| Add User')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Add Event</h1>
    <hr>

    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'calendar/event/store')) }}

    <div class="form-group">
        {{ Form::label('userslist', 'Invitees') }}
        {{ Form::select('userslist[]', $users, null, ['class'=>'form-control','multiple']) }}
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}
        <br/>
        {{ Form::label('type', 'Meeting') }}
        {{ Form::radio('type', '1' , true) }}
        {{ Form::label('type', 'Event') }}
        {{ Form::radio('type', '2' , false) }}
    </div>

    <div class="form-group">
        {{ Form::label('subject', 'Event Subject') }}
        {{ Form::text('subject', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Event Description') }}
        {{ Form::textarea('description', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('start_date', 'Event Start Date') }}
        <div class='input-group date' id='datetimepicker1'>
            {{ Form::text('start_date', '', array('class' => 'form-control')) }}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('end_date', 'Event End Date') }}
        <div class='input-group date' id='datetimepicker2'>
        {{ Form::text('end_date', '', array('class' => 'form-control')) }}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('location', 'Event Location') }}
        {{ Form::text('location', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('billable', 'Billable') }}
        {{ Form::checkbox('billable', 1,'') }}
        {{ Form::label('yes', 'Yes') }}
    </div>
    <div class="form-group">
        @php
        $intervals=[
                    ""=>"-- Select --",
                    "5 Mins"=>"5 Mins",
                    "10 Mins"=>"10 Mins",
                    "15 Mins"=>"15 Mins",
                    "30 Mins"=>"30 Mins",
                    "1 Hour"=>"1 Hour",
                    "2 Hours"=>"2 Hours",
                    "3 Hours"=>"3 Hours",
                    "4 Hours"=>"4 Hours",
                    "5 Hours"=>"5 Hours",
                    "6 Hours"=>"6 Hours",
                    "12 Hours"=>"12 Hours",
                    "18 Hours"=>"18 Hours",
                    "1 Day"=>"1 Day",
                    "2 Days"=>"2 Days",
                    "3 Days"=>"3 Days",
                    "4 Days"=>"4 Days",
                    "5 Days"=>"5 Days",
                    "6 Days"=>"6 Days",
                ];
        @endphp
        {{ Form::label('remainder_interval', 'Remainder Every') }}
        {{ Form::select('remainder_interval', $intervals, null, ['class'=>'form-control']) }}
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection
