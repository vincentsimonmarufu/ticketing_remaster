@extends('layouts.app-home')

@section('template_title')
    Follow Up on Issue
@endsection

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('visitor/css/datatables.css')}}">
    <link rel="stylesheet" href="{{ asset('visitor/css/dt-global_style.css')}}">
@endsection

@section('content')
    
<section id="follow" class="offset">
    <div class="follow-main">
      <div class="follow-header">
        <h2>follow up on issue</h2>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-md-10">
              <form action="{{ url('/follow')}}" method="POST" role="form">
                {{ csrf_field() }}
                <div class="input-group mb-3">
                  <input type="text" name="key" class="form-control follow-control" placeholder="Enter ticket reference number or Email Address " aria-label="Recipient's username" aria-describedby="button-addon2">
                  <div class="input-group-append">
                    <button class="button follow-btn" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="follow-content">

        @if(isset($tickets))
        <div class="table-responsive mb-4 mt-4">
          <table id="zero-config" class="table table-hover" style="width:100%">
              <thead>
                  <tr>
                      <th>Reference No:</th>
                      <th>Issue subject</th>
                      <th>issue details</th>
                      <th>date reported</th>
                      <th>Status</th>
                      <th>Attended by</th>
                  </tr>
              </thead>
              <tbody>
                @foreach ($tickets as $ticket)
                  <tr>
                      <td>{{$ticket->key}}</td>
                      <td>{{$ticket->subject}}</td>
                      <td>{{$ticket->description}}</td>
                      <td>{{$ticket->created_at}}</td>
                      <td>@switch($ticket->resolved_status)
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
                        
                      @endswitch</td>
                      <td>@if ($ticket->resolved_status === 0)
                        {{ 'Not Yet' }}
                        @else
                        {{ $ticket->resolved_by }}
                      @endif</td>
                  </tr>  
                @endforeach                                  
              </tbody>
              
          </table>
        </div>
        @endif
        
      </div>
    </div>
  </section>
  <br><br><br><br><br>

  @endsection

@section('footer_scripts')
  <script src="{{ asset('visitor/js/datatables.js')}}"></script>
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