@extends('layouts.admin')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="app-main__inner">
                    <div class="app-page-title app-page-title-simple">
                        <div class="page-title-wrapper">
                            <div class="page-title-heading">
                                <div>
                                    <div class="page-title-head center-elem">
                                        <span class="d-inline-block pr-2">
                                            <i class="lnr-apartment opacity-6"></i>
                                        </span>
                                        <span class="d-inline-block">Magniva Events</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

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
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
@parent

@endsection

