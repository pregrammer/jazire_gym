<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی پروفایل من</title>
    <link rel="icon" href="{{ asset('imgs/site/logo.jpg') }}" />
    <link rel="stylesheet" href="{{ asset('css/header.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/my_profile.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/icon/themify-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
  </head>
  <body>
    @include('header')
    <main>
      <div class="main--content">
        <h5>پروفایل من</h5>
        <form action="{{ route('submit_my_profile') }}" method="post" class="main--form-about">
          @csrf
          <div class="form-row">
            <label>ایمیل:</label>
            <input type="email" name="email" required value="{{auth()->user()->email}}"/>
            <label>نام و نام خانوادگی:</label>
            <input type="text" name="fullName" value="@if ($userdetail){{$userdetail->fullName}}@endif" required />
          </div>
          <div class="form-row">
            <label>کد ملی:</label>
            <input type="number" name="melliCode" value="@if ($userdetail){{$userdetail->melliCode}}@endif" required/>
            <label>شماره تماس:</label>
            <input type="number" name="phoneNumber" value="@if ($userdetail){{$userdetail->phoneNumber}}@endif" required />
          </div>
          <div class="form-row">
            <label>آدرس:</label>
            <textarea name="address" required cols="30" rows="3">@if ($userdetail){{$userdetail->address}}@endif</textarea>
          </div>
          @if (!$isManager)
          <button class="btn btn-success">ویرایش مشخصات</button>
          @endif
        </form>
        <form action="{{ route('change_user_pass') }}" method="post" class="main--form-change-pass">
          @csrf
          <div class="form-row">
            <label>رمز عبور جدید:</label>
            <input type="password" name="password" required />
            <label>تکرار رمز عبور جدید:</label>
            <input type="password" name="password_confirmation" required />
          </div>
          @error('password', 'profile')<small style="font-family: vazir; position: absolute; right: 50%; transform: translateX(50%);" class="text-danger mb-2">{{ $message }}</small>@enderror
          @if (!$isManager)
          <button class="btn btn-warning">ویرایش رمز عبور</button>
          @endif
        </form>
      </div>
    </main>
    @include('footer')
  </body>
</html>
