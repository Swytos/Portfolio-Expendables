@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Categories
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="categories" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Categories</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($categories as $category)
                        <tr category-id="{{ $category->id }}">
                            <th>{{ $category->category }}</th>
                            <th>
                                <a href="{{ route('admin.edit_category',['id' => $category->id]) }}" class="btn btn-secondary edit_project"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger remove_category"><i class="fas fa-trash-alt"></i></button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.new_category') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Categories</a>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.blog.categories.remove_category_modal')
@endpush