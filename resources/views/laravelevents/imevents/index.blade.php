
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Timezones</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
        }
    </style>
</head>
<body>
<div class="col-lg-10 col-lg-offset-1">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Event Title</th>
                <th>Event Description</th>
                <th>Start Time </th>
                <th>End Time</th>
                <th>Operations</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($imevents as $imevent)
                <tr>

                    <td>{{ $imevent->title}}</td>
                    <td>{{ $imevent->description }}</td>
                    <td>{{ $imevent->start_time }}</td>
                    <td>{{ $imevent->end_time }}</td>
                    <td>{{ $imevent->user->all->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}

                    <td>
                        <a href="{{ route('/imevent/edit/', $imevent->id) }}" class="btn btn-info pull-left" style="margin-right: 3px;">Edit</a>

                        {!! Form::open(['method' => 'DELETE', 'route' => ['/imevent/delete/', $imevent->id] ]) !!}
                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}

                    </td>
                </tr>
            @endforeach
            </tbody>

        </table>
    </div>

    <a href="{{ route('users.create') }}" class="btn btn-success">Add User</a>

</div>
</body>
</html>
