@extends('layout')
@section('content')
    <!-- hero section -->
    <div>
        <div class="">
            @foreach ($hot->take(1) as $key => $h)
                <section id="browse-dashboard" class=" d-flex direction-column flex-start middle-align">
                    <div>
                        <!--trailer video-->
                        <video class="hero-background-image" id="hero-video"
                            poster="
                        @php
$image_check = substr($h->movie_image->image, 0, 5);
$startPos = strpos($h->movie_image->image, 'movies/');
$image = substr($h->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                @else
                                   {{ asset('uploads/movie/' . $h->movie_image->image) }} @endif
                        ">
                            {{-- <source src="https://samplelib.com/lib/preview/mp4/sample-5s.mp4"
                            > --}}


                        </video>

                        <!--left shadow-->
                        <div class="shadow-layer"></div>
                    </div>

                    <div class="container text-container" style="z-index: 5;">
                        <style>
                            .contentlogo {
                                font-size: 70px;
                            }

                            @media (max-width: 601px) {
                                .contentlogo {
                                    font-size: 34px;
                                }

                                .synopsis {
                                    width: 95%;
                                }
                            }
                        </style>
                        <div class="contentlogo">
                            {{-- <img src="" alt="content logo" class="show-logo" /> --}}
                            {{ $h->title }}
                        </div>
                        <!--top 10 ranking badge svg-->
                        <div class="ranking d-flex m-t-20 flex-middle">
                            <svg id="top-10-badge" viewBox="0 0 28 30">
                                <path d="M0,0 L28,0 L28,30 L0,30 L0,0 Z M2,2 L2,28 L26,28 L26,2 L2,2 Z" fill="#FFFFFF">
                                </path>
                                <path
                                    d="M16.8211527,22.1690594 C17.4133103,22.1690594 17.8777709,21.8857503 18.2145345,21.3197261 C18.5512982,20.7531079 18.719977,19.9572291 18.719977,18.9309018 C18.719977,17.9045745 18.5512982,17.1081018 18.2145345,16.5414836 C17.8777709,15.9754594 17.4133103,15.6921503 16.8211527,15.6921503 C16.2289952,15.6921503 15.7645345,15.9754594 15.427177,16.5414836 C15.0904133,17.1081018 14.9223285,17.9045745 14.9223285,18.9309018 C14.9223285,19.9572291 15.0904133,20.7531079 15.427177,21.3197261 C15.7645345,21.8857503 16.2289952,22.1690594 16.8211527,22.1690594 M16.8211527,24.0708533 C15.9872618,24.0708533 15.2579042,23.8605988 14.6324861,23.4406836 C14.0076618,23.0207685 13.5247891,22.4262352 13.1856497,21.6564897 C12.8465103,20.8867442 12.6766436,19.9786109 12.6766436,18.9309018 C12.6766436,17.8921018 12.8465103,16.9857503 13.1856497,16.2118473 C13.5247891,15.4379442 14.0076618,14.8410352 14.6324861,14.4205261 C15.2579042,14.0006109 15.9872618,13.7903564 16.8211527,13.7903564 C17.6544497,13.7903564 18.3844012,14.0006109 19.0098194,14.4205261 C19.6352376,14.8410352 20.1169224,15.4379442 20.4566558,16.2118473 C20.7952012,16.9857503 20.9656618,17.8921018 20.9656618,18.9309018 C20.9656618,19.9786109 20.7952012,20.8867442 20.4566558,21.6564897 C20.1169224,22.4262352 19.6352376,23.0207685 19.0098194,23.4406836 C18.3844012,23.8605988 17.6544497,24.0708533 16.8211527,24.0708533"
                                    fill="#FFFFFF"></path>
                                <polygon fill="#FFFFFF"
                                    points="8.86676 23.9094206 8.86676 16.6651418 6.88122061 17.1783055 6.88122061 14.9266812 11.0750267 13.8558085 11.0750267 23.9094206">
                                </polygon>
                                <path
                                    d="M20.0388194,9.42258545 L20.8085648,9.42258545 C21.1886861,9.42258545 21.4642739,9.34834303 21.6353285,9.19926424 C21.806383,9.05077939 21.8919103,8.83993091 21.8919103,8.56731273 C21.8919103,8.30122788 21.806383,8.09572485 21.6353285,7.94961576 C21.4642739,7.80410061 21.1886861,7.73104606 20.8085648,7.73104606 L20.0388194,7.73104606 L20.0388194,9.42258545 Z M18.2332436,12.8341733 L18.2332436,6.22006424 L21.0936558,6.22006424 C21.6323588,6.22006424 22.0974133,6.31806424 22.4906012,6.51465818 C22.8831952,6.71125212 23.1872921,6.98684 23.4028921,7.34142182 C23.6178982,7.69659758 23.7259952,8.10522788 23.7259952,8.56731273 C23.7259952,9.04246424 23.6178982,9.45762788 23.4028921,9.8122097 C23.1872921,10.1667915 22.8831952,10.4429733 22.4906012,10.6389733 C22.0974133,10.8355673 21.6323588,10.9335673 21.0936558,10.9335673 L20.0388194,10.9335673 L20.0388194,12.8341733 L18.2332436,12.8341733 Z"
                                    fill="#FFFFFF"></path>
                                <path
                                    d="M14.0706788,11.3992752 C14.3937818,11.3992752 14.6770909,11.322063 14.9212,11.1664509 C15.1653091,11.0114327 15.3553697,10.792863 15.4913818,10.5107418 C15.6279879,10.2286206 15.695697,9.90136 15.695697,9.52717818 C15.695697,9.1535903 15.6279879,8.82573576 15.4913818,8.54361455 C15.3553697,8.26149333 15.1653091,8.04351758 14.9212,7.88790545 C14.6770909,7.73288727 14.3937818,7.65508121 14.0706788,7.65508121 C13.7475758,7.65508121 13.4642667,7.73288727 13.2201576,7.88790545 C12.9760485,8.04351758 12.7859879,8.26149333 12.6499758,8.54361455 C12.5139636,8.82573576 12.4456606,9.1535903 12.4456606,9.52717818 C12.4456606,9.90136 12.5139636,10.2286206 12.6499758,10.5107418 C12.7859879,10.792863 12.9760485,11.0114327 13.2201576,11.1664509 C13.4642667,11.322063 13.7475758,11.3992752 14.0706788,11.3992752 M14.0706788,12.9957842 C13.5634545,12.9957842 13.0995879,12.9090691 12.6784848,12.7344509 C12.2573818,12.5604267 11.8915152,12.3163176 11.5808848,12.0027176 C11.2708485,11.6891176 11.0314909,11.322063 10.8634061,10.9003661 C10.6953212,10.479263 10.6115758,10.0213358 10.6115758,9.52717818 C10.6115758,9.03302061 10.6953212,8.57568727 10.8634061,8.1539903 C11.0314909,7.73288727 11.2708485,7.36523879 11.5808848,7.05163879 C11.8915152,6.73803879 12.2573818,6.49452364 12.6784848,6.31990545 C13.0995879,6.14588121 13.5634545,6.05857212 14.0706788,6.05857212 C14.577903,6.05857212 15.0417697,6.14588121 15.4628727,6.31990545 C15.8839758,6.49452364 16.2498424,6.73803879 16.5604727,7.05163879 C16.871103,7.36523879 17.1098667,7.73288727 17.2779515,8.1539903 C17.4460364,8.57568727 17.5297818,9.03302061 17.5297818,9.52717818 C17.5297818,10.0213358 17.4460364,10.479263 17.2779515,10.9003661 C17.1098667,11.322063 16.871103,11.6891176 16.5604727,12.0027176 C16.2498424,12.3163176 15.8839758,12.5604267 15.4628727,12.7344509 C15.0417697,12.9090691 14.577903,12.9957842 14.0706788,12.9957842"
                                    fill="#FFFFFF"></path>
                                <polygon fill="#FFFFFF"
                                    points="8.4639503 12.8342327 6.65837455 13.2666206 6.65837455 7.77862061 4.65323515 7.77862061 4.65323515 6.22012364 10.4690897 6.22012364 10.4690897 7.77862061 8.4639503 7.77862061">
                                </polygon>
                            </svg>
                            <span class="p-l-10">#2 in Viet Nam Today</span>
                        </div>

                        <div class="synopsis m-t-20" style="max-width: 500px;">

                            @php

                                $description = $h->movie_description->description;

                                $trimmedDescription = substr($description, 0, 155);

                                echo $trimmedDescription . '...';
                            @endphp


                        </div>
                        <div class="buttons-container m-t-20">
                            @foreach ($h->episode->take(1) as $epi)
                                <button class="play-button"
                                    onclick="location.href='{{ url('xem-phim/' . $h->slug . '/tap-' . $epi->episode . '/server-' . $epi->server_id) }}'"><span>
                                        <svg viewBox="0 0 24 24">
                                            <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                                        </svg>
                                    </span> <a>Play</a></button>
                            @endforeach


                            <button onclick="location.href='{{ route('movie', $h->slug) }}'"
                                class="more-info-button m-t-20"><span>
                                    <svg viewBox="0 0 24 24">
                                        <path
                                            d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10zm-2 0a8 8 0 0 0-8-8 8 8 0 0 0-8 8 8 8 0 0 0 8 8 8 8 0 0 0 8-8zm-9 6v-7h2v7h-2zm1-8.75a1.21 1.21 0 0 1-.877-.364A1.188 1.188 0 0 1 10.75 8c0-.348.123-.644.372-.886.247-.242.54-.364.878-.364.337 0 .63.122.877.364.248.242.373.538.373.886s-.124.644-.373.886A1.21 1.21 0 0 1 12 9.25z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span> More Info</button>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

        <!--paretn div with black bg after main hero section-->
        <style>
            @media (max-width: 601px) {
                .black-background {
                    box-shadow: 0px -40px 80px 75px black;
                }
            }
        </style>
        <div class="black-background">
            <!--continure watching-->
            @foreach ($category_home as $key => $cate_home)
                <section id="continue-watching" class="container p-t-40">
                    <h4 class="continue-watching-heading">
                        {{ $cate_home->title }} Mới Cập Nhật
                    </h4>

                    <div class="continue-watching-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
                        @foreach ($cate_home->movie->sortBydesc('updated_at')->take(35) as $key => $mov)
                            @foreach ($mov->episode->take(1) as $ep)
                                <div class="video">
                                    <a href="javascript:void(0)"
                                        onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                        <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                            src="
                                    @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                @else
                                   {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                                    " loading="lazy">
                                        
                                        <h3 class="title_mobile">{{ $mov->title }}</h3>
                                    </a>
                                    <div class="video-description d-flex flex-end direction-column">

                                        <div class="play-button">
                                            <button style="background: none; border:none"
                                                onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                                    $originalTitle = $mov->title;
                                    $shortenedTitle = mb_substr($originalTitle, 0, 25, 'UTF-8');
                                    if (mb_strlen($originalTitle, 'UTF-8') > 25) {
                                        $shortenedTitle .= '...';
                                    }
                                    echo $shortenedTitle;
                                    ?>

                                </h4>
                            </div>
                            <div class="info d-flex flex-middle flex-no-wrap">

                                @if ($mov->season < 1)
                                    <p class="rated text-shadow"><strong>
                                            13+
                                        </strong></p>
                                @else
                                    <p class="rated text-shadow"><strong>
                                            Session {{ $mov->season }}
                                        </strong></p>
                                @endif

                                <p class="season-count text-shadow">{{ $cate_home->title }}</p>
                            </div>
                            <div class="genere d-flex flex-no-wrap text-shadow">
                                <style>


                                </style>
                                @foreach ($mov->movie_genre->take(3) as $gen)
                                    <p> {{ $gen->title }}
                                        @if (!$loop->last)
                                            ,
                                        @endif
                                    </p>
                                @endforeach
                                <a class="button" href="{{ route('movie', $mov->slug) }}"><i
                                        class="fa-solid fa-chevron-down fa-xl" style="color: #ffffff;"></i></i></a>
                            </div>

                    </div>
        </div>
        @endforeach
    </div>
    </section>
    @endforeach
    <!--Netflix Movies-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Netflix
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movie_netflix as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                    @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                        @if ($image_check == 'https') {{ $url_update . $image }}
                                                    @else
                                                       {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                    " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <!--big poster screen left poster right content-->
    @if (isset($topview_day))
        <section class="big-section d-flex flex-start container">
            <img src="@php
$image_check = substr($topview_day->image, 0, 5);
$startPos = strpos($topview_day->image, 'movies/');
$image = substr($topview_day->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                        @else
                                                           {{ asset('uploads/movie/' . $topview_day->image) }} @endif"
                alt="" loading="lazy">

            <div class="right-side">
                {{-- <div class="contentlogo">
                                <img src="" alt="content logo" class="show-logo" />
                            </div> --}}

                <!--top 10 ranking badge svg-->
                <div class="ranking d-flex m-t-20 flex-middle">
                    <svg id="top-10-badge" viewBox="0 0 28 30" style="height: 50px;">
                        <path d="M0,0 L28,0 L28,30 L0,30 L0,0 Z M2,2 L2,28 L26,28 L26,2 L2,2 Z" fill="#FFFFFF">
                        </path>
                        <path
                            d="M16.8211527,22.1690594 C17.4133103,22.1690594 17.8777709,21.8857503 18.2145345,21.3197261 C18.5512982,20.7531079 18.719977,19.9572291 18.719977,18.9309018 C18.719977,17.9045745 18.5512982,17.1081018 18.2145345,16.5414836 C17.8777709,15.9754594 17.4133103,15.6921503 16.8211527,15.6921503 C16.2289952,15.6921503 15.7645345,15.9754594 15.427177,16.5414836 C15.0904133,17.1081018 14.9223285,17.9045745 14.9223285,18.9309018 C14.9223285,19.9572291 15.0904133,20.7531079 15.427177,21.3197261 C15.7645345,21.8857503 16.2289952,22.1690594 16.8211527,22.1690594 M16.8211527,24.0708533 C15.9872618,24.0708533 15.2579042,23.8605988 14.6324861,23.4406836 C14.0076618,23.0207685 13.5247891,22.4262352 13.1856497,21.6564897 C12.8465103,20.8867442 12.6766436,19.9786109 12.6766436,18.9309018 C12.6766436,17.8921018 12.8465103,16.9857503 13.1856497,16.2118473 C13.5247891,15.4379442 14.0076618,14.8410352 14.6324861,14.4205261 C15.2579042,14.0006109 15.9872618,13.7903564 16.8211527,13.7903564 C17.6544497,13.7903564 18.3844012,14.0006109 19.0098194,14.4205261 C19.6352376,14.8410352 20.1169224,15.4379442 20.4566558,16.2118473 C20.7952012,16.9857503 20.9656618,17.8921018 20.9656618,18.9309018 C20.9656618,19.9786109 20.7952012,20.8867442 20.4566558,21.6564897 C20.1169224,22.4262352 19.6352376,23.0207685 19.0098194,23.4406836 C18.3844012,23.8605988 17.6544497,24.0708533 16.8211527,24.0708533"
                            fill="#FFFFFF"></path>
                        <polygon fill="#FFFFFF"
                            points="8.86676 23.9094206 8.86676 16.6651418 6.88122061 17.1783055 6.88122061 14.9266812 11.0750267 13.8558085 11.0750267 23.9094206">
                        </polygon>
                        <path
                            d="M20.0388194,9.42258545 L20.8085648,9.42258545 C21.1886861,9.42258545 21.4642739,9.34834303 21.6353285,9.19926424 C21.806383,9.05077939 21.8919103,8.83993091 21.8919103,8.56731273 C21.8919103,8.30122788 21.806383,8.09572485 21.6353285,7.94961576 C21.4642739,7.80410061 21.1886861,7.73104606 20.8085648,7.73104606 L20.0388194,7.73104606 L20.0388194,9.42258545 Z M18.2332436,12.8341733 L18.2332436,6.22006424 L21.0936558,6.22006424 C21.6323588,6.22006424 22.0974133,6.31806424 22.4906012,6.51465818 C22.8831952,6.71125212 23.1872921,6.98684 23.4028921,7.34142182 C23.6178982,7.69659758 23.7259952,8.10522788 23.7259952,8.56731273 C23.7259952,9.04246424 23.6178982,9.45762788 23.4028921,9.8122097 C23.1872921,10.1667915 22.8831952,10.4429733 22.4906012,10.6389733 C22.0974133,10.8355673 21.6323588,10.9335673 21.0936558,10.9335673 L20.0388194,10.9335673 L20.0388194,12.8341733 L18.2332436,12.8341733 Z"
                            fill="#FFFFFF"></path>
                        <path
                            d="M14.0706788,11.3992752 C14.3937818,11.3992752 14.6770909,11.322063 14.9212,11.1664509 C15.1653091,11.0114327 15.3553697,10.792863 15.4913818,10.5107418 C15.6279879,10.2286206 15.695697,9.90136 15.695697,9.52717818 C15.695697,9.1535903 15.6279879,8.82573576 15.4913818,8.54361455 C15.3553697,8.26149333 15.1653091,8.04351758 14.9212,7.88790545 C14.6770909,7.73288727 14.3937818,7.65508121 14.0706788,7.65508121 C13.7475758,7.65508121 13.4642667,7.73288727 13.2201576,7.88790545 C12.9760485,8.04351758 12.7859879,8.26149333 12.6499758,8.54361455 C12.5139636,8.82573576 12.4456606,9.1535903 12.4456606,9.52717818 C12.4456606,9.90136 12.5139636,10.2286206 12.6499758,10.5107418 C12.7859879,10.792863 12.9760485,11.0114327 13.2201576,11.1664509 C13.4642667,11.322063 13.7475758,11.3992752 14.0706788,11.3992752 M14.0706788,12.9957842 C13.5634545,12.9957842 13.0995879,12.9090691 12.6784848,12.7344509 C12.2573818,12.5604267 11.8915152,12.3163176 11.5808848,12.0027176 C11.2708485,11.6891176 11.0314909,11.322063 10.8634061,10.9003661 C10.6953212,10.479263 10.6115758,10.0213358 10.6115758,9.52717818 C10.6115758,9.03302061 10.6953212,8.57568727 10.8634061,8.1539903 C11.0314909,7.73288727 11.2708485,7.36523879 11.5808848,7.05163879 C11.8915152,6.73803879 12.2573818,6.49452364 12.6784848,6.31990545 C13.0995879,6.14588121 13.5634545,6.05857212 14.0706788,6.05857212 C14.577903,6.05857212 15.0417697,6.14588121 15.4628727,6.31990545 C15.8839758,6.49452364 16.2498424,6.73803879 16.5604727,7.05163879 C16.871103,7.36523879 17.1098667,7.73288727 17.2779515,8.1539903 C17.4460364,8.57568727 17.5297818,9.03302061 17.5297818,9.52717818 C17.5297818,10.0213358 17.4460364,10.479263 17.2779515,10.9003661 C17.1098667,11.322063 16.871103,11.6891176 16.5604727,12.0027176 C16.2498424,12.3163176 15.8839758,12.5604267 15.4628727,12.7344509 C15.0417697,12.9090691 14.577903,12.9957842 14.0706788,12.9957842"
                            fill="#FFFFFF"></path>
                        <polygon fill="#FFFFFF"
                            points="8.4639503 12.8342327 6.65837455 13.2666206 6.65837455 7.77862061 4.65323515 7.77862061 4.65323515 6.22012364 10.4690897 6.22012364 10.4690897 7.77862061 8.4639503 7.77862061">
                        </polygon>
                    </svg>
                    <span class="p-l-10 f-s-24 f-w-8">#Top 1 in Viet Nam Today</span>
                </div>

                <div class="synopsis m-t-20" style="max-width: 500px;">
                    <p class="f-s-20">
                        @php

                            $description = $topview_day->description;

                            $trimmedDescription = substr($description, 0, 250);

                            echo $trimmedDescription . '</p>';

                        @endphp
                    </p>
                </div>
                <div class="buttons-container m-t-20">

                    <button class="play-button"
                        onclick="location.href='{{ url('xem-phim/' . $topview_day->slug . '/tap-' . $topview_day->episode . '/server-' . $topview_day->server_id) }}'"><span>
                            <svg viewBox="0 0 24 24">
                                <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                            </svg>
                        </span> <a>Play</a></button>


                    <button onclick="location.href='{{ route('movie', $topview_day->slug) }}'"
                        class="more-info-button m-t-20"><span>
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10zm-2 0a8 8 0 0 0-8-8 8 8 0 0 0-8 8 8 8 0 0 0 8 8 8 8 0 0 0 8-8zm-9 6v-7h2v7h-2zm1-8.75a1.21 1.21 0 0 1-.877-.364A1.188 1.188 0 0 1 10.75 8c0-.348.123-.644.372-.886.247-.242.54-.364.878-.364.337 0 .63.122.877.364.248.242.373.538.373.886s-.124.644-.373.886A1.21 1.21 0 0 1 12 9.25z"
                                    fill="currentColor"></path>
                            </svg>
                        </span> More Info</button>
                </div>
            </div>
        </section>
    @else
        <section class="big-section d-flex flex-start container">
            <img src="@php
$image_check = substr($topview->image, 0, 5);
$startPos = strpos($topview->image, 'movies/');
$image = substr($topview->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                                                @else
                                                                                   {{ asset('uploads/movie/' . $topview->image) }} @endif"
                alt="" loading="lazy">

            <div class="right-side">
                {{-- <div class="contentlogo">
                                <img src="" alt="content logo" class="show-logo" />
                            </div> --}}

                <!--top 10 ranking badge svg-->
                <div class="ranking d-flex m-t-20 flex-middle">
                    <svg id="top-10-badge" viewBox="0 0 28 30" style="height: 50px;">
                        <path d="M0,0 L28,0 L28,30 L0,30 L0,0 Z M2,2 L2,28 L26,28 L26,2 L2,2 Z" fill="#FFFFFF">
                        </path>
                        <path
                            d="M16.8211527,22.1690594 C17.4133103,22.1690594 17.8777709,21.8857503 18.2145345,21.3197261 C18.5512982,20.7531079 18.719977,19.9572291 18.719977,18.9309018 C18.719977,17.9045745 18.5512982,17.1081018 18.2145345,16.5414836 C17.8777709,15.9754594 17.4133103,15.6921503 16.8211527,15.6921503 C16.2289952,15.6921503 15.7645345,15.9754594 15.427177,16.5414836 C15.0904133,17.1081018 14.9223285,17.9045745 14.9223285,18.9309018 C14.9223285,19.9572291 15.0904133,20.7531079 15.427177,21.3197261 C15.7645345,21.8857503 16.2289952,22.1690594 16.8211527,22.1690594 M16.8211527,24.0708533 C15.9872618,24.0708533 15.2579042,23.8605988 14.6324861,23.4406836 C14.0076618,23.0207685 13.5247891,22.4262352 13.1856497,21.6564897 C12.8465103,20.8867442 12.6766436,19.9786109 12.6766436,18.9309018 C12.6766436,17.8921018 12.8465103,16.9857503 13.1856497,16.2118473 C13.5247891,15.4379442 14.0076618,14.8410352 14.6324861,14.4205261 C15.2579042,14.0006109 15.9872618,13.7903564 16.8211527,13.7903564 C17.6544497,13.7903564 18.3844012,14.0006109 19.0098194,14.4205261 C19.6352376,14.8410352 20.1169224,15.4379442 20.4566558,16.2118473 C20.7952012,16.9857503 20.9656618,17.8921018 20.9656618,18.9309018 C20.9656618,19.9786109 20.7952012,20.8867442 20.4566558,21.6564897 C20.1169224,22.4262352 19.6352376,23.0207685 19.0098194,23.4406836 C18.3844012,23.8605988 17.6544497,24.0708533 16.8211527,24.0708533"
                            fill="#FFFFFF"></path>
                        <polygon fill="#FFFFFF"
                            points="8.86676 23.9094206 8.86676 16.6651418 6.88122061 17.1783055 6.88122061 14.9266812 11.0750267 13.8558085 11.0750267 23.9094206">
                        </polygon>
                        <path
                            d="M20.0388194,9.42258545 L20.8085648,9.42258545 C21.1886861,9.42258545 21.4642739,9.34834303 21.6353285,9.19926424 C21.806383,9.05077939 21.8919103,8.83993091 21.8919103,8.56731273 C21.8919103,8.30122788 21.806383,8.09572485 21.6353285,7.94961576 C21.4642739,7.80410061 21.1886861,7.73104606 20.8085648,7.73104606 L20.0388194,7.73104606 L20.0388194,9.42258545 Z M18.2332436,12.8341733 L18.2332436,6.22006424 L21.0936558,6.22006424 C21.6323588,6.22006424 22.0974133,6.31806424 22.4906012,6.51465818 C22.8831952,6.71125212 23.1872921,6.98684 23.4028921,7.34142182 C23.6178982,7.69659758 23.7259952,8.10522788 23.7259952,8.56731273 C23.7259952,9.04246424 23.6178982,9.45762788 23.4028921,9.8122097 C23.1872921,10.1667915 22.8831952,10.4429733 22.4906012,10.6389733 C22.0974133,10.8355673 21.6323588,10.9335673 21.0936558,10.9335673 L20.0388194,10.9335673 L20.0388194,12.8341733 L18.2332436,12.8341733 Z"
                            fill="#FFFFFF"></path>
                        <path
                            d="M14.0706788,11.3992752 C14.3937818,11.3992752 14.6770909,11.322063 14.9212,11.1664509 C15.1653091,11.0114327 15.3553697,10.792863 15.4913818,10.5107418 C15.6279879,10.2286206 15.695697,9.90136 15.695697,9.52717818 C15.695697,9.1535903 15.6279879,8.82573576 15.4913818,8.54361455 C15.3553697,8.26149333 15.1653091,8.04351758 14.9212,7.88790545 C14.6770909,7.73288727 14.3937818,7.65508121 14.0706788,7.65508121 C13.7475758,7.65508121 13.4642667,7.73288727 13.2201576,7.88790545 C12.9760485,8.04351758 12.7859879,8.26149333 12.6499758,8.54361455 C12.5139636,8.82573576 12.4456606,9.1535903 12.4456606,9.52717818 C12.4456606,9.90136 12.5139636,10.2286206 12.6499758,10.5107418 C12.7859879,10.792863 12.9760485,11.0114327 13.2201576,11.1664509 C13.4642667,11.322063 13.7475758,11.3992752 14.0706788,11.3992752 M14.0706788,12.9957842 C13.5634545,12.9957842 13.0995879,12.9090691 12.6784848,12.7344509 C12.2573818,12.5604267 11.8915152,12.3163176 11.5808848,12.0027176 C11.2708485,11.6891176 11.0314909,11.322063 10.8634061,10.9003661 C10.6953212,10.479263 10.6115758,10.0213358 10.6115758,9.52717818 C10.6115758,9.03302061 10.6953212,8.57568727 10.8634061,8.1539903 C11.0314909,7.73288727 11.2708485,7.36523879 11.5808848,7.05163879 C11.8915152,6.73803879 12.2573818,6.49452364 12.6784848,6.31990545 C13.0995879,6.14588121 13.5634545,6.05857212 14.0706788,6.05857212 C14.577903,6.05857212 15.0417697,6.14588121 15.4628727,6.31990545 C15.8839758,6.49452364 16.2498424,6.73803879 16.5604727,7.05163879 C16.871103,7.36523879 17.1098667,7.73288727 17.2779515,8.1539903 C17.4460364,8.57568727 17.5297818,9.03302061 17.5297818,9.52717818 C17.5297818,10.0213358 17.4460364,10.479263 17.2779515,10.9003661 C17.1098667,11.322063 16.871103,11.6891176 16.5604727,12.0027176 C16.2498424,12.3163176 15.8839758,12.5604267 15.4628727,12.7344509 C15.0417697,12.9090691 14.577903,12.9957842 14.0706788,12.9957842"
                            fill="#FFFFFF"></path>
                        <polygon fill="#FFFFFF"
                            points="8.4639503 12.8342327 6.65837455 13.2666206 6.65837455 7.77862061 4.65323515 7.77862061 4.65323515 6.22012364 10.4690897 6.22012364 10.4690897 7.77862061 8.4639503 7.77862061">
                        </polygon>
                    </svg>
                    <span class="p-l-10 f-s-24 f-w-8">#Top 1 in Viet Nam Today</span>
                </div>

                <div class="synopsis m-t-20" style="max-width: 500px;">
                    <p class="f-s-20">
                        @php
                            $description = $topview->description;
                            $trimmedDescription = substr($description, 0, 250);
                            echo $trimmedDescription . '</p>';
                        @endphp
                    </p>
                </div>
                <div class="buttons-container m-t-20">
                    <button class="play-button"
                        onclick="location.href='{{ url('xem-phim/' . $topview->slug . '/tap-' . $topview->episode . '/server-' . $topview->server_id) }}'"><span>
                            <svg viewBox="0 0 24 24">
                                <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                            </svg>
                        </span> <a>Play</a></button>

                    <button onclick="location.href='{{ route('movie', $topview->slug) }}'"
                        class="more-info-button m-t-20"><span>
                            <svg viewBox="0 0 24 24">
                                <path
                                    d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10zm-2 0a8 8 0 0 0-8-8 8 8 0 0 0-8 8 8 8 0 0 0 8 8 8 8 0 0 0 8-8zm-9 6v-7h2v7h-2zm1-8.75a1.21 1.21 0 0 1-.877-.364A1.188 1.188 0 0 1 10.75 8c0-.348.123-.644.372-.886.247-.242.54-.364.878-.364.337 0 .63.122.877.364.248.242.373.538.373.886s-.124.644-.373.886A1.21 1.21 0 0 1 12 9.25z"
                                    fill="currentColor"></path>
                            </svg>
                        </span> More Info</button>
                </div>
            </div>
        </section>
    @endif
    <!--Oscar Movies-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Movies Oscar
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movies_oscar as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                    @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                        @if ($image_check == 'https') {{ $url_update . $image }}
                                                    @else
                                                       {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                    " loading="lazy">
                              
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <!--Romantic Movies-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            {{ $gen_slug->title }}
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movie_animation as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                            @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                            @else
                                                               {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                            " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <!--Movies Us-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Movies US
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movie_us as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                      @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                      @else
                                                         {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                      " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>

    <!--Movies Viet Nam-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Phim Viet Nam
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movie_vietnam as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                      @php
$image_check = substr($mov->movie_image->image, 0, 5);
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                      @else
                                                         {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                      " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <section class="big-section d-flex flex-start container">
        <img src="@php
$image_check = substr($topview_tvseries->image, 0, 5);
 $startPos = strpos($topview_tvseries->image, 'movies/');
$image = substr($topview_tvseries->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                                            @else
                                                                               {{ asset('uploads/movie/' . $topview_tvseries->image) }} @endif"
            alt="" loading="lazy">

        <div class="right-side">
            {{-- <div class="contentlogo">
                            <img src="" alt="content logo" class="show-logo" />
                        </div> --}}

            <!--top 10 ranking badge svg-->
            <div class="ranking d-flex m-t-20 flex-middle">
                <svg id="top-10-badge" viewBox="0 0 28 30" style="height: 50px;">
                    <path d="M0,0 L28,0 L28,30 L0,30 L0,0 Z M2,2 L2,28 L26,28 L26,2 L2,2 Z" fill="#FFFFFF">
                    </path>
                    <path
                        d="M16.8211527,22.1690594 C17.4133103,22.1690594 17.8777709,21.8857503 18.2145345,21.3197261 C18.5512982,20.7531079 18.719977,19.9572291 18.719977,18.9309018 C18.719977,17.9045745 18.5512982,17.1081018 18.2145345,16.5414836 C17.8777709,15.9754594 17.4133103,15.6921503 16.8211527,15.6921503 C16.2289952,15.6921503 15.7645345,15.9754594 15.427177,16.5414836 C15.0904133,17.1081018 14.9223285,17.9045745 14.9223285,18.9309018 C14.9223285,19.9572291 15.0904133,20.7531079 15.427177,21.3197261 C15.7645345,21.8857503 16.2289952,22.1690594 16.8211527,22.1690594 M16.8211527,24.0708533 C15.9872618,24.0708533 15.2579042,23.8605988 14.6324861,23.4406836 C14.0076618,23.0207685 13.5247891,22.4262352 13.1856497,21.6564897 C12.8465103,20.8867442 12.6766436,19.9786109 12.6766436,18.9309018 C12.6766436,17.8921018 12.8465103,16.9857503 13.1856497,16.2118473 C13.5247891,15.4379442 14.0076618,14.8410352 14.6324861,14.4205261 C15.2579042,14.0006109 15.9872618,13.7903564 16.8211527,13.7903564 C17.6544497,13.7903564 18.3844012,14.0006109 19.0098194,14.4205261 C19.6352376,14.8410352 20.1169224,15.4379442 20.4566558,16.2118473 C20.7952012,16.9857503 20.9656618,17.8921018 20.9656618,18.9309018 C20.9656618,19.9786109 20.7952012,20.8867442 20.4566558,21.6564897 C20.1169224,22.4262352 19.6352376,23.0207685 19.0098194,23.4406836 C18.3844012,23.8605988 17.6544497,24.0708533 16.8211527,24.0708533"
                        fill="#FFFFFF"></path>
                    <polygon fill="#FFFFFF"
                        points="8.86676 23.9094206 8.86676 16.6651418 6.88122061 17.1783055 6.88122061 14.9266812 11.0750267 13.8558085 11.0750267 23.9094206">
                    </polygon>
                    <path
                        d="M20.0388194,9.42258545 L20.8085648,9.42258545 C21.1886861,9.42258545 21.4642739,9.34834303 21.6353285,9.19926424 C21.806383,9.05077939 21.8919103,8.83993091 21.8919103,8.56731273 C21.8919103,8.30122788 21.806383,8.09572485 21.6353285,7.94961576 C21.4642739,7.80410061 21.1886861,7.73104606 20.8085648,7.73104606 L20.0388194,7.73104606 L20.0388194,9.42258545 Z M18.2332436,12.8341733 L18.2332436,6.22006424 L21.0936558,6.22006424 C21.6323588,6.22006424 22.0974133,6.31806424 22.4906012,6.51465818 C22.8831952,6.71125212 23.1872921,6.98684 23.4028921,7.34142182 C23.6178982,7.69659758 23.7259952,8.10522788 23.7259952,8.56731273 C23.7259952,9.04246424 23.6178982,9.45762788 23.4028921,9.8122097 C23.1872921,10.1667915 22.8831952,10.4429733 22.4906012,10.6389733 C22.0974133,10.8355673 21.6323588,10.9335673 21.0936558,10.9335673 L20.0388194,10.9335673 L20.0388194,12.8341733 L18.2332436,12.8341733 Z"
                        fill="#FFFFFF"></path>
                    <path
                        d="M14.0706788,11.3992752 C14.3937818,11.3992752 14.6770909,11.322063 14.9212,11.1664509 C15.1653091,11.0114327 15.3553697,10.792863 15.4913818,10.5107418 C15.6279879,10.2286206 15.695697,9.90136 15.695697,9.52717818 C15.695697,9.1535903 15.6279879,8.82573576 15.4913818,8.54361455 C15.3553697,8.26149333 15.1653091,8.04351758 14.9212,7.88790545 C14.6770909,7.73288727 14.3937818,7.65508121 14.0706788,7.65508121 C13.7475758,7.65508121 13.4642667,7.73288727 13.2201576,7.88790545 C12.9760485,8.04351758 12.7859879,8.26149333 12.6499758,8.54361455 C12.5139636,8.82573576 12.4456606,9.1535903 12.4456606,9.52717818 C12.4456606,9.90136 12.5139636,10.2286206 12.6499758,10.5107418 C12.7859879,10.792863 12.9760485,11.0114327 13.2201576,11.1664509 C13.4642667,11.322063 13.7475758,11.3992752 14.0706788,11.3992752 M14.0706788,12.9957842 C13.5634545,12.9957842 13.0995879,12.9090691 12.6784848,12.7344509 C12.2573818,12.5604267 11.8915152,12.3163176 11.5808848,12.0027176 C11.2708485,11.6891176 11.0314909,11.322063 10.8634061,10.9003661 C10.6953212,10.479263 10.6115758,10.0213358 10.6115758,9.52717818 C10.6115758,9.03302061 10.6953212,8.57568727 10.8634061,8.1539903 C11.0314909,7.73288727 11.2708485,7.36523879 11.5808848,7.05163879 C11.8915152,6.73803879 12.2573818,6.49452364 12.6784848,6.31990545 C13.0995879,6.14588121 13.5634545,6.05857212 14.0706788,6.05857212 C14.577903,6.05857212 15.0417697,6.14588121 15.4628727,6.31990545 C15.8839758,6.49452364 16.2498424,6.73803879 16.5604727,7.05163879 C16.871103,7.36523879 17.1098667,7.73288727 17.2779515,8.1539903 C17.4460364,8.57568727 17.5297818,9.03302061 17.5297818,9.52717818 C17.5297818,10.0213358 17.4460364,10.479263 17.2779515,10.9003661 C17.1098667,11.322063 16.871103,11.6891176 16.5604727,12.0027176 C16.2498424,12.3163176 15.8839758,12.5604267 15.4628727,12.7344509 C15.0417697,12.9090691 14.577903,12.9957842 14.0706788,12.9957842"
                        fill="#FFFFFF"></path>
                    <polygon fill="#FFFFFF"
                        points="8.4639503 12.8342327 6.65837455 13.2666206 6.65837455 7.77862061 4.65323515 7.77862061 4.65323515 6.22012364 10.4690897 6.22012364 10.4690897 7.77862061 8.4639503 7.77862061">
                    </polygon>
                </svg>
                <span class="p-l-10 f-s-24 f-w-8">#Top 1 TV Series in Viet Nam Today</span>
            </div>

            <div class="synopsis m-t-20" style="max-width: 500px;">
                <p class="f-s-20">
                    @php
                        $description = $topview_tvseries->description;
                        $trimmedDescription = substr($description, 0, 250);
                        echo $trimmedDescription . '</p>';
                    @endphp
                </p>
            </div>
            <div class="buttons-container m-t-20">
                <button class="play-button"
                    onclick="location.href='{{ url('xem-phim/' . $topview_tvseries->slug . '/tap-' . $topview_tvseries->episode . '/server-' . $topview_tvseries->server_id) }}'"><span>
                        <svg viewBox="0 0 24 24">
                            <path d="M6 4l15 8-15 8z" fill="currentColor"></path>
                        </svg>
                    </span> <a>Play</a></button>

                <button onclick="location.href='{{ route('movie', $topview_tvseries->slug) }}'"
                    class="more-info-button m-t-20"><span>
                        <svg viewBox="0 0 24 24">
                            <path
                                d="M22 12c0 5.523-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2s10 4.477 10 10zm-2 0a8 8 0 0 0-8-8 8 8 0 0 0-8 8 8 8 0 0 0 8 8 8 8 0 0 0 8-8zm-9 6v-7h2v7h-2zm1-8.75a1.21 1.21 0 0 1-.877-.364A1.188 1.188 0 0 1 10.75 8c0-.348.123-.644.372-.886.247-.242.54-.364.878-.364.337 0 .63.122.877.364.248.242.373.538.373.886s-.124.644-.373.886A1.21 1.21 0 0 1 12 9.25z"
                                fill="currentColor"></path>
                        </svg>
                    </span> More Info</button>
            </div>
        </div>
    </section>
    <!--Tv series thai lan-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Tv Series ThaiLan
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($tv_thailan->take(30) as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                  @php
$image_check = substr($mov->movie_image->image, 0, 5); 
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                  @else
                                                     {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                  " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>
    <!--movie horror-->
    <section id="mylist" class="container">

        <h4 class="mylist-heading">
            Phim Kinh Dị
        </h4>
        <div class="mylist-container d-flex flex-start flex-middle flex-no-wrap owl-carousel">
            @foreach ($movie_horror as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <div class="video">
                        <a href="javascript:void(0)"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 video-item thumbnail-respone"
                                src="
                  @php
$image_check = substr($mov->movie_image->image, 0, 5); 
$startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                  @else
                                                     {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif
                  " loading="lazy">
                            <h3 class="title_mobile">{{ $mov->title }}</h3>
                        </a>
                        <div class="video-description d-flex flex-end direction-column">

                            <div class="play-button">
                                <button style="background: none; border:none"
                                    onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
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
                        $originalTitle = $mov->title;
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
                    <p class="season-count text-shadow"> {{ $mov->category->title }}</p>
                </div>
                <div class="genere d-flex flex-no-wrap text-shadow">

                    @foreach ($mov->movie_genre->take(3) as $gen)
                        <p>{{ $gen->title }}
                            @if (!$loop->last)
                                ,
                            @endif
                        </p>
                    @endforeach
                    <a class="button" href="{{ route('movie', $mov->slug) }}"><i class="fa-solid fa-chevron-down fa-xl"
                            style="color: #ffffff;"></i></i></a>
                </div>
        </div>
        </div>
        @endforeach
        </div>

    </section>

    </div>
    </div>
@endsection
