<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use Auth;
use Image;
use Illuminate\Http\Request;
use App\Eloquent\Projects;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateProject;
use App\Http\Requests\UpdateProject;

class ProjectsController extends Controller
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

    public function projects()
    {
        $nav_bar = 'Projects';
        $active_page = 'Projects';
        $projects = [];
        $projects = Projects::select('*')->where('is_deleted', 0)->get()->toArray();
        return view('admin.projects.projects', compact('nav_bar', 'active_page', 'projects'));
    }

    public function removeProject(Request $request)
    {
        $projects = Projects::where('id', $request->project_id)->update(['is_deleted' => 1]);
        if ($projects == 1) {
            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }
        return response()->json($result);
    }

    public function createProjectView(Request $request)
    {
        $nav_bar = 'Projects';
        $active_page = 'New project';
        return view('admin.projects.project_info', compact('nav_bar', 'active_page'));
    }

    public function createProject(CreateProject $request)
    {
        if($request->isXmlHttpRequest()){

            $project = new Projects;
            $project->name = $request->input('name');
            $project->url = $request->input('url');
            $project->team_size = $request->input('team_size');
            $project->platform = $request->input('platform');
            $project->skills = $request->input('skills');
            $project->timeline = $request->input('timeline');
            $project->description = $request->input('description');


            $filename = time().'.jpg';
            $path = '/img/projects/'.$filename;
            Image::make(file_get_contents($request->input('image')))->save(public_path().$path);
            $project->image=$path;

            $project->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editProject(UpdateProject $request, $project_id)
    {
        if($request->isXmlHttpRequest()){

            $project = Projects::find($request->project_id);
            $project->name = $request->input('name');
            $project->url = $request->input('url');
            $project->team_size = $request->input('team_size');
            $project->platform = $request->input('platform');
            $project->skills = $request->input('skills');
            $project->timeline = $request->input('timeline');
            $project->description = $request->input('description');

            if ($request->has('image')) {
                $filename = time().'.jpg';
                $path = '/img/projects/'.$filename;
                Image::make(file_get_contents($request->input('image')))->save(public_path().$path); 
                $project->image=$path;
            }

            $project->update();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editProjectView(Request $request, $project_id)
    {
        $nav_bar = 'Projects';
        $active_page = 'Update project';
        $project = Projects::where('id', $project_id)->get()->first()->toArray();
        return view('admin.projects.project_info', compact('nav_bar', 'active_page', 'project'));
    }
}
