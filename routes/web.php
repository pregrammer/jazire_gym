<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('index');
});
*/

Route::get('/',  [IndexController::class, 'index'])->name('index');
Route::get('/inside-gym-courses',  [IndexController::class, 'inside_gym_courses'])->name('inside_gym_courses');
Route::get('/outside-gym-courses',  [IndexController::class, 'outside_gym_courses'])->name('outside_gym_courses');



Route::get('/login',  [UserController::class, 'index_login'])->name('login');
Route::post('/login',  [UserController::class, 'login'])->name('login_user');
Route::get('/register',  [UserController::class, 'index_register'])->name('register');
Route::post('/register',  [UserController::class, 'register'])->name('register_user');
Route::get('/user-account/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/my-profile',  [UserController::class, 'index_my_profile'])->name('my_profile');
Route::get('/user-profile/{user_id}',  [UserController::class, 'user_profile'])->name('user_profile');
Route::post('/my-profile/submit',  [UserController::class, 'submit_my_profile'])->name('submit_my_profile');
Route::post('/my-profile/change-pass',  [UserController::class, 'change_user_pass'])->name('change_user_pass');

Route::get('/my-courses',  [UserController::class, 'index_my_courses'])->name('my_courses');

Route::get('/courses/add-credit/{order_id}',  [CourseController::class, 'add_credit_to_course'])->name('add_credit_to_course');



Route::get('/course-detail/{course_id}',  [CourseController::class, 'index_detail'])->name('course_detail');
Route::get('/submit-course/{course_id?}',  [CourseController::class, 'index_submit'])->name('submit_course');
Route::post('/course/add',  [CourseController::class, 'add_course'])->name('add_course');
Route::post('/course/edit/{course_id}',  [CourseController::class, 'edit_course'])->name('edit_course');
Route::get('/course/delete/{course_id}',  [CourseController::class, 'delete_course'])->name('delete_course');

Route::get('/course/order/{course_id}',  [CourseController::class, 'order_course'])->name('order_course');



Route::get('/management',  [ManagementController::class, 'index'])->name('management')->middleware('auth');
Route::get('/management/course-athlete/{course_id}',  [ManagementController::class, 'show_course_athletes'])->name('show_course_athletes');

Route::get('/course/order/delete/{order_id}',  [ManagementController::class, 'delete_order'])->name('delete_order');
