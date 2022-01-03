<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')->paginate(4);

        return view('index', ['courses' => $courses]);
    }

    public function inside_gym_courses()
    {
        $courses = DB::table('courses')->where('isInsideGym', true)->paginate(4);

        return view('index', ['courses' => $courses]);
    }

    public function outside_gym_courses()
    {
        $courses = DB::table('courses')->where('isInsideGym', false)->paginate(4);

        return view('index', ['courses' => $courses]);
    }

}
