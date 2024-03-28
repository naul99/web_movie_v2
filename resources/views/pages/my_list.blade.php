@extends('layout')
@section('content')
    <!--my list container-->
    <section id="mylist" class="container p-t-40">
        <h4 class="romantic-heading">
            My List
        </h4>
        <style>
        </style>
        <article class="">
            <div id="row_wishlist">

            </div>
        </article>

    </section>
    <script>
        function view() {
            if (localStorage.getItem('data') != null) {
                var data = JSON.parse(localStorage.getItem('data'));

                for (var i = data.length - 1; i >= 0; i--) {
                    var name = data[i].name;
                    var slug = data[i].slug;
                    var img = data[i].img;
                    var url= data[i].url;
                    $("#row_wishlist").append('<a href="javascript:void(0)" onclick=location.href="'+url['href']+'" ><img height="200px" width="150px" src="' +
                        img + '" class="mylist-img p-r-10 p-t-10 image-size item" alt="'+name+'" ></a>');

                }
            }

        }
        view();
    </script>
@endsection
