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
    <div style="padding-left: 2%">
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

            .server-active {
                background-color: #fff;
                color: #222;
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

            .img-mobile {
                height: 400px;
                width: 300px
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
                    font-size: 12px;
                    font-weight: 700;
                    line-height: 1.5;
                    margin: 2px;
                    max-width: none;
                    min-height: 35px;
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
                    width: 40%;
                }

                .server-active {
                    background-color: #fff;
                    color: #222;
                }

                .button-31 {
                    font-size: 10px;
                    min-height: 35px;
                }

                .img-mobile {
                    height: 290px;
                    width: 200px
                }

            }


            .button-31:hover {
                background-color: #fff;
                color: #222;
            }

            .active-ep {
                background-color: #fff;
                color: #222;
            }

            .episode-list {
                display: none;
            }
        </style>
        @foreach ($server as $key => $ser)
            @foreach ($episode_movie as $key => $ser_mov)
                @if ($ser_mov->server_id == $ser->id)
                    @if ($movie->type_movie == 0)
                        @foreach ($episode_list as $key => $ep)
                            @if ($ep->server_id == $ser->id)
                                <div class="server{{ $server_active == 'server-' . $ser->id ? ' server-active' : '' }}"
                                    onclick="location.href='{{ url('xem-phim/' . $movie->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                    Server: {{ $ser->title }}</div>
                            @endif
                        @endforeach
                    @else
                        <div id="server-{{ $ser->id }}"
                            class="server{{ $server_active == 'server-' . $ser->id ? ' server-active' : '' }}"
                            onclick="showEpisodes('server{{ $ser->id }}')">
                            Server: {{ $ser->title }}</div>
                    @endif
                @endif
            @endforeach
        @endforeach
        @if ($movie->type_movie == 1)
            @foreach ($server as $key => $ser)
                @foreach ($episode_movie as $key => $ser_mov)
                    @if ($ser_mov->server_id == $ser->id)
                        <div id="episodeList{{ $ser->id }}" class="episode-list"
                            style="padding-left: 2%;padding-bottom: 1%">
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
                    @endif
    </div>
    @endforeach
    @endforeach
    @endif

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var server_active = "{{ $server_active }}";
            document.getElementById(server_active).click();

        });

        function showEpisodes(server) {
            // Ẩn tất cả danh sách tập phim
            document.querySelectorAll('.episode-list').forEach(function(el) {
                el.style.display = 'none';
            });

            // Hiển thị danh sách tập phim của server được chọn
            document.getElementById('episodeList' + server.charAt(server.length - 1)).style.display = 'block';
        }
    </script>
    </div>
    <section class="movieinformation container">
        <div class="">

            <img id="wishlist_movieimage" class="img-mobile"
                src="  @php
$image_check = substr($movie->movie_image->image, 0, 5); $startPos = strpos($movie->movie_image->image, 'movies/');
$image = substr($movie->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
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
        <div class="actions d-flex flex-start flex-middle wishlist">

            <a href="javacript:void(0)" onclick="showNotification('Thanks.')" class="link-item">
                <i class="fa fa-thumbs-up"></i></br>
                Like
            </a>
            <a href="javacript:void(0)" class="copy-url link-item" data-url='{{ url('movie/' . $movie->slug) }}'>
                <i class="fa fa-share"></i></br>
                Share
            </a>
            @foreach ($movie->episode->take(1) as $ep)
                @if (isset($ep->linkdownload))
                    <a href={!! $ep->linkdownload !!} target="_blank" class="link-item">
                        <i class="fa fa-download"></i></br>
                        Download
                    </a>
                @elseif (isset($ep->linkdownload) == '')
                    <a href="https://4share.vn/search?search_string={{ $movie->name_english }}" target="_blank"
                        class="link-item">
                        <i class="fa fa-download"></i></br>
                        Download
                    </a>
                @endif
            @endforeach
            <a href="javacript:void(0)" id="{{ $movie->id }}" onclick="add_wishlist(this.id);" class=" link-item">
                <i class="fa fa-plus"></i></br>
                My List
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
                            <video class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                poster="
                            @php
$image_check = substr($rel->movie_image->image, 0, 5);
 $startPos = strpos($rel->movie_image->image, 'movies/');
$image = substr($rel->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                            @else
                                                               {{ asset('uploads/movie/' . $rel->movie_image->image) }} @endif
                            ">
                                {{-- <source src="../images/tv-show/videos/Never Have I Ever - Official Trailer - Netflix_2.mp4"
                                type="video/mp4">
                            Your browser does not support the video tag. --}}
                            </video>
                            <h3>{{ $rel->title }}</h3>
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
                        <?php
                        $originalTitle = $rel->title;
                        $shortenedTitle = mb_substr($originalTitle, 0, 25, 'UTF-8');
                        if (mb_strlen($originalTitle, 'UTF-8') > 25) {
                            $shortenedTitle .= '...';
                        }
                        echo $shortenedTitle;
                        ?>
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
                    <a class="button" href="{{ route('movie', $rel->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <input type="hidden" id="witshlist_moviename" value="{{ $movie->title }}">
    <input type="hidden" id="witshlist_movieslug" value="{{ $movie->slug }}">
    <script>
        var name = document.getElementById('witshlist_moviename').value;
        var slug = document.getElementById('witshlist_movieslug').value;
        var img = document.getElementById('wishlist_movieimage').src;
        var mylist = document.getElementById({{ $movie->id }});
        var url = window.location;

        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));

                for (i = 0; i < data.length; i++) {
                    var slugs = data[i].slug;

                    if (slugs === slug) {

                        mylist.remove();
                        $(".wishlist").append(
                            '<a href="javascript:void(0)" class="link-item"> <i class="fa-regular fa-circle-check"></i></br>Added</a>'
                        );
                    }
                }
            }

        }
        view();

        function add_wishlist(clicked_id) {
            var id = clicked_id;
            var newItem = {
                'id': id,
                'name': name,
                'slug': slug,
                'url': url,
                'img': img
            }
            if (localStorage.getItem('data') == null) {
                localStorage.setItem('data', '[]');
            }
            var old_data = JSON.parse(localStorage.getItem('data'));

            var matches = $.grep(old_data, function(obj) {
                return obj.id == id;

            })
            if (matches.length) {
                showNotification("Wishlist Created.");
                return false;
            } else {
                old_data.push(newItem);
            }
            localStorage.setItem('data', JSON.stringify(old_data));
            mylist.remove();
            $(".wishlist").append(
                '<a href="javascript:void(0)" class="link-item"> <i class="fa-regular fa-circle-check"></i></br>Added</a>'
            );
            showNotification("Add Wishlist Successfully.");

        }

        function add_recent() {
            var id = {{ $movie->id }};
            var currentTime = new Date().getTime();

            var newItems = {
                'id': id,
                'name': name,
                'slug': slug,
                'img': img,
                'url': url,
                'time': currentTime
            }
            if (localStorage.getItem('data_recent') == null) {
                localStorage.setItem('data_recent', '[]');
            }
            var old_datas = JSON.parse(localStorage.getItem('data_recent'));

            var matchess = $.grep(old_datas, function(obj) {
                return obj.id == id;

            })
            if (matchess.length) {
                matchess[0].time = currentTime;
                matchess[0].url = url;
            } else {
                old_datas.push(newItems);
            }
            old_datas.sort(function(a, b) {
                return b.time - a.time;
            });
            localStorage.setItem('data_recent', JSON.stringify(old_datas));

        }
        add_recent();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var copyUrlLinks = document.querySelectorAll('.copy-url');

            copyUrlLinks.forEach(function(link) {
                link.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent default link behavior

                    var dataUrl = this.getAttribute('data-url'); // Get the data-url attribute value
                    copyTextToClipboard(dataUrl); // Copy the data-url value to the clipboard

                    // You can add additional feedback here, like showing a message that the data-url has been copied.
                    showNotification("Copy link successfully.");
                    console.log('data-url copied:', dataUrl);
                });
            });

            function copyTextToClipboard(text) {
                var textarea = document.createElement("textarea");
                textarea.value = text;
                document.body.appendChild(textarea);
                textarea.select();
                document.execCommand("copy");
                document.body.removeChild(textarea);
            }
        });
    </script>
    <script>
        // Thay đổi URL hiện tại bằng URL mới
        // var newUrl = '/movie/{{ $movie->slug }}';
        // history.replaceState({}, null, newUrl);

        // Thực hiện chuyển đổi URL mới vào lịch sử trình duyệt

        //history.pushState({}, null, '/watch/{{ $movie->slug }}');

        function onDevToolsOpen() {

            // Lấy đối tượng div bằng cách sử dụng id
            var divElement = document.getElementById("mainiframe");
            divElement.src = "";

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
