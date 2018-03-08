@extends('layouts.app')

@section('title', '| Add User')

@section('content')

    <div class='col-lg-4 col-lg-offset-4'>

        <h1><i class='fa fa-user-plus'></i> Add Event</h1>
        <hr>

        {{-- @include ('errors.list') --}}

        {{ Form::open(array('url' => 'calendar/event/update/'.$imevent->id,'id'=>'event-form')) }}

        <div class="form-group">
            {{ Form::label('userslist', 'Invitees') }}
            {{ Form::select('userslist[]', $users, $oldusers, ['class'=>'form-control','multiple','id'=>'js-search-multi']) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('userslist'))
                <span class="error text-danger">{{ $errors->first('end_date') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('type', 'Type') }} <span class="text-danger">*</span>
            <br/>
            {{ Form::label('type', 'Meeting') }}
            {{ Form::radio('type', '1' , ($imevent->type == 1)?true:false) }}
            {{ Form::label('type', 'Event') }}
            {{ Form::radio('type', '2' ,($imevent->type == 2)?true:false) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('type'))
                <span class="error text-danger">{{ $errors->first('end_date') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('subject', 'Event Subject') }} <span class="text-danger">*</span>
            {{ Form::text('subject', $imevent->subject, array('class' => 'form-control')) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('subject'))
                <span class="error text-danger">{{ $errors->first('end_date') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('description', 'Event Description') }}
            {{ Form::textarea('description',  $imevent->description, array('class' => 'form-control')) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('description'))
                <span class="error text-danger">{{ $errors->first('subject') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('start_date', 'Event Start Date') }} <span class="text-danger">*</span>
            <div class='input-group date' id='startdate'>
                {{ Form::text('start_date', $imevent->start_date, array('class' => 'form-control')) }}
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
            {{ Form::label('end_date', 'Event End Date') }} <span class="text-danger">*</span>
            <div class='input-group date' id='enddate'>
                {{ Form::text('end_date', $imevent->end_date, array('class' => 'form-control')) }}
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
            {{ Form::label('location', 'Event Location') }} <span class="text-danger">*</span>
            {{ Form::text('location', $imevent->location, array('class' => 'form-control')) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('location'))
                <span class="error text-danger">{{ $errors->first('location') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('billable', 'Billable') }}
            {{ Form::checkbox('billable', 1, ($imevent->billable == '1')?true:false) }}
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

            {{ Form::label('remainder_interval', 'Remainder Every') }}
            {{ Form::select('remainder_interval', $intervals, $imevent->remainder->interval, ['class'=>'form-control']) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('remainder_interva'))
                <span class="error text-danger">{{ $errors->first('remainder_interva') }}</span>
            @endif
        </div>
        <div class="form-group">
            @php
                $statuses=[
                            ""=>"-- Select --",
                            "1"=>"Scheduled",
                            "2"=>"Cancelled",
                            "3"=>"Expired",
                        ];
            @endphp
            {{ Form::label('status', 'Event Status') }}
            {{ Form::select('status', $statuses, $imevent->status, ['class'=>'form-control']) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('status'))
                <span class="error text-danger">{{ $errors->first('status') }}</span>
            @endif
        </div>

        <div class="form-group">
            {{ Form::label('reason', 'Reason(if Cancelled)') }}
            {{ Form::textarea('reason', '', array('class' => 'form-control')) }}
            <span class="help-block with-errors"></span>
            @if ($errors->has('reason'))
                <span class="error text-danger">{{ $errors->first('reason') }}</span>
            @endif
        </div>

        {{ Form::submit('Update', array('class' => 'btn btn-primary')) }}

        {{ Form::close() }}

    </div>

@endsection
