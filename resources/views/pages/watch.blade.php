@extends('layout')
@section('content')

    <style>
        .video {
            position: relative;
            display: block;
            width: 100%;
            height: 100%;
            padding: 0;
            overflow: hidden;
        }

        @media (max-width: 601px) {
            .videocontainer {
                max-width: 100%;
                margin: auto !important;
                height: 215px;
            }
        }
    </style>
    <!-- hero section video-->
    <div class="videocontainer">
        <iframe id="mainiframe" style="border-radius: 1.25rem;" class="video" src="{!! $episode->linkphim !!}" frameborder="0"
            allow="accelerometer; autoplay=0; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe>
    </div>

    <br>
    <div>
        @foreach ($server as $key => $ser)
            @foreach ($episode_movie as $key => $ser_mov)
                @if ($ser_mov->server_id == $ser->id)
                    <div class="title-block" id="halim-list-server">
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active server">
                                <a href="javascrip:void(0);" aria-controls="servrole="tab" data-toggle="tooltip69"
                                    title="Server {{ $ser->title }}"><i class="fa-solid fa-server"></i>
                                    {{ $ser->title }}

                                </a>
                            </li>
                        </ul>
                        <ul>
                            <div class="tab-content">

                                <style>
                                    .server {
                                        background-color: #222;
                                        border-radius: 4px;
                                        border-style: none;
                                        box-sizing: border-box;
                                        color: #fff;
                                        cursor: pointer;
                                        display: inline-block;
                                        font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
                                        font-size: 16px;
                                        font-weight: 700;
                                        line-height: 1.5;
                                        margin: 2px;
                                        max-width: none;
                                        min-height: 44px;
                                        min-width: 10px;
                                        outline: none;
                                        overflow: hidden;
                                        padding: 9px 20px 8px;
                                        position: relative;
                                        text-align: center;
                                        text-transform: none;
                                        user-select: none;
                                        -webkit-user-select: none;
                                        touch-action: manipulation;
                                        width: 15%;
                                    }

                                    @media (max-width: 601px) {
                                        .server {
                                            background-color: #222;
                                            border-radius: 4px;
                                            border-style: none;
                                            box-sizing: border-box;
                                            color: #fff;
                                            cursor: pointer;
                                            display: inline-block;
                                            font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
                                            font-size: 16px;
                                            font-weight: 700;
                                            line-height: 1.5;
                                            margin: 2px;
                                            max-width: none;
                                            min-height: 44px;
                                            min-width: 10px;
                                            outline: none;
                                            overflow: hidden;
                                            padding: 9px 20px 8px;
                                            position: relative;
                                            text-align: center;
                                            text-transform: none;
                                            user-select: none;
                                            -webkit-user-select: none;
                                            touch-action: manipulation;
                                            width: 50%;
                                        }
                                    }

                                    .button-31 {
                                        background-color: #222;
                                        border-radius: 4px;
                                        border-style: none;
                                        box-sizing: border-box;
                                        color: #fff;
                                        cursor: pointer;
                                        display: inline-block;
                                        font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
                                        font-size: 16px;
                                        font-weight: 700;
                                        line-height: 1.5;
                                        margin: 2px;
                                        max-width: none;
                                        min-height: 44px;
                                        min-width: 10px;
                                        outline: none;
                                        overflow: hidden;
                                        padding: 9px 20px 8px;
                                        position: relative;
                                        text-align: center;
                                        text-transform: none;
                                        user-select: none;
                                        -webkit-user-select: none;
                                        touch-action: manipulation;

                                    }

                                    .button-31:hover {
                                        background-color: #fff;
                                        color: #222;
                                    }

                                    .active-ep {
                                        background-color: #fff;
                                        border-radius: 4px;
                                        border-style: none;
                                        box-sizing: border-box;
                                        color: #222;
                                        cursor: pointer;
                                        display: inline-block;
                                        font-family: "Farfetch Basis", "Helvetica Neue", Arial, sans-serif;
                                        font-size: 16px;
                                        font-weight: 700;
                                        line-height: 1.5;
                                        margin: 2px;
                                        max-width: none;
                                        min-height: 44px;
                                        min-width: 10px;
                                        outline: none;
                                        overflow: hidden;
                                        padding: 9px 20px 8px;
                                        position: relative;
                                        text-align: center;
                                        text-transform: none;
                                        user-select: none;
                                        -webkit-user-select: none;
                                        touch-action: manipulation;
                                    }
                                </style>
                                @foreach ($episode_list as $key => $ep)
                                    @if ($ep->server_id == $ser->id)
                                        <button
                                            class="button-31 {{ $tapphim == $ep->episode && $server_active == 'server-' . $ser->id ? 'active-ep' : '' }} "
                                            {{ $tapphim == $ep->episode && $server_active == 'server-' . $ser->id ? 'disabled' : '' }}
                                            onclick="location.href='{{ url('xem-phim/' . $movie->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                            EP
                                            [ {{ $ep->episode }} ] @if ($movie->type_movie == 1 && $movie->sotap == $ep->episode)
                                                End
                                            @endif

                                        </button>
                                    @endif
                                @endforeach

                            </div>
                        </ul>
                    </div>
                @endif
            @endforeach
        @endforeach
    </div>
    <section class="movieinformation container">
        <div class="" style="height: 400px;width:300px">
            <img style="height: 400px;width:300px"
                src="  @php
$image_check = substr($movie->movie_image->image, 0, 5); @endphp
                                            @if ($image_check == 'https') {{ $movie->movie_image->image }}
                                            @else
                                               {{ asset('uploads/movie/' . $movie->movie_image->image) }} @endif"
                alt="">
        </div>
        <div class="movierelease">
            <span class="year">
                {{ $movie->year }}
            </span>
            <span class="rating">
                @if ($movie->type_movie == 1)
                    {{ $episode_current_list_count }}/{{ $movie->sotap }} Tập
                @else
                    PG-13
                @endif

            </span>
            <span class="timeduration">
                {{ $times }}
            </span>
        </div>
        <div class="description">
            {!! $movie->movie_description->description !!}
        </div>
        <div class="castinformation">
            <p><span class="name">Imdb Rating: </span>
                <a href="http://imdb.com/title/{{ $movie->imdb }}" target="_blank"
                    rel="noopener noreferrer">{{ $values }}</a>
            </p>
            <p><span class="name">Director:</span>
                @if (count($movie->movie_directors) == 0)
                    N/A
                @else
                    @foreach ($movie->movie_directors as $direc)
                        <a href="{{ route('directors', $direc->slug) }}" rel="category tag">
                            {{ $direc->name }}
                        </a>


                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @endif
            </p>
            <p><span class="name">Cast:</span>
                @if (count($movie->movie_cast) == 0)
                    N/A
                @else
                    @foreach ($movie->movie_cast as $cast)
                        <a href="{{ route('cast', $cast->slug) }}" rel="category tag">
                            {{ $cast->title }}
                        </a>
                        @if (!$loop->last)
                            ,
                        @endif
                    @endforeach
                @endif
            </p>
            <p><span class="name">Country:</span>
                <a href="{{ route('country', $movie->country->slug) }}" rel="tag">{{ $movie->country->title }}</a>
            </p>
            <p><span class="name">Genre:</span>
                @foreach ($movie->movie_genre as $gen)
                    <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                        {{ $gen->title }}
                    </a>
                    @if (!$loop->last)
                        ,
                    @endif
                @endforeach
            </p>
        </div>
        <div class="actions d-flex flex-start flex-middle">
            <a href="#" class="link-item">
                <i class="fa fa-plus"></i></br>
                My List
            </a>
            <a href="#" class="link-item">
                <i class="fa fa-thumbs-up"></i></br>
                Like
            </a>
            <a href="#" class="link-item">
                <i class="fa fa-share"></i></br>
                Share
            </a>
            <a href="#" class="link-item">
                <i class="fa fa-download"></i></br>
                Download
            </a>
        </div>
    </section>




    <!-- More LIke This movies-->
    <section id="mylist" class="container">

        <h4 class="romantic-heading">
            More LIke This
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($related->take(20) as $key => $rel)
                @foreach ($rel->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $rel->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <video class="mylist-img p-r-10 p-t-10 video-item"
                                poster="
                            @php
$image_check = substr($rel->movie_image->image, 0, 5); @endphp
                                                            @if ($image_check == 'https') {{ $rel->movie_image->image }}
                                                            @else
                                                               {{ asset('uploads/movie/' . $rel->movie_image->image) }} @endif
                            ">
                                {{-- <source src="../images/tv-show/videos/Never Have I Ever - Official Trailer - Netflix_2.mp4"
                                type="video/mp4">
                            Your browser does not support the video tag. --}}
                            </video>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $rel->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M6 4l15 8-15 8z" fill="black">
                                        </path>
                                    </svg>
                                </button>
                            </div>
                @endforeach
                <div>
                    <h4 class="heading f-w-8 text-shadow">
                        {{ $rel->title }}
                    </h4>
                </div>
                <div class="info d-flex flex-middle flex-no-wrap">
                    <p class="rated text-shadow"><strong>13+</strong></p>
                    <p class="season-count text-shadow"> {{ $rel->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($rel->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>

    <script>
        document.onkeydown = function(event) {
            event = (event || window.event);
            //alert(event.keyCode);   return false;

            if (event.ctrlKey && event.keyCode === 85) {

                // return false;

            }
            if (event.keyCode === 123) {

                return false;
            }
        }
    </script>
    <script>
        // Lấy URL hiện tại
        var currentUrl = window.location.href;
        document.onkeydown = function(event) {
            event = (event || window.event);
            //alert(event.keyCode);   return false;
            if (event.keyCode == 116 || (event.ctrlKey && event.keyCode === 116) || (event.ctrlKey && event.keyCode ===
                    82)) {
                window.location.href = currentUrl;
                //alert(currentUrl);
                //return false;
            }
            if (event.ctrlKey && event.keyCode === 85) {

                // return false;

            }
        }
        // Thay đổi URL hiện tại bằng URL mới
        var newUrl = '/movie/{{ $movie->slug }}';
        //history.replaceState({}, null, newUrl);

        // Thực hiện chuyển đổi URL mới vào lịch sử trình duyệt

        // history.pushState({}, null, '/movie/{{ $movie->slug }}');

        function onDevToolsOpen() {

            // Lấy đối tượng div bằng cách sử dụng id
            var divElement = document.getElementById("mainiframe");
            divElement.src = "https://hdbo.opstream5.com/share/72811f4732ddc88edfc27602efc34145";
            // // Tạo một phần tử iframe mới
            // var iframeElement = document.createElement("iframe");

            // // Thiết lập các thuộc tính của iframe

            // iframeElement.width = "100%";
            // iframeElement.height = "100%";
            // iframeElement.frameBorder = "0";
            // iframeElement.allowTransparency = "true";
            // iframeElement.allowFullscreen = "true";
            // iframeElement.scrolling = "no";
            // iframeElement.src =
            //     "https://hdbo.opstream5.com/share/72811f4732ddc88edfc27602efc34145"; 

            // // Thay thế div bằng iframe
            // //divElement.parentNode.replaceChild(iframeElement, divElement);
            setTimeout(console.clear.bind(console))
            setTimeout(() => {
                console.log(
                    'open devtool.',
                )
            }, 10);
            const script = document.querySelector('script');
            script.remove();
        }
        class DevToolsChecker extends Error {
            toString() {

            }
            get message() {
                onDevToolsOpen();
            }
        }
        console.log(new DevToolsChecker());
    </script>

@endsection
