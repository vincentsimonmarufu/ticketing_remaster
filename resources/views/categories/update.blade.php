@extends('layouts.app')

@section('template_title')

@endsection

@section('template_linked_css')

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />

    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <link href="{{ asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="{{ asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
    {{-- <link href="{{ asset('assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" /> --}}
    <!--  END CUSTOM STYLE FILE  -->

    <style type="text/css">

        .pw-change-container {
            display: none;
        }
    </style>
@endsection

@section('content')

    <div class="col-xl-7 col-lg-7 col-sm-12">    
        <div id="flRegistrationForm" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4 class="float-left">Edit {{ $category->name }} Category </h4>
                            <a href="{{ url('/categories') }}" class="btn btn-outline-primary btn-rounded mt-2 float-right">
                                Back to Categories
                            </a>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area" >
                    {!! Form::open(array('route' => ['categories.update', $category->id], 'method' => 'patch', 'role' => 'form')) !!}
                    {!! csrf_field() !!}
                    <div class="form-group mb-4" >
                        <label for="cat_name">Category Name</label>
                        <input type="text" class="form-control" value="{{ $category->name }}" id="cat-name" name="name">   
                    </div> 
                    <button type="button" data-toggle = 'modal' data-target = '#confirmSave' data-title = 'Save Changes' data-message = 'Are you sure you want to save changes' class="btn btn-primary mb-2 mr-2 btn-rounded mt-3">Update Category</button>
                    {!! Form::close() !!}
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
