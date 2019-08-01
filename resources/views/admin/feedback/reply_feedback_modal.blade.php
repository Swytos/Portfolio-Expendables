<!-- Modal -->
<div class="modal fade" id="reply_feedback_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" id="remove_feedback_id" value="0">
            <div class="modal-header">
                <h5 class="modal-title">Reply feedback</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><b>From:</b> {{auth()->user()->email}}</p>
                <p><b>To:</b> {{$feedback[0]['email']}}</p>
                <form id="formReply" action="{{ route('admin.reply_message') }}" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="from" type="text" value="{{auth()->user()->email}}">
                    <input type="hidden" name="to" type="text" value="{{$feedback[0]['email']}}">
                    <h4>Message</h4>
                    <textarea name="messages" id="editor" class="md-textarea form-control" rows="3"></textarea>
                    <h4>Atach file</h4>
                    <div class="input-group my-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                        </div>
                        <div class="custom-file">
                            <input name="file" type="file" class="custom-file-input" id="file" aria-describedby="inputGroupFileAddon01">
                            <label class="custom-file-label" for="file">Choose file</label>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                <button type="button" class="btn btn-primary" id="confirm_reply_feedback">Reply</button>
            </div>
        </div>
    </div>
</div>