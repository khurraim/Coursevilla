<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PagesController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\EvaluatorController;

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EvaluatorAuthController;
use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\TeacherAuthController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\TeacherForgotPasswordController;

use App\Http\Controllers\CheckoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PagesController::class, 'home']);

// teacher register route
// Route::get('/register-teacher', function() {
//     return View('register-teacher');
// });

// blog page
// Route::get('/blog',function() {
//     return View('blog');
// });

Route::get('/blog', [PagesController::class, 'blog']);
Route::get('/Post/{id}', [PagesController::class, 'SinglePost']);
Route::get('/teachers',[PagesController::class, 'teachers']);
Route::get('/courses',[PagesController::class, 'courses']);
Route::get('/about',[PagesController::class, 'about']);
Route::get('/PostByCategory/{name}',[PagesController::class, 'PostsByCategory']);
Route::post('/Search', [PagesController::class, 'SearchForm']);

Route::get('/PreviewCourse/{id}', [PagesController::class, 'PreviewCourse']);

// contact page
Route::get('/contact',function() {
    return View('contact');
});

// Checking Student/Teacher Panel
Route::get('/CheckStudent',function() {
    return View('index');
});

// faqs page
Route::get('/faqs', [FAQController::class, 'ViewFAQs']);

Route::get('register-teacher', [TeacherController::class, 'RegisterPage']);

// admin panel
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/CreatePost', [AdminController::class, 'CreatePost']);
Route::get('/CreateCategory', [AdminController::class, 'CreateCategory']);
Route::get('/CreateFAQ', [AdminController::class, 'CreateFAQ']);
Route::get('/CreateField', [AdminController::class, 'CreateField']);
Route::get('/CreateEvaluator', [AdminController::class, 'CreateEvaluator']);

Route::get('/ViewCategories', [AdminController::class, 'ViewCategories']);
Route::get('/ViewPosts', [AdminController::class, 'ViewPosts']);
Route::get('/ViewMessages', [AdminController::class, 'ViewMessages']);
Route::get('/ViewFAQs', [AdminController::class, 'ViewFAQs']);
Route::get('/ViewTeachers', [AdminController::class, 'ViewTeachers']);
Route::get('/ViewFields', [AdminController::class, 'ViewFields']);
Route::get('/ViewEvaluators', [AdminController::class, 'ViewEvaluators']);
Route::get('/ViewStudents', [AdminController::class, 'ViewStudents']);
Route::get('/ViewCoursesAll', [AdminController::class, 'ViewCourses']);

Route::post('/CreatePost', [AdminController::class, 'SavePost']);
Route::post('/CreateCategory', [AdminController::class, 'SaveCategory']);
Route::post('/SaveMessage', [MessageController::class, 'SaveMessage']);
Route::post('/SaveFAQ', [AdminController::class, 'SaveFAQ']);
Route::post('/SaveCategory', [AdminController::class, 'SaveCategory']);
Route::post('/SaveField', [AdminController::class, 'SaveField']);
Route::post('/SaveTeacher', [TeacherController::class, 'SaveTeacher']);
Route::post('/SaveEvaluator', [AdminController::class, 'SaveEvaluator']);

// edit form
Route::resource('faqs', AdminController::class);
Route::get('EditFaq/{id}', [AdminController::class, 'EditFaq']);
Route::post('UpdateFaq/{id}', [AdminController::class, 'UpdateFaq']);

Route::get('EditCategory/{id}', [AdminController::class ,'EditCategory']);
Route::post('UpdateCategory/{id}', [AdminController::class, 'UpdateCategory']);

Route::get('EditField/{id}',[AdminController::class, 'EditField']);
Route::post('UpdateField/{id}',[AdminController::class, 'UpdateField']);

Route::get('EditPost/{id}',[AdminController::class, 'EditPost']);
Route::post('UpdatePost/{id}',[AdminController::class,'UpdatePost']);


Route::post('/DeletePost/{id}', [AdminController::class, 'DeletePost']);
Route::post('/DeleteMessage/{id}', [AdminController::class, 'DeleteMessage']);
Route::post('/DeleteFAQ/{id}', [AdminController::class, 'DeleteFAQ']);
Route::post('/DeleteTeacher/{id}', [AdminController::class, 'DeleteTeacher']);
Route::post('/DeleteField/{id}', [AdminController::class, 'DeleteField']);
Route::post('/DeleteEvaluator/{id}', [AdminController::class, 'DeleteEvaluator']);
Route::post('/DeleteCategory/{id}', [AdminController::class, 'DeleteCategory']);


Route::post('/EditCategory/{id}', [AdminController::class, 'EditCategory']);

// admin panel
// Route::get('/create-post',function() {
//     return View('create-post');
// });



// Admin Panel Auth Routes
Route::get('dashboard', [AdminAuthController::class, 'dashboard']); 
Route::get('login', [AdminAuthController::class, 'index'])->name('login');
Route::post('custom-login', [AdminAuthController::class, 'customLogin'])->name('login.custom'); 
Route::post('post-login', [AdminAuthController::class, 'postLogin'])->name('login.post'); 
Route::get('registration', [AdminAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [AdminAuthController::class, 'customRegistration'])->name('register.custom'); 
Route::post('post-registration', [AdminAuthController::class, 'postRegistration'])->name('register.post'); 
Route::get('signout', [AdminAuthController::class, 'signOut'])->name('signout');


// Email Verify Registration (Admin)
Route::get('dashboard', [AdminAuthController::class, 'dashboard'])->middleware(['auth', 'is_verify_email']); 
Route::get('/acount/verify/{token}', [AdminAuthController::class, 'verifyAccount'])->name('user.verify'); 


// Admin Panel Foeget Password Routes
Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Evaluator Panel Auth Routes
Route::get('EvaluatorDashboard', [EvaluatorAuthController::class, 'EvaluatorDashboard']); 
Route::get('EvaluatorLoginPage', [EvaluatorAuthController::class, 'index']); 
Route::post('evaluator-login', [EvaluatorAuthController::class, 'EvaluatorLogin'])->name('EvaluatorLogin'); 
Route::get('EvaluatorSignout', [EvaluatorAuthController::class, 'EvaluatorSignOut'])->name('EvaluatorSignout');




// Evaluator Panel Links
Route::get('AssignedTeachers',[EvaluatorController::class, 'AssignedTeachers']);
Route::get('SendEmail',[EvaluatorController::class,'SendEmail']);
Route::post('SendEmail', [EvaluatorController::class, 'SendMailProcess']);
Route::post('CheckData', [EvaluatorController::class, 'CheckData']);
Route::get('ViewEvaluatorsAll', [EvaluatorController::class, 'ViewEvaluatorsAll']);
Route::post('ApproveTeacher/{id}', [EvaluatorController::class, 'ApproveTeacher']);
// Route::get('EvaluatorForgetPassword',[EvaluatorController::class, 'ForgetPassword']);
// Route::post('EvaluatorSendReset',[EvaluatorController::class, 'SendReset']);
// Route::get('CheckResetEmail', [EvaluatorController::class, 'CheckResetEmail']);
// Route::get('ResetPasswordPage/{mail}', [EvaluatorController::class, 'ResetPasswordPage']);
// Route::get('ResetEvaluatorPassword/{mail}',[EvaluatorController::class, 'ResetEvaluatorPassword']);
// Teachers Panel


// Students Auth Route
//Route::get('StudentDashboard', [StudentAuthController::class, 'StudentDashboard']); 
Route::get('StudentLoginPage', [StudentAuthController::class, 'index']); 
Route::get('StudentRegister', [StudentAuthController::class, 'StudentRegisterPage']);
Route::post('StudentRegister', [StudentAuthController::class, 'StudentRegister']);
Route::post('student-login', [StudentAuthController::class, 'StudentLogin'])->name('StudentLogin'); 
Route::post('student-post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('StudentSignout', [StudentAuthController::class, 'StudentSignOut'])->name('StudentSignout');
Route::get('StudentPanel', [StudentAuthController::class, 'StudentDashboard']); 


// Student Verify Email Routes
Route::post('student-post-registration', [StudentAuthController::class, 'StudentPostRegistration'] )->name('StudentRegister.post');
Route::get('StudentDashboard', [StudentAuthController::class, 'StudentDashboard'])->middleware(['auth', 'is_verify_student_email']); 
Route::get('account/verify-student/{token}', [StudentAuthController::class, 'verifyAccount'])->name('student.verify'); 


// Teacher Auth Route
Route::get('TeacherLoginPage', [TeacherAuthController::class, 'index']); 
//Route::get('StudentRegister', [TeacherAuthController::class, 'StudentRegisterPage']);
//Route::post('TeacherRegister', [TeacherAuthController::class, 'StudentRegister']);
Route::post('teacher-login', [TeacherAuthController::class, 'TeacherLogin'])->name('TeacherLogin');
Route::get('TeacherSignout', [TeacherAuthController::class, 'TeacherSignOut']);
Route::get('TeacherPanel', [TeacherAuthController::class, 'TeacherDashboard']);


// Teacher Panel Links
Route::get('CreateCourse', [TeacherController::class, 'CreateCourse']); // Create Course Form
Route::get('ViewCourses',[TeacherController::class, 'ViewCourses']);
Route::post('SaveCourse',[TeacherController::class, 'SaveCourse']); // Save Course
Route::get('/CreateModule', [TeacherController::class, 'CreateModule']);
Route::post('/SaveModule', [TeacherController::class, 'SaveModule']);
Route::get('ViewModules',[TeacherController::class, 'ViewModules']);

Route::get('TeacherChangeProfile',[TeacherAuthController::class, 'ProfileChange']);
Route::post('UpdateTeacher/{id}',[TeacherAuthController::class, 'UpdateTeacher']);

// Teacher Forget Password Routes
Route::get('TeacherForgetPassword', [TeacherAuthController::class, 'ShowForgetPasswordForm']);
Route::post('teacher-forget-password', [TeacherAuthController::class, 'SubmitForgetPasswordForm']); 
Route::get('teacher-reset-password/{token}', [TeacherAuthController::class, 'ShowResetPasswordForm'])->name('reset.teacher-password.get');
Route::post('teacher-reset-password', [TeacherAuthController::class, 'SubmitResetPasswordForm'])->name('reset.teacher-password.post');


// Evaluator Forget Password Routes
Route::get('EvaluatorForgetPassword', [EvaluatorAuthController::class, 'ShowForgetPasswordForm']);
Route::post('evaluator-forget-password', [EvaluatorAuthController::class, 'SubmitForgetPasswordForm']); 
Route::get('evaluator-reset-password/{token}', [EvaluatorAuthController::class, 'ShowResetPasswordForm'])->name('reset.evaluator-password.get');
Route::post('evaluator-reset-password', [EvaluatorAuthController::class, 'SubmitResetPasswordForm'])->name('reset.evaluator-password.post');

// Student Forget Password Routes
Route::get('StudentForgetPassword', [StudentAuthController::class, 'ShowForgetPasswordForm']);
Route::post('student-forget-password', [StudentAuthController::class, 'SubmitForgetPasswordForm']); 
Route::get('student-reset-password/{token}', [StudentAuthController::class, 'ShowResetPasswordForm'])->name('reset.student-password.get');
Route::post('student-reset-password', [StudentAuthController::class, 'SubmitResetPasswordForm'])->name('reset.student-password.post');


// Change Passwords
Route::get('/TeacherChangePassword',[TeacherAuthController::class, 'ChangePassword']);
Route::post('/UpdateTeacherPassword',[TeacherAuthController::class, 'UpdatePassword']);
Route::get('/AdminChangePassword', [AdminAuthController::class, 'ChangePassword']);
Route::post('/UpdateAdminPassword',[AdminAuthController::class, 'UpdatePassword']);

// Payment Routes
Route::get('checkout',[CheckoutController::class, 'checkout']);
Route::post('checkout',[CheckoutController::class, 'afterpayment'])->name('checkout.credit-card');

// Stripe Payment Setup Route in Teacher's Panel
Route::post('/stripe/connect',[CheckoutController::class, 'connect']);
Route::get('/stripe/connect/callback',[CheckoutController::class, 'StripeCallback']);

// Buy Course Button
Route::get('/BuyCourse/{id}',[CheckoutController::class, 'BuyCourse']);
Route::post('/BuyCourse',[CheckoutController::class, 'SaveCourse'])->name('checkout.course');