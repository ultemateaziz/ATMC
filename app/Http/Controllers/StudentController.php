<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use App\Models\Project_Status;
use App\Models\Upload;


class StudentController extends Controller
{

    public function index()
    {
        $upload_items = Upload::select('id','upload_file','file_name')->get();
        return view('student.student-form',compact('upload_items'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'gpa' => ['required'],
            'sfia_skill' => ['required'],
            'project_list' => ['required'],
            'student_name' => ['required']
        ]);

        if(Auth::user()->restricted=='Y')
        {
            return 'restricted';
        }

        $user_id = Auth::user()->id;
        $project_req = $request->input('project_list');
        $student_name = $request->input('student_name');
        $second_student = $request->input('second_student','');
        $third_student = $request->input('third_student','');

        $proj_ins = collect($project_req)->map(function ($item,$key) use($student_name,$second_student,$third_student,$user_id){ 
            if($student_name)
            {
                $proj_status = new Project_Status();
                $proj_status->project_id = $item;
                $proj_status->preference = $key+1;
                $proj_status->assigned_student = $student_name;
                $proj_status->assigned_by = $user_id;

                $proj_status->save();
            }

            if($second_student != '')
            {
                $proj_status = new Project_Status();
                $proj_status->project_id = $item;
                $proj_status->preference = $key+1;
                $proj_status->assigned_student = $second_student;
                $proj_status->assigned_by = $user_id;

                $proj_status->save();
            }

            if($third_student != '')
            {
                $proj_status = new Project_Status();
                $proj_status->project_id = $item;
                $proj_status->preference = $key+1;
                $proj_status->assigned_student = $third_student;
                $proj_status->assigned_by = $user_id;

                $proj_status->save();
            }
        });

        
        $student = new Student();
        $student->user_id = $user_id;
        $student->gpa = $request->input('gpa');
        $student->sfia_skill = serialize($request->input('sfia_skill'));
        $student->project_list = serialize($project_req);
        $student->name = $student_name;
        $student->second_name = $second_student;
        $student->third_name = $third_student;

        $student->save();
        // we need to insert project list in DB
        if($student->id){
            User::where('id',$user_id)->update(['restricted' => 'Y']);
            return 'success';
        }else{
            return 'failure';
        }

    }
}
