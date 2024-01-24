@extends('layout')
@section('content')
    <!-- hero section video-->
    <style>
        .video {
            width: 1280px;
            height: 720px;
        }
    </style>
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
                            <li role="presentation" class="active server-1">
                                <a href="javascrip:void(0);" aria-controls="servrole="tab" data-toggle="tooltip69"
                                    title="Server {{ $ser->title }}"><i class="fa-solid fa-server"></i>
                                    {{ $ser->title }}

                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <ul class="halim-list-eps">
                                @foreach ($episode_list as $key => $ep)
                                    @if ($ep->server_id == $ser->id)
                                        <button
                                            onclick="location.href='{{ url('xem-phim/' . $movie->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                            <li class="halim-episode"><span
                                                    class="halim-btn halim-btn-2 {{ $tapphim == $ep->episode && $server_active == 'server-' . $ser->id ? 'active' : '' }} halim-info-1-1 box-shadow"
                                                    data-post-id="37976" data-server="1" data-episode="1"
                                                    data-position="first" data-embed="0" data-title="" data-h1="">EP
                                                    [ {{ $ep->episode }} ] @if ($movie->type_movie == 1 && $movie->sotap == $ep->episode)
                                                        End
                                                    @endif
                                                </span></li>
                                        </button>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
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
                PG-13
            </span>
            <span class="timeduration">
                {{ $times }}
            </span>
        </div>
        <div class="description">
            {!! $movie->movie_description->description !!}
        </div>
        <div class="castinformation">
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




    <!--Hollywood Action movies-->
    <section id="similar" class="container p-t-40">
        <h4 class="romantic-heading">
            More LIke This
        </h4>
        <div class="romantic-container d-flex flex-start flex-middle">
            @foreach ($related as $key => $rel)
                <a href="#">
                    <img src="  @php
$image_check = substr($rel->movie_image->image, 0, 5); @endphp
                                                    @if ($image_check == 'https') {{ $rel->movie_image->image }}
                                                    @else
                                                       {{ asset('uploads/movie/' . $rel->movie_image->image) }} @endif"
                        alt="" class="mylist-img p-r-10 p-t-10 image-size item"></a>
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
