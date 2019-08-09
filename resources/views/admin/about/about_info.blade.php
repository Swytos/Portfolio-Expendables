@extends('admin.main')
@push('styles')
    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/prism.css') }}" />
    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/croppie.css') }}" />
    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
    <script src="{{ asset('libraries/crop-image/prism.js') }}"></script>

    <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
    <script src="{{ asset('libraries/crop-image/uploadPhoto.js') }}"></script>
    <script>
        UploadPhoto.init();
    </script>
    <script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor_about');
    </script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            About Info
        </div>
        <div class="card-body">
            <div class="container">
                <div class="alert alert-danger" id="error_block" role="alert" style="display:none">
                    <strong>Oh no!</strong> Apply comments written below and try again.
                    <div id="error_list"></div>
                </div>
                <div class="alert alert-success" id="success_block" role="alert" style="display:none">
                    <strong>Great!</strong> Now you can return to <a href="{{ route('admin.about') }}">about list page.</a>
                </div>
                <div class="photo-wrap upload-photo">
                    <div class="grid">
                        <form role="form" method="POST" id="about_form" enctype="multipart/form-data" action="{{ isset($about) ? route('admin.edit_about', $about['id']) : route('admin.new_about') }}">
                            <div class="col-md-5">
                                @if (isset($about))
                                    <div id="team-member">
                                        <img class="mx-auto rounded-circle" src="{{ $about['image'] }}" alt=""></br>
                                        <button type="button" id="change_member_photo" class="btn btn-secondary" style="inline-block:none">Change</button>
                                    </div>
                                    <div id="uploading_image" style="display:none;">
                                        @else
                                            <div id="uploading_image">
                                                @endif
                                                <div class="upload-msg">
                                                    Upload Profile photo
                                                </div>
                                                <div class="upload-photo-wrap">
                                                    <div id="about_img"></div>
                                                </div>
                                                <div class="actions">
                                                    <button class="btn btn-secondary file-btn">
                                                        <span>Upload</span>
                                                        <input type="file" id="about_photo" value="Choose a file" accept="image/*" />
                                                    </button>
                                                    <button type="button" class="btn btn-secondary upload-result">Preview</button>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="col-md-7">
                                        <h4 class="m-y-2">{{ $active_page }}</h4>
                                        <div class="tab-pane" id="edit">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="name" value="{{ isset($about) ? $about['name'] : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Date</label>
                                                <div class="col-lg-9">
                                                    <input class="form-control" type="text" name="date" value="{{ isset($about) ? $about['date'] : '' }}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label">Description</label>
                                                <div class="col-lg-9">
                                                    <textarea id="editor_about" class="form-control" name="description" rows="3">{{ isset($about) ? $about['description'] : '' }}</textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label form-control-label"></label>
                                                <div class="col-lg-9">
                                                    <a href="{{ route('admin.about') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                                    <input type="button" id="apply_about_changes" name="apply_about_changes" class="btn btn-primary" value="{{ $active_page == 'New about' ? 'Create' : 'Update' }}">
                                                </div>
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