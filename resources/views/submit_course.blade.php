<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ی ثبت مشخصات دوره</title>
    <link rel="icon" href="{{ asset('imgs/site/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('css/submit_course.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
</head>
<body>
    <header>
        <h5>صفحه ی ثبت مشخصات دوره</h5>
    </header>
    <main>
        <div class="main--content">
            <h5>فرم مشخصات دوره :</h5>
            <form action="@if ($course_detail) {{ route('edit_course', ['course_id'=>$course_id]) }} @else {{ route('add_course') }} @endif" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <label>نام دوره:</label>
                    <input type="text" name="name" value="@if($course_detail){{$course_detail->name}}@endif" required>
                </div>
                <div class="form-row">
                    <label>درباره ی دوره:</label>
                    <textarea name="about" required cols="30" rows="10">@if($course_detail){{$course_detail->about}}@endif</textarea>
                </div>
                <div class="form-row">
                    <label>عکس پیش زمینه:</label>
                    <input type="file" name="bgcImage" @if(!$course_detail) required @endif>
                </div>
                <div class="form-row">
                    <label>نام مربی:</label>
                    <input type="text" name="coachName" value="@if($course_detail){{$course_detail->coachName}}@endif" required>
                </div>
                <div class="form-row">
                    <label>عکس مربی:</label>
                    <input type="file" name="coachImage" @if(!$course_detail) required @endif>
                </div>
                <div class="form-row">
                    <label>برنامه ی زمانی:</label>
                    <input type="text" name="schedule" value="@if($course_detail){{$course_detail->schedule}}@endif" required>
                </div>
                <div class="form-row">
                    <label>ویژه ی:</label>
                    <select name="for">
                        <option value="0" @if($course_detail && $course_detail->for == false) selected @endif>آقایان</option>
                        <option value="1" @if($course_detail && $course_detail->for == true) selected @endif>بانوان</option>
                    </select>
                </div>
                <div class="form-row">
                    <label>آدرس برگزاری:</label>
                    <textarea name="address" required cols="30" rows="5">@if($course_detail){{$course_detail->address}}@endif</textarea>
                </div>
                <div class="form-row">
                    <label>شهریه ی ماهیانه:</label>
                    <input type="number" name="pricePerMonth" value="@if($course_detail){{$course_detail->pricePerMonth}}@endif" required>
                </div>
                <div class="form-row">
                    <label>محیط ورزشی:</label>
                    <label for="s">داخل سالن</label>
                    <input type="radio" value="0" @if(!$course_detail) checked @else @if($course_detail->isInsideGym) checked @endif @endif id="s" name="gym_env">
                    <label for="f">خارج از سالن</label>
                    <input type="radio" value="1" id="f" @if($course_detail && !$course_detail->isInsideGym) checked @endif name="gym_env">
                </div>
                <button class="btn btn-success">ثبت مشخصات دوره</button>
            </form>
        </div>
    </main>
</body>
</html>