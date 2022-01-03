<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحه ی دوره های من</title>
    <link rel="icon" href="imgs/site/logo.jpg" />
    <link rel="stylesheet" href="css/header.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/my_courses.css" />
    <link rel="stylesheet" href="css/icon/themify-icons.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
</head>
<body>
    @include('header')
    <main>
        <h5>دوره های من :</h5>
        <div class="main--content">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">رشته</th>
                <th scope="col">برنامه</th>
                <th scope="col">تاریخ ثبت نام</th>
                <th scope="col">اعتبار باقیمانده</th>
                <th scope="col">اعمال تغییرات</th>
              </tr>
            </thead>
            <tbody style="vertical-align: middle">

              @forelse ($courses as $course)
              <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$course->name}}</td>
                <td>{{$course->schedule}}</td>
                <td style="font-family: salamat; font-size: 1.4rem">{{$dates[$loop->index]}}</td>
                <td @if ($remain_times[$loop->index] < 0) style="color: red" @endif>{{abs($remain_times[$loop->index])}} روز {{$remain_times[$loop->index] < 0 ? 'گذشته' : ''}}</td>
                <td><a href="{{ route('add_credit_to_course', ['order_id'=>$user_orders[$loop->index]->id]) }}">افزودن یک ماه اعتبار</a></td>
              </tr>
              @empty
                <tr>هیچ دوره ای برای نمایش وجود ندارد</tr>
              @endforelse              
              <tr>
                <td colspan="6">دوره ای برای نمایش وجود ندارد!</td>
              </tr>
            </tbody>
          </table>
        </div>
    </main>
    @include('footer')
</body>
</html>