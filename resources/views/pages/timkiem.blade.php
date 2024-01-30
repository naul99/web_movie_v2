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
            @foreach ($movie as $key => $mov)
                @foreach ($mov->episode->take(1) as $ep)
                    <a onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                        <img height="400px" width="300px" src=" @php
$image_check = substr($mov->movie_image->image, 0, 5); @endphp
                                                                                @if ($image_check == 'https') {{ $mov->movie_image->image }}
                                                                                @else
                                                                                   {{ asset('uploads/movie/' . $mov->movie_image->image) }} @endif"
                            alt="" class="mylist-img p-r-10 p-t-10 image-size item"></a>
                    </a>
                @endforeach
            @endforeach
            </div>
        </article>

    </section>
@endsection
