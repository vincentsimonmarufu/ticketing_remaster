@extends('layouts.app')

@section('template_title')
    {!! trans('usersmanagement.showing-all-users') !!}
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
    <style>
        h5.show-heading{
            font-size: 15px;
            font-weight: 600;
        }
        .users-head h4{
            font-size: 20px;
            font-weight: 600;
        }
        .users-head p{
            font-size: 13px;
            color: #919aa3;
            text-transform: capitalize;
        }
    </style>
@endsection

@section('content')

<div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
    
    <div class="users-head">
        <h4>Users </h4>
        <p>Overview of System users <span style="padding-right: 10px;" class="float-right"><a href="{{ url('/users')}}"><svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> / Users</a></span></p>
    </div>
    <div class="widget-content widget-content-area br-6">
        <div class="widget-header">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                    <h5 class="ml-2 show-heading">Showing All Users <span class="float-right"><a href="{{ url('/users/create')}}" class="btn btn-light btn-rounded btn-sm" style="color:3b3f5c;font-weight:bold;">create user</a></span></h5>
                </div>
            </div>
        </div>
        <div class="table-responsive mb-4 mt-4">
            <table id="zero-config" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td> {{ $user->first_name }}</td>
                        <td> {{ $user->last_name }}</td>
                        <td><a href="mailto:{{ $user->email }}" title="email {{ $user->email }}">{{ $user->email }}</a></td>
                        <td>
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
                        </td>
                        <td style="white-space: nowrap;">
                            {!! Form::open(array('url' => 'users/' . $user->id, 'class' => 'd-inline', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                            {!! Form::hidden('_method', 'DELETE') !!}
                            {!! Form::button('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg>', array('class' => 'd-inline','type' => 'button','style'=>'border:none;background-color:#fff;','data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete User', 'data-message' => 'Are you sure you want to delete this user ?')) !!}
                            {!! Form::close() !!}

                            <a class="d-inline" href="{{ URL::to('users/' . $user->id) }}" data-toggle="tooltip" title="Show">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                            </a>

                            <a class="d-inline" href="{{ URL::to('users/' . $user->id . '/edit') }}" data-toggle="tooltip" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach()
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>NAME</th>
                        <th>FIRSTNAME</th>
                        <th>LASTNAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
            
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
    

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    <script src="plugins/table/datatable/datatables.js"></script>
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
    @include('scripts.tooltips')
@endsection
