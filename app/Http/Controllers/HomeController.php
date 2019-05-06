<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sportsman;
use App\Models\Tour;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function test() {
        dump($tours = Sportsman::find(1)->tours()->pluck('name')->first());
        dump($sportsman = Tour::find(1)->sportsmen()->pluck('sportsman')->first());
    }
}
