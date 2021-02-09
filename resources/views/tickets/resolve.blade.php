@extends('layouts.app')

@section('template_title')

@endsection

@section('template_linked_css')

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">

@endsection

@section('content')

    <div class="col-xl-12 col-lg-12 col-sm-12">   
        <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="float-left"> {{ $ticket->key }}  Ticket Overview</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area" >
                    <form action="{{ route('tickets.update',$ticket->id) }}" method="post" role="form">
                        {{ method_field('patch') }}
                        
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="subject">Subject: </label>
                                    <input type="text" id="subject" class="form-control" value="{{ $ticket->subject }}" disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="category">Issue Category: </label>
                                    <select class="form-control" name="category">
                                        <option>Select Category</option>
                                        @if ($categories)
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="description">Problem Description: </label>
                                    <textarea id="description" cols="30" rows="2" disabled class="form-control">{{ $ticket->description }}</textarea>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="resolved_how">Explanation of how issue was resolved: </label>
                                    <textarea name="resolved_how" id="resolved_how" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="email">Issuer Email: </label>
                                    <input type="text" name="email" id="name" class="form-control" value="{{ $ticket->email }}" disabled>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="resolved_status">Ticket Status: </label>
                                    <input type="text" name="resolved_status" id="resolved_status" class="form-control" 
                                    value="
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
                                    " 
                                    disabled>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="col-xl-6 col-md-6">
                                <div class="form-group mb-4">
                                    <label for="date_reported">Date Reported: </label>
                                    <input type="text" id="date_reported" class="form-control" value="{{ $ticket->created_at }}" disabled>
                                </div>
                            </div>

                            @if($ticket->resolved_status === 1 )

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="acknowledged">Acknowledged by: </label>
                                        <input type="text" id="acknowledged" class="form-control" value="{{ $ticket->resolved_by }}" disabled>
                                    </div>
                                </div>

                            @elseif($ticket->resolved_status === 3 )

                                <div class="col-xl-6 col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="escalated">Escalated by: </label>
                                        <input type="text" id="escalated" class="form-control" value="{{ $ticket->resolved_by }}" disabled>
                                    </div>
                                </div>

                            @else

                            @endif
                            
                        </div>
                        
                        <button class="btn btn-primary btn-rounded btn-md">  Submit Ticket  </button>
                        {{ @csrf_field() }}
                    </form>
                </div>
            </div>
        </div>        
    </div>


    @include('modals.modal-save')
    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @include('scripts.save-modal-script')
  @include('scripts.check-changed')
  <script src="{{ asset('assets/js/scrollspyNav.js')}}"></script>
  <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
  <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
  <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>

@endsection
