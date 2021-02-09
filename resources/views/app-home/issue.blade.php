@extends('layouts.app-home')   

@section('template_title')
    Issue Page
@endsection

@section('content')

<section id="is-content">
    <div class="is-head">
        <h3>Issue Ticket</h3>
    </div>
    <div class="">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('tickets.store') }}" method="POST" role="form">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="text" class="is-control @error('name') is-invalid @enderror" name="name" placeholder="Full Name">
                            @error('name')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <input type="text" class="is-control @error('email') is-invalid @enderror" name="email" placeholder="Email Address">
                            @error('email')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group mb-4">                  
                            <input type="text" class="is-control @error('contactable') is-invalid @enderror" name="contactable" placeholder="Contactable On">
                            @error('contactable')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group mb-4"> 
                            <input type="text" class="is-control @error('subject') is-invalid @enderror" name="subject" placeholder="Subject of the issue">
                            @error('subject')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group mb-4">                                
                            <textarea name="description" id="" cols="30" rows="4" class="@error('description') is-invalid @enderror" placeholder="Give a detailed explanation of the problem "></textarea>
                            @error('description')
                                <span class="help-block">
                                    <strong>{{ $message }}</strong>
                                </span> 
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="button button-submit">Submit Ticket</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
    
@endsection