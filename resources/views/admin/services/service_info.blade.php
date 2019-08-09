@extends('admin.main')
@push('styles')

    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
@endpush
@push('scripts')
    <script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'editor_service');
    </script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-user-graduate"></i>
            Service Info
        </div>
        <div class="card-body">
            <div class="container">
                <div class="alert alert-danger" id="error_block" role="alert" style="display:none">
                    <strong>Oh no!</strong> Apply commens written below and try again.
                    <div id="error_list"></div>
                </div>
                <div class="alert alert-success" id="success_block" role="alert" style="display:none">
                    <strong>Great!</strong> Now you can return to <a href="{{ route('admin.services') }}">services list page.</a>
                </div>
                <div class="photo-wrap upload-photo">
                    <div class="grid">
                        <form role="form" method="POST" id="service_form" enctype="multipart/form-data" action="{{ isset($service) ? route('admin.edit_service', $service['id']) : route('admin.new_service') }}">
                            <div class="col-md-12">
                                <h4 class="m-y-2">{{ $active_page }}</h4>
                                <div class="tab-pane" id="edit">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Name</label>
                                        <div class="col-lg-9">
                                            <input class="form-control" type="text" name="name" value="{{ isset($service) ? $service['name'] : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Icon</label>
                                        <div class="col-lg-8">
                                            <input class="form-control icon" type="text" name="icon" value="{{ isset($service) ? $service['icon'] : '' }}">
                                        </div>
                                        <div class="col-lg-1"><div class="icons"><i class="fas fa-{{ isset($service) ? $service['icon'] : '' }} fa-2x"></i></div></div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Description</label>
                                        <div class="col-lg-9">
                                            <textarea class="form-control" id="editor_service" name="description" rows="3">{{ isset($service) ? $service['description'] : '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label"></label>
                                        <div class="col-lg-9">
                                            <a href="{{ route('admin.services') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                            <input type="button" id="apply_service_changes" name="apply_service_changes" class="btn btn-primary" value="{{ $active_page == 'New service' ? 'Create' : 'Update' }}">
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