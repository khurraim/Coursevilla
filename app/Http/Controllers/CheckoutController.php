<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Teacher;
use App\Models\Course;
use App\Models\CourseComposite;

use Stripe\Stripe;
use Stripe\OAuth;

class CheckoutController extends Controller
{
    public function checkout()
    {   
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51MWRsCDRY9dPJdGdrOikJ3AcdQSwg2hG28iUmEnd6qZiAGa72jxwkewtjNE6kDxW2wWNabkOLdPnKvZPW8QLqr2t00mnSBIj2q');

        		
		$amount = 100;
		$amount *= 100;
        $amount = (int) $amount;
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $amount,
			'currency' => 'USD',
			'description' => 'Payment From All About Laravel',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;

		return view('checkout.credit-card',compact('intent'));

    }

    public function afterPayment()
    {
        echo 'Payment Received, Thanks you for using our services.';
    }

    public function connect(Request $request)
    {
         // Step 2: Initiate the Stripe Connect OAuth process
        $authorize_request_body = [
            'response_type' => 'code',
            'scope' => 'read_write',
            //'client_id' => env('STRIPE_CLIENT_ID'),
            'client_id' => 'ca_NKdmR26Gv5qOEORFr1zkX0fHshqxeAfs',
            //'redirect_uri' => env('STRIPE_REDIRECT_URI'),
            'redirect_uri' => 'http://127.0.0.1:8000/stripe/connect/callback'
        ];
        $url = OAuth::authorizeUrl($authorize_request_body);
        return redirect($url);
    }

    public function StripeCallback(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51MWRsCDRY9dPJdGdrOikJ3AcdQSwg2hG28iUmEnd6qZiAGa72jxwkewtjNE6kDxW2wWNabkOLdPnKvZPW8QLqr2t00mnSBIj2q');

        \Stripe\Stripe::setClientId('ca_NKdmR26Gv5qOEORFr1zkX0fHshqxeAfs');

         // Step 4: Request an access token from Stripe
        $token_request_body = [
            'grant_type' => 'authorization_code',
            'client_id' => env('STRIPE_CLIENT_ID'),
            'code' => $request->code,
            'client_secret' => env('STRIPE_API_KEY'),
        ];

        $token_response = OAuth::token($token_request_body);
        $access_token = $token_response['access_token'];
    
        // Step 5: Retrieve the account ID
        $stripe_account = \Stripe\Account::retrieve($access_token);
        $account_id = $stripe_account->id;

        // Gett Current Teacher
        $TeacherId = auth()->guard('teacher')->user()->id;

        $CurrentTeacher = Teacher::find($TeacherId);

        $CurrentTeacher->stripe_account_id = $account_id;
        $CurrentTeacher->payment_setup = 1;

        $CurrentTeacher->save();

        return redirect('/TeacherPanel');
    }

    public function BuyCourse($id)
    {
        $CourseTeacherEmail = Course::all()->where('id',$id)->first()->tutor_email;
        $TeacherAccountId = Teacher::all()->where('email',$CourseTeacherEmail)->first()->stripe_account_id;

        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51MWRsCDRY9dPJdGdrOikJ3AcdQSwg2hG28iUmEnd6qZiAGa72jxwkewtjNE6kDxW2wWNabkOLdPnKvZPW8QLqr2t00mnSBIj2q');

        $courses = Course::select('id','name')->where('id',$id)->get();
        		
		$amount = Course::all()->where('id', $id)->first()->price;
		$amount *= 100;
        $amount = (int) $amount;

        // Teacher Commision
        $TeacherCommision = $amount*0.8;    // 80%

        // System Commision
        $AdminCommision = $amount*0.2;    //20%
        
        $payment_intent = \Stripe\PaymentIntent::create([
			'description' => 'Stripe Test Payment',
			'amount' => $AdminCommision,
			'currency' => 'USD',
			'description' => 'Payment From All About Laravel',
			'payment_method_types' => ['card'],
		]);
		$intent = $payment_intent->client_secret;
        
        // Create a transfer object
        $transfer = \Stripe\Transfer::create(array(
            "amount" => $TeacherCommision, // amount in cents
            "currency" => "usd",
            "destination" => $TeacherAccountId,
            "description" => "Payment for services"
        ));

        if(!$transfer)
        {
            echo 'Transfer Failed !!!';
        }

		return view('checkout.buy-course',compact('intent'), [
            'price' => $amount,
            'courses' => $courses
        ]);
    }


    public function SaveCourse(Request $request)
    {
        $CourseComposite = new CourseComposite();

        $CourseComposite->user_fid = Auth::guard('student')->user()->id;
        $CourseComposite->course_name = request('course_name');

        $CourseComposite->save();

        return redirect('/StudentPanel');
        
    }
}


