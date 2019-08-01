@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Services
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="services" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr service-id="{{ $service['id'] }}">
                            <th>{{ $service['name'] }}</th>
                            @if (strlen($service['description']) > 155)
                                <th>{{ substr($service['description'], 0, 155) }} . . .</th>
                            @else
                                <th>{{ $service['description'] }}</th>
                            @endif
                            <th><i class="fas fa-{{ $service['icon'] }} fa-2x"></i></th>
                            <th>
                                <a href="{{ route('admin.edit_service', ['id' => $service['id']]) }}" class="btn btn-secondary edit_project"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger remove_service"><i class="fas fa-trash-alt"></i></button>
                            </th>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.new_service') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Service</a>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.services.remove_service_modal')
@endpush