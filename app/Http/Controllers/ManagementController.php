<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function index()
    {
        $courses = DB::table('courses')->select('id', 'name')->get();

        $orders = DB::table('orders')->select()->get();
        $names = array();
        $remain_times = array();
        $dates = array();

        foreach ($orders as $order) {
            $names[] = DB::table('users_profiles')->where('user_id', $order->user_id)->select('fullName')->get();

            $startTime = \Carbon\Carbon::parse($order->created_at);
            $endTime = \Carbon\Carbon::now();
            $totalDuration = $endTime->diffInDays($startTime);
            $remain_times[] = $order->dayCount - $totalDuration;

            $dates[] = new Verta($order->created_at);
        }

        return view('management', [
            'courses' => $courses,
            'orders' => $orders,
            'names' => $names,
            'dates' => $dates,
            'remain_times' => $remain_times,
        ]);
    }

    public function show_course_athletes($course_id)
    {
        $courses = DB::table('courses')->select('id', 'name')->get();

        $orders = DB::table('orders')->where('course_id', $course_id)->select()->get();
        $names = array();
        $remain_times = array();
        $dates = array();

        foreach ($orders as $order) {
            $names[] = DB::table('users_profiles')->where('user_id', $order->user_id)->select('fullName')->get();

            $startTime = \Carbon\Carbon::parse($order->created_at);
            $endTime = \Carbon\Carbon::now();
            $totalDuration = $endTime->diffInDays($startTime);
            $remain_times[] = $order->dayCount - $totalDuration;

            $dates[] = new Verta($order->created_at);
        }

        return view('management', [
            'courses' => $courses,
            'orders' => $orders,
            'names' => $names,
            'dates' => $dates,
            'remain_times' => $remain_times,
        ]);
    }

    public function delete_order($order_id)
    {
        DB::table('orders')->where('id', $order_id)->delete();
        
        return back();
    }
}
