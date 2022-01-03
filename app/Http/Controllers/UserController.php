<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index_register()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $messages = [
            'required' => 'پر کردن این فیلد الزامی است.',
            'max:255' => 'طول متن بزرگتر از حد معمول است.',
            'confirmed' => 'رمز عبور و تکرار آن همخوانی ندارد.',
            'email' => 'لطفا ایمیل را به شکل صحیح وارد کنید.',
            'unique' => 'این ایمیل قبلا استفاده شده است.'
        ];

        Validator::make($request->all(), [
            'email' => 'required|unique:users,email|email|max:255',
            'password' => 'required|confirmed'
        ], $messages)->validateWithBag('register');

        DB::table('users')->insert([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            "created_at" =>  \Carbon\Carbon::now()
        ]);

        auth()->attempt($request->only('email', 'password'));

        if (auth()->id() == 1) {
            return redirect('/management');
        } else {
            return redirect('/');
        }
        
    }

    public function index_login()
    {
        return view('login');
    }

    public function login(Request $request)
    {

        $messages = [
            'required' => 'پر کردن این فیلد الزامی است.',
            'email' => 'لطفا ایمیل را به شکل صحیح وارد کنید.'
        ];

        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ], $messages)->validateWithBag('login');

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return back()->with('status', 'ورود نامعتبر!');
        }

        if (auth()->id() == 1) {
            return redirect('/management');
        } else {
            return redirect('/');
        }
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }

    public function index_my_profile()
    {
        $userdetail = DB::table('users_profiles')->where('user_id', auth()->id())->first();
        $isManager = false;

        return view('my_profile', [
            'userdetail' => $userdetail,
            'isManager' => $isManager,
        ]);
    }

    public function user_profile($user_id)
    {
        $userdetail = DB::table('users_profiles')->where('user_id', $user_id)->first();
        $isManager = true;

        return view('my_profile', [
            'userdetail' => $userdetail,
            'isManager' => $isManager,
        ]);
    }

    public function submit_my_profile(Request $request)
    {
        DB::table('users')->where('id', auth()->id())->update([
            'email' => $request->email,
            "updated_at" =>  \Carbon\Carbon::now()
        ]);

        $userdetail = DB::table('users_profiles')->where('user_id', auth()->id())->first();
        if (!$userdetail) { //create
            DB::table('users_profiles')->insert([
                'fullName' => $request->fullName,
                'melliCode' => $request->melliCode,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'user_id' => auth()->id(),
                "created_at" =>  \Carbon\Carbon::now()
            ]);
        } else { //update
            DB::table('users_profiles')->where('user_id', auth()->id())->update([
                'fullName' => $request->fullName,
                'melliCode' => $request->melliCode,
                'phoneNumber' => $request->phoneNumber,
                'address' => $request->address,
                'user_id' => auth()->id(),
                "updated_at" =>  \Carbon\Carbon::now()
            ]);
        }
        return redirect('/');
    }

    public function change_user_pass(Request $request)
    {
        $messages = [
            'confirmed' => 'رمز عبور و تکرار آن همخوانی ندارد.',
        ];

        Validator::make($request->all(), [
            'password' => 'confirmed'
        ], $messages)->validateWithBag('profile');

        DB::table('users')->where('id', auth()->id())->update([
            'password' => Hash::make($request->password),
            "updated_at" =>  \Carbon\Carbon::now()
        ]);

        if (auth()->id() == 1) {
            return redirect('/management');
        } else {
            return redirect('/');
        }
    }

    public function index_my_courses()
    {
        $user_orders = (DB::table('orders')->where('user_id', auth()->id())->select()->get());
        $courses = array();
        $remain_times = array();
        $dates = array();
        if ($user_orders->count()) {
            foreach ($user_orders as $user_order) {
                $courses[] = (DB::table('courses')->where('id', $user_order->course_id)->select('name', 'schedule', 'created_at')->get())[0];

                $startTime = \Carbon\Carbon::parse($user_order->created_at);
                $endTime = \Carbon\Carbon::now();
                $totalDuration = $endTime->diffInDays($startTime);
                $remain_times[] = $user_order->dayCount - $totalDuration;

                $dates[] = new Verta($user_order->created_at);
            }
        }


        return view('my_courses', [
            'courses' => $courses,
            'remain_times' => $remain_times,
            'user_orders' => $user_orders,
            'dates' => $dates,
        ]);
    }

}
