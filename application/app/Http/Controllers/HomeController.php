<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Application;
use App\User;
use App\Wallpaper;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => ['api_home','home_push_data']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $title = 'Dashboard';
        $users = User::where('role','=','operator')->get();
        $applications = Application::all();
        $wallpapers = Wallpaper::all();

        return view('home',['title' => $title, 'users' => $users, 'applications' => $applications, 'wallpapers' => $wallpapers]);
    }

    public function api_home($api_key = NULL){
        $limit = 10;
        $last = DB::table("wallpapers")
                                ->leftJoin('applications','applications.id','=','wallpapers.application_id')
                                ->leftJoin('categories','categories.id','=','wallpapers.category_id')
                                ->selectRaw('wallpapers.id as wallpaper_id, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url')
                                ->where('applications.api_key','=',$api_key)
                                ->orderBy('wallpapers.created_at','DESC')
                                ->limit($limit)
                                ->get();

        $popular = DB::table('loves')
                                ->leftJoin('wallpapers','loves.wallpaper_id','=','wallpapers.id')
                                ->leftJoin('applications','applications.id','=','wallpapers.application_id')
                                ->leftJoin('categories','wallpapers.category_id','=','categories.id')
                                ->selectRaw('count(loves.wallpaper_id) as loves_qty, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url, wallpapers.id as wallpaper_id')
                                ->where('applications.api_key','=',$api_key)
                                ->groupBy('loves.wallpaper_id','categories.id','categories.name','wallpapers.thumbnail','wallpapers.wallpaper_url','wallpapers.id')
                                ->orderBy('loves_qty','DESC')
                                ->limit($limit)
                                ->get();

        $rates = DB::table('rates')
                                ->leftJoin('wallpapers','rates.wallpaper_id','=','wallpapers.id')
                                ->leftJoin('applications','applications.id','=','wallpapers.application_id')
                                ->leftJoin('categories','wallpapers.category_id','=','categories.id')
                                ->selectRaw('sum(rates.stars) as rates_sum, categories.id as category_id, categories.name as category_name, wallpapers.thumbnail, wallpapers.wallpaper_url, wallpapers.id as wallpaper_id')
                                ->where('applications.api_key','=',$api_key)
                                ->groupBy('rates.wallpaper_id','categories.id','categories.name','wallpapers.thumbnail','wallpapers.wallpaper_url','wallpapers.id')
                                ->orderBy('rates_sum','DESC')
                                ->limit($limit)
                                ->get();

        $data = [
            'last' => $this->home_push_data($last),
            'popular' => $this->home_push_data($popular),
            'rates' => $this->home_push_data($rates)
        ];

        return response()
                    ->json($data)
                    ->header('Access-Control-Allow-Origin','*');
    }

    public function home_push_data($resource){

        $data = [];

        foreach($resource as $rs){

            $tmp = [
                'id' => $rs->wallpaper_id,
                'category_id' => $rs->category_id,
                'category_name' => $rs->category_name,
                'thumbnail' => env('APP_URL') . 'application/storage/app/'.$rs->thumbnail,
                'wallpaper' => env('APP_URL') . 'application/storage/app/'.$rs->wallpaper_url
            ];

            array_push($data, $tmp);

        }

        return $data;
    }
}
