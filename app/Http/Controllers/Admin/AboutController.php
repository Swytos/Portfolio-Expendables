<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use Image;
use App\Eloquent\About;
use App\Http\Requests\CreateAbout;
use App\Http\Requests\UpdateAbout;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function about()
    {
        $nav_bar = 'About';
        $active_page = 'About';
        $about = [];
        $about = About::select('*')->where('is_deleted', 0)->get()->toArray();
        return view('admin.about.about', compact('nav_bar', 'active_page', 'about'));
    }

    public function createAboutView(Request $request)
    {
        $nav_bar = 'About';
        $active_page = 'New about';
        return view('admin.about.about_info', compact('nav_bar', 'active_page'));
    }

    public function createAbout(CreateAbout $request)
    {
        if($request->isXmlHttpRequest()){

            $about = new About;
            $about->name = $request->input('name');
            $about->date = $request->input('date');
            $about->description = $request->input('description');


            $filename = time().'.jpg';

            $path = '/img/about/'.$filename;

            Image::make(file_get_contents($request->input('photo')))->save(public_path().$path);
            $about->image=$path;
            $about->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editAboutView(Request $request, $about_id)
    {
        if(count(About::where('id', $about_id)->get())>0){
            $nav_bar = 'About';
            $active_page = 'Update about';
            $about = About::where('id', $about_id)->get()->first()->toArray();
            return view('admin.about.about_info', compact('nav_bar', 'active_page', 'about'));
        } else {
            return abort(404);
        }
    }
    public function editAbout(UpdateAbout $request, $about_id)
    {
        if($request->isXmlHttpRequest()){

            $about = About::find($request->about_id);
            $about->name = $request->input('name');
            $about->date = $request->input('date');
            $about->description = $request->input('description');

            if ($request->has('photo')) {
                $filename = time().'.jpg';
                $path = '/img/about/'.$filename;
                Image::make(file_get_contents($request->input('photo')))->save(public_path().$path);
                $about->image=$path;
            }

            $about->update();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }
    public function removeAbout(Request $request)
    {
        $about = About::where('id', $request->about_id)->update(['is_deleted' => 1]);
        if ($about == 1) {
            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }
        return response()->json($result);
    }
}
