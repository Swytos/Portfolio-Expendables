<?php

namespace App\Http\Controllers;


use App\Eloquent\Projects;
use App\Eloquent\Services;
use Illuminate\Http\Request;
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
		$members = TeamMembers::where('is_deleted', 0)->get()->toArray();
		$services = Services::where('is_deleted', 0)->get()->toArray();
		return view('portfolio/main', compact('not_show_header', 'members', 'projects', 'services','about'));
	}

	public function getProject(Request $request, $project_id)
    {
        $not_show_header = true;
        $project = Projects::where('id', $project_id)->first();
	    return view('portfolio/project', compact('not_show_header','project'));
    }


    static function closetags($html) {
        preg_match_all('#<(?!meta|img|br|hr|input\b)\b([a-z]+)(?: .*)?(?<![/|/ ])>#iU', $html, $result);
        $openedtags = $result[1];
        preg_match_all('#</([a-z]+)>#iU', $html, $result);
        $closedtags = $result[1];
        $len_opened = count($openedtags);
        if (count($closedtags) == $len_opened) {
            return $html;
        }
        $openedtags = array_reverse($openedtags);
        for ($i=0; $i < $len_opened; $i++) {
            if (!in_array($openedtags[$i], $closedtags)) {
                $html .= '</'.$openedtags[$i].'>';
            } else {
                unset($closedtags[array_search($openedtags[$i], $closedtags)]);
            }
        }
        return $html;
    }
}
