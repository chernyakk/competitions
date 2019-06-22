<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use App\Models\Contest;


class GuestController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }


    /**
     * @return Factory|View
     */
    public function listContest() {

        $contests = Contest::all();

        return view('app.contest.guest-index', ['contests' => $contests]);
    }

    public function viewContest($id) {
        $qb = DB::table('results')
            ->where('contest_id', '=', $id)
            ->orderBy('sportsman_id', 'desc');

        $contestName = DB::table('contests')
            ->where('id', '=', $id)
            ->value('name');

        $ct = $qb->max('tour_id');
        $cnt = $qb->get();

        $sum = DB::table('results')
            ->select(DB::raw('sportsman_id, SUM(haul) as haul, SUM(point) as point'))
            ->groupBy(DB::raw('sportsman_id'))
            ->get();

        return view('app.contest.guest-view', ['ct' => $ct, 'cnt' => $cnt, 'sum' => $sum, 'id' => $id, 'contestName' => $contestName]);
    }


    public function cardsContest($contestId) {
        $sportsmenInComp = DB::table('sportsmen')
            ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
            ->where('results.contest_id', '=', $contestId)
            ->select('sportsmen.sportsman', 'results.sector', 'results.contest_id')
            ->groupBy('results.sportsman_id')
            ->orderBy('results.sector', 'asc')
            ->get();

        $tourCount = DB::table('results')
            ->where('results.contest_id', '=', $contestId)
            ->select('results.tour_id')
            ->get()
            ->max();

        return view('app.contest.guest-list-cards', ['contestId' => $contestId, 'sportsmenInComp' => $sportsmenInComp, 'tourCount' => $tourCount]);
    }

}
