@extends('layouts.app')

@section('template_title')
    Reports Overview
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">
    <style>
        .report-heading{
            margin-left: 10px;
            padding: 0px;
        }
    </style>
@endsection

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">


        <div class="widget-content widget-content-area br-6 mt-3">

            <form action="{{ route('reports.selectreport') }}" method="POST" role="form" class="needs-validation">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label for="">Get Status for</label>
                        <div class="input-group">
                            <select name="status" id="" class="form-control" >
                                @if ($tickets)
                                    @foreach($tickets as $ticket)
                                        @switch($ticket->resolved_status)
                                            @case(0)
                                                <option value="{{ $ticket->resolved_status }}">Unattended</option>
                                                @break
                                            @case(1)
                                                <option value="{{ $ticket->resolved_status }}">Pending</option>
                                                @break
                                            @case(2)
                                                <option value="{{ $ticket->resolved_status }}">Resolved</option>
                                                @break
                                            @case(3)
                                                <option value="{{ $ticket->resolved_status }}">Escalated</option>
                                                @break
                                            @default
                                                
                                        @endswitch
                                        
                                    @endforeach
                                @endif   
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date</label>
                                    <input type="date" class="form-control" name="start_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Date</label>
                                    <input type="date" class="form-control" name="end_date">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary text-center btn-lg btn-rounded">Get Report</button>
                        </div>
                    </div>
                </div>
            </form>

            <div class="table-responsive mb-4">

                @if (isset($rep))
                                   
                <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                    <thead>
                    <tr>
                        <th>key</th>
                        <th>name</th>
                        <th>email</th>
                        <th>issue subject</th>
                        <th>status</th>
                        <th>date reported</th>
                        <th>date attended</th>
                        <th>attended by</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($rep as $report)
                        <tr>
                            <td>{{ $report->key }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ $report->email }}</td>
                            <td>{{ $report->subject }}</td>
                            <td>
                                @switch($report->resolved_status)
                                    @case(0)
                                        {{ 'Unattended' }}
                                        @break
                                    @case(1)
                                        {{ 'Pending' }}
                                        @break
                                    @case(2)
                                        {{ 'Resolved' }}
                                        @break
                                    @case(3)
                                        {{ 'Escalated' }}
                                        @break
                                    @default
                                        
                                @endswitch
                            </td>
                            <td>{{ $report->created_at }}</td>
                            <td>{{ $report->updated_at }}</td>
                            <td>{{ $report->resolved_by }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                @endif
            </div>
        </div>
    </div>
@endsection

@section('footer_scripts')

    <script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>

    <script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js')}}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js')}}"></script>
    <script>
        $('#html5-extension').DataTable( {
            dom: '<"row"<"col-md-12"<"row"<"col-md-6"B><"col-md-6"f> > ><"col-md-12"rt> <"col-md-12"<"row"<"col-md-5"i><"col-md-7"p>>> >',
            buttons: {
                buttons: [
                    { extend: 'copy', className: 'btn' },
                    { extend: 'csv', className: 'btn' },
                    { extend: 'excel', className: 'btn' },
                    { extend: 'print', className: 'btn' }
                ]
            },
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        } );
    </script>
@endsection