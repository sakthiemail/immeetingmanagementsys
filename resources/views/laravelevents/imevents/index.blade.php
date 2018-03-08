@extends('layouts.app')
@section('title', '| Events')
@section('content')
<div class="col-lg-10 col-lg-offset-1">
    <div class="container">
          <p class="text-right"><a href="{{ url('calendar/events/calendar-view') }}">Calendar View</a></p>
    </div>
</div>
<div class="col-lg-10 col-lg-offset-1">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Subject</th>
                <th>Description</th>
                <th>Start Date </th>
                <th>End Date</th>
                <th>Status</th>
                <th>Operations</th>
            </tr>
            </thead>

            <tbody>

            @foreach ($imevents as $imevent)
                <tr>
                    <td>{{ $imevent->subject}}</td>
                    <td>{{ $imevent->description }}</td>
                    <td>{{ $imevent->start_date }}</td>
                    <td>{{ $imevent->end_date }}</td>
                    <td>{{ $imevent->eventstatus }}</td>
                    <td>
                        {!! Form::open(['url'=>'calendar/event/delete/'.$imevent->id,'method' => 'DELETE']) !!}
                        <a href="{{ url('calendar/event/'.$imevent->id) }}" class="btn btn-warning text-left" style="margin-right: 3px;">
                            <span class="glyphicon glyphicon-list-alt"></span>
                        </a>
                        <a href="{{ url('calendar/event/edit/'.$imevent->id) }}" class="btn btn-info" style="margin-right: 3px;">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>

                        {{ Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm'] )  }}

                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ url('calendar/event/add') }}" class="btn btn-success">Add Event</a>

</div>

@endsection
