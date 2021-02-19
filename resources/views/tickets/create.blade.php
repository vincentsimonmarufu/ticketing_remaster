@extends('layouts.app')

@section('template_title')
    Issue Ticket
@endsection

@section('template_linked_css')

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

    <style>
        .form-group label, label {
            color: #3b3f5c;
        }
        .form-control{
            border-radius: 1px;
        }
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

    <div class="col-xl-9 col-lg-9 col-sm-12">    
        <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
            <div class="users-head">
                <h4>Raise an issue </h4>
                <p>Fill in the fields below to create a ticket </p>
            </div>
            <div class="statbox widget box box-shadow">
                <div class="widget-content widget-content-area" style="padding: 20px;">
                    <form action="{{ route('tickets.store') }}" method="post" role="form">
                        @csrf
                        <div class="form-group mb-4">
                            <label for="name">Full Name: </label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="e.g Vincent Marufu">
                            @error('name')
                                <span class="help-block">
                                <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="email">Email Address: </label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="e.g vmarufu@whelson.co.zw">
                            @error('email')
                            <span class="help-block">   
                            <strong> {{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="contactable">Contactable On</label>
                            <input type="text" name="contactable" id="contactable" class="form-control @error('contactable') is-invalid @enderror" placeholder="id: 12345 pass: 434ndc">
                            @error('contactable')
                                <span class="help-block">
                                <strong> {{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="subject">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" placeholder="e.g Emails issue">
                            @error('subject')
                            <span class="help-block">
                                <strong>
                                    {{  $message }}
                                </strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="description">Give a detailed explanation of the problem</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description" id="description" cols="30" rows="3" placeholder="i'nm not receiving emails in real time"></textarea>
                            @error('description')
                                <span class="help-block">
                                <strong>{{ $message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-primary btn-rounded btn-md">  Submit Ticket  </button>
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
@endsection
