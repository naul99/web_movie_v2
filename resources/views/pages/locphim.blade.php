@extends('layout')
@section('content')
    <section id="mylist" class="container p-t-40" style="padding-top: 50px;">
        <h4 class="romantic-heading">
            Kết Quả Lọc
        </h4>
        <style>
            .img-responsive {
                height: 200px;
                widows: 200px;
            }
        </style>
        <article class="">
            @if (count($movie) != 0)
                @foreach ($movie as $key => $mov)
                    @foreach ($mov->episode->take(1) as $ep)
                        <a
                            onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                            @php
                                $image_check = substr($mov->movie_image->image, 0, 5);
                                $startPos = strpos($mov->movie_image->image, 'movies/');
                                $image = substr($mov->movie_image->image, $startPos + strlen('movies/'));
                            @endphp
                            @if ($image_check == 'https')
                                <img class="lazy img-responsive" src="{{ $url_update . $image }}" alt="{{ $mov->title }}"
                                    title="{{ $mov->title }}">
                            @else
                                <img class="lazy img-responsive"
                                    src="{{ asset('uploads/movie/' . $mov->movie_image->image) }}" alt="{{ $mov->title }}"
                                    title="{{ $mov->title }}">
                            @endif
                        </a>
                    @endforeach
                @endforeach
            @else
                <span>Không tìm thấy phim!</span>
            @endif
        </article>
    </section>

    <div class="text-right">
        {{ $movie->appends($_GET)->links('vendor.pagination.custom') }}
    </div>
@endsection
