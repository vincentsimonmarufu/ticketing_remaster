@extends('layouts.app')

@section('template_title')
    {!!trans('usersmanagement.show-deleted-users')!!}

@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css')}}">

    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    <style>
        .users-head h4{
            font-size: 20px;
            font-weight: 600;
        }
        .users-head p{
            font-size: 13px;
            color: #919aa3;
        }
    </style>


@endsection

@section('content')
<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    <div class="users-head">
        <h4>Deleted Users </h4>
        <p>Overview of System Deleted Users <span style="padding-right: 10px;" class="float-right">
            <a href="{{ url('/users')}}" style="color: #919aa3"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> / users</a><a href="{{ url('/users/create')}}"> / deleted</a>
        </span></p>
    </div>
    <div class="widget-content widget-content-area br-6">
        
        <div class="table-responsive mb-4 mt-4">
            <table id="zero-config" class="table table-hover" style="width:100%">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Role</th>
                    <th>Deleted At</th>
                    <th>Deleted IP</th>
                    <th class="no-content">Actions</th>
                </tr>
                </thead>
                <tbody>

                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->first_name }}</td>
                        <td>{{ $user->last_name }}</td>
                        <td>
                            @foreach ($user->roles as $user_role)

                                @if ($user_role->name == 'User')
                                    @php $labelClass = 'primary' @endphp

                                @elseif ($user_role->name == 'Admin')
                                    @php $labelClass = 'warning' @endphp

                                @elseif ($user_role->name == 'Unverified')
                                    @php $labelClass = 'danger' @endphp

                                @else
                                    @php $labelClass = 'default' @endphp

                                @endif

                                <span class="label label-{{$labelClass}}">{{ $user_role->name }}</span>

                            @endforeach
                        </td>
                        <td>{{$user->deleted_at}}</td>
                        <td>{{$user->deleted_ip_address}}</td>
                        <td style="white-space: nowrap;">
                            {!! Form::model($user, array('action' => array('SoftDeletesController@update', $user->id),'class'=>'d-inline', 'method' => 'PUT', 'data-toggle' => 'tooltip')) !!}
                                {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="8.5" cy="7" r="4"></circle><line x1="20" y1="8" x2="20" y2="14"></line><line x1="23" y1="11" x2="17" y2="11"></line></svg>', array('class' => 'd-inline', 'type' => 'submit','style'=>'border:none;background-color:#fff;', 'data-toggle' => 'tooltip', 'title' => 'Restore User')) !!}
                            {!! Form::close() !!}

                            <a class="d-inline" href="{{ URL::to('users/deleted/' . $user->id) }}" data-toggle="tooltip" title="Show User">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>

                            {!! Form::model($user, array('action' => array('SoftDeletesController@destroy', $user->id), 'method' => 'DELETE', 'class' => 'd-inline', 'data-toggle' => 'tooltip', 'title' => 'Destroy User Record')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>', array('class' => 'd-inline','type' => 'button', 'style' =>'border:none;background:#fff;','data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')

    <script src="{{ asset('plugins/table/datatable/datatables.js')}}"></script>
    <script>
        $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Search...",
                "sLengthMenu": "Results :  _MENU_",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 7
        });
    </script>

    @if (count($users) > 10)
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @include('scripts.tooltips')

@endsection
