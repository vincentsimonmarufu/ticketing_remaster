@extends('layouts.app')

@section('template_title')
  {!! trans('usersmanagement.showing-user', ['name' => $user->name]) !!}
@endsection

@section('template_linked_css')
    <style>
        .divider{
            border-top: 1px solid lightgray;
            margin-bottom: 3px;
        }
        .content-display h4{
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
  $levelAmount = trans('usersmanagement.labelUserLevel');
  if ($user->level() >= 2) {
    $levelAmount = trans('usersmanagement.labelUserLevels');
  }
@endphp

@section('content')

  <div class="container">

      <div class="widget-content widget-content-area">
          <p><span class="float-right"><a href="{{ url('/users') }}" class="btn btn-outline-info btn-rounded btn-sm">Back to Users</a></span></p>

        <div class="row justify-content-center">
            <div class="col-md-6  br-6 mb-4">
                <div class="center ">
                    <h5 class="text-center">Vincent</h5>
                    <p class="text-center">vmarufu@gmail.com</p>
                    <div class="controls text-center">
                        <a href="{{ url('/profile/'.$user->name) }}" class="btn btn-primary btn-sm btn-rounded">View Profile</a>
                        <a href="{{ url('/users/'.$user->id.'/edit')}}" class="btn btn-warning btn-sm btn-rounded">Edit User</a>
                        <form class="d-inline" action="{{ url('users/'.$user->id) }}" method="post">
                            {{ method_field('delete') }}
                            <button type="button" class="btn btn-danger btn-sm btn-rounded" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this user ?">Delete User</button>
                            {{ csrf_field() }}
                          </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="divider"></div>

        <div class="content-display">
            <h4>First Name: </h4>
            <p>{{ $user->first_name}}</p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Last Name: </h4>
            <p>{{ $user->last_name}}</p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Email Address: </h4>
            <p>
                <span data-toggle="tooltip" data-placement="top" title="Email {{ $user->email}}">
                {{ Html::mailto($user->email,$user->email)}}
                </span>
            </p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Role: </h4>
            <p>
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
            </p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Status: </h4>
            <p>
                @if ($user->activated == 1)
                    <span class="badge badge-success">
                        Activated
                    </span>
                @else
                    <span class="badge badge-danger">
                        Not-Activated
                    </span>
                @endif
            </p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Created At: </h4>
            <p>{{ $user->created_at}}</p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Updated At: </h4>
            <p>{{ $user->updated_at}}</p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Admin Sign Up Ip: </h4>
            <p>{{ $user->admin_ip_address}}</p>
        </div>
        <div class="divider"></div>

        <div class="content-display">
            <h4>Last Updated Ip: </h4>
            <p>{{ $user->updated_ip_address}}</p>
        </div>
        <div class="divider"></div>
    </div>
  </div>
  
  @include('modals.modal-delete')

@endsection

@section('footer_scripts')

  @include('scripts.delete-modal-script')
  @if(config('usersmanagement.tooltipsEnabled'))
    @include('scripts.tooltips')
  @endif
@endsection
