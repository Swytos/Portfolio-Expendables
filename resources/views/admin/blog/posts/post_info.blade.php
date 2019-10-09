@extends('admin.main')
@push('styles')
    <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
    <link rel="stylesheet" href="{{ asset('libraries/select2/dist/css/select2.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('libraries/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
    <script>
        var CSRFToken = $('meta[name="csrf-token"]').attr('content');
        var editor = CKEDITOR.replace( 'post_content', {
            filebrowserUploadUrl: '/upload?type=Files&_token=' + CSRFToken,
            filebrowserUploadMethod: 'form'
        });
        $('.tags').select2();
    </script>
    <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-mail-bulk"></i>
            Post Info
        </div>
        <div class="card-body">
            <div class="container">
                <div class="alert alert-danger" id="error_block" role="alert" style="display:none">
                    <strong>Oh no!</strong> Apply commens written below and try again.
                    <div id="error_list"></div>
                </div>

                <div class="alert alert-success" id="success_block" role="alert" style="display:none">
                    <strong>Great!</strong> Now you can return to <a href="{{ route('admin.posts') }}">posts list page.</a>
                </div>
                <div class="photo-wrap upload-photo">
                    <div class="grid">
                        <form role="form" method="POST" id="post_form" enctype="multipart/form-data" action="{{ isset($post) ? route('admin.edit_post', ['id' => $post->id]) : route('admin.new_post') }}">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h4 class="m-y-2">{{ $active_page }}</h4>
                                    <div class="tab-pane" id="edit">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label form-control-label">Post title</label>
                                            <div class="col-lg-10">
                                                <input class="form-control" type="text" name="post_title" value="{{ isset($post) ? $post->post_title : '' }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label form-control-label">Post categories</label>
                                            <div class="col-lg-10">
                                                <select name="post_category" class="form-control">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->category }}" {{ isset($post) ? $category->category == $post->post_category ? 'selected' : '' : ''}}>{{ $category->category }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label form-control-label">Post tags</label>
                                            <div class="col-lg-10">
                                                <select class="form-control tags" name="post_tags[]" multiple="multiple">
                                                    @foreach ($tags as $tag)
                                                        <option value="{{ $tag->id  }}" {{ isset($post) ? in_array($tag->id, $postTags) ? 'selected' : '' : ''}}>{{ $tag->tag_name  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label form-control-label">Post content</label>
                                            <div class="col-lg-10">
                                                <textarea name="post_content" id="" cols="30" rows="10">{{isset($post) ? $post->post_content : ''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label form-control-label"></label>
                                            <div class="col-lg-10">
                                                <a href="{{ route('admin.posts') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
                                                <input type="button" id="apply_post_changes" name="apply_post_changes" class="btn btn-primary" value="{{ $active_page == 'New post' ? 'Create' : 'Update' }}">
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