@extends('layouts.app-home')

@section('content')
    
<section id="ticket-container" class="offset">
  <div class="container">
    <div class="row justify-content-center ticket-content">
      <div class="col-md-10 col-sm-12 col-lg-10 ticket-content-body">

        <div class="is-head">
          <div class="ticket-send">
              @if ($message = Session::get('success'))
                  <div class="alert alert-success alert-dismissible fade show issue-sucess" role="alert" >
                      <strong>Success !</strong> {{ $message }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
          </div>
          
        </div>

        <div class="issue-heading">
          <h2>create a ticket</h2>
        </div>

        <div class="ticket-body">
          <form action="{{ route('tickets.store')}}" method="POST" role="form">
            @csrf
            <div class="form-group">
              <input type="text" name="name" class="issue-control @error('name') is-invalid @enderror" id="" placeholder="Full Name">
              @error('name')
                <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <input type="email" name="email" class="issue-control @error('email') is-invalid @enderror" id="" placeholder="Email Address">
              @error('email')
                <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" name="contactable" class="issue-control @error('contactable') is-invalid @enderror" id="" placeholder="Contactable on">
              @error('contactable')
                <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <input type="text" name="subject" class="issue-control @error('subject') is-invalid @enderror" id="" placeholder="Subject of the issue">
              @error('subject')
                <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <textarea name="description" class="issue-control @error('description') is-invalid @enderror" id="" cols="30" rows="5" placeholder="Give a detailded description of the problem"></textarea>
              @error('description')
                <span class="help-block">
                  <strong>{{ $message }}</strong>
                </span>
              @enderror
            </div>
            <div class="form-group">
              <button class="create-ticket-control" type="submit">create ticket</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>

</section>

@endsection