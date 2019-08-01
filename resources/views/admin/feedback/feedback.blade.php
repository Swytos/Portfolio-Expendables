@extends('admin.main')
@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <i class="fas fa-table"></i>
            Feedback
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="feedback" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Message</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($feedbacks as $feedback)
                        <tr feedback-id="{{ $feedback['id'] }}">
                            @if ($feedback['status'] == 1)
                            <th><span class="badge badge-pill badge-success">New</span></th>
                            @else
                                <th><span class="badge badge-pill badge-secondary">Read</span></th>
                            @endif
                            <th>{{ $feedback['name'] }} </th>
                            <th>{{ $feedback['email'] }}</th>
                            <th>{{ $feedback['company'] }}</th>
                            @if (strlen($feedback['message']) > 155)
                                <th>{{ substr($feedback['message'], 0, 155) }} . . .</th>
                            @else
                                <th>{{$feedback['message']}}</th>
                            @endif
                            <th>
                                <a href="{{  route(('admin.preview_feedback') , ['id' => $feedback['id']]) }}" class="btn btn-secondary"><i class="fas fa-eye"></i></a>
                                <button type="button" class="btn btn-danger remove_feedback"><i class="fas fa-trash-alt"></i></button>
                            </th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
       </div>
    </div>
@endsection
@push('modals')
    @include('admin.feedback.remove_feedback_modal')
@endpush