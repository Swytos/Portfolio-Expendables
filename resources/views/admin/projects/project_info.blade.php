@extends('admin.main')
@push('styles')

        <link rel="Stylesheet" type="text/css" href="{{ asset('libraries/crop-image/uploadPhoto.css') }}" />
@endpush
@push('scripts')
	<script src="{{ asset('libraries/ckeditor/ckeditor.js') }}"></script>
	<script>
		CKEDITOR.replace( 'editor_project');
	</script>
        <script src="{{ asset('libraries/crop-image/croppie.js') }}"></script>
@endpush

@section('content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-chalkboard-teacher"></i>
		Project Info
	</div>
	<div class="card-body">
		<div class="container">
			<div class="alert alert-danger" id="error_block" role="alert" style="display:none">
				<strong>Oh no!</strong> Apply commens written below and try again.
				<div id="error_list"></div>
			</div>
			<div class="alert alert-success" id="success_block" role="alert" style="display:none">
				<strong>Great!</strong> Now you can return to <a href="{{ route('admin.projects') }}">projects list page.</a>
			</div>
			<div class="photo-wrap upload-photo">
				<div class="grid">
					<form role="form" method="POST" id="project_form" enctype="multipart/form-data" action="{{ isset($project) ? route('admin.edit_project', $project['id']) : route('admin.new_project') }}">
						<div class="col-md-6">
							@if (isset($project))
							<div id="project">
								<img src="{{ $project['image'] }}" alt=""></br>
								<button type="button" id="change_project_photo" class="btn btn-secondary" style="">Change</button>
							</div>
							<div id="uploading_image" style="display:none;">
							@else
							<div id="uploading_image">
							@endif
								<div class="upload-msg">
									Upload project photo
								</div>
								<div class="upload-profile-photo-wrap">
								    <img id="project_img"/>
								</div>
								<div class="actions">
									<button class="btn btn-secondary file-btn">
										<span>Upload</span>
										<input type="file" id="project_photo" value="Choose a file" accept="image/*" />
									</button>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<h4 class="m-y-2">{{ $active_page }}</h4>
							<div class="tab-pane" id="edit">
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Name</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="name" value="{{ isset($project) ? $project['name'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Url</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="url" value="{{ isset($project) ? $project['url'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Team Size</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="team_size" value="{{ isset($project) ? $project['team_size'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Platform</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="platform" value="{{ isset($project) ? $project['platform'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Skills</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="skills" value="{{ isset($project) ? $project['skills'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Timeline</label>
									<div class="col-lg-9">
										<input class="form-control" type="text" name="timeline" value="{{ isset($project) ? $project['timeline'] : '' }}">
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label">Description</label>
									<div class="col-lg-9">
										<textarea id="editor_project" class="form-control" name="description" rows="3">{{ isset($project) ? $project['description'] : '' }}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label class="col-lg-3 col-form-label form-control-label"></label>
									<div class="col-lg-9">
										<a href="{{ route('admin.projects') }}" id="cancel_changes" class="btn btn-secondary"><i class="fas fa-arrow-circle-left"></i> Back</a>
										<input type="button" id="apply_project_changes" name="apply_project_changes" class="btn btn-primary" value="{{ $active_page == 'New project' ? 'Create' : 'Update' }}">
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