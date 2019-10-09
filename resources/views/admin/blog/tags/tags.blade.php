@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Tags
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="tags" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tag</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tags as $tag)
                        <tr tag-id="{{ $tag->id }}">
                            <th>{{ $tag->tag_name }}</th>
                            <th>
                                <a href="{{ route('admin.edit_tag', ['id' => $tag->id]) }}" class="btn btn-secondary edit_tag"><i class="fas fa-edit"></i></a>
                                <button type="button" class="btn btn-danger remove_tag"><i class="fas fa-trash-alt"></i></button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.new_tag') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Tag</a>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.blog.tags.remove_tag_modal');
@endpush