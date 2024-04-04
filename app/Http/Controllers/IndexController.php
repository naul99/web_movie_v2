<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Genre;
use App\Models\Country;
use App\Models\Customer;
use App\Models\Movie;
use App\Models\Episode;
use App\Models\Movie_Genre;
use App\Models\Movie_Views;
use App\Models\Rating;
use App\Models\Cast;
use App\Models\Directors;
use App\Models\Movie_Directors;
use App\Models\Movie_Cast;
use App\Models\Info;
use App\Models\Server;
use App\Models\Movie_Package;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function search()
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        return view('pages.search', compact('category'));
    }


    public function timkiem()
    {
        if (isset($_GET['search'])) {
            $search = $_GET['search'];
            $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
            $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
            $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
            //$cate_slug = Category::where('slug', $slug)->first(); 

            $movie = Movie::where(function ($querys) {
                $search = $_GET['search'];
                $cast_slug = Cast::where('title', 'LIKE', '%' . $search . '%')->first();
                if (isset($cast_slug)) {
                    $movie_cast = Movie_Cast::where('cast_id', $cast_slug->id)->get();
                    $many_cast = [];
                    foreach ($movie_cast as $key => $movi) {
                        $many_cast[] = $movi->movie_id;
                    }
                } else {
                    $many_cast = [];
                }

                $querys->orWhere('name_english', 'LIKE', '%' . $search . '%')->orWhereIn('id', $many_cast)->orwhereRaw("MATCH(title) AGAINST(? IN BOOLEAN MODE)",[$search]);
            })->where('status', 1)->with(['episode' => function ($ep) {
                $ep->orderBy('episode', 'ASC');
            }])->orderBy('id','DESC')->paginate(20);
            $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
            $url_update = $api_ophim['pathImage'];
            //dd($movie);


            // $movie = Movie::whereIn('id', $many_cast)->where('status', 1)->withCount(['episode' => function ($query) {
            //     $query->select(DB::raw('count(distinct(episode))'));
            // }])->orderBy('updated_at', 'DESC')->paginate(12);

            return view('pages.timkiem', compact('category', 'genre', 'country', 'search', 'movie', 'url_update'));
        } else {
            $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
            return view('pages.search', compact('category'));
        }
    }
    public function home()
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        //qua ba
        $category_home = Category::with(['movie' => function ($m) {
            $m->where('status', 1)->with(['movie_image' => function ($thumb) {
                $thumb->where('is_thumbnail', 1);
            }])->with(['episode' => function ($ep) {
                $ep->orderBy('episode', 'ASC');
            }]);
        }])->orderBy('position', 'ASC')->where('status', 1)->get();
        // foreach($category_home as $mov){
        //     foreach($mov->movie as $mo){
        //         dd($mo);
        //     }
        // }
        // dd($category_home);
        //$hot = Movie::with()->get();
        $hot = Movie::with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->where('hot', 1)->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->where('status', 1)->orderBy('updated_at', 'DESC')->get();

        $day = Carbon::today('Asia/Ho_Chi_Minh')->subDays(0)->startOfDay();
        // $startOfMonth = Carbon::now()->startOfMonth();
        // $endOfMonth = Carbon::now()->endOfMonth();
        // $week = Carbon::today('Asia/Ho_Chi_Minh')->subDays(7)->startOfDay();

        //dd($hot);
        $topview = Movie::select('title', 'slug', 'image', 'season', 'episode', 'server_id', 'description', DB::raw('SUM(count_views) as count_views'))->groupBy('title', 'slug', 'image', 'season', 'episode', 'server_id', 'description')->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
            ->join('movie_image', 'movie_views.movie_id', '=', 'movie_image.movie_id')->join('movie_description', 'movie_image.movie_id', '=', 'movie_description.movie_id')->where('is_thumbnail', 1)->where('movies.status', 1)->orderBy('count_views', 'DESC')->join('episodes', 'movies.id', '=', 'episodes.movie_id')->orderBy('episode', 'ASC')->first();
        $topview_tvseries = Movie::select('title', 'slug', 'image', 'season', 'episode', 'server_id', 'description', DB::raw('SUM(count_views) as count_views'))->groupBy('title', 'slug', 'image', 'season', 'episode', 'server_id', 'description')->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
            ->join('movie_image', 'movie_views.movie_id', '=', 'movie_image.movie_id')->join('movie_description', 'movie_image.movie_id', '=', 'movie_description.movie_id')->where('is_thumbnail', 1)->where('movies.type_movie', 1)->where('movies.status', 1)->orderBy('count_views', 'DESC')->join('episodes', 'movies.id', '=', 'episodes.movie_id')->orderBy('episode', 'ASC')->first();
            // dd($topview_tvseries);
        $topview_day = Movie::join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
            ->join('movie_image', 'movie_views.movie_id', '=', 'movie_image.movie_id')->join('movie_description', 'movie_image.movie_id', '=', 'movie_description.movie_id')
            ->where('date_views', $day)->where('movies.status', 1)->where('is_thumbnail', 1)->orderBy('count_views', 'DESC')->join('episodes', 'movies.id', '=', 'episodes.movie_id')->orderBy('episode', 'ASC')->first();
      
        // $topview_week = Movie::select('title', 'slug', 'image', 'season', DB::raw('SUM(count_views) as count_views'))->groupBy('title', 'slug', 'image', 'season')->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
        //     ->join('movie_image', 'movie_views.movie_id', '=', 'movie_image.movie_id')
        //     ->whereBetween('date_views', [$week, $day])->where('status', 1)->orderBy('count_views', 'DESC')->paginate(5);

        // $topview_month = Movie::select('title', 'slug', 'image', 'season', DB::raw('SUM(count_views) as count_views'))->groupBy('title', 'slug', 'image', 'season')->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
        //     ->join('movie_image', 'movie_views.movie_id', '=', 'movie_image.movie_id')
        //     ->whereBetween('date_views', [$startOfMonth, $endOfMonth])->where('status', 1)->orderBy('count_views', 'DESC')->paginate(5);

        $gen_slug = Genre::where('title', 'LIKE', '%hoat hinh%')->first();

        $movie_genre = Movie_Genre::where('genre_id', $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie_animation = Movie::whereIn('id', $many_genre)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        //movie oscar

        $oscar = Genre::where('title', 'LIKE', '%Oscar%')->first();

        $movie_oscar = Movie_Genre::where('genre_id', $oscar->id)->get();
        $many_oscar = [];
        foreach ($movie_oscar as $key => $mov) {
            $many_oscar[] = $mov->movie_id;
        }
        $movies_oscar = Movie::whereIn('id', $many_oscar)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();


        //movie us
        $list_country = ['Au My', 'Phap', 'Anh', 'Y', 'Duc'];
        $many_country = [];
        foreach ($list_country as $countr) {
            $country_slug = Country::where('title', 'LIKE', '%' . $countr . '%')->get();
            foreach ($country_slug as $coun) {
                $many_country[] = $coun->id;
            }
        }

        $movie_us = Movie::whereIn('country_id', $many_country)->where('type_movie', 0)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        //movie viet nam
        $list_country = ['Viet Nam'];
        $many_country = [];
        foreach ($list_country as $countr) {
            $country_slug = Country::where('title', 'LIKE', '%' . $countr . '%')->get();
            foreach ($country_slug as $coun) {
                $many_country[] = $coun->id;
            }
        }

        $movie_vietnam = Movie::whereIn('country_id', $many_country)->where('type_movie', 0)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        //tv series thailan
        $list_country = ['Thai Lan'];
        $many_country = [];
        foreach ($list_country as $countr) {
            $country_slug = Country::where('title', 'LIKE', '%' . $countr . '%')->get();
            foreach ($country_slug as $coun) {
                $many_country[] = $coun->id;
            }
        }

        $tv_thailan = Movie::whereIn('country_id', $many_country)->where('type_movie', 1)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        $gen_horror_slug = Genre::where('title', 'LIKE', '%kinh di%')->first();

        $movie_genre = Movie_Genre::where('genre_id', $gen_horror_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie_horror = Movie::whereIn('id', $many_genre)->where('type_movie', 0)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        return view('pages.home', compact('category', 'genre', 'country', 'category_home', 'hot', 'topview', 'topview_day', 'movie_animation', 'gen_slug', 'movie_us', 'movie_vietnam', 'tv_thailan', 'movie_horror', 'topview_tvseries', 'url_update'));
    }
    public function category($slug)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        //qua ba

        $cate_movie = Category::where('slug', $slug)->first();
        $category_page = Movie::with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->with(['episode' => function ($ep) {
            $ep->orderBy('episode', 'ASC');
        }])->where('status', 1)->where('category_id', $cate_movie->id)->get();

        $hot = Movie::with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->where('hot', 1)->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->where('status', 1)->where('category_id', $cate_movie->id)->orderBy('updated_at', 'DESC')->get();

        $gen_slug = Genre::where('title', 'LIKE', '%hoat hinh%')->first();

        $movie_genre = Movie_Genre::where('genre_id', $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie_animation = Movie::whereIn('id', $many_genre)->where('category_id', $cate_movie->id)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        //movie asia
        $list_country = ['Viet Nam', 'Nhat Ban', 'Trung Quoc', 'Thai Lan', 'Han Quoc', 'Dai Loan'];
        $many_country = [];
        foreach ($list_country as $countr) {
            $country_slug = Country::where('title', 'LIKE', '%' . $countr . '%')->get();
            foreach ($country_slug as $coun) {
                $many_country[] = $coun->id;
            }
        }

        $movie_asia = Movie::whereIn('country_id', $many_country)->where('category_id', $cate_movie->id)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();



        //only netflix
        $gen_slug_netflix = Genre::where('title', 'LIKE', '%netflix%')->first();

        $movie_genre_netflix = Movie_Genre::where('genre_id', $gen_slug_netflix->id)->get();
        $many_genre_netflix = [];
        foreach ($movie_genre_netflix as $key => $movi_netflix) {
            $many_genre_netflix[] = $movi_netflix->movie_id;
        }
        $movie_netlix = Movie::whereIn('id', $many_genre_netflix)->where('category_id', $cate_movie->id)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();

        //movie asia


        $country__korea_slug = Country::where('title', 'LIKE', '%han quoc%')->first();

        $movie_korea = Movie::where('country_id', $country__korea_slug->id)->where('category_id', $cate_movie->id)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->get();
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        return view('pages.category', compact('category', 'genre', 'country', 'category_page', 'hot', 'movie_animation', 'gen_slug', 'cate_movie', 'movie_asia', 'movie_netlix', 'movie_korea', 'url_update','movies_oscar'));
    }
    public function year($year)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        if ($year == 'more') {
            $movie = Movie::where('status', 1)->where('year', '<', 2000)->with(['episode' => function ($query) {
                $query->orderBy('episode', 'ASC');
            }])->with(['movie_image' => function ($thumb) {
                $thumb->where('is_thumbnail', 1);
            }])->orderBy('updated_at', 'DESC')->paginate(40);
        } else {

            $movie = Movie::where('status', 1)->where('year', $year)->with(['episode' => function ($query) {
                $query->orderBy('episode', 'ASC');
            }])->with(['movie_image' => function ($thumb) {
                $thumb->where('is_thumbnail', 1);
            }])->orderBy('updated_at', 'DESC')->paginate(20);
        }
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        //dd($movie);
        return view('pages.year', compact('category', 'genre', 'country', 'year', 'movie', 'url_update'));
    }

    public function tag($tag)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $tag = $tag;
        $movie = Movie::join('movie_tags', 'movies.id', '=', 'movie_tags.movie_id')->where('tags', 'LIKE', '%' . $tag . '%')->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->paginate(20);
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        //dd($movie);
        return view('pages.tag', compact('category', 'genre', 'country', 'tag', 'movie', 'url_update'));
    }
    public function genre($slug)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $gen_slug = Genre::where('slug', $slug)->first();
        if (!isset($gen_slug)) {
            return redirect()->back();
        }
        $movie_genre = Movie_Genre::where('genre_id', $gen_slug->id)->get();
        $many_genre = [];
        foreach ($movie_genre as $key => $movi) {
            $many_genre[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_genre)->where('status', 1)->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->orderBy('updated_at', 'DESC')->paginate(20);
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        //dd($many_genre);
        return view('pages.genre', compact('category', 'genre', 'country', 'gen_slug', 'movie', 'url_update'));
    }
    public function country($slug)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $count_slug = Country::where('slug', $slug)->first();
        if (!isset($count_slug)) {
            return redirect()->back();
        }
        $movie = Movie::where('country_id', $count_slug->id)->where('status', 1)->withCount(['episode' => function ($query) {
            $query->select(DB::raw('count(distinct(episode))'));
        }])->orderBy('updated_at', 'DESC')->paginate(20);
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        return view('pages.country', compact('category', 'genre', 'country', 'count_slug', 'movie', 'url_update'));
    }
    public function all_movies()
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();

        $movie = Movie::where('status', 1)->withCount(['episode' => function ($query) {
            $query->select(DB::raw('count(distinct(episode))'));
        }])->orderBy('updated_at', 'DESC')->paginate(8);
        //dd($many_genre);
        return view('pages.allmovies', compact('category', 'genre', 'country', 'movie'));
    }
    public function directors($slug)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $directors_slug = Directors::where('slug', $slug)->first();
        if (!isset($directors_slug)) {
            return redirect()->back();
        }
        $movie_directors = Movie_Directors::where('directors_id', $directors_slug->id)->get();
        $many_directors = [];
        foreach ($movie_directors as $key => $movi) {
            $many_directors[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_directors)->where('status', 1)->withCount(['episode' => function ($query) {
            $query->select(DB::raw('count(distinct(episode))'));
        }])->orderBy('updated_at', 'DESC')->paginate(20);
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        //dd($many_genre);
        return view('pages.directors', compact('category', 'genre', 'country', 'directors_slug', 'movie', 'url_update'));
    }
    public function cast($slug)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $cast_slug = Cast::where('slug', $slug)->first();
        if (!isset($cast_slug)) {
            return redirect()->back();
        }
        $movie_cast = Movie_Cast::where('cast_id', $cast_slug->id)->get();

        $many_cast = [];
        foreach ($movie_cast as $key => $movi) {
            $many_cast[] = $movi->movie_id;
        }
        $movie = Movie::whereIn('id', $many_cast)->where('status', 1)->withCount(['episode' => function ($query) {
            $query->select(DB::raw('count(distinct(episode))'));
        }])->orderBy('updated_at', 'DESC')->paginate(20);
        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];
        //dd($many_genre);
        return view('pages.cast', compact('category', 'genre', 'country', 'cast_slug', 'movie', 'url_update'));
    }
    public function movie(Request $request, $slug)
    {
        //check internet
        // $connected = @fsockopen("www.omdbapi.com", 80);
        // //website, port  (try 80 or 443)
        // if ($connected) {
        //     $is_conn = true; //action when connected
        //     fclose($connected);
        // } else {
        //     $is_conn = false; //action in connection failure
        // }


        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $movie_thumbnail = Movie::select('id')->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->where('slug', $slug)->where('status', 1)->first();
        $movie = Movie::with('category', 'genre', 'country', 'movie_genre', 'movie_cast', 'movie_directors', 'movie_tags', 'movie_views')->where('slug', $slug)->where('status', 1)->first();
        if (!isset($movie)) {
            return redirect()->back();
        }
        $minutes = Movie::select('time')->where('slug', $slug)->first();
        if (floor($minutes->time / 60) == 0) {
            $times = ($minutes->time - floor($minutes->time / 60) * 60) . 'm';
        } elseif (($minutes->time - floor($minutes->time / 60) * 60) == 0) {
            $times = floor($minutes->time / 60) . 'h';
        } else
            $times = floor($minutes->time / 60) . 'h ' . ($minutes->time - floor($minutes->time / 60) * 60) . 'm';

        $related = Movie::with('category', 'genre', 'country')->where('status', 1)->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->get();

        $episode_first = Episode::with('movie')->where('movie_id', $movie->id)->orderBy('episode', 'ASC')->take(1)->first();
        //lay tap phim
        $query = "CAST(episode AS SIGNED INTEGER) DESC";
        $episode = Episode::with('movie')->where('movie_id', $movie->id)->orderByRaw($query)->take(4)->get()->unique('episode');
        //dd($episode);
        //lay tap da them link
        $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get()->unique('episode');
        $episode_current_list_count = $episode_current_list->count();

        //xu ly api from imdb
        // $data = Movie::with('movie_rating')->where('slug', $slug)->where('status', 1)->first();

        // foreach ($data->movie_rating as $value) {

        // if ($is_conn == true) {
        $api_imdb = Http::get('https://www.omdbapi.com/?i=' . $movie->imdb . '&apikey=6c2f1ca1');


        if ($api_imdb->status() == 200) {
            if ($api_imdb['Response'] == "True" && $api_imdb['imdbRating'] != "N/A") {
                $values = $api_imdb['imdbRating'] . ' /10';
            } elseif ($api_imdb['Response'] == "False") {
                $values = "N/A";
            } elseif ($api_imdb['Response'] == "True") {
                $values = $api_imdb['imdbRating'];
            }
        } else
            return $values = "N/A";
        // } else
        //     return $values = "Connection false!";

        $link_imdb = ('https://www.imdb.com/title/' . $movie->imdb);
        // }
        //xu ly comments
        // $comments = Movie::with('movie_comments.replies', 'movie_comments.user:id,name,avatar', 'movie_comments.replies.user:id,name,avatar', 'movie_comments.replies.replies.user:id,name,avatar')->where('slug', $slug)->first();


        // $avatar_comment = Comment::join('customers','comments.user_id','=','customers.id')->where('movie_id', $movie->id)->orderBy('comments.id', 'DESC')->get();

        // $avatar_reply = Reply::join('customers','replies.user_id','=','customers.id')->where('movie_id', $movie->id)->get();

        // $count = 0;
        // $counts = 0;

        //dd($data['comment_id']);
        //xuly comment

        //$movie_tags = Movie::select('tags')->join('movie_tags', 'movies.id', '=', 'movie_tags.movie_id')->where('slug', $slug)->get();
        //$movie_tags = Movie::with('movie_tags')->where('slug', $slug)->get();

        //dd($movie_tags);
        //dd($replys);
        // $user = Customer::where('status', 1)->get();
        // if (Auth::guard('customer')->check($user)) {
        //     $user_id = Auth::guard('customer')->user()->id;
        // } else {
        //     $user_id = '0';
        // }
        //$watched = Movie_History::where('user_id', $user_id)->where('movie_id', $movie->id)->get();
        //dd($watched);
        $rating = Rating::where('movie_id', $movie->id)->avg('rating');
        $rating = round($rating, 1);
        $count_total = Rating::where('movie_id', $movie->id)->count();

        //save views movie for day
        $day = Carbon::today('Asia/Ho_Chi_Minh')->subDays(0)->startOfDay();


        $count_view = Movie_Views::where('movie_id', $movie->id)->where('date_views', $day)->first();
        if ($count_view) {
            $count_views = $count_view->count_views + 1;
            $count_view->count_views = $count_views;
            //dd($count_view);
            $count_view->save();
        } else {
            $count_view = new Movie_Views();
            $count_view->count_views = '1';
            $count_view->movie_id = $movie->id;
            $count_view->date_views = Carbon::now('Asia/Ho_Chi_Minh')->format('Y:m:d');
            $count_view->save();
        }

        $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
        $url_update = $api_ophim['pathImage'];

        return view('pages.movie', compact('category', 'genre', 'country', 'movie', 'related', 'episode', 'episode_first', 'episode_current_list_count', 'times', 'values', 'link_imdb', 'count_total', 'rating', 'movie_thumbnail', 'url_update'));
    }
    public function add_rating(Request $request)
    {
        $data = $request->all();
        $ip_address = $request->ip();

        //reviews get ip_address

        // $rating_count = Rating::where('movie_id', $data['movie_id'])->where('ip_address', $ip_address)->count();
        // if ($rating_count > 0) {
        //     echo 'exist';
        // } else {
        //     $rating = new Rating();
        //     $rating->movie_id = $data['movie_id'];
        //     $rating->rating = $data['index'];
        //     $rating->ip_address = $ip_address;
        //     $rating->save();
        //     echo 'done';
        // }

        //reviews free
        $rating = new Rating();
        $rating->movie_id = $data['movie_id'];
        $rating->rating = $data['index'];
        $rating->ip_address = $ip_address;
        $rating->save();
        echo 'done';
    }
    public function title($slug, $tap)
    {
        $movie = Movie::where('slug', $slug)->where('status', 1)->first();
        //dd($movie);
        $tapphim = $tap;
        return view('layout', compact('movie', 'tapphim'));
    }
    public function watch($slug, $tap, $server_active)
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
        $movie = Movie::with('category', 'genre', 'country', 'episode')->where('slug', $slug)->where('status', 1)->first();
        $minutes = Movie::select('time')->where('slug', $slug)->first();
        if (floor($minutes->time / 60) == 0) {
            $times = ($minutes->time - floor($minutes->time / 60) * 60) . 'm';
        } elseif (($minutes->time - floor($minutes->time / 60) * 60) == 0) {
            $times = floor($minutes->time / 60) . 'h';
        } else
            $times = floor($minutes->time / 60) . 'h ' . ($minutes->time - floor($minutes->time / 60) * 60) . 'm';
        //save views movie for day
        $day = Carbon::today('Asia/Ho_Chi_Minh')->subDays(0)->startOfDay();

        $count_view = Movie_Views::where('movie_id', $movie->id)->where('date_views', $day)->first();
        if ($count_view) {
            $count_views = $count_view->count_views + 1;
            $count_view->count_views = $count_views;
            //dd($count_view);
            $count_view->save();
        } else {
            $count_view = new Movie_Views();
            $count_view->count_views = '1';
            $count_view->movie_id = $movie->id;
            $count_view->date_views = Carbon::now('Asia/Ho_Chi_Minh')->format('Y:m:d');
            $count_view->save();
        }
        if (!isset($movie)) {
            return redirect()->back();
        }
        $related = Movie::with('category', 'genre', 'country')->where('status', 1)->where('category_id', $movie->category->id)->orderby(DB::raw('RAND()'))->whereNotIn('slug', [$slug])->with(['episode' => function ($query) {
            $query->orderBy('episode', 'ASC');
        }])->with(['movie_image' => function ($thumb) {
            $thumb->where('is_thumbnail', 1);
        }])->get();

        $ser = substr($server_active, 7, 10);

        try {
            if (isset($tap)) {
                $tapphim = $tap;
                $tapphim = substr($tap, 4, 10);
                $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->where('server_id', $ser)->first();
                if (!isset($episode)) {
                    return redirect()->back();
                }
            } else {
                $tapphim = 1;
                $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->where('server_id', $ser)->first();
            }

            $server = Server::orderby('id', 'DESC')->get();
            $views = Movie::select('title', DB::raw('SUM(count_views) as count_views'))->groupBy('title')->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')
                ->where('movies.id', $movie->id)->orderBy('count_views', 'DESC')->first();

            $episode_movie = Episode::where('movie_id', $movie->id)->get()->unique('server_id');
            $query = "CAST(episode AS SIGNED INTEGER) ASC";
            $episode_list = Episode::where('movie_id', $movie->id)->orderByRaw($query)->get();

            $api_imdb = Http::get('https://www.omdbapi.com/?i=' . $movie->imdb . '&apikey=6c2f1ca1');
            if ($api_imdb->status() == 200) {
                if ($api_imdb['Response'] == "True" && $api_imdb['imdbRating'] != "N/A") {
                    $values = $api_imdb['imdbRating'] . ' /10';
                } elseif ($api_imdb['Response'] == "False") {
                    $values = "N/A";
                } elseif ($api_imdb['Response'] == "True") {
                    $values = $api_imdb['imdbRating'];
                }
            } else
                return $values = "N/A";
            $episode_current_list = Episode::with('movie')->where('movie_id', $movie->id)->get()->unique('episode');
            $episode_current_list_count = $episode_current_list->count();
            $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
            $url_update = $api_ophim['pathImage'];
            return view('pages.watch', compact('category', 'genre', 'country', 'movie', 'related', 'episode', 'tapphim', 'views', 'server', 'episode_movie', 'episode_list', 'server_active', 'times', 'values', 'episode_current_list_count', 'url_update'));
        } catch (ModelNotFoundException $th) {
            return redirect()->back();
        }
        //}

        //return response()->json($movie);
    }
    public function episode()
    {
        return view('pages.episode');
    }
    //loc phim
    public function locphim()
    {

        //get
        $sort = $_GET['order'];
        $category_get = $_GET['category'];
        $genre_get = $_GET['genre'];
        $country_get = $_GET['country'];
        $year_get = $_GET['year'];

        if ($sort == "" && $category_get == "" && $genre_get == "" && $country_get == "" && $year_get == "") {

            return redirect()->back();
        } else {
            $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
            $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
            $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();
            $movie_array = Movie::withCount(['episode' => function ($query) {
                $query->select(DB::raw('count(distinct(episode))'));
            }])->where('status', 1);

            if ($category_get) {
                $movie_array = $movie_array->where('category_id', $category_get);
            }
            if ($country_get) {
                $movie_array = $movie_array->where('country_id', $country_get);
            }
            if ($year_get) {
                $movie_array = $movie_array->where('year', $year_get);
            }
            if ($sort == 'count_views') {
                // $movie_array = $movie_array->join('movie_views', 'movies.id', '=', 'movie_views.movie_id')->orderBy($sort, 'DESC');
            }
            if ($sort == 'created_at') {
                $movie_array = $movie_array->orderBy('created_at', 'DESC');
            }
            if ($sort == 'title') {
                $movie_array = $movie_array->orderBy('title', 'ASC');
            }

            if ($genre_get) {
                $gen_slug = Genre::where('id', $genre_get)->first();
                $movie_genre = Movie_Genre::where('genre_id', $gen_slug->id)->get();
                $many_genre = [];
                foreach ($movie_genre as $key => $movi) {
                    $many_genre[] = $movi->movie_id;
                }
                $movie_array = $movie_array->whereIn('id', $many_genre);
            }


            // $movie_array = $movie_array->with('movie_genre');

            // $movie = array();
            // foreach ($movie_array as $mov) {
            //     dd($mov);
            //     foreach ($mov->movie_genre as $mov_gen) {
            //         $movie = $movie_array->whereIn('genre_id', [$mov_gen->genre_id]);
            //     }
            // }

            $movie = $movie_array->paginate(20);
            $api_ophim = Http::get('https://ophim1.com/danh-sach/phim-moi-cap-nhat');
            $url_update = $api_ophim['pathImage'];
            return view('pages.locphim', compact('category', 'genre', 'country', 'movie', 'url_update'));
        }
    }
    public function my_list()
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        // $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        // $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();


        return view('pages.my_list', compact('category'));
    }
    public function recent()
    {
        $category = Category::orderBy('id', 'ASC')->where('status', 1)->get();
        // $genre = Genre::where('status', 1)->orderBy('id', 'DESC')->get();
        // $country = Country::where('status', 1)->orderBy('id', 'DESC')->get();


        return view('pages.my_recent', compact('category'));
    }

    public function policy()
    {
        return view('pages.policy');
    }
    public function watches($slug)
    {
        return redirect()->back();
    }

    public function ajax_episode($slug, $tap, $server_active)
    {
        $movie = Movie::with('episode')->where('slug', $slug)->where('status', 1)->first();
        if (!isset($movie)) {
            return response()->json([
                'success' => false,
            ]);
        }
        $ser = substr($server_active, 7, 10);

        try {
            if (isset($tap)) {
                $tapphim = $tap;
                $tapphim = substr($tap, 4, 10);
                $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->where('server_id', $ser)->first();
                if (!isset($episode)) {
                    return response()->json([
                        'success' => false,
                    ]);
                }
            } else {
                $tapphim = 1;
                $episode = Episode::where('movie_id', $movie->id)->where('episode', $tapphim)->where('server_id', $ser)->first();
            }


            return response()->json([
                'success' => true,
                'data'=>$episode->linkphim
            ]);
        } catch (ModelNotFoundException $th) {
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
