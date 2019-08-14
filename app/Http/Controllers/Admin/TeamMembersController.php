<?php

namespace App\Http\Controllers\Admin;

use App\Eloquent\Contact;
use Auth;
use Image;
use Illuminate\Http\Request;
use App\Eloquent\TeamMembers;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateTeamMember;
use App\Http\Requests\UpdateTeamMember;

class TeamMembersController extends Controller
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

    public function teamMembers()
    {
        $active_page = 'Team members';
        $nav_bar = 'Team members';
        $members = TeamMembers::select('*')->where('is_deleted', 0)->get()->toArray();
        return view('admin.team_members.team_members', compact('nav_bar', 'active_page', 'members'));
    }

    public function removeMember(Request $request)
    {
        $members = TeamMembers::where('id', $request->member_id)->update(['is_deleted' => 1]);
        if ($members == 1) {
            $result = array('success' => true);
        } else {
            $result = array('success' => false);
        }
        return response()->json($result);
    }

    public function createMemberView(Request $request)
    {
        $nav_bar = 'Team members';
        $active_page = 'New member';
        return view('admin.team_members.member_info', compact('nav_bar', 'active_page'));
    }

    public function createMember(CreateTeamMember $request)
    {
        if($request->isXmlHttpRequest()){

            $member = new TeamMembers;
            $member->full_name = $request->input('full_name');
            $member->role = $request->input('role');
            $member->role = $request->role;
            $member->description = $request->input('description');


            $filename = time().'.jpg';
            $path = '/img/team/'.$filename;
            Image::make(file_get_contents($request->input('photo')))->save(public_path().$path); 
            $member->image=$path;

            $member->save();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editMember(UpdateTeamMember $request, $member_id)
    {
        if($request->isXmlHttpRequest()){

            $member = TeamMembers::find($request->member_id);
            $member->full_name = $request->input('full_name');
            $member->role = $request->input('role');
            $member->description = $request->input('description');

            if ($request->has('photo')) {
                $filename = time().'.jpg';
                $path = '/img/team/'.$filename;
                Image::make(file_get_contents($request->input('photo')))->save(public_path().$path); 
                $member->image=$path;
            }

            $member->update();
            return response()->json(array('success' => true));
        } else {
            return abort(404);
        }
    }

    public function editMemberView(Request $request, $member_id)
    {
        if(count(TeamMembers::where('id', $member_id)->get())>0){
            $member = TeamMembers::where('id', $member_id)->get()->first()->toArray();
            $nav_bar = 'Team members';
            $active_page = 'Update member';
            return view('admin.team_members.member_info', compact('nav_bar', 'active_page', 'member'));
        } else {
            return abort(404);
        }
    }
}
