<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('visitor/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('visitor/css/style.css')}}" />
    <link rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('visitor/css/fixed.css')}}" />
    @yield('template_linked_css')
    <title>@yield('template_title')</title>
  </head>

  <body >
  
    <nav class="navbar navbar-expand-md navbar-light bg-dark fixed-top">
      <div class="container-fluid">
        <a href="" class="navbar-brand">
          <img src="{{ asset('visitor/images/top_logo_small.png')}}" alt=""/>
        </a>
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

            @guest
            <li class="nav-item active">
              <a href="{{ url('/')}}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/follow')}}" class="nav-link">Follow</a>
            </li>
            <li class="nav-item">
              <a href="{{ url('/issue')}}" class="nav-link">create</a>
            </li>
            <li class="nav-item nav-login">
              <a href="{{ route('login')}}" class="nav-link ">Login</a>
            </li>

            @endguest
          </ul>
        </div>
      </div>
    </nav>

    <div class="contents-page">
      @yield('content')
    </div>
    
    <footer id="footer" class="offset">
      <div class="container">
        <div class="row footer-section-content">
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="footer-section">
              <div class="footer-head">
                <h3>about</h3>
              </div>
              <div class="footer-content">
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Est, aspernatur!</p>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="footer-section">
              <div class="footer-head">
                <h3>contact</h3>
              </div>
              <div class="footer-content">
                <ul>
                  <li>Address: 64 Lytton Road, Workington, Harare</li>
                  <li>Telephone: (0242) 754708 / 755916 / 17</li>
                  <li>Fax: (0242) 754177</li>
                  <li>Email: reception@whelson.co.zw</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="footer-section">
              <div class="footer-head">
                <h3>quick links</h3>
              </div>
              <div class="footer-content">
                <ul>
                  @guest
                  <li><a href="{{ url('/')}}">home</a></li>
                  <li><a href="{{ url('/issue')}}">issue ticket</a></li>
                  <li><a href="{{ url('/follow')}}">follow ticket</a></li>
                  <li><a href="{{ url('/login')}}">login</a></li>
                  @endguest
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="footer-end">
        <p>&copy; <?php echo date('Y') ?> Whelson IT Projects. All rights reserved.</p>
      </div>
    </footer>
   
    <script src="{{ asset('visitor/js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ asset('visitor/js/bootstrap.min.js')}}"></script>
    <script src="https://use.fontawesome.com/releases/v5.6.1/js/all.js"></script>
    @yield('footer_scripts')
  </body>
</html>