@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            About
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="about" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($about as $element)
                        <tr about-id="{{ $element['id'] }}">
                            <th>{{ $element['name'] }}</th>
                            <th>{{ $element['date'] }}</th>
                            @if (strlen($element['description']) > 155)
                                <th>{{ substr($element['description'], 0, 155) }} . . .</th>
                            @else
                                <th>{{ $element['description'] }}</th>
                            @endif
                            <th><img style="max-height: 50px; width: auto;"  src="{{ $element['image'] }}"/></th>
                            <th>
                                <a href="{{ route('admin.edit_about', ['id' => $element['id']]) }}" class="btn btn-secondary edit_project"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger remove_about"><i class="fas fa-trash-alt"></i></button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.new_about') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add About</a>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.about.remove_about_modal')
@endpush