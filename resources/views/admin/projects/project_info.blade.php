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
					<div class="col-md-6">
						<div id="uploading_image">
							<div class="upload-msg">
								Upload project photo
							</div>

							<div class="upload-profile-photo-wrap">

							</div>

							<div class="actions col-12">
								<button class="btn btn-secondary file-btn">
									<span>Upload</span>
									<input type="file" id="project_photo" value="Choose a file" accept="image/*" name="upload_file[]"  multiple/>
								</button>
							</div>
						</div>
					</div>
					<form role="form" method="POST" id="project_form" enctype="multipart/form-data" action="{{ isset($project) ? route('admin.edit_project', $project['id']) : route('admin.new_project') }}">

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
									<div class="col-lg-3"></div>
									<div class="form-check col-lg-9">
										<input {!! isset($project) ? $project->display_project == 1 ? 'checked' : '' : '' !!} type="checkbox" name="display_project" class="form-check-input" id="display_project">
										<label  class="form-check-label" for="display_project">Display project</label>
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
<script>
	var files = {};
	files = <?php echo json_encode($files); ?>;
</script>
@endsection