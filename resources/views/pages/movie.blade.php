@extends('layout')
@section('css')
    <link rel="stylesheet" href="/css/detail.css">
@endsection
@section('content')
    <div class="text-white">
        <div class="md:grid md:place-items-center"><img class="md:w-[74rem] md:rounded-b-md"
                src=" @php
$image_check = substr($movie_thumbnail->movie_image->image, 0, 5);  
$startPos = strpos($movie_thumbnail->movie_image->image, 'movies/');
$image = substr($movie_thumbnail->movie_image->image, $startPos + strlen('movies/')); @endphp
                                                                            @if ($image_check == 'https') {{ $url_update . $image }}
                                                                            @else
                                                                               {{ asset('uploads/movie/' . $movie_thumbnail->movie_image->image) }} @endif">
        </div><img class="-mt-32 ml-4 w-36 rounded-xl md:-mt-[16rem] md:ml-32 md:w-72"
            src=" @php
$image_check = substr($movie->movie_image->image, 0, 5);
$startPos = strpos($movie->movie_image->image, 'movies/');
$image = substr($movie->movie_image->image, $startPos + strlen('movies/')); @endphp
                                                                            @if ($image_check == 'https') {{ $url_update . $image }}
                                                                        @else
                                                                           {{ asset('uploads/movie/' . $movie->movie_image->image) }} @endif"
            alt="The Incident">
        <button href="#"
            onclick="location.href='{{ url('xem-phim/' . $movie->slug . '/tap-' . $episode_first->episode . '/server-' . $episode_first->server_id) }}'"
            class="block absolute right-2  top-[14.6rem]  ml-12  mr-3 mt-6 flex w-40 items-center  justify-center  rounded-lg bg-white py-[.42rem] font-light text-black md:right-[4.5rem] md:top-[42rem] md:font-semibold ">
            <img class="none mr-1 w-3">Play</button>
        <h1 class="ml-5 mt-2  text-2xl font-bold md:absolute  md:left-[25.3rem] md:top-[41.5rem] md:text-3xl">
            {{ $movie->title }}</h1>
        <h1 class="bg-red mb-1 ml-5 text-xs md:absolute md:left-[25.3rem] md:top-[44rem] md:pt-2 md:text-sm md:font-normal">
            Name English: {{ $movie->name_english }} @if ($movie->season != 0)
                Season {{ $movie->season }}
            @endif
        </h1>
        <h1 class=" ml-5 font-semibold md:absolute md:left-[25.3rem] md:top-[44.8rem] md:pt-3 md:text-xl">
            {{ $values }}
            ⭐</span></h1>
        <h1
            class="ml-5 text-sm font-thin md:absolute md:left-[25.3rem] md:top-[46.8rem] md:pt-[.3rem]  md:text-base md:font-medium">
            @if ($movie->type_movie == '0')
                {{ $times }}
            @else
                {{ $times }}/ Tập
            @endif
        </h1>
        <h1
            class="mb-2 ml-5 text-sm font-extralight md:absolute md:left-[25.3rem] md:top-[48.4rem] md:text-base md:font-normal">
            {{ $movie->year }}</h1>
        <ul class="ml-2 flex flex-wrap gap-1 md:absolute md:left-[25.3rem] md:top-[50.2rem] md:gap-5 md:pl-2">
            @foreach ($movie->movie_genre as $gen)
                <li class="rounded-full border px-2 py-1 md:border-2 md:px-3 md:font-medium">

                    <a href="{{ route('genre', $gen->slug) }}" rel="category tag">
                        {{ $gen->title }}
                    </a>
                </li>
            @endforeach
        </ul>
        <h1 class="ml-2 mt-5   text-2xl font-bold text-slate-300 md:mb-5 md:ml-20 md:mt-8  md:text-3xl">Descriptions
        </h1>
        <h1 class="mx-2 mt-1 text-sm md:ml-20 md:w-[50rem] md:text-lg"> {!! $movie->movie_description->description !!}</h1>
        <h1 class="ml-2 mt-5   text-2xl font-bold text-slate-300 md:mb-5 md:ml-20 md:mt-8  md:text-3xl">#Tag
        </h1>
        <h1 class="mx-2 mt-1 text-sm md:ml-20 md:w-[50rem] md:text-lg">
            @if (isset($movie->movie_tags))
                @php
                    $tagss = [];
                    $tagss = explode(',', $movie->movie_tags->tags);
                @endphp
                @foreach ($tagss as $key => $tag)
                    {{-- <a class="badge badge-dark" href="{{ url('tag/' . $tag) }}"> #{{ $tag }}</a> --}}
                    <a class="tag"
                        style="display: inline-block;
                    padding: .25em 1.4em;
                    font-size: 130%;
                    font-weight: 800;
                    line-height: 1;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: baseline;
                    border-radius: .25rem;
                    text-decoration: none;
                    background-color: #117a8b;
                    color:#fff;
                    margin: 1%;"
                        href="{{ url('tag/' . $tag) }}">#{{ $tag }}</a>
                @endforeach
            @endif
        </h1>
        <h1 class="ml-2 mt-5   text-2xl font-bold text-slate-300 md:mb-5 md:ml-20 md:mt-8  md:text-3xl">Trailer
        </h1>
        <h1 class="mx-2 mt-1 text-sm md:ml-20 md:w-[50rem] md:text-lg"><iframe height="360px" width="80%"
                src="https://www.youtube.com/embed/{{ $movie->movie_trailer->trailer }}?rel=0&amp;autoplay=1&mute=1"
                frameborder="0" allowfullscreen></iframe></h1>
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

    </div>
@endsection
