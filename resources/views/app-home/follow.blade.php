@extends('layouts.app-home')   

@section('template_title')
    Follow Page
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('app-home/css/datatables.css')}}">
    <link rel="stylesheet" href="{{ asset('app-home/css/dt-global_style.css')}}">
@endsection

@section('content')
    <section id="is-content">
        <div class="is-head">
            <h3>Follow Up On issue</h3>
            
        </div>
        
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <form action="{{ route('tick.follow')}}" method="POST" role="form">
                            {{ csrf_field() }}
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <input type="text" name="key" class="is-control" name="name" placeholder="Full Name">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="button"><i class="fa fa-search" style="font-size: 18px;"></i></button>
                                </div>
                            </div>   
                        </form>

                        @if (isset($tickets))
                        <div class="table-responsive mb-4">
                            <table id="zero-config" class="table table-hover" style="width: 100%;">
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
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                                
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <br><br><br><br><br>
@endsection

@section('footer_scripts')
<script src="{{ asset('app-home/js/datatables.js')}}"></script>
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