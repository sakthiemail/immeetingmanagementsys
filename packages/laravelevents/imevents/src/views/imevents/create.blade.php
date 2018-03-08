@extends('layouts.app')

@section('title', '| Add User')

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Add Event</h1>
    <hr>

    {{-- @include ('errors.list') --}}

    {{ Form::open(array('url' => 'calendar/event/store', 'id'=>'event-form')) }}

    <div class="form-group">
        {{ Form::label('userslist', 'Invitees') }}<span class="text-danger">*</span>
        {{ Form::select('userslist[]', $users, null, [ 'id'=>'js-search-multi','class'=>'form-control','multiple']) }}
        <span class="help-block with-errors"></span>
        @if ($errors->has('userslist'))
            <span class="error text-danger">{{ $errors->first('userslist') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('type', 'Type') }}<span class="text-danger">*</span>
        <br/>
        {{ Form::label('type', 'Meeting') }}
        {{ Form::radio('type', '1' , true) }}
        {{ Form::label('type', 'Event') }}
        {{ Form::radio('type', '2' , false) }}
        <span class="help-block with-errors"></span>
        @if ($errors->has('type'))
            <span class="error text-danger">{{ $errors->first('type') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('subject', 'Event Subject') }}<span class="text-danger">*</span>
        {{ Form::text('subject', '', array('class' => 'form-control')) }}
        <span class="help-block with-errors"></span>
        @if ($errors->has('subject'))
            <span class="error text-danger">{{ $errors->first('subject') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('description', 'Event Description') }}<span class="text-danger">*</span>
        {{ Form::textarea('description', '', array('class' => 'form-control')) }}
        <span class="help-block with-errors"></span>
        @if ($errors->has('description'))
            <span class="error text-danger">{{ $errors->first('description') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('start_date', 'Event Start Date') }}<span class="text-danger">*</span>
        <div class='input-group date' id='startdate'>
            {{ Form::text('start_date', '', array('class' => 'form-control')) }}
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </div>
        <span class="help-block with-errors"></span>
        @if ($errors->has('start_date'))
            <span class="error text-danger">{{ $errors->first('start_date') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('end_date', 'Event End Date') }}<span class="text-danger">*</span>
        <div class='input-group date' id='enddate'>
        {{ Form::text('end_date', '', array('class' => 'form-control')) }}
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
        </div>
        <span class="help-block with-errors"></span>
        @if ($errors->has('end_date'))
            <span class="error text-danger">{{ $errors->first('end_date') }}</span>
        @endif
    </div>

    <div class="form-group">
        {{ Form::label('location', 'Event Location') }}
        {{ Form::text('location', '', array('class' => 'form-control')) }}
        <span class="help-block with-errors"></span>
        @if ($errors->has('end_date'))
            <span class="error text-danger">{{ $errors->first('location') }}</span>
        @endif
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
                ];
        @endphp
        {{ Form::label('remainder_interval', 'Send Remainder Before') }}
        {{ Form::select('remainder_interval', $intervals, null, ['class'=>'form-control']) }}
    </div>

    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div>

@endsection
