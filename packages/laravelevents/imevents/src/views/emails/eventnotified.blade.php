<!DOCTYPE>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap-theme.min.css') }}"/>
</head>
<body>
    <div class="col-lg-10 col-lg-offset-1">
        <div class="panel">
            <div class=panel-heading">
                <h4 class="panel-title" id="event_name">{{ $imevent->subject }}</h4>
            </div>
            <div class="panel-body">
                <div><span>Start Date:</span>{{ $imevent->start_date }}</div>
                <div><span>End Date:</span>{{ $imevent->end_date }}</div>
                <div><span>Status:</span>{{  $imevent->eventstatus}}</div>
                <p><a  href="{{url('/calendar/event/'.$imevent->id.'/view')}}" class="btn-primary">View the Event</a></p>
            </div>
        </div> <!-- /.col-lg-10 -->
    </div><!-- /.col-lg-10 -->
</body>
</html>