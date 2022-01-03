<header>
    <div class="header--top">
      <span class="header-top--icons">
        <a href="#"><i class="ti-facebook"></i></a>
        <a href="#"><i class="ti-instagram"></i></a>
        <a href="#"><i class="ti-twitter"></i></a>
        <a href="#"><i class="ti-youtube"></i></a>
      </span>
      <span class="header-top--entery">
        @guest
        <a href="{{ route('login') }}">ورود به سایت</a>
        @endguest
        @auth
        <a href="{{ route('my_profile') }}">پروفایل من</a>
        <span>   /   </span>
        <a href="{{ route('my_courses') }}">دوره های من</a>
        <span>   /   </span>
        <a href="{{ route('logout') }}">خروج</a>
        @endauth
      </span>
      <span class="header-top--info">
        <span>info@jazire.com<i class="ti-email"></i></span>
        <span>021-64251813<i class="ti-headphone-alt"></i></span>
      </span>
    </div>
    <div class="header--down">
      <ul>
        <li><a href="#">ارتباط با ما</a></li>
        <li><a href="#">درباره ی ما</a></li>
        <li>
          محیط ورزشی
          <ul class="header--down-drop-down">
            <li><a href="{{ route('inside_gym_courses') }}">داخل سالن</a></li>
            <li><a href="{{ route('outside_gym_courses') }}">خارج از سالن</a></li>
          </ul>
        </li>
      </ul>
      <span
        >باشگاه ورزشی جزیره<img src="{{ asset('imgs/site/logo.jpg') }}" alt="logo"
      /></span>
    </div>
  </header>