<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Teacher;
use App\Models\Course;
use App\Models\Module;
use DB;


class PagesController extends Controller
{
    //

    public function home()
    {
        $teachers = Teacher::all();
        $courses = Course::all();
        return View('home', [
            'teachers' => $teachers,
            'courses' => $courses
        ]);
    }

    public function about()
    {
        $teachers = Teacher::all();
        return View('about', [
            'teachers' => $teachers
        ]);
    }

    public function Blog()
    {
        $posts = Post::all();
        $categories = Category::all();
        return View('blog', [
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

    public function PostsByCategory($name)
    {
        $SelectArray = ['id','post_title','post_image','post_category','post_description','created_at'];
        //$posts = Post::all()->where('post_category', $name)->get($SelectArray);
        $posts = DB::table('posts')->select($SelectArray)->where('post_category',$name)->latest()->get();
        //echo $posts;
        return View('PostsByCategory', [
            'posts' => $posts
        ]);
    }

    public function SinglePost($id)
    {
        $post = Post::all()->where('id', $id);
        return View('single-post', [
            'posts' => $post
        ]);
    }

    public function SearchForm()
    {
        $query = request('query');

        $SelectArray = ['id','post_title','post_image','post_category','post_description','created_at'];

        $posts = DB::table('posts')->select($SelectArray)->whereIn('post_title',[$query])->get();

        return View('SearchResults',[
            'posts' => $posts
        ]);
    }

    public function teachers()
    {
        $teachers = Teacher::all();
        return View('teachers', [
            'teachers' => $teachers
        ]);
    }

    public function courses()
    {
        $courses = Course::all();
        return View('courses',[
            'courses' => $courses
        ]);
    }

    
    public function PreviewCourse($id)
    {
        //ini_set('max_execution_time', 360); //3 minutes
        $course = Course::all()->where('id',$id);
        $course_name = Course::select('name')->where('id',$id)->first()->name;

        $modules = Module::all()->where('course_title', $course_name);

        return View('single-course', [
            'courses' => $course,
            'modules' =>$modules
        ]);
    }
}
