<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function feedback()
    {
        $nav_bar = 'Feedback';
        $active_page = 'Feedback';
        $feedbacks = [];
        $feedbacks = Contact::select('*')->where('is_deleted', 0)->orderBy('status','desc')->get()->toArray();
        return view('admin.feedback.feedback', compact('nav_bar', 'active_page', 'feedbacks'));
    }

    public function createFeedbackView(Request $request, $feedback_id)
    {
        $nav_bar = 'Feedback';
        $active_page = 'Preview feedback';
        Contact::select('*')->where('id', $feedback_id)->update(['status' => 0]);
        $feedback = Contact::select('*')->where('id', $feedback_id)->get()->toArray();
        return view('admin.feedback.feedback_info', compact('nav_bar', 'active_page', 'feedback'));
    }

    public function removeFeedback(Request $request)
    {
        $feedback = Contact::where('id', $request->feedback_id)->update(['is_deleted' => 1]);
        if ($feedback == 1) {
            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }
        return response()->json($result);
    }

    public function replyMessage(Request $request)
    {
        dd($request->all());
        if($request->messages === null){
            return response()->json(array('success'=>false));
        } else {
            $data['messages'] = $request->messages;
            $data['from'] = $request->from;
            $data['to'] = $request->to;
            Mail::send('emails.reply', $data, function ($message) use ($data){
                $message->from($data['from']);
                $message->to($data['to']);
            });
            return response()->json(array('success'=>true));
        }
    }
}
