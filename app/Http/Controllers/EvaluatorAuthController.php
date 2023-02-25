<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Hash;
use Session;
use DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Models\Evaluator;
use Illuminate\Support\Facades\Auth;

class EvaluatorAuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:evaluator');
    // }

    public function index()
    {
        return View('auth.EvaluatorLogin');
    }

    public function EvaluatorLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::guard('evaluator')->attempt($credentials)) {
            return redirect()->intended('EvaluatorDashboard')
                        ->withSuccess('Signed in');
        }

        return redirect("EvaluatorLoginPage")->withSuccess('Login details are not valid');
    }

    public function EvaluatorDashboard()
    {
        //$this->middleware('auth:evaluator');
        if(Auth::guard('evaluator')->check()){
            //$name = auth()->user()->name;
            $name = Auth::guard('evaluator')->user()->name;
            $email = Auth::guard('evaluator')->user()->email;
            $field = Auth::guard('evaluator')->user()->field;
            $bio = Auth::guard('evaluator')->user()->bio;

            return view('EvaluatorPanel',[
                'name' => $name,
                'email' => $email,
                'field' => $field,
                'bio'   => $bio
            ]);
        }
  
        return redirect("EvaluatorLoginPage")->withSuccess('You are not allowed to access');
    }

    public function EvaluatorSignOut()
    {
        Session::flush();
        Auth::guard('evaluator')->logout();
  
        return Redirect('EvaluatorLoginPage');
    }

    public function ShowForgetPasswordForm()
    {
        return View('auth.evaluatorForgetPassword');
    }

    public function SubmitForgetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:evaluators',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert([
            'email' => $request->email, 
            'token' => $token, 
            'created_at' => Carbon::now()
          ]);

        Mail::send('mail.EvaluatorForgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }

    public function ShowResetPasswordForm($token)
    {
        return View('auth.EvaluatorForgetPasswordLink', ['token' => $token]);
    }

    public function SubmitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:evaluators',
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
  
          $user = Evaluator::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/EvaluatorLoginPage')->with('message', 'Your password has been changed!');
    }

}
