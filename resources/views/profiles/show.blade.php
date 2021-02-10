@extends('layouts.app')

@section('template_title')
    {{ $user->name }}'s Profile
@endsection

@section('template_fastload_css')
    <style>
        #map-canvas{
            min-height: 300px;
            height: 100%;
            width: 100%;
        }
    </style>
@endsection

@section('template_linked_css')
    <link href="{{ asset('assets/css/users/user-profile.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .profile-heading{
            font-size: 20px;
            font-weight: 600;
            color: #1b55e2;
        }
        .divider{
            border-top: 1px solid lightgray;
            margin-bottom: 3px;
        }
        .content-display{
            padding-top: .5rem;
            padding-bottom: .5rem;
        }
        .skills .widget-content-area .content-display h4{
            font-weight: bold;
            font-size: 14px;
            margin-bottom:0;
            padding-bottom: 0;
        }
        .content-display p{
            font-weight: lighter;
            font-size: 13px;
        }
    </style>
@endsection

@php
    $currentUser = Auth::user()
@endphp

@section('content')
<div class="col-xl-4 col-lg-6 col-md-5 col-sm-12 layout-top-spacing">

    <div class="user-profile layout-spacing">
        <div class="widget-content widget-content-area">
            <div class="d-flex justify-content-between">
                <h3 class="">Profile</h3>
                <a href="{{ url('/profile/'.$currentUser->name.'/edit') }}" class="mt-2 edit-profile"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg></a>
            </div>
            <div class="text-center">
            <p class="profile-heading">{{ $user->name }}</p>
            </div>
            <div class="user-info-list">

                <div class="">
                    <ul class="contacts-block list-unstyled">
                        
                        <li class="contacts-block__item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>Paynumber
                        </li>
                        <li class="contacts-block__item">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
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
                            <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>Mobile</a>
                        </li>
                        
                    </ul>
                </div>                                    
            </div>
        </div>
    </div>
</div>

<div class="col-xl-8 col-lg-6 col-md-7 col-sm-12 layout-top-spacing">

    <div class="skills layout-spacing ">
        <div class="widget-content widget-content-area">
            <div class="content-display">
                <h4>Username</h4>
                <p>{{  $user->name }}</p>
            </div>
            <div class="divider"></div>

            <div class="content-display">
                <h4>Firstname</h4>
                <p>{{ $user->first_name }}</p>
            </div>
            <div class="divider"></div>
            
            <div class="content-display">
                <h4>Lastname</h4>
                <p>{{ $user->last_name }}</p>
            </div>
            <div class="divider"></div> 

            <div class="content-display">
                <h4>Email Address</h4>
                <p>{{ $user->email }}</p>
            </div>

            @if ($user->profile->github_username)
            <div class="content-display">
                <h4>Github Username</h4>
                <p>{!! HTML::link('https://github.com/'.$user->profile->github_username, $user->profile->github_username, array('class' => 'github-link', 'target' => '_blank')) !!}</p>
            </div>
                
            @endif

            @if ($user->profile)
                @if ($currentUser->id == $user->id)
                    {!! HTML::icon_link(URL::to('/profile/'.$currentUser->name.'/edit'), 'fa fa-fw fa-cog', trans('titles.editProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}
                @endif
            @else
                <p>
                    {{ trans('profile.noProfileYet') }}
                </p>
                {!! HTML::icon_link(URL::to('/profile/'.$currentUser->name.'/edit'), 'fa fa-fw fa-plus ', trans('titles.createProfile'), array('class' => 'btn btn-small btn-info btn-block')) !!}
            @endif

        </div>
    </div>
</div>
@endsection

@section('footer_scripts')

    @if(config('settings.googleMapsAPIStatus'))
        @include('scripts.google-maps-geocode-and-map')
    @endif

@endsection
