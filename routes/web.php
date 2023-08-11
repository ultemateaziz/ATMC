<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StaffController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//this route used for the index.blade.php default calling
Route::get('/', function () {
    return view('index');
})->name('home');

// we use same login page for both portals
Route::get('/login/{id}',function($id){
    if($id == 1)
        $user = "STAFF";
    else
        $user = "STUDENT";
    return view('auth.login',compact('user'));
});

Route::post('/login-action', [LoginController::class, 'login']);

Route::middleware(['auth'])->group(function (){


    Route::middleware(['staff:1'])->group(function (){

        Route::get('/staff', function (){
            $title = 'Staff';
            return view('staff.staff',compact('title'));
        });

        Route::get('/student_register', [StaffController::class, 'student_register']);
        Route::post('/new_student', [StaffController::class, 'new_student']);
        Route::get('/upload_index', [StaffController::class, 'upload_index']);
        Route::post('/upload_file',[StaffController::class, 'upload_file']);
        Route::get('/view-group',[StaffController::class, 'view_group']);
    });

    Route::middleware(['student:2'])->group(function (){

        /*
        Route::get('/student', function (){
            return view('student.student-form');
        }); */
        Route::get('/student', [StudentController::class, 'index']);
    
        Route::post('/student_save', [StudentController::class, 'save']);
    });


    
});
Route::get('/code', function(){
    return view('code.staffs.team');
});

Route::get('/logout',[LoginController::class, 'logout']);






