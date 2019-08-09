@extends('admin.main')
@push('styles')
        <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/prism.css') }}" />
        <link rel="Stylesheet" type="text/css" href="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.css" />
        <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/croppie.css') }}" />
        <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
@endpush
@push('scripts')
        <script src="{{ asset('libraries/crop-image/prism.js') }}"></script>
        <script src="https://foliotek.github.io/Croppie/bower_components/sweetalert/dist/sweetalert.min.js"></script>

        <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
        <script src="{{ asset('libraries/crop-image/uploadPhoto.js') }}"></script>
        <script src="https://foliotek.github.io/Croppie/bower_components/exif-js/exif.js"></script>
        <script>
            UploadPhoto.init();
        </script>
		<script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
		<script>
			CKEDITOR.replace( 'editor_member');
		</script>
@endpush

@section('content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-user"></i>
		Member Info
	</div>
	<div class="card-body">
		<div class="container">
			<div class="alert alert-danger" id="error_block" role="alert" style="display:none">
				<strong>Oh no!</strong> Apply commens written below and try again.
				<div id="error_list"></div>
			</div>
			<div class="alert alert-success" id="success_block" role="alert" style="display:none">
				<strong>Great!</strong> Now you can return to <a href="{{ route('admin.team_members') }}">members list page.</a>
			</div>
			<div class="photo-wrap upload-photo">
				<div class="grid">
					<form role="form" method="POST" id="profile_form" enctype="multipart/form-data" action="{{ isset($member) ? route('admin.edit_member', $member['id']) : route('admin.new_member') }}">
						<div class="col-md-5">
							@if (isset($member))
							<div id="team-member">
								<img class="mx-auto rounded-circle" src="{{ $member['image'] }}" alt=""></br>
								<button type="button" id="change_member_photo" class="btn btn-secondary" style="inline-block">Change</button>
							</div>
							<div id="uploading_image" style="display:none;">
							@else
							<div id="uploading_image">
							@endif
								<div class="upload-msg">
									Upload Profile photo
								</div>
								<div class="upload-photo-wrap">
									<div id="upload-photo"></div>
								</div>
								<div class="actions">
									<button class="btn btn-secondary file-btn">
										<span>Upload</span>
										<input type="file" id="profile_photo" value="Choose a file" accept="image/*" />
									</button>
									<button type="button" class="btn btn-secondary upload-result">Preview</button>
								</div>
							</div>
						</div>
						<div class="col-md-7">
							<h4 class="m-y-2">{{ $active_page }}</h4>
							<div class="tab-pane" id="edit">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Full name</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="full_name" value="{{ isset($member) ? $member['full_name'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Role</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="role" value="{{ isset($member) ? $member['role'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Description</label>
									<div class="col-lg-9">
										<textarea class="form-control" id="editor_member" name="description" rows="3">{{ isset($member) ? $member['description'] : '' }}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<a href="{{ route('admin.team_members') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
										<input type="button" id="apply_member_changes" name="apply_member_changes" class="btn btn-primary" value="{{ $active_page == 'New member' ? 'Create' : 'Update' }}">
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