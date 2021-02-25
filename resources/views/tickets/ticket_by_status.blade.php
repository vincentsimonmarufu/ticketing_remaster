@extends('layouts.app')

@section('template_title')
    {{  $ticket_status_name }}  tickets
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
    <style>
        .users-head h4{
            font-size: 20px;
            font-weight: 600;
        }
        .users-head p{
            font-size: 13px;
            color: #919aa3;
        }
    </style>
@endsection

@section('content')

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="users-head">
        <h4>{{ $ticket_status_name }} Tickets Overview </h4>
        <p>Overview of tickets raised by users <span style="padding-right: 10px;" class="float-right">
            <a href="{{ url('/home')}}" style=" font-size: 13px;color:#919aa3;"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> / Home </a><a href="">/ {{ $ticket_status_name}}</a>
        </span></p>
    </div>
    <div class="widget-content widget-content-area br-6">
        <div class="table-responsive mb-4 ">
            <table id="zero-config" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>Ref no:</th>
                        <th>email</th>
                        <th>subject</th>
                        <th>description</th>
                        <th>date reported</th>
                        <th>date attended</th>
                        <th>status</th>
                        <th>attended by</th>
                        <th>ACTIONS </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)

                    <tr>
                        <td>
                            <span data-toggle="tooltip" data-title="Click to View">
                                <a href="{{ route('tickets.show', $ticket->id) }}" 
                                    data-toggle="modal" data-target="#ticketInfo" 
                                    data-name="{{ $ticket->name }}"
                                    data-contact="{{ $ticket->contactable }}"
                                    data-subject="{{ $ticket->subject }}"
                                    data-description="{{ $ticket->description }}"
                                    data-key="{{ $ticket->key}}" 
                                    data-status="{{ $ticket->resolved_status}}"
                                    data-rep="{{ $ticket->created_at}}"
                                    data-title="{{ $ticket->key }} ticket Overview" >{{ $ticket->key }}</a>
                            </span>
                        </td>
                        <td>{{ $ticket->email }}</td>
                        <td>{{ $ticket->subject }}</td>
                        <td>{{ $ticket->description }}</td>
                        <td>{{ $ticket->created_at }}</td>
                        <td>{{ $ticket->updated_at }}</td>
                        <td>
                            @switch($ticket->resolved_status)
                                    @case(0)
                                        <span class="badge outline-badge-danger shadow-none">Unattended</span>
                                        @break
                                    @case(1)
                                        <span class="badge outline-badge-warning shadow-none">Pending</span>
                                        @break
                                    @case(2)
                                        <span class="badge outline-badge-success shadow-none">Resolved</span>
                                        @break
                                    @case(3)
                                        <span class="badge outline-badge-danger shadow-none">Escalated</span>
                                        @break
                                    @case(4)
                                        <span class="badge outline-badge-primary shadow-none">In progress</span>
                                        @break
                                    @default
                                        
                                @endswitch
                        </td>
                        <td class="text-center">@if ($ticket->resolved_status === 0)
                            {{ 'Not Yet' }}
                            @else
                            {{ $ticket->resolved_by }}
                          @endif</td>
                        <td style="white-space: nowrap;">
                            <form class="d-inline" action="{{ route('tickets.attend', $ticket->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-primary" data-toggle="tooltip" title="Attend Issue" style="border: none;background:#fff">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-check"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><polyline points="17 11 19 13 23 9"></polyline></svg>
                                </button>
                            </form>

                            <form class="d-inline" action="{{ route('tickets.acknowledge', $ticket->id) }}" method="post">
                                @csrf
                                @method('PUT')
                                <button type="submit" data-toggle="tooltip" class="text-warning" title="Acknowledge" style="border: none;background: #fff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-anchor"><circle cx="12" cy="5" r="3"></circle><line x1="12" y1="22" x2="12" y2="8"></line><path d="M5 12H2a10 10 0 0 0 20 0h-3"></path></svg>
                                </button>
                            </form>

                            <a href="{{ route('tickets.edit', $ticket->id) }}" data-toggle="tooltip" title="Resolve" class=" d-inline text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                            </a>

                            <form class="d-inline" action="{{ route('tickets.escalate', $ticket->id) }}" method="POST" >
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-danger" data-toggle="tooltip" title="Escalate" style="border: none;background: #fff;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
                                </button>
                            </form>

                        </td>

                    </tr>

                    @endforeach
                </tbody>
                <tfoot>

                </tfoot>
            </table>
        </div>
    </div>
</div>


    @include('modals.modal-delete')
    @include('modals.modal-show-ticket')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.show-ticket-modal-script')
    <script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#zero-config').DataTable({
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
        });
    </script>
    @include('scripts.tooltips')
@endsection