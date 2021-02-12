@extends('layouts.app')

@section('template_title')
    Follow up on issue
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">
<link href="{{ asset('assets/css/elements/search.css')}}" rel="stylesheet" type="text/css" />
@endsection

@section('content') 
<div class="col-lg-8 col-md-8 col-sm-9 filtered-list-search mx-auto">
<form class="form-inline my-2 my-lg-0 justify-content-center" action="{{ route('ticket.follow')}}" role="form" method="POST">
        {{ csrf_field() }}
        <div class="w-100">
            <input type="text" class="w-100 form-control product-search br-30" id="input-search" placeholder="Search using ticket key or email address" name="key" >
            <button class="btn btn-primary" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
        </div>
    </form>
</div>      
    @if (isset($tickets))
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="table-responsive mb-4">
                    <table id="zero-config" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Ref no:</th>
                                <th>Name</th>
                                <th>Subject</th>
                                <th>Description</th>
                                <th>Date reported</th>
                                <th>date attended</th>
                                <th>status</th>
                                <th>attended by</th>
                                <th class="no-content"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $item)
                            <tr>
                                <td>{{ $item->key }}</td>
                                <td>{{ $item->name}}</td>
                                <td>{{ $item->subject}}</td>
                                <td>{{ $item->description}}</td>
                                <td>{{ $item->created_at}}</td>
                                <td>{{ $item->updated_at}}</td>
                                <td>
                                    @switch($item->resolved_status)
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
                                <td>
                                    @if ($item->resolved_status === 0)
                                        {{ 'Not Yet' }}
                                    @else
                                        {{ $item->resolved_by }}
                                    @endif
                                </td>
                                <td></td>
                            </tr>
                            @endforeach
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('footer_scripts')
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
@endsection
