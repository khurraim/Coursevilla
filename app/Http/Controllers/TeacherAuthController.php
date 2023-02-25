<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Str;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Teacher;
use App\Models\Field;

class TeacherAuthController extends Controller
{
    //
    public function index()
    {
        return View('auth.TeacherLogin');
    }

    public function TeacherLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('teacher')->attempt($credentials)) {
            return redirect()->intended('TeacherPanel')
                        ->withSuccess('Signed in');
        }

        return redirect("TeacherLoginPage")->withSuccess('Login details are not valid');

    }

    public function TeacherDashboard()
    {
        if(Auth::guard('teacher')->check()){
            
            $name = Auth::guard('teacher')->user()->name;
            $email = Auth::guard('teacher')->user()->email;

            return view('TeacherPanel');
        }
    }

    public function ChangePassword()
    {
        return View('auth.TeacherChangePassword');
    }

    public function UpdatePassword(Request $request)
    {
        $NewPassword = request('new-password');
        $ConfirmPassword = request('confirm-password');

        if($NewPassword != $ConfirmPassword)
        {
            return View('errors.PasswordNoMatch');
        }
        
        $TeacherID = Auth::guard('teacher')->user()->id;

        $Teacher = Teacher::findOrFail($TeacherID);
        $Teacher->password = Hash::make($request->get('new-password'));
        $Teacher->save();

        return redirect('/TeacherPanel');

    }

    public function ProfileChange()
    {
        $id = Auth::guard('teacher')->user()->id;
        $teacher = Teacher::all()->where('id', $id);
        $fields = Field::all();
        return View('auth.TeacherProfileChange', [
            'teachers' => $teacher,
            'fields' => $fields
        ]);
    }

    public function UpdateTeacher($id, Request $request)
    {
        $teacher = Teacher::find($id);
        $teacher->name = request('name');
        $teacher->bio = request('bio');
        $teacher->field = request('field');

        if(isset($_FILES['image']))
        {
            $file = $request->file('image');
            if(!empty($file))
            {
                $teacher->image = $request->file('image')->hashName();    
                $file = $request->file('image');
                // store image in local storage
                $file->store('public/images/teacher');
            }   
        }

        $teacher->save();

        return redirect('/TeacherPanel');
    }

    public function TeacherSignOut()
    {
        Session::flush();
        Auth::guard('teacher')->logout();
  
        return Redirect('TeacherLoginPage');
    }

    public function ShowForgetPasswordForm()
    {
        return View('auth.teacherForgetPassword');
    }

    public function SubmitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:teachers',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('mail.TeacherForgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function ShowResetPasswordForm($token)
    {
        return View('auth.TeacherForgetPasswordLink', ['token' => $token]);
    }

    public function SubmitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:teachers',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = Teacher::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/TeacherLogin')->with('message', 'Your password has been changed!');
    }


}
