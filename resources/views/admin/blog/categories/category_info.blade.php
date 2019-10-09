@extends('admin.main')
@push('styles')

    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
    <script>
        // CKEDITOR.replace( 'editor_project');
    </script>
    <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-tags"></i>
            Tag Info
        </div>
        <div class="card-body">
            <div class="container">
                <div class="alert alert-danger" id="error_block" role="alert" style="display:none">
                    <strong>Oh no!</strong> Apply commens written below and try again.
                    <div id="error_list"></div>
                </div>

                <div class="alert alert-success" id="success_block" role="alert" style="display:none">
                    <strong>Great!</strong> Now you can return to <a href="{{ route('admin.categories') }}">categories list page.</a>
                </div>
                <div class="photo-wrap upload-photo">
                    <div class="grid">
                        <form role="form" method="POST" id="category_form" enctype="multipart/form-data" action="{{ isset($category) ? route('admin.edit_category', ['id' => $category->id ]) : route('admin.new_category') }}">
                            <div class="col-md-6">
                                <h4 class="m-y-2">{{ $active_page }}</h4>
                                <div class="tab-pane" id="edit">
{{--                                    {{ dd($category) }}--}}
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label form-control-label">Category name</label>
                                        <div class="col-lg-8">
                                            <input class="form-control" type="text" name="category" value="{{ isset($category) ? $category->category : ''}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-4 col-form-label form-control-label"></label>
                                        <div class="col-lg-8">
                                            <a href="{{ route('admin.categories') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                            <input type="button" id="apply_category_changes" name="apply_category_changes" class="btn btn-primary" value="{{ $active_page == 'New category' ? 'Create' : 'Update' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection