<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('template_title')</title>
    <link rel="stylesheet" href="{{ asset('app-home/bootstrap-4.1.3-dist/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('app-home/style.css')}}" />
    <link rel="stylesheet" href="{{ asset('app-home/css/fixed.css')}}" />
    @yield('template_linked_css')
  </head>

  <body >
    <!-- start home -->
    
      <!-- navigation -->
      <nav class="navbar navbar-expand-md navbar-light bg-dark fixed-top">
        <div class="container">
          <a href="" class="navbar-brand"
              ><img src="{{ asset('app-home/img/top_logo_small.png')}}" alt=""
            /></a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
          >
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a href="{{ route('welcome') }}" class="nav-link">Home</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('issue') }}" class="nav-link">Issue</a>
              </li>
              <li class="nav-item">
                <a href="{{ route('follow') }}" class="nav-link">Follow</a>
              </li>
              <li class="nav-item nav-login">
                <a href="{{ route('login') }}" class="nav-link " style="color: #fff">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      
    <!-- end home -->

      <div class="section-container">
          @yield('content')
      </div>

    <div id="footer" class="offset">
      <footer class="page-footer">
        <div class="container text-center text-md-left footer-top">
          <div class="row">
            <div class="col-md-4 mx-auto mb-4 footer-section">
              <h6>About</h6>
              <hr class="bg-maron mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;height: 2px;">
              <p class="mt-2">Whelson Ticketing is a web-based portal for whelson employees to report their queries,
                problems and suggestions as and when the need arise.</p>
            </div>
            <div class="col-md-4 mx-auto mb-4 footer-section">
              <h6>Contact</h6>
              <hr class="bg-maron mb-4 mt-0 d-inline-block mx-auto" style="width: 85px;height: 2px;">
              <ul class="list-unstyled">
                <li class="my-2"><i class="fa fa-home mr-2"></i>Address: 64 Lytton Road, Workington, Harare</li>
                <li class="my-2"><i class="fa fa-phone mr-2"></i>Telephone: (0242) 754708 / 755916 / 17</li>
                <li class="my-2"><i class="fa fa-fax mr-2"></i>Fax: (0242) 754177</li>
                <li class="my-2"><i class="fa fa-envelope-open-text mr-2"></i>Email: reception@whelson.co.zw</li>
                
              </ul>
            </div>
            <div class="col-md-4 mx-auto mb-4 footer-section">
              <h6>Quick Links</h6>
              <hr class="bg-maron mb-4 mt-0 d-inline-block mx-auto" style="width: 92px;height: 2px;">
              <ul class="list-unstyled">
                <li class="my-2 mr-2"><i class="fas fa-angle-right"></i> <a href=""> HOME</a></li>
                <li class="my-2 mr-2"><i class="fas fa-angle-right"></i> <a href=""> ISSUE TICKET</a></li>
                <li class="my-2 mr-2"><i class="fas fa-angle-right"></i> <a href=""> FOLLOW UP ISSUE</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-bottom">
          <p>©2021 Whelson IT Projects. All rights reserved.</p>
        </div>
      </footer>
    </div>
    <!-- end home -->

    <!--- Script Source Files -->
    <script src="{{ asset('app-home/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('app-home/bootstrap-4.1.3-dist/js/bootstrap.min.js')}}"></script>
    <script src="https://use.fontawesome.com/releases/v5.6.1/js/all.js"></script>
    @yield('footer_scripts')
    <!--- End of Script Source Files -->
  </body>
</html>