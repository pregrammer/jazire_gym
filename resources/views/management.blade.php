<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی مدیریت</title>
    <link rel="icon" href="{{ asset('imgs/site/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('css/management.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  </head>
  <body>
    <header>
      <a href="{{ route('logout') }}">خروج</a>
      <h5>صفحه ی مدیریت</h5>
    </header>
    <aside>
        <h4>ورزش ها</h4>
        <div class="aside--sports">
          @forelse ($courses as $course)
          <a href="{{ route('show_course_athletes', ['course_id'=>$course->id]) }}">{{$course->name}}<div class="edit-sport"><a href="{{ route('delete_course', ['course_id'=>$course->id]) }}"><i class="ti-trash"></i></a><a href="{{ route('submit_course', ['course_id'=>$course->id]) }}"><i class="ti-pencil"></i></a></div></a>
          @empty
          <p style="color: white; font-family: vazir;">!ورزشی اضافه نکرده اید</p>
          @endforelse
        </div>
        <a href="{{ route('submit_course') }}">( افزودن دوره ی جدید )</a>
        <div class="line"></div>
        <form action="{{ route('change_user_pass') }}" method="post">
          @csrf
          <input type="password" name="password" placeholder="رمز عبور جدید" required>
          <input type="password" name="password_confirmation" placeholder="تکرار رمز عبور جدید" required>
          @error('password', 'profile')<small style="position: absolute; bottom: 2.6rem; color: white; font-size: 11px">{{ $message }}</small>@enderror
          <button>تغییر</button>
        </form>
    </aside>
    <main>
      <div class="main--content">
        <table class="table">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">نام ورزشکار</th>
              <th scope="col">تاریخ ثبت نام</th>
              <th scope="col">اعتبار باقیمانده</th>
              <th scope="col">اعمال تغییرات</th>
            </tr>
          </thead>
          <tbody style="vertical-align: middle">
            @forelse ($orders as $order)
            <tr>
              <th scope="row">{{$loop->index + 1}}</th>
              <td><a href="{{ route('user_profile', ['user_id'=>$order->user_id]) }}" style="text-decoration: none; color: unset;">{{$names[$loop->index][0]->fullName}}</a></td>
              <td style="font-family: salamat; font-size: 1.4rem">{{$dates[$loop->index]}}</td>
              <td @if ($remain_times[$loop->index] < 0) style="color: red" @endif>{{abs($remain_times[$loop->index])}} روز {{$remain_times[$loop->index] < 0 ? 'گذشته' : ''}}</td>
              <td><a href="{{ route('add_credit_to_course', ['order_id'=>$order->id]) }}">افزودن یک ماه اعتبار</a><a href="{{ route('delete_order', ['order_id'=>$order->id]) }}">حذف از دوره</a></td>
            </tr>
            @empty
            <tr>
              <td colspan="5">ورزشکاری ثبت نام نکرده!</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </main>
  </body>
</html>
