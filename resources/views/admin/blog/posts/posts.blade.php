@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Posts
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="posts" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
{{--                        {{ dd($post->postImages) }}--}}
                    <tr post-id="{{ $post->id }}">
                        <th>{{ $post->post_title }}</th>
                        <th>{{ substr($post->post_content, 0, 150) }}</th>
                        <th>{{ $post->post_category }}</th>
                        <th>
                        @foreach ($post->postTags as $postTag)
                                <a href="" class="badge badge-secondary">{{ $postTag->tag->tag_name }}</a>
                        @endforeach
                        </th>
                        <th>
                            <a href="{{ route('admin.edit_post', ['id' => $post->id]) }}" class="btn btn-secondary edit_post"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger remove_post"><i class="fas fa-trash-alt"></i></button>
                        </th>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <a href="{{ route('admin.new_post') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Add Post</a>
        </div>
    </div>
@endsection
@push('modals')
    @include('admin.blog.posts.remove_post_modal')
@endpush