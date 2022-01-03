<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی اصلی</title>
    <link rel="icon" href="imgs/site/logo.jpg" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="css/icon/themify-icons.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    @include('header')
    <main>
      <div class="container">
        @forelse ($courses as $course)
        <a href="{{ route('course_detail', ['course_id'=>$course->id]) }}" class="main--course-box">
          <div class="main--course-box-content">
            <h3>{{$course->name}}</h3>
            <div></div>
            <p>مربی: {{$course->coachName}}</p>
            <p>{{$course->schedule}}</p>
            <p>ویژه ی {{$course->for ? 'بانوان' : 'آقایان'}}</p>
          </div>
        </a>
        @empty
            <div class="no-courses">
              <p>!به مجموعه ورزشی جزیره خوش آمدید</p>
              <p>.فعلا دوره ای برای نمایش وجود ندارد</p>
            </div>
        @endforelse
        
        <span class="main--course-links">
          {{ $courses->links() }}
        </span>
      </div>
    </main>
    @include('footer')
  </body>
</html>
