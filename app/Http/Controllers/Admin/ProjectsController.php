<?php

namespace App\Http\Controllers\Admin;


use App\Eloquent\ProjectImages;
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
        $projects = Projects::all();
        return view('admin.projects.projects', compact('nav_bar', 'active_page', 'projects'));
    }

    public function removeProject(Request $request)
    {
        $project_images = ProjectImages::where('projects_id', $request->project_id);
        foreach ($project_images->get() as $image){
            unlink(public_path($image->image_path));
        }
        $project_images->delete();
        $projects = Projects::where('id', $request->project_id)->delete();
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
        $files['old'] = 0;
        return view('admin.projects.project_info', compact('nav_bar', 'active_page','files'));
    }

    public function createProject(CreateProject $request)
    {
        if($request->isXmlHttpRequest()){

            $project = new Projects;
            $project->name = $request->input('name');
            $project->url = $request->input('url');
            $project->description = $request->input('description');
            $project->display_project = $request->display_project;
            $project->save();
            if ($request->has('fileNew')) {
                foreach($request->fileNew as $file){
                    $filename = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
                    $filename = $filename.'.jpg';
                    $path = '/img/projects/'.$filename;
                    Image::make(file_get_contents($file))->save(public_path().$path);
                    $project_images = new ProjectImages();
                    $project_images->projects_id = $project->id;
                    $project_images->image_path = $path;
                    $project_images->save();
                }
            }
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
            $project->description = $request->input('description');
            $project->display_project = $request->display_project;
            if ($request->has('fileOld')){
                ProjectImages::where('projects_id', $request->project_id)->whereNotIn('image_path',$request->fileOld)->delete();
            } else {
                ProjectImages::where('projects_id', $request->project_id)->delete();
            }
            if ($request->has('fileNew')) {
                foreach($request->fileNew as $file){
                    $filename = substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(10/strlen($x)) )),1,10);
                    $filename = $filename.'.jpg';
                    $path = '/img/projects/'.$filename;
                    Image::make(file_get_contents($file))->save(public_path().$path);
                    $project_images = new ProjectImages();
                    $project_images->projects_id = $request->project_id;
                    $project_images->image_path = $path;
                    $project_images->save();
                }
            }

            $project->update();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editProjectView(Request $request, $project_id)
    {
        if(count(Projects::where('id', $project_id)->get())>0){
        $nav_bar = 'Projects';
        $active_page = 'Update project';
        $project = Projects::where('id', $project_id)->get()->first();
        $images = $project->projectImages->toArray();
        if (count($images) > 0){
            foreach($images as $image){
                $file[$image['id']] = $image['image_path'];
            }
            $files['old'] = $file;
        } else {
            $files['old'] = 0;
        }


        return view('admin.projects.project_info', compact('nav_bar', 'active_page', 'project', 'files'));
        } else {
            return abort(404);
        }
    }
}
