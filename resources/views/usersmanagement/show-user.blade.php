@extends('layouts.app')

@section('template_title')
  {!! trans('usersmanagement.showing-user', ['name' => $user->name]) !!}
@endsection

@section('template_linked_css')
  <link href="{{ asset('assets/css/users/user-profile.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('plugins/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css') }}"> 
@endsection

@php
  $levelAmount = trans('usersmanagement.labelUserLevel');
  if ($user->level() >= 2) {
    $levelAmount = trans('usersmanagement.labelUserLevels');
  }
@endphp

@section('content')

<div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">
  <div class="user-profile layout-spacing">
      <div class="widget-content widget-content-area">
          <div class="d-flex justify-content-between">
              <h3 class="">Profile</h3>
              <a href="{{ URL::to('users/' . $user->id . '/edit') }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
          </div>
          <div class="text-center user-info">
              <img src="{{ asset('assets/img/90x90.jpg') }}" alt="avatar">
              @if ($user->name)
                <p class="">{{ $user->name }}</p>
              @endif
              
          </div>
          <div class="user-info-list">

              <div class="">
                  <ul class="contacts-block list-unstyled">
                      <li class="contacts-block__item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>
                          @foreach ($user->roles as $user_role)

                              @if ($user_role->name == 'User')
                                  @php $badgeClass = 'primary' @endphp

                              @elseif ($user_role->name == 'Admin')
                                  @php $badgeClass = 'warning' @endphp

                              @elseif ($user_role->name == 'Unverified')
                                  @php $badgeClass = 'danger' @endphp

                              @else
                                  @php $badgeClass = 'default' @endphp

                              @endif

                              <span class="badge badge-{{$badgeClass}}">{{ $user_role->name }}</span>

                          @endforeach
                      </li>
                      <li class="contacts-block__item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                          @if ($user->last_name)
                            {{ $user->last_name }}
                              
                          @endif
                      </li>
                      <li class="contacts-block__item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                          @if ($user->activated == 1)
                              <span class="badge badge-success">
                                Activated
                              </span>
                          @else
                              <span class="badge badge-danger">
                                Not-Activated
                              </span>
                          @endif
                      </li>
                      <li class="contacts-block__item">
                          <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                          @if ($user->email)
                              {{ $user->email }}
                          @endif
                          </a>
                      </li>
                      <li class="contacts-block__item">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg> +1 (530) 555-12121
                      </li>
                      <li class="contacts-block__item">
                          <form action="{{ url('users/'.$user->id) }}" method="post">
                            {{ method_field('delete') }}
                            <button class="btn btn-danger btn-rounded">Delete User</button>
                            {{ csrf_field() }}
                          </form>
                          
                      </li>

                  </ul>
              </div>                                    
          </div>
      </div>
  </div>

  <div class="work-experience layout-spacing ">

    <div class="widget-content widget-content-area">

        <h3 class="">Additional User info</h3>

        <div class="timeline-alter">

            <div class="item-timeline">
                <div class="t-meta-date">
                    <p class="">Firstname</p>
                </div>
                <div class="t-dot">
                </div>
                <div class="t-text">
                    <p>{{ $user->first_name }}</p>
                    <p></p>
                </div>
            </div>

            <div class="item-timeline">
                <div class="t-meta-date">
                    <p class="">Lastname</p>
                </div>
                <div class="t-dot">
                </div>
                <div class="t-text">
                    <p>{{ $user->last_name }}</p>

                </div>
            </div>

            <div class="item-timeline">
                <div class="t-meta-date">
                    <p class="">Date Created</p>
                </div>
                <div class="t-dot">
                </div>
                <div class="t-text">
                    <p>{{ $user->created_at }}</p>
                    <p></p>
                </div>
            </div>
            <div class="item-timeline">
                <div class="t-meta-date">
                    <p class="">Date Updated</p>
                </div>
                <div class="t-dot">
                </div>
                <div class="t-text">
                    <p>{{ $user->updated_at }}</p>
                    <p></p>
                </div>
            </div>

        </div>
    </div>

  </div>
</div>

<div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

  <div class="row">
    <div class="col-xl-8 col-lg-6 col-md-6 col-sm-12 col-12 layout-spacing">
      <div class="widget-four">
          <div class="widget-heading">
              <h5 class="">User Access Rights</h5>
          </div>
          <div class="widget-content">
              <div class="vistorsBrowser">
                    @if($user->level() >= 3)             
                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chrome"><circle cx="12" cy="12" r="10"></circle><circle cx="12" cy="12" r="4"></circle><line x1="21.17" y1="8" x2="12" y2="8"></line><line x1="3.95" y1="6.06" x2="8.54" y2="14"></line><line x1="10.88" y1="21.94" x2="15.46" y2="14"></line></svg>
                        </div>
                        <div class="w-browser-details">
                            <div class="w-browser-info">
                                <h6>Administrator</h6>
                                <p class="browser-count">100%</p>
                            </div>
                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-primary" role="progressbar" style="width: 65%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                    @elseif ($user->level() < 3 && $user->level() > 1)

                    <div class="browser-list">
                        <div class="w-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-compass"><circle cx="12" cy="12" r="10"></circle><polygon points="16.24 7.76 14.12 14.12 7.76 16.24 9.88 9.88 16.24 7.76"></polygon></svg>
                        </div>
                        <div class="w-browser-details">
                            
                            <div class="w-browser-info">
                                <h6>Univerified</h6>
                                <p class="browser-count">25%</p>
                            </div>

                            <div class="w-browser-stats">
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 35%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                    @else

                    <div class="browser-list">
                      <div class="w-icon">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-globe"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg>
                      </div>
                      <div class="w-browser-details">
                          
                          <div class="w-browser-info">
                              <h6>User</h6>
                              <p class="browser-count">15%</p>
                          </div>

                          <div class="w-browser-stats">
                              <div class="progress">
                                  <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                          </div>

                      </div>

                    @endif()

                  </div>
                  
              </div>

          </div>
      </div>
    </div>
  

    <div class="bio layout-spacing ">
        <div class="widget-content widget-content-area">
            <h3 class="">Bio</h3>
            <p>I'm Web Developer from California. I code and design websites worldwide. Mauris varius tellus vitae tristique sagittis. Sed aliquet, est nec auctor aliquet, orci ex vestibulum ex, non pharetra lacus erat ac nulla.</p>

            <p>Sed vulputate, ligula eget mollis auctor, lectus elit feugiat urna, eget euismod turpis lectus sed ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nunc ut velit finibus, scelerisque sapien vitae, pharetra est. Nunc accumsan ligula vehicula scelerisque vulputate.</p>

            <div class="bio-skill-box">

                <div class="row">
                    
                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                        
                        <div class="d-flex b-skills">
                            <div>
                            </div>
                            <div class="">
                                <h5>Sass Applications</h5>
                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse eu fugiat nulla pariatur.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-5 mb-5 ">
                        
                        <div class="d-flex b-skills">
                            <div>
                            </div>
                            <div class="">
                                <h5>Github Countributer</h5>
                                <p>Ut enim ad minim veniam, quis nostrud exercitation aliquip ex ea commodo consequat.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-5 ">
                        
                        <div class="d-flex b-skills">
                            <div>
                            </div>
                            <div class="">
                                <h5>Photograhpy</h5>
                                <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia anim id est laborum.</p>
                            </div>
                        </div>

                    </div>

                    <div class="col-12 col-xl-6 col-lg-12 mb-xl-0 mb-0 ">
                        
                        <div class="d-flex b-skills">
                            <div>
                            </div>
                            <div class="">
                                <h5>Mobile Apps</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do et dolore magna aliqua.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>                                
    </div>
  </div>

</div>
  
  @include('modals.modal-delete')

@endsection

@section('footer_scripts')
  <script src="{{ asset('plugins/apex/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/js/widgets/modules-widgets.js') }}"></script>
  @include('scripts.delete-modal-script')
  @if(config('usersmanagement.tooltipsEnabled'))
    @include('scripts.tooltips')
  @endif
@endsection
