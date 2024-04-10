@extends('layout')
@section('content')
    <!--my list container-->
    <section id="mylist" class="container p-t-40">
        <h4 class="romantic-heading">
            Search
        </h4>
        <style>

        </style>
        <article class="">
            <style>
                .link-container {
                    display: grid;
                    grid-template-columns: 25% 25% 25% 25%;

                }

                .title-link {
                    margin: 6px;
                    max-width: 100%;

                }
                .mylist-img{
                    height: 190px;
                    width: 512px;
                }
                

                @media only screen and (max-width: 1023px) {
                    .link-container {
                        display: grid;
                        grid-template-columns: 50% 50%;
                    }
                    .mylist-img{
                        height: 110px;
                    }
                }
            </style>
            <div class="link-container">
                @foreach ($movie as $key => $mov)
                    @foreach ($mov->episode->take(1) as $ep)
                        <a class="title-link"
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            <img class="mylist-img p-r-10 p-t-10 image-size item"
                                src=" @php
$image_check = substr($mov->movie_image->image, 0, 5); $startPos = strpos($mov->movie_image->image, 'movies/');
$image = substr($mov->movie_image->image, $startPos + strlen('movies/')); @endphp
                                @if ($image_check == 'https') {{ $url_update . $image }}
                                                                                @else
                                                                                   {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif"
                                alt="{{ $mov->title }}" loading="lazy" c></a>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </article>

    </section>
    <div class="text-right">
        {{ $movie->appends($_GET)->links('vendor.pagination.custom') }}
    </div>
@endsection
