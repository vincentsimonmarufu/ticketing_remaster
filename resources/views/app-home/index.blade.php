@extends('layouts.app-home')   

@section('template_title')
    Home Page
@endsection
        
@section('content')
    {{--  start image slider --}}
    <div
    id="carouselExampleIndicators"
    class="carousel slide"
    data-ride="carousel"
    data-interval="7000"
    >
    <ol class="carousel-indicators">
    <li
        data-target="#carouselExampleIndicators"
        data-slide-to="0"
        class="active"
    ></li>
    <li
        data-target="#carouselExampleIndicators"
        data-slide-to="1"
        class=""
    ></li>
    <li
        data-target="#carouselExampleIndicators"
        data-slide-to="2"
        class=""
    ></li>
    </ol>
    <div class="carousel-inner" role="listbox">
    <!-- slide 1 -->
    <div
        class="carousel-item active"
        style="background-image: url(app-home/img/DSC_0181.JPG)"
    >
        <div class="carousel-caption text-center">
        <h1>Welcome To Ticketing System</h1>
        <h3>A Laravel Project</h3>
        <a class="btn btn-outline-light btn-lg" href="" href="#issue"
            >Get Started</a
        >
        </div>
    </div>
    <!-- slide 2 -->
    <div
        class="carousel-item"
        style="background-image: url(app-home/img/DSC_0180.JPG)"
    >
        <div class="carousel-caption text-center"></div>
    </div>

    <!-- slide 3 -->
    <div
        class="carousel-item"
        style="background-image: url(app-home/img/DSC_0180.JPG)"
    >
        <div class="carousel-caption text-center"></div>
    </div>
    </div>
    <!-- next /prev -->
    <a
    class="carousel-control-prev"
    href="#carouselExampleIndicators"
    role="button"
    data-slide="prev"
    >
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    </a>
    <a
    class="carousel-control-next"
    href="#carouselExampleIndicators"
    role="button"
    data-slide="next"
    >
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    </a>
    </div>
    <!-- end image slider -->

<!-- team -->
    <div id="team" class="offset profile-area">
        <div class="col-12 text-center">
        <h3 class="heading">Meet the team</h3>
        <div class="heading-underline"></div>
        </div>
        <div class="row">

        </div>
    </div>
  <!-- end team -->
@endsection       
        