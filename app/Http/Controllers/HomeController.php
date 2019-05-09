<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contest;
use App\Services\LoadDocsService;
use Illuminate\Support\Facades\DB;


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


    public function index()
    {
        return view('home');
    }

    public function createContest(LoadDocsService $loadDocsService, Request $request) {
        if($request->isMethod('post')) {
            $contest = new Contest(['name' => $request->input('cup')]);
            $contest->save();
            $ids = $loadDocsService->write('sportsmen', 'sportsman', $request->file('file'));

            for($i = 1; $i <= $request->input('tours'); $i++) {
                foreach ($ids as $key => $value) {
                    $data[] = [
                        'contest_id' => $contest->id,
                        'sportsman_id' => $value,
                        'tour_id' => $i
                    ];
                }
            }

            DB::table('results')->insert($data);
        }
    }
}
