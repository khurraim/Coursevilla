<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
//use Hash;
use Session;
use App\Models\Student;
use App\Models\StudentVerify;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class StudentAuthController extends Controller
{
    //
    public function index()
    {
        return View('auth.StudentLogin');
    }

    public function StudentRegisterPage()
    {
        return View('auth.StudentRegister');
    }

    public function StudentRegister(Request $request)
    {
        // Model Instance
        $student = new Student();

        // Model Parameters
        $student->name = request('name');
        $student->email = request('email');
        $student->description = request('description');
        $student->password = bcrypt(request('password'));    // encrypting the password
        $student->image = $request->file('image')->hashName();    // unique filename

        // saving file in storage
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            // store iamge in local storage
            $file->store('public/images/student');
        }

        // saving in db
        $student->save();

        return redirect("StudentLoginPage");

    }

    public function StudentLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('student')->attempt($credentials)) {
            return redirect()->intended('StudentPanel')
                        ->withSuccess('Signed in');
        }

        return redirect("StudentLoginPage")->withSuccess('Login details are not valid');

    }

    public function StudentDashboard()
    {
        if(Auth::guard('student')->check()){
            
            $name = Auth::guard('student')->user()->name;
            $email = Auth::guard('student')->user()->email;

            return view('StudentPanel');
        }
    }

    public function StudentSignOut()
    {
        Session::flush();
        Auth::guard('student')->logout();
  
        return Redirect('StudentLoginPage');
    }

    public function ShowForgetPasswordForm()
    {
        return View('auth.StudentForgetPassword');
    }

    public function SubmitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:students',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('mail.StudentForgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function ShowResetPasswordForm($token)
    {
        return View('auth.StudentForgetPasswordLink', ['token' => $token]);
    }

    public function SubmitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:students',
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
  
          $user = Student::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/StudentLoginPage')->with('message', 'Your password has been changed!');
    }

    public function StudentPostRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:students',
            //'password' => 'required|min:6',
            'description' => 'required|min:6',
            'image' =>  ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);
           
        $data = $request->all();
        //$createUser = $this->create($data);
        //$createUser = Student::create($data);

        $createUser = new Student();
        $createUser->name = request('name');
        $createUser->password = bcrypt(request('password'));
        $createUser->email = request('email');
        $createUser->description = request('description');

        $createUser->save();

        
  
        $token = Str::random(64);
  
        StudentVerify::create([
              //'user_id' => $createUser->id, 
              'student_id' => $createUser->id,  
              'token' => $token
            ]);
  
        Mail::send('mail.StudentEmailVerificationEmail', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Student Verification Mail');
          });
         
        return redirect("StudentDashboard")->withSuccess('Great! You have Successfully loggedin');
    }

    public function verifyAccount($token)
    {
        $verifyStudent = StudentVerify::select('student_id')->where('token', $token)->first()->student_id;

        //echo $verifyStudent;
  
        $message = 'Sorry your email cannot be identified.';
  
        if($verifyStudent){

            $id = Student::select('id')->where('id', $verifyStudent)->first()->id;
            $student = Student::findOrFail($id);
            $student->update(['is_email_verified'=>1]);

        }
        return redirect('/StudentLoginPage');
      //return redirect()->route('/StudentLoginPage')->with('message', $message);
    }

}
