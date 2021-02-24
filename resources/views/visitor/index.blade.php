@extends('layouts.app-home')

@section('content')
    
<section class="offset"> 
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="6000">
      <ol class="carousel-indicators">
        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="1" class="" ></li>
        <li data-target="#carouselExampleIndicators" data-slide-to="2" class=""></li>
      </ol>
    <div class="carousel-inner" role="listbox">
        <!-- slide 1 -->
      <div  class="carousel-item active blur"  style="background-image: url(visitor/images/DSC_0181.JPG)"  >
        <div class="carousel-caption text-center">
          <h3 class="animate__animated animate__bounceInRight" style="animation-delay: 1s;">Welcome To Ticketing System</h3>
          <p class="animate__animated animate__bounceInLeft" style="animation-delay: 2s;">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <div class="carousel-button">
            <a href="{{ url('/issue')}}" class="slider-btn slider-1 animate__animated animate__fadeInUp" style="animation-delay: 3s;">raise an issue</a>
            <a href="{{ url('/follow')}}" class="slider-btn slider-2 animate__animated animate__fadeInUp" style="animation-delay: 3s;">follow up issue</a>
          </div>
        </div>
      </div>
      <!-- slide 2 -->
      <div class="carousel-item" style="background-image: url(visitor/images/DSC_0180.JPG)" >
        <div class="carousel-caption text-center">
          
          <h3>Raise your issue</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <div class="carousel-button">
            <a href="{{ url('/issue')}}" class="slider-btn slider-1 animate__animated animate__fadeInUp" style="animation-delay: 1s;">raise an issue</a>
          </div>
        </div>
      </div>

      <!-- slide 3 -->
      <div  class="carousel-item" style="background-image: url(visitor/images/DSC_0180.JPG)"  >
        <div class="carousel-caption text-center">
          <h3>Follow up on issue</h3>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
          <div class="carousel-button">
            <a href="{{ url('/follow')}}" class="slider-btn slider-2 animate__animated animate__fadeInUp" style="animation-delay: 1s;">follow up issue</a>
          </div>
        </div>
      </div>
      </div>
    
    </div>
  </section>

  <section id="team" class="offset">
    <div class="container">
      <div class="header-section">
        <h2>meet the team</h2>
        <div class="header-underline"></div>
      </div>
      <div class="row team-body">
        <div class="col-md-4 col-sm-12 team-body-content">
          <img src="{{ asset('visitor/images/team/team1.png')}}" alt="user image" class="img-fluid">
          <div class="team-content">
            <h2>denis ziki</h2>
            <h3>it manager</h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 team-body-content">
          <img src="{{ asset('visitor/images/team/team2.png')}}" alt="user image" class="img-fluid">
          <div class="team-content">
            <h2>tadiwanashe dauya</h2>
            <h3>systems applications administator</h3>
          </div>
        </div>
        <div class="col-md-4 col-sm-12 team-body-content">
          <img src="{{ asset('visitor/images/team/team1.png')}}" alt="user image" class="img-fluid">
          <div class="team-content">
            <h2>lester muhwati</h2>
            <h3>systems administator</h3>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="comments" class="offset">
    <div class="container">
      <div class="comments-header">
        <h2>comments and suggestions</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-xl-9 col-md-9 col-sm-12">
            <form action="{{ url('/comments')}}" method="POST" role="form">
             @csrf

              <div class="form-group row">
                <label for="name" class="col-sm-3">name</label>
               <div class="col-sm-9">
                <input type="text" class="comment-control @error('name') is-invalid @enderror" name="name" id="name">
                @error('name')
                <span class="help-block">
                  <strong>{{ $message}}</strong>
                </span>
                @enderror
               </div>
              </div>

              <div class="form-group row">
                <label class="col-sm-3" for="email">email</label>
                <div class="col-sm-9">
                  <input type="email" class="comment-control @error('email') is-invalid @enderror" name="email" id="email">
                  @error('email')
                    <span class="help-block">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="message" class="col-sm-3">message</label>
                <div class="col-sm-9">
                  <textarea name="message" id="message" class="comment-control @error('message') is-invalid @enderror" cols="30" rows="4"></textarea>
                  @error('message')
                    <strong>{{ $message }}</strong>
                  @enderror
                </div>
              </div>

              <div class="form-group">
                <button type="submit" class="slider-btn slider-1">Submit Request</button>
              </div>

            </form>
        </div>
      </div>
    </div>
  </section>

  @endsection