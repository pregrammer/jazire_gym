<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی جزئیات دوره</title>
    <link rel="icon" href="{{ asset('imgs/site/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/course_detail.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  </head>
  <body>
    @include('header')
    <main>
      <div class="main--top" style="background-image: url({{ asset('imgs/course_bgc/' . $course_detail->bgcImage) }});">
        <div class="main--top-content">
          <h6>نام دوره:</h6>
          <p>{{$course_detail->name}}</p>
          <h6>درباره ی دوره:</h6>
          <p>
            {{$course_detail->about}}
          </p>
        </div>
      </div>
      <div class="main--down">
        <h3>مشخصات :</h3>
        <div class="main--down-course-info">
          <img src="{{ asset('imgs/coach/' . $course_detail->coachImage) }}" alt="coach_image">
          <div class="course-info-row">
            <label>نام مربی:</label>
            <div>{{$course_detail->coachName}}</div>
          </div>
          <div class="course-info-row">
            <label>برنامه:</label>
            <div>{{$course_detail->schedule}}</div>
          </div>
          <div class="course-info-row">
            <label>ویژه:</label>
            <div>{{$course_detail->for ? 'بانوان' : 'آقایان'}}</div>
          </div>
          <div class="course-info-row">
            <label>مکان:</label>
            <div>{{$course_detail->address}}</div>
          </div>
          <div class="course-info-row">
            <label>شهریه:</label>
            <div>ماهیانه {{$course_detail->pricePerMonth}} هزار تومان</div>
          </div>
        </div>
      </div>
      @auth
      @if ($user_profile_completed)
      @if ($ordered)
      <a href="{{ route('my_courses') }}" style="opacity: 0.6">شما در این دوره ثبت نام کرده اید. جهت تمدید آن کلیک کنید</a>
      @else
      <a href="{{ route('order_course', ['course_id'=>$course_detail->id]) }}">ثبت نام</a>
      @endif
      @else
      <a href="{{ route('my_profile') }}" style="opacity: 0.6">برای ثبت نام لطفا ابتدا مشخصات خود را تکمیل کنید</a>
      @endif
      @endauth
      @guest
          <a href="{{ route('login') }}" style="opacity: 0.6">برای ثبت نام لطفا ابتدا وارد شوید</a>
      @endguest
    </main>
    @include('footer')
  </body>
</html>
