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
		$projects = Projects::select('*')->where('is_deleted', 0)->get()->toArray();
		$members = TeamMembers::select('*')->where('is_deleted', 0)->get()->toArray();
		$services = Services::select('*')->where('is_deleted', 0)->get()->toArray();
		$about = About::select('*')->where('is_deleted', 0)->get()->toArray();
		return view('portfolio/main', compact('not_show_header', 'members', 'projects', 'services','about'));
	}
}
