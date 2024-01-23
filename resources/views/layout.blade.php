<!DOCTYPE html>
<html lang="vi" xml:lang="vi">

<head>


    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta content="width=device-width,initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
    <meta name="theme-color" content="#234556">
    <meta content="VN" name="geo.region" />
    <meta name="DC.language" scheme="utf-8" content="vi" />
    <meta name="language" content="Việt Nam, English">
    <link rel="shortcut icon" href="{{ asset('uploads/logo/Old-Video-Cam-icon.ico') }}" type="image/x-icon" />
    <meta name="revisit-after" content="1 days" />
    <meta name='robots' content='index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @if (isset($tapphim) && $movie->thuocphim == 1)
        <title>
            Tập {{ $tapphim }} - {{ $movie->title }} | FullHDPhim
        </title>
    @elseif (isset($movie->slug))
        <title>
            {{ $movie->title }} - Phim Chất Lượng Cao | FullHDPhim
        </title>
    @else
        <title>FullHDPhim | Xem Phim Chất Lượng Tốt Nhất</title>
    @endif
    @if (!isset($movie->slug))
        <meta name="description"
            content="Fullhdphim, Phim hay - Xem phim hay nhất, xem phim online miễn phí, phim nhanh, Xem Phim Online, Phim Vietsub, Xem Phim Hay, phim HD , phim hot ,phim mới, phim bom tấn" />
    @else
        <meta name="description"
            content="Xem Phim {{ $movie->title }} - {{ $movie->name_english }} ({{ $movie->year }})" />
    @endif
    @if (!isset($movie->slug))
        <meta name="title" content="FullHDPhim | Xem Phim Chất Lượng Tốt Nhất" />
    @else
        <meta name="title" content="Phim {{ $movie->title }} [Full HD], {{ $movie->name_english }}" />
    @endif
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <link rel="next" href="" />
    <meta property="og:locale" content="vi_VN" />
    @if (!isset($movie->slug))
        <meta property="og:title" content="Phim hay 2023 - Xem phim hay nhất" />
    @else
        <meta property="og:title" content="Phim {{ $movie->title }} [Full HD], {{ $movie->name_english }}" />
    @endif
    <meta property="og:type" content="website" />
    @if (!isset($movie->slug))
        <meta property="og:url" content="{{ route('homepage') }}" />
    @else
        <meta property="og:url" content="{{ route('homepage') }}/movie/{{ $movie->slug }}" />
    @endif
    @if (!isset($movie->slug))
        <meta property="og:description"
            content="Phim hay 2023 - Xem phim hay nhất, phim hay trung quốc, hàn quốc, việt nam, mỹ, hong kong , chiếu rạp" />
    @else
        <meta property="og:description"
            content="Xem Phim {{ $movie->title }} - {{ $movie->name_english }} ({{ $movie->year }})" />
    @endif
    <meta property="og:site_name" content="fullhdphim.click" />
    @if (!isset($movie->slug))
        <meta property="og:image" content="" />
    @else
        <meta property="og:image" content="{{ asset('uploads/movie/' . $movie->movie_image->image) }}" />
    @endif
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
    @if (!isset($movie->slug))
        <meta name="keywords"
            content="Phim, xem phim, xem phim online, phim online, xem phim hd, phim vietsub, phim thuyet minh, fullhdphim" />
    @else
        <meta name="keywords"
            content="xem phim {{ $movie->title }},xem phim {{ $movie->title }} vietsub,xem phim {{ $movie->title }} online,xem phim {{ $movie->title }} bluray,xem phim {{ $movie->title }} hd,xem phim {{ $movie->title }} full hd,xem phim {{ $movie->title }} 1080p,xem phim {{ $movie->title }} vietsub online,xem phim {{ $movie->title }} free,xem phim {{ $movie->title }} miễn ph&#237;,xem online, phim chất lượng, si&#234;u n&#233;t, bluray,fullhd, xem phim {{ $movie->name_english }}" />
    @endif


    @if (!isset($movie->slug))
        <link rel="canonical" href="{{ route('homepage') }}" />
    @else
        <link rel="canonical" href="{{ route('homepage') }}/movie/{{ $movie->slug }}" />
    @endif


    {{-- @yield('css') --}}
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="stylesheet" href="/lib/owl.carousel.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css"
        integrity="sha256-t2kyTgkh+fZJYRET5l9Sjrrl4UDain5jxdbqe8ejO8A=" crossorigin="anonymous" />

    <link rel="stylesheet" href="/css/global.css">
    <link rel="stylesheet" href="/css/browse.css">

    <!--main script file-->
    <script src="/lib/jquery 3.5.0.js"></script>
    <script src="/lib/owl.carousel.js"></script>


</head>

<body>
    <main id="mainContainer" class="p-b-40">

        @include('nav')
        
        @yield('content')

        @include('footer')
        </div>


    </main>

    <div class="footer-navigation d-flex space-between">
        <a href="browse.html" class="nav-item active">
            <i class="fa fa-home" aria-hidden="true"></i> </br>
            Home
        </a>
        <a href="search.html" class="nav-item">
            <i class="fa fa-search" aria-hidden="true"></i></br>
            Search
        </a>
        <a href="latest.html" class="nav-item">
            <i class="fa fa-film" aria-hidden="true"></i></br>
            Latest
        </a>
        <a href="user-profile/home.html" class="nav-item">
            <i class="fa fa-user" aria-hidden="true"></i></br>
            Account
        </a>
    </div>

    <script src="/js/main-script.js"></script>
</body>

</html>
