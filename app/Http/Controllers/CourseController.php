<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function index_detail($course_id)
    {
        $course_detail = (DB::table('courses')->where('id', $course_id)->select()->get())[0];
        $user_profile = DB::table('users_profiles')->where('user_id', auth()->id())->select()->get();
        $user_profile_completed = false;
        if ($user_profile->count()) {
            $user_profile_completed = true;
        }

        $ordered = false;
        $user_order = DB::table('orders')->where('user_id', auth()->id())->where('course_id', $course_id)->select()->get();
        if ($user_order->count()) {
            $ordered = true;
        }

        return view('course_detail', [
            'course_detail' => $course_detail,
            'user_profile_completed' => $user_profile_completed,
            'ordered' => $ordered,
        ]);
    }

    public function index_submit($course_id = null)
    {
        if (auth()->id() != 1) {
            return response('!دسترسی غیر مجاز', 403);
        }

        $course_detail = null;
        if ($course_id) {
            $course_detail = (DB::table('courses')->where('id', $course_id)->select()->get())[0];
        }

        return view('submit_course', [
            'course_detail' => $course_detail,
            'course_id' => $course_id
        ]);
    }

    public function add_course(Request $request)
    {
        if (auth()->id() != 1) {
            return response('!دسترسی غیر مجاز', 403);
        }

        $bgc_name = "1";
        $maxId = DB::table('courses')->where('id', DB::raw("(select max(`id`) from courses)"))->get();
        if ($maxId->count()) {
            $bgc_name = (string)($maxId[0]->id + 1);
        }

        DB::table('courses')->insert([
            'name' => $request->name,
            'about' => $request->about,
            'bgcImage' => $bgc_name . '.' . $request->bgcImage->extension(),
            'coachName' => $request->coachName,
            'coachImage' => $request->coachName . '.' . $request->coachImage->extension(),
            'schedule' => $request->schedule,
            'for' => $request->for == "1" ? true : false,
            'address' => $request->address,
            'pricePerMonth' => $request->pricePerMonth,
            'isInsideGym' => $request->gym_env == "1" ? false : true,
            "created_at" =>  \Carbon\Carbon::now()
        ]);

        $request->bgcImage->move(public_path('imgs/course_bgc'), $bgc_name . '.' . $request->bgcImage->extension());
        $request->coachImage->move(public_path('imgs/coach'), $request->coachName . '.' . $request->coachImage->extension());

        return redirect('/management');
    }

    public function edit_course(Request $request, $course_id)
    {
        if (auth()->id() != 1) {
            return response('!دسترسی غیر مجاز', 403);
        }

        $images = (DB::table('courses')->where('id', $course_id)->select('bgcImage', 'coachImage')->get())[0];

        $newBgcImage = "";
        $newCoachImage = "";

        if ($request->hasFile('bgcImage')) {
            File::delete(public_path('imgs/course_bgc/' . $images->bgcImage));
            $newBgcImage = $course_id . '.' . $request->bgcImage->extension();
            $request->bgcImage->move(public_path('imgs/course_bgc'), $newBgcImage);
        } else { // because we asign "1".ext to bgcImage if there is no course (when we create a course), this else replce "1" to course_id. execpt this, this else is useless.
            $infoPath = pathinfo(public_path('imgs/course_bgc/' . $images->bgcImage));
            $extension = $infoPath['extension'];
            $newBgcImage = $course_id . '.' . $extension;
            rename(public_path('imgs/course_bgc/' . $images->bgcImage), public_path('imgs/course_bgc/' . $newBgcImage));
        }

        if ($request->hasFile('coachImage')) {
            File::delete(public_path('imgs/coach/' . $images->coachImage));
            $newCoachImage = $request->coachName . '.' . $request->coachImage->extension();
            $request->coachImage->move(public_path('imgs/coach'), $newCoachImage);
        } else {
            $infoPath = pathinfo(public_path('imgs/coach/' . $images->coachImage));
            $extension = $infoPath['extension'];
            $newCoachImage = $request->coachName . '.' . $extension;
            rename(public_path('imgs/coach/' . $images->coachImage), public_path('imgs/coach/' . $newCoachImage));
        }


        DB::table('courses')->where('id', $course_id)->update([
            'name' => $request->name,
            'about' => $request->about,
            'bgcImage' => $newBgcImage,
            'coachName' => $request->coachName,
            'coachImage' => $newCoachImage,
            'schedule' => $request->schedule,
            'for' => $request->for == "1" ? true : false,
            'address' => $request->address,
            'pricePerMonth' => $request->pricePerMonth,
            'isInsideGym' => $request->gym_env == "1" ? false : true,
            "updated_at" =>  \Carbon\Carbon::now()
        ]);

        return redirect('/management');
    }

    public function delete_course($course_id)
    {
        if (auth()->id() != 1) {
            return response('!دسترسی غیر مجاز', 403);
        }
        
        $course = (DB::table('courses')->where('id', $course_id)->select('bgcImage', 'coachImage')->get())[0];
        File::delete(public_path('imgs/course_bgc/' . $course->bgcImage));
        File::delete(public_path('imgs/coach/' . $course->coachImage));
        DB::table('courses')->where('id', $course_id)->delete();

        return redirect('/management');
    }

    public function order_course($course_id)
    {
        DB::table('orders')->insert([
            'dayCount' => 30,
            'user_id' => auth()->id(),
            'course_id' => $course_id,
            "created_at" =>  \Carbon\Carbon::now()
        ]);

        return redirect('/my-courses');
    }

    public function add_credit_to_course($order_id)
    {
        
        DB::table('orders')->where('id', $order_id)->increment('dayCount', 30);
        
        DB::table('orders')->where('id', $order_id)->update([
            "updated_at" =>  \Carbon\Carbon::now()
        ]);

        return back();
    }

}
