@extends('admin.main')
@section('content')
<div class="card mb-3">
	<div class="card-header">
		<i class="fas fa-table"></i>
		Team
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="team_members" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Full name</th>
						<th>Role</th>
						<th>Description</th>
						<th>Image</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($members as $member)
					<tr member-id="{{ $member['id'] }}">
						<th>{{ $member['full_name'] }}</th>
						<th>{{ $member['role'] }}</th>
						@if (strlen($member['description']) > 155)
							<th>{{ substr($member['description'], 0, 155) }} . . .</th>
						@else
							<th>{{ $member['description'] }}</th>
						@endif
						<th><img height="50px" width="50px" src="{{ asset($member['image'])}}"/></th>
						<th>
							<a href="{{ route('admin.edit_member', ['id' => $member['id']]) }}" class="btn btn-secondary edit_member"><i class="fas fa-edit"></i></a> 
							<button type="button" class="btn btn-danger remove_member"><i class="fas fa-trash-alt"></i></button>
						</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		<a href="{{ route('admin.new_member') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create member</a>
	</div>
</div>
@endsection
@push('modals')
	@include('admin.team_members.remove_member_modal')
@endpush