<?php

namespace App\Http\Controllers;

use App\Eloquent\Contact;
use App\Http\Requests\CreateContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function mailContact(CreateContact $request)
        
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['company'] = $request->company;
        $data['mes'] = $request->message;
        Mail::send('emails.contact', $data, function ($message) use ($data){
            $message->from($data['email']);
            $message->to('testto@test.com');
        });

        $data = new Contact;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['company'] = $request->company;
        $data['message'] = $request->message;
        $data['status'] = 1;
        $data->save();
        return response()->json(['success' => true]);
    }
}
