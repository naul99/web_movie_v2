@extends('layout')
@section('content')
    <!--my list container-->
    <section id="mylist" class="container p-t-40">
        <h4 class="romantic-heading">
            My Recents
        </h4>
        <style>
        </style>
        <article class="">
            <div id="row_recent">

            </div>
        </article>

    </section>
    <script>
        function view() {
            if (localStorage.getItem('data_recent') != null) {
                var data = JSON.parse(localStorage.getItem('data_recent'));

                for (var i = 0 ; i <= data.length ; i++) {
                    var name = data[i].name;
                    var slug = data[i].slug;
                    var img = data[i].img;
                    $("#row_recent").append('<a href="/movie/' + slug + '" ><img height="200px" width="150px" src="' +
                        img + '" class="mylist-img p-r-10 p-t-10 image-size item" alt="'+name+'" ></a>');

                }
            }

        }
        view();
    </script>
@endsection
