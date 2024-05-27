@extends('layout')
@section('content')
    <section id="mylist" class="container p-t-40">
        <h4 class="romantic-heading">
            Kết Quả Lọc
        </h4>
        <style>
            .link-container {
                display: grid;
                grid-template-columns: 25% 25% 25% 25%;

            }

            .title-link {
                margin: 6px;
                max-width: 100%;

            }

            .mylist-img {
                height: 190px;
                width: 512px;
            }


            @media only screen and (max-width: 1023px) {
                .link-container {
                    display: grid;
                    grid-template-columns: 50% 50%;
                }

                .mylist-img {
                    height: 110px;
                }
            }
        </style>
        <article class="">
            @if (count($movie) != 0)
                <div class="link-container">
                    @foreach ($movie as $key => $mov)
                        @foreach ($mov->episode->take(1) as $ep)
                            <a class="title-link"
                                onclick="location.href='{{ url('xem-phim/' . $mov->slug . '/tap-' . $ep->episode . '/server-' . $ep->server_id) }}'">
                                @php
                                    $image_check = substr($mov->movie_image->image, 0, 5);
                                    $startPos = strpos($mov->movie_image->image, 'movies/');
                                    $image = substr($mov->movie_image->image, $startPos + strlen('movies/'));
                                @endphp
                                @if ($image_check == 'https')
                                    <img height="200px" width="150px" class="mylist-img p-r-10 p-t-10 image-size item"
                                        loading="lazy" src="{{ $url_update . $image }}" alt="{{ $mov->title }}"
                                        title="{{ $mov->title }}">
                                @else
                                    <img height="200px" width="150px" class="mylist-img p-r-10 p-t-10 image-size item"
                                        loading="lazy" src="{{ asset('uploads/movie/' . $mov->movie_image->image) }}"
                                        alt="{{ $mov->title }}" title="{{ $mov->title }}">
                                @endif
                            </a>
                        @endforeach
                    @endforeach
                </div>
            @else
                <span>Không tìm thấy phim!</span>
            @endif
        </article>
    </section>

    <div class="text-right">
        {{ $movie->appends($_GET)->links('vendor.pagination.custom') }}
    </div>
@endsection
