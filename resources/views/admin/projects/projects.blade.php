@extends('admin.main')
@section('content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Projects
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="projects" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Name</th>
						<th>Url</th>
						<th>Description</th>
						<th>Image</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($projects as $project)
					<tr project-id="{{ $project['id'] }}">
						<th>{{ $project['name'] }}</th>
						<th>{{ $project['url'] }}</th>
						@if (strlen($project['description']) > 155)
							<th>{{ substr($project['description'], 0, 155) }} . . .</th>
						@else
							<th>{{ $project['description'] }}</th>
						@endif
						<th>
							@foreach($project->projectImages as $image)
							<img style="max-height: 50px; max-width: 50px;"  src="{{ $image->image_path }}"/>
							@endforeach
						</th>
						<th>
							<a href="{{ route('admin.edit_project', ['id' => $project['id']]) }}" class="btn btn-secondary edit_project"><i class="fas fa-edit"></i></a> 
							<button type="button" class="btn btn-danger remove_project"><i class="fas fa-trash-alt"></i></button>
						</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<a href="{{ route('admin.new_project') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Project</a>
	</div>
</div>
@endsection
@push('modals')
	@include('admin.projects.remove_projects_modal')
@endpush