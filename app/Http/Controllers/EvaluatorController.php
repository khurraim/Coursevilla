<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hash;
use Session;
use App\Models\Teacher;
use App\Models\Evaluator;
use Illuminate\Support\Facades\Auth;
//use Mail;
use Illuminate\Support\Facades\Mail;

class EvaluatorController extends Controller
{
    //

    public function AssignedTeachers()
    {
        // Getting Evaluators field from auth
        $EvaluatorField = Auth::guard('evaluator')->user()->field;

        // getting teachers from same field as evaluator
        $AssignedTeachersList = Teacher::all()->where('field',$EvaluatorField)->where('approved',0);

        return View('AssignedTeachers', [
            'AssignedTeachers' => $AssignedTeachersList
        ]);
    }

    public function SendEmail()
    {
        // Getting Evaluators field from auth
        $EvaluatorField = Auth::guard('evaluator')->user()->field;

        // getting teachers from same field as evaluator
        $AssignedTeachersList = Teacher::select('email')->where('field',$EvaluatorField)->get();
        return View('SendEmail', [
            'AssignedTeachersList' => $AssignedTeachersList
        ]);
    }

    public function SendMailProcess()
    {
        $name = request('name');
        $email = request('email');
        $subject = request('subject');
        $body = request('body');

        $data = array(
            'name' => $name,
            'subject' => $subject,
            'body' => $body
        );

        Mail::send('mail',$data,function($message) use($email,$subject,$body)  {
            $message->to($email)->subject($subject);
        });
    }

    public function CheckData()
    {
        $name = request('name');
        $email = request('email');
        $subject = request('subject');
        $body = request('body');

        return $email;
    }

    public function ViewEvaluatorsAll()
    {
        $evaluators = Evaluator::all();
        return View('view-evaluators-all', [
            'evaluators' => $evaluators,
        ]);
    }

    public function ApproveTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->update(['approved'=>1]);
        return redirect('/AssignedTeachers');
    }

    // public function ForgetPassword()
    // {
    //     return View('auth.EvaluatorForgetPassword');
    // }

    // public function SendReset()
    // {
    //     // Checking if account exists
    //     $email = request('email');

    //     $evaluator = Evaluator::all()->where('email',$email);
    //     $evaluatorCount = count($evaluator);

    //     if($evaluatorCount == 0)
    //     {
    //         return 'No account associated with this email was found';
    //     } else {
    //         $name = Evaluator::select('name')->where('email',$email)->get();
    //         $id = Evaluator::select('id')->where('email',$email)->get();
    //         //$EvaluatorEmail = Evaluator::all()->where('email',$email);
    //         $EvaluatorEmail = Evaluator::select('email')->where('email',$email)->first();
    //         $subject = "Evaluator Account Password Reset";
    //         $data = array(
    //             'name' => $name,
    //             'subject' => $subject,
    //             'email' => $EvaluatorEmail
    //         );
    
    //         Mail::send('EvaluatorResetBody',$data,function($message) use($email,$subject)  {
    //             $message->to($email)->subject($subject);
    //         });

    //         return redirect('/CheckResetEmail');
    //     }
    // }

    // public function CheckResetEmail()
    // {
    //     return View('CheckResetEmail');
    // }

    // public function ResetPasswordPage($id)
    // {
    //     $EvaluatorEmail = Evaluator::select('email')->where('id',$id);
    //     return View('ResetPasswordPage', [
    //         'email' => $EvaluatorEmail
    //     ]);
    // }

    // public function ResetEvaluatorPassword($mail)
    // {

    //     $Password = request('Password');
    //     $ConfirmPassword = request('ConfirmPassword');

    //     if($Password != $ConfirmPassword)
    //     {
    //         return 'Passwords do not match!!';
    //     }

    //     $evaluator = Evaluator::findOrFail($mail);
    //     $password = request('password');
    //     $evaluator->update(['password'=>bcrypt($password)]);

    //     return Redirect('/EvaluatorLoginPage');
    // }



}
