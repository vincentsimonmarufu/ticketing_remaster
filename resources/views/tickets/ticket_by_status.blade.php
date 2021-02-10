@extends('layouts.app')

@section('template_title')
    {{  $ticket_status_name }}  tickets
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
@endsection

@section('content')

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
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
                        <td>{{ $ticket->resolved_by }}</td>
                        <td style="white-space: nowrap;">
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