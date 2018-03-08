@extends('layouts.app')

@section('title', '| Create New Pack')

@section('content')
    <div class="col-lg-10 col-lg-offset-1">
        <div class="container">
            <p class="text-right"><a href="{{ url('calendar/events') }}">List View</a></p>
        </div>
    </div>
    <div class="col-lg-10 col-lg-offset-1">
    <div class="panel panel-primary">

        <div class="panel-heading">
           Calender View
        </div>

        <div class="panel-body" >

            {!! $calendar->calendar() !!}

            {!! $calendar->script() !!}

        </div>

    </div>
    </div>
    <div class="modal fade" id ="calendarPopup" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="event_name">Event Details</h4>
                </div>
                <div class="modal-body">
                    <p id="task_description">One fine body</p>
                    <div><span>Start Date:</span><span id="event_start_date"></span></div>
                    <div><span>End Date:</span><span id="event_end_date"></span></div>
                    <div><span>Status:</span><span id="event_status"></span></div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- ============= info popup ============= -->

</div>
@endsection