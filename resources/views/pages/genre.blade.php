@extends('layout')
@section('content')
    <section id="mylist" class="container p-t-40" style="padding-top: 180px;">
        <h4 class="romantic-heading">
            My List
        </h4>
        <style>
            .img-responsive{
                height: 200px;
                widows: 200px;
            }
        </style>
        <article class="">
            @foreach ($movie as $key => $mov)
                <a>
                    @php
                        $image_check = substr($mov->movie_image->image, 0, 5);
                    @endphp
                    @if ($image_check == 'https')
                        <img class="lazy img-responsive" src="{{ $mov->movie_image->image }}" alt="{{ $mov->title }}"
                            title="{{ $mov->title }}">
                    @else
                        <img class="lazy img-responsive" src="{{ asset('uploads/movie/' . $mov->movie_image->image) }}"
                            alt="{{ $mov->title }}" title="{{ $mov->title }}">
                    @endif
                </a>
            @endforeach
            </div>
        </article>

    </section>

    <div class="text-right">
        {!! $movie->links('vendor.pagination.custom') !!}
    </div>
@endsection
