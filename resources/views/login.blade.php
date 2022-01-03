<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی ورود</title>
    <link rel="icon" href="imgs/site/logo.jpg" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <main style="@if (session('status')) height: 77vh; @endif @error('email', 'login') height: 67vh; @enderror">
      <div class="logo">
        <img src="imgs/site/logo.jpg" alt="logo" />
      </div>
      <form action="{{ route('login_user') }}" method="post">
       @csrf

       @if (session('status'))
        <div class="alert alert-danger mb-3 text-center" role="alert">
            {{ session('status') }}
        </div>
      @endif

        <label for="">ایمیل:</label>
        <input type="email" style="@error('email', 'login') margin-bottom: 0.5rem; @enderror" name="email" value="@error('email', 'login') {{old('email')}} @enderror @error('password', 'login') {{old('email')}} @enderror" class="@error('email', 'login') border border-danger @enderror"/>
        @error('email', 'login') <small class="text-danger mb-2">{{ $message }}</small> @enderror

        <label for="">رمز عبور:</label>
        <input type="password" style="@error('password', 'login') margin-bottom: 0.5rem; @enderror" name="password" class="@error('password', 'login') border border-danger @enderror"/>
        @error('password', 'login') <small class="text-danger mb-2">{{ $message }}</small> @enderror

        <input type="submit" class="btn btn-success" value="ورود" />
      </form>
      <div class="buttom-of-form">
        <a href="{{ route('register') }}">ثبت نام</a><span>حساب کاربری ندارید؟</span>
      </div>
    </main>
  </body>
</html>
