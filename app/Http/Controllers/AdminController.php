<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use App\Models\Message;
use App\Models\Question;
use App\Models\Teacher;
use App\Models\Field;
use App\Models\Evaluator;
use App\Models\Student;
use App\Models\Course;

// namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // main page
    public function index()
    {
        //$name = auth()->user()->name;
        if(Auth::check()){
            $name = auth()->user()->name;
            return view('AdminBody',['name'=>$name]);
        }
        
        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function CreatePost()
    {
        $categories = Category::all();
        return View('admin.create-post',[
            'categories'=> $categories,
        ]);
    }

    public function CreateCategory()
    {
        return View('admin.create-category');
    }

    public function CreateFAQ()
    {
        return View('admin.create-faq');
    }

    public function CreateField()
    {
        return View('admin.create-field');
    }

    public function CreateEvaluator()
    {
        $fields = Field::all();
        return View('admin.create-evaluator',[
            'fields'=>$fields,
        ]);
    }


    public function ViewPosts()
    {
        $posts = Post::all();
        return View('admin.view-posts', [
            'posts' => $posts,
        ]);
    }


    public function ViewCategories()
    {
        $categories = Category::all();
        return View('admin.view-categories', [
            'categories' => $categories,
        ]);
    }

    public function ViewMessages()
    {
        $messages = Message::all();
        return View('admin.view-messages', [
            'messages'=> $messages,
        ]);
    }

    public function ViewFAQs()
    {
        $faqs = Question::all();
        return View('admin.view-faqs', [
            'faqs'=>$faqs,
        ]);
    }

    public function ViewTeachers()
    {
        $teachers = Teacher::all();
        return View('admin.view-teachers', [
            'teachers'=>$teachers,
        ]);
    }

    public function ViewFields()
    {
        $fields = Field::all();
        return View('admin.view-fields', [
            'fields'=>$fields,
        ]);
    }

    public function ViewEvaluators()
    {
        $evaluators = Evaluator::all();
        return View('admin.view-evaluators', [
            'evaluators' => $evaluators,
        ]);
    }

    public function ViewStudents()
    {
        $students = Student::all();
        return View('admin.view-students', [
            'students' => $students,
        ]);
    }

    public function ViewCourses()
    {
        $courses = Course::all();
        return View('admin.view-courses', [
            'courses' => $courses,
        ]);
    }


    // save post to the database
    public function SavePost(Request $request)
    {
        $post = new Post();
        $post->post_title = request('title');
        //$post->post_image = request('image');
        $post->post_category = request('category');
        $post->post_description = request('description');
        $post->post_image = $request->file('image')->hashName();

        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            // store iamge in local storage
            $file->store('public/images/post');
        }
        // get image name

        
        $post->save();
        return redirect('/ViewPosts');
    }

    public function EditPost($id)
    {
        $edit = Post::all()->where('id',$id);
        $categories = Category::all();
        return View('admin.edit-post',[
            'posts' => $edit,
            'categories' => $categories
        ]);
    }

    public function UpdatePost($id, Request $request)
    {
        $post = Post::find($id);

        $post->post_title =  $request->get('title');
        $post->post_category =  $request->get('category');
        $post->post_description = $request->get('description');

        if(isset($_FILES['image']))
        {
            $file = $request->file('image');
            if(!empty($file))
            {
                $post->post_image = $request->file('image')->hashName();    
                $file = $request->file('image');
                // store image in local storage
                $file->store('public/images/post');
            }   
        }

        // if ($request->file('image')->isValid()) {
        //     $file = $request->file('image');
        //     // store image in local storage
        //     $file->store('public/images/post');
        // }

        $post->save();

        return redirect('/ViewPosts');
    }


    public function SaveCategory()
    {
        $category = new Category();

        $category->category_name = request('title');
        $category->category_description = request('description');
        $category->save();

        return redirect('/admin');
    }

    public function SaveFAQ()
    {
        $faq = new Question();

        $faq->question = request('question');
        $faq->answer = request('answer');

        $faq->save();

        return redirect('/ViewFAQs');
    }

    public function SaveField()
    {
        $field = new Field();

        $field->name = request('name');
        $field->description = request('description');

        $field->save();

        return redirect('/ViewFields');
    }

    public function SaveEvaluator()
    {
        $evaluator = new Evaluator();

        $evaluator->name = request('name');
        $evaluator->email = request('email');
        $evaluator->bio = request('bio');
        $evaluator->field = request('field');

        // laravel auth uses bcrypt password
        $obtained_password = request('password');
        $evaluator->password = bcrypt($obtained_password);
        
        $evaluator->save();

        return redirect('/ViewEvaluators');
    }

    public function EditField($id)
    {
        $edit = Field::all()->where('id', $id);
        return View('admin.edit-field', [
            'fields' => $edit
        ]);
    }

    public function UpdateField(Request $request,$id)
    {
        $field = Field::find($id);
        $field->name = $request->get('name');
        $field->description = $request->get('description');
        
        $field->save();

        return redirect('/ViewFields');
    }

    public function EditCategory($id)
    {
        $edit = Category::all()->where('id', $id);
        return View('admin.edit-category',[
            'categories' => $edit
        ]);
    }

    public function UpdateCategory(Request $request, $id)
    {
        $category = Category::find($id);

        $category->category_name = $request->get('name');
        $category->category_description = $request->get('description');
        
        $category->save();

        return redirect('ViewCategories');
    }

    public function EditFaq($id)
    {
        $edit = Question::all()->where('id',$id);
        return View('admin.edit-faq', [
            'faqs' => $edit
        ]);
    }

    // This function will update the FAQ from edit form
    public function UpdateFaq(Request $request, $id)
    {

        $question = Question::find($id);
        // Getting values from the blade template form
        $question->question =  $request->get('question');
        $question->answer = $request->get('answer');
        
        $question->save();
    
        return redirect('ViewFAQs')->with('success','User updated successfully');
    }


    public function DeletePost($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect('/ViewPosts');
    }

    public function DeleteCategory($id)
    {
        $category = Category::findOrFail($id);

        $CategoryName = Category::select('category_name')->where('id',$id)->first()->category_name;

        $posts = Post::all()->where('post_category', $CategoryName)->first();

        if($posts != null)
        {
            return View('errors.CategoryDelete');
        }

        $category->delete();

        return redirect('/ViewCategories');
    }

    public function DeleteMessage($id)
    {
        $message = Message::findOrFail($id);
        $message->delete();

        return redirect('/ViewMessages');
    }

    public function DeleteFAQ($id)
    {
        $faq = Question::findOrFail($id);
        $faq->delete();

        return redirect('/ViewFAQs');
    }

    public function DeleteTeacher($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        return redirect('/ViewTeachers');
    }

    public function DeleteEvaluator($id)
    {
        $evaluator = Evaluator::findOrFail($id);
        $evaluator->delete();

        return redirect('/ViewEvaluators');
    }


}
