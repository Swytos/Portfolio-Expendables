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
        CKEDITOR.replace( 'editor');
    </script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Feedback Info
        </div>
        <div class="card-body">
            <div class="container">
                <h4 class="m-y-2">{{ $active_page }}</h4>
                <div class="tab-pane">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label form-control-label">Name</label>
                        <div class="col-lg-10">
                            <p>{{ $feedback[0]['name'] }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label form-control-label">Email</label>
                        <div class="col-lg-10">
                            <p>{{ $feedback[0]['email'] }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label form-control-label">Company</label>
                        <div class="col-lg-10">
                            <p>{{ $feedback[0]['company'] }}</p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label form-control-label">Message</label>
                        <div class="col-lg-10">
                            <p>{{ $feedback[0]['message'] }}</p>
                        </div>
                    </div>
                    <div class="alert alert-success text-center" id="success" style="display: none"></div>
                    <div class="alert alert-danger text-center" id="error" style="display: none"></div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label form-control-label"></label>
                        <div class="col-lg-10">
                            <a href="{{ route('admin.feedback') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                            <button class="btn btn-primary reply_feedback"><i class="fas fa-reply"></i>
                                Reply
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.feedback.reply_feedback_modal')
@endpush