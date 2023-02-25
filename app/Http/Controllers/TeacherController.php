<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use App\Models\Field;
use App\Models\Course;
use App\Models\Module;

//use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class TeacherController extends Controller
{
    //
    public function RegisterPage()
    {
        $fields = Field::all();
        return View('register-teacher',[
            'fields' => $fields,
        ]);
    }

    public function SaveTeacher(Request $request)
    {
        $teacher = new Teacher();

        $teacher->name = request('name');
        $teacher->email = request('email');

        $password = request('password');
        $teacher->password = bcrypt($password);

        $teacher->dob = request('dob');
        $teacher->gender = request('gender');
        $teacher->field = request('field');
        $teacher->bio = request('bio');
        $teacher->image = $request->file('image')->hashName();

        $request->file('image')->store('public/images/teacher');

        $teacher->save();

        return redirect('/');
    }

    public function CreateCourse()
    {
        if(auth()->guard('teacher')->user()->approved != 1)
        {
            return redirect('/TeacherPanel');
        }
        return View('teacher.create-course');
    }

    public function ViewCourses()
    {
        $teacher_email = auth()->guard('teacher')->user()->email;
        $courses = Course::all()->where('tutor_email', $teacher_email);

        if(auth()->guard('teacher')->user()->approved != 1)
        {
            return redirect('/TeacherPanel');
        }
        return View('teacher.view-courses', [
            'courses' => $courses
        ]);
    }

    public function ViewModules()
    {
        $teacher_email = auth()->guard('teacher')->user()->email;
        $modules = Module::all()->where('teacher_email', $teacher_email);

        if(auth()->guard('teacher')->user()->approved != 1)
        {
            return redirect('/TeacherPanel');
        }

        return View('teacher.view-modules', [
            'modules' => $modules
        ]);
    }

    public function SaveCourse(Request $request)
    {

        set_time_limit(0);

        $course = new Course();
        $course->name = request('name');
        $course->description = request('description');
        $course->image = $request->file('image')->hashName();
        $course->preview_video = cloudinary()->uploadVideo($request->file('preview_video')->getRealPath())->getSecurePath();
        $course->price = request('price');
        $course->requirements = request('requirements');
        $course->scope = request('scope');

        $teacher_name = auth()->guard('teacher')->user()->name;
        $teacher_email = auth()->guard('teacher')->user()->email;

        // Adding dummy data to last 2 coloumns
        $course->tutor_name = $teacher_name;
        $course->tutor_email = $teacher_email;

        // moving image to storage folder
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            // store iamge in local storage
            $file->store('public/images/course');
        }

        $course->save();


       // $response = cloudinary()->upload($request->file('preview_video')->getRealPath())->getSecurePath();
       //$response = cloudinary()->uploadVideo($request->file('preview_video')->getRealPath())->getSecurePath();

        //dd($response);

        return back()
            ->with('success', 'File uploaded successfully');
    }


    public function SaveModule(Request $request)
    {
        set_time_limit(0);

        $module = new Module();
        $module->name = request('name');
        $module->short_description = request('description');
        $module->video_link = cloudinary()->uploadVideo($request->file('video')->getRealPath())->getSecurePath();
        $module->course_title = request('course');
        $module->teacher_email = auth()->guard('teacher')->user()->email;

        $module->save();

        return redirect('/ViewModules');
    }

    public function CreateModule()
    {
        $teacher_email = auth()->guard('teacher')->user()->email;
        $teacher_courses = Course::all()->where('tutor_email', $teacher_email);

        if(auth()->guard('teacher')->user()->approved != 1)
        {
            return redirect('/TeacherPanel');
        }
        
        return View('teacher.create-module', [
            'courses' => $teacher_courses
        ]);        
    }
}
