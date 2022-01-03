<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>صفحه ی ثبت نام</title>
    <link rel="icon" href="imgs/site/logo.jpg" />
    <link rel="stylesheet" href="css/register.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <main>
      <div class="logo">
        <img src="imgs/site/logo.jpg" alt="logo" />
      </div>
      <form action="{{ route('register_user') }}" method="post">
        @csrf

        <label for="">ایمیل:</label>
        <input type="email" style="@error('email', 'register') margin-bottom: 0.5rem; @enderror" name="email" value="@error('email', 'register') {{old('email')}} @enderror @error('password', 'register') {{old('email')}} @enderror" class="@error('email', 'register') border border-danger @enderror"/>
        @error('email', 'register') <small class="text-danger mb-2">{{ $message }}</small> @enderror

        <label for="">رمز عبور:</label>
        <input type="password" style="@error('password', 'register') margin-bottom: 0.5rem; @enderror" name="password" class="@error('password', 'register') border border-danger @enderror"/>
        @error('password', 'register') <small class="text-danger mb-2">{{ $message }}</small> @enderror

        <label for="">تکرار رمز عبور:</label>
        <input type="password" name="password_confirmation" class="@error('password_confirmation', 'register') border border-danger @enderror"/>

        <input type="submit" class="btn btn-success" value="ثبت نام" />
      </form>
    </main>
  </body>
</html>
