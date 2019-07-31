<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Home;
use App\Application;
use App\User;
use App\Wallpaper;

class HomeController extends Controller
{
    private $home;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->home = new Home();
        $this->middleware('auth',['except' => ['api_home']]);
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

        $data = [
            'last' => $this->home->last($api_key, $limit),
            'popular' => $this->home->popular($api_key, $limit),
            'rates' => $this->home->rates($api_key, $limit)
        ];

        return response()
                    ->json($data)
                    ->header('Access-Control-Allow-Origin','*');
    }
}
