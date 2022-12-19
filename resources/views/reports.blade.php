@extends('layouts.admin')

@section('content')

<div class="card mb-3">
    <div class="card-header">
        Events Report
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Number of Active Events</th>
                        <th>Number of Attendants</th>
                        <th>Number of Events Today</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $active_events }}</td>
                        <td>{{ $attendants }}</td>
                        <td>{{ $today_events }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
