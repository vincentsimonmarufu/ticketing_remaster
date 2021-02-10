@extends('layouts.app')

@section('template_title')
   {{ $category_name }}
@endsection

@section('template_linked_css')
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">
@endsection

@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="widget-content widget-content-area br-6">
        <div class="table-responsive mb-4 mt-4">
            <table id="html5-extension" class="table table-hover non-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ref no:</th>
                        <th>email</th>
                        <th>subject</th>
                        <th>date reported</th>
                        <th>date attended</th>
                        <th>attended by</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($tickets_by as $item)
                    <tr>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->key }}</td>
                        <td>{{ $item->key }}</td>
                    </tr>
                   @endforeach
                </tbody>
            </table>
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
