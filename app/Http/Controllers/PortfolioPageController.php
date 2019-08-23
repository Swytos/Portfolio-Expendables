<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Eloquent\About;
use App\Eloquent\Projects;
use App\Eloquent\Services;
use App\Eloquent\TeamMembers;

class PortfolioPageController extends Controller
{    
	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$not_show_header = true;
		$projects = Projects::where('display_project', 1)->get();
		$members = TeamMembers::select('*')->where('is_deleted', 0)->get()->toArray();
		$services = Services::select('*')->where('is_deleted', 0)->get()->toArray();
		$about = About::select('*')->where('is_deleted', 0)->get()->toArray();
		return view('portfolio/main', compact('not_show_header', 'members', 'projects', 'services','about'));
	}

	public function getProject(Request $request, $project_id)
    {
        $not_show_header = true;
        $project = Projects::where('id', $project_id)->first();
	    return view('portfolio/project', compact('not_show_header','project'));
    }
}
