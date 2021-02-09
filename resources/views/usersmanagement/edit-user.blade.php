@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.create-new-user') !!}
@endsection

@section('template_linked_css')
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="row">
        <div class="col-xl-8 col-lg-8 col-sm-12">
            <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">                                
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4 class="float-left">{!! trans('usersmanagement.editing-user', ['name' => $user->name]) !!}</h4>
                                    <a href="{{ url('/users/' . $user->id) }}" class="btn btn-outline-primary btn-rounded mt-2 float-right">
                                        {!! trans('usersmanagement.buttons.back-to-user') !!}
                                    </a>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {!! Form::open(array('route' => ['users.update', $user->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation')) !!}

                            {!! csrf_field() !!}
                            <div class="form-group mb-4" {{ $errors->has('name') ? ' has-error ' : '' }}>
                                <input type="text" value="{{ $user->name }}" name="name" class="form-control" id="rUsername" placeholder="Username *">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('email') ? ' has-error ' : '' }}>
                                <input type="email" value="{{ $user->email }}" class="form-control" id="email" name="email" placeholder="{!! trans('forms.create_user_ph_email') !!} *">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('first_name') ? ' has-error ' : '' }}>
                                <input type="text" value="{{ $user->first_name }}" name="first_name" class="form-control" id="rFirstname" placeholder="First Name *">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('last_name') ? ' has-error ' : '' }}>
                                <input type="text" value="{{ $user->last_name }}" class="form-control" name="last_name" id="rLastname" placeholder="Last Name *">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group" {{ $errors->has('role') ? ' has-error ' : '' }}>
                                <select class="custom-select form-control" name="role" id="role">
                                    <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                                    @if ($roles)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ $currentRole->id == $role->id ? 'selected="selected"' : '' }}>{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="pw-change-container">
                                <div class="form-group has-feedback row {{ $errors->has('password') ? ' has-error ' : '' }}">

                                    <div class="col-md-9">
                                        <div class="input-group">
                                            {!! Form::password('password', array('id' => 'password', 'class' => 'form-control ', 'placeholder' => trans('forms.create_user_ph_password'))) !!}

                                        </div>
                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group has-feedback row {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}">

                                    <div class="col-md-9">
                                        <div class="input-group">
                                            {!! Form::password('password_confirmation', array('id' => 'password_confirmation', 'class' => 'form-control', 'placeholder' => trans('forms.create_user_ph_pw_confirmation'))) !!}

                                        </div>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <a href="#" class="btn btn-outline-secondary btn-block btn-rounded btn-change-pw mt-3" title="{{ trans('forms.change-pw')}} ">
                                        <i class="fa fa-fw fa-lock" aria-hidden="true"></i>
                                        <span></span> {!! trans('forms.change-pw') !!}
                                    </a>
                                </div>
                                <div class="col-12 col-sm-6">
                                    {!! Form::button(trans('forms.save-changes'), array('class' => 'btn btn-primary btn-rounded btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'button', 'data-toggle' => 'modal', 'data-target' => '#confirmSave', 'data-title' => trans('modals.edit_user__modal_text_confirm_title'), 'data-message' => trans('modals.edit_user__modal_text_confirm_message'))) !!}
                                </div>
                            </div>
                            <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                            
                        {!! Form::close() !!}

                    </div>
                </div>
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
