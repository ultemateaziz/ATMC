<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Upload;
use App\Models\Project;
use App\Models\Project_Status;
use Illuminate\Support\Facades\Auth;


class StaffController extends Controller
{
    public function student_register()
    {
        return view('staff.student_registration');
    }

    public function new_student(Request $request)
    {
        $request->validate([
            'email' => ['required','unique:users,email'],
            'password' => ['required'],
            'confirm_password' => ['required','same:password']
        ]);

        $user = new User();
        $user->email = $request->input('email');
        $user->role = 'student';
        $user->user_level = 2;
        $user->password = bcrypt($request->input('password'));
        $user->save();

        if($user->id){
            return 'success';
        }else{
            return 'error';
        }
        
    }

    public function upload_index()
    {
        return view('staff.upload_index');
    }

    public function upload_file(Request $request)
    {
        request()->validate([
            'upld_file'  => 'required|mimes:doc,docx,pdf,txt|max:2048',
        ]);
    
        $upload = new Upload;

        if ($request->upld_file) {
            $imageName = time(). date('d') .'.'. request()->upld_file->getClientOriginalExtension();
            $request->upld_file->move(public_path('pdf'), $imageName);
            $upload->upload_file = $imageName;
        }
        $upload->file_name = $request->input('file_name','');
        $upload->uploaded_by = Auth::user()->id;
        $upload->save();

        if($upload->id)
        {
            return 'success';
        }else{
            return 'error';
        }
    }

    public function view_group()
    {
        $project_list = Project::leftJoin('project_statuses','project_statuses.project_id','projects.id')->select('project_id','project_name','assigned_student')->where('project_id','!=',NULL)->groupBy('project_statuses.project_id','projects.project_name','project_statuses.assigned_student')->get()->groupBy('project_name');
    
        $final = $project_list->transform(function ($item){
            return $item->pluck('assigned_student');
        });
    
        return view('staff.team',compact('final'));
    }
}
