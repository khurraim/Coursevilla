<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;

class FAQController extends Controller
{
    //
    public function ViewFAQs()
    {
        $faqs = Question::all();
        return View('faq', [
            'faqs' => $faqs,
        ]);
    }
}
