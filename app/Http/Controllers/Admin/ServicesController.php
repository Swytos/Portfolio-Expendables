<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use App\Eloquent\Services;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateService;
use App\Http\Requests\UpdateService;

class ServicesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function services()
    {
        $nav_bar = 'Services';
        $active_page = 'Services';
        $services = [];
        $services = Services::select('*')->where('is_deleted', 0)->get()->toArray();
        return view('admin.services.services', compact('nav_bar', 'active_page', 'services'));
    }

    public function createServiceView(Request $request)
    {
        $nav_bar = 'Services';
        $active_page = 'New service';
        return view('admin.services.service_info', compact('nav_bar', 'active_page'));
    }

    public function createService(CreateService $request)
    {
        if ($request->isXmlHttpRequest()) {

            $service = new Services;

            $service->icon = $request->input('icon');
            $service->name = $request->input('name');
            $service->description = $request->input('description');

            $service->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editService(UpdateService $request, $service_id)
    {
        if($request->isXmlHttpRequest()){

            $service = Services::find($request->service_id);
            $service->name = $request->input('name');
            $service->icon = $request->input('icon');
            $service->description = $request->input('description');


            $service->update();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editServiceView(Request $request, $service_id)
    {
        $nav_bar = 'Services';
        $active_page = 'Update service';
        $service = Services::where('id', $service_id)->get()->first()->toArray();
        return view('admin.services.service_info', compact('nav_bar', 'active_page', 'service'));
    }

    public function removeService(Request $request)
    {
//        dd($request->all());
        $service = Services::where('id', $request->service_id)->update(['is_deleted' => 1]);
        if ($service == 1) {
            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }
        return response()->json($result);
    }
}
