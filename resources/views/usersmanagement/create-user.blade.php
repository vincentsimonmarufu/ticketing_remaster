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
                                <h4>{!! trans('usersmanagement.create-new-user') !!}</h4>
                            </div>                                                                        
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        {!! Form::open(array('route' => 'users.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                            {!! csrf_field() !!}
                            <div class="form-group mb-4" {{ $errors->has('name') ? ' has-error ' : '' }}>
                                <input type="text" name="name" class="form-control" id="rUsername" placeholder="Username *">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('email') ? ' has-error ' : '' }}>
                                <input type="email" class="form-control" id="email" name="email" placeholder="{!! trans('forms.create_user_ph_email') !!} *">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('first_name') ? ' has-error ' : '' }}>
                                <input type="text" name="first_name" class="form-control" id="rFirstname" placeholder="First Name *">
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group mb-4" {{ $errors->has('last_name') ? ' has-error ' : '' }}>
                                <input type="text" class="form-control" name="last_name" id="rLastname" placeholder="Last Name *">
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group" {{ $errors->has('role') ? ' has-error ' : '' }}>
                                <select class="selectpicker form-control" name="role" id="role">
                                    <option value="">{{ trans('forms.create_user_ph_role') }}</option>
                                    @if ($roles)
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if ($errors->has('role'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('role') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group"  {{ $errors->has('password') ? ' has-error ' : '' }}>
                                <input type="password" class="form-control" id="password" name="password" placeholder="{!! trans('forms.create_user_ph_password') !!} *">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <div class="form-group"  {{ $errors->has('password_confirmation') ? ' has-error ' : '' }}>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="{!! trans('forms.create_user_ph_pw_confirmation') !!} *">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                            <small id="emailHelp2" class="form-text text-muted">*Required Fields</small>
                            
                            <div class="row">
                                <div class="col-12 col-sm-6 text-center">
                                    {!! Form::button(trans('forms.create_user_button_text'), array('class' => 'btn btn-outline-primary btn-rounded btn-block margin-bottom-1 mt-3 mb-2 btn-save','type' => 'submit' )) !!}

                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection

@section('footer_scripts')
<script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
<script>
    var formSmall = $(".form-small").select2({ tags: true });
    formSmall.data('select2').$container.addClass('form-control-sm')
</script>
@endsection
