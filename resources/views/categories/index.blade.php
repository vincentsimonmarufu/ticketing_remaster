@extends('layouts.app')

@section('template_title')
    Showing all Categories
@endsection

@section('template_linked_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">

    <style>
        .hidden-update{
            display: none;
        }
        .form-group label, label {
            color: #3b3f5c;
        }
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

<div class="col-xl-5 col-lg-5 col-sm-12">

    <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
        <div class="users-head">
            <h4>Add New Category </h4>
            <p>Specify the category of the tickets </p>
        </div>
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                {!! Form::open(array('route' => 'categories.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation')) !!}
                    {!! csrf_field() !!}
                    <div class="form-group mb-4">
                        <label for="cat_name">Category Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="cat_name" placeholder="e.g User Related">
                        @error('name')
                            <span class="help-block">
                            <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        <button type="button" data-toggle = 'modal' data-target = '#confirmSave' data-title = 'Add Category' data-message = 'Are you sure you want to save changes' class="btn btn-primary mb-2 mr-2 btn-rounded mt-3">Add new Category</button>
                    </div>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>


<div class="col-xl-7 col-lg-7 col-sm-12">
    <div class="widget-content widget-content-area br-6">

        <div class="table-responsive mb-4 mt-4">
            <table id="zero-config" class="table table-hover" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>CATEGORY NAME</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td style="white-space: nowrap;">

                            <form class="d-inline" action="{{ route('categories.destroy',$category->id) }}" method="POST" data-toggle="tooltip" title="Delete Category">
                                {{ method_field('delete') }}
                                <button type="button" data-toggle="modal" data-target="#confirmDelete" data-title = "Delete User" data-message = "Are you sure you want to delete this Category ?"  class="d-inline" style="border:none;background:#fff;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x-circle table-cancel"><circle cx="12" cy="12" r="10"></circle><line x1="15" y1="9" x2="9" y2="15"></line><line x1="9" y1="9" x2="15" y2="15"></line></svg></button>
                                {{ csrf_field() }}
                            </form>

                            <a class="d-inline" href="{{ URL::to('categories/' . $category->id . '/edit') }}" data-toggle="tooltip" title="Edit Category" onclick="removeHidden()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach()
                </tbody>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>CATEGORY NAME</th>           
                        <th></th>
                    </tr>
                </tfoot>
            </table>
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
    <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
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
    <script>
        function removeHidden(){
            var element = document.getElementById("updateCatForm");
            element.classList.remove("hidden-update");
        }
    </script>
    @include('scripts.tooltips')
@endsection
