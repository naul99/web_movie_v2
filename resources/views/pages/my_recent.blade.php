@extends('layout')
@section('content')
    <!--my list container-->
    <section id="mylist" class="container p-t-40">
        <h4 class="romantic-heading">
            My Recents
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
        <article class="">
            <div id="row_recent" class="link-container">

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
                    var img = data[i].thumbnail;
                    var url = data[i].url;
                    //alert(img);
                    
                    $("#row_recent").append('<a class="title-link" href="javascript:void(0)" onclick=location.href="'+url['href']+'" ><img height="200px" width="150px" src="' +
                        img + '" class="mylist-img p-r-10 p-t-10 image-size item" alt="'+name+'" loading="lazy"></a>');

                }
            }

        }
        view();
    </script>
@endsection
