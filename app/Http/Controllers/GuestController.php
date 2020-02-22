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

        foreach ($sum as $sportsman){
            DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->update([
                    'hauls' => $sportsman->haul,
                    'points' => $sportsman->point,
                    'last_haul' => DB::table('results')
                        ->where('sportsman_id', '=', $sportsman->sportsman_id)
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $ct)
                        ->value('haul')]);
        };

        $summary = DB::table('summary')
            ->where('contest_id', '=', $id)
            ->orderByRaw('points desc, hauls desc, last_haul desc')
            ->get();

        $checker = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id', '=', 14)
            ->value('hauls');

        return view('app.contest.guest-view', ['ct' => $ct, 'cnt' => $cnt, 'sum' => $sum, 'id' => $id, 'contestName' => $contestName,
        'summary' => $summary, 'checker' => $checker]);
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

    public function finalOfCompetition($id) {

        $finalists = DB::table('final')
            ->join('sportsmen', 'final.sportsman_id','=', 'sportsmen.id')
            ->where('final.contest_id', '=', $id)
            ->select('final.now_id', 'final.sportsman_id', 'sportsmen.sportsman', 'final.hauls')
            ->orderBy('final.now_id')
            ->get();

        $check1 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->first();

        $check2 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 9)
            ->select('sportsman_id')
            ->first();

        $check3 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 13)
            ->select('sportsman_id')
            ->first();


        return view('app.contest.guest-final-of-competition', ['id' => $id, 'check1' => $check1, 'check2' => $check2, 'check3' => $check3, 'finalists' => $finalists]);
    }

    public function finalResults($id){
        function haulsCounter($sportsman, $point) {
            $oldHauls = DB::table('final')
                ->where('contest_id', '=', $sportsman->contest_id)
                ->whereIn('now_id', range(1, $point))
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->sum('hauls');
            return $oldHauls;
        }

        $allSportsman = [];
        $winSportsman = [];

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

        foreach ($sum as $sportsman){
            DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->update([
                    'hauls' => $sportsman->haul,
                    'points' => $sportsman->point,
                    'last_haul' => DB::table('results')
                                    ->where('sportsman_id', '=', $sportsman->sportsman_id)
                                    ->where('contest_id', '=', $id)
                                    ->where('tour_id', '=', $ct)
                                    ->value('haul')]);
        };

        $winnersPlaces = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', [13, 14])
            ->orderBy('hauls', 'desc')
            ->get();
        $losersPlaces = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', [15, 16])
            ->orderBy('hauls', 'desc')
            ->get();
        if($losersPlaces[0]->hauls == $losersPlaces[1]->hauls) {
            $comparer = DB::table('summary')
                ->where('contest_id', '=', $id)
                ->whereIn('sportsman_id', [$losersPlaces[0]->sportsman_id, $losersPlaces[1]->sportsman_id])
                ->orderByRaw('points desc, hauls desc, last_haul desc')
                ->get();
            switch ($comparer[0]->sportsman_id == $losersPlaces[0]->sportsman_id){
                case true:
                    $losersPlaces[0]->place = 3;
                    $losersPlaces[1]->place = 4;
                break;
                case false:
                    $losersPlaces[0]->place = 4;
                    $losersPlaces[1]->place = 3;
                break;
            }
        }
        foreach($winnersPlaces as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 16);
            $sportsman->hauls = DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->where('contest_id', '=', $id)
                ->value('hauls');
            $sportsman->points = DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->where('contest_id', '=', $id)
                ->value('points');
        }
        foreach($losersPlaces as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 16);
            $sportsman->hauls = DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->where('contest_id', '=', $id)
                ->value('hauls');
            $sportsman->points = DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->where('contest_id', '=', $id)
                ->value('points');
        }
        $summary = DB::table('summary')
            ->where('contest_id', '=', $id)
            ->orderByRaw('points desc, hauls desc, last_haul desc')
            ->get();
        $allSportsmanRaw = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', range(1, 8))
            ->select('sportsman_id')
            ->get()
            ->all();
        $winSportsmanRaw = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', range(13, 16))
            ->select('sportsman_id')
            ->get()
            ->all();
        foreach($allSportsmanRaw as $item => $value){
            array_push($allSportsman, $value->sportsman_id);
        }
        foreach($winSportsmanRaw as $item => $value){
            array_push($winSportsman, $value->sportsman_id);
        }
        $places58 = $summary->slice(0, 8);
        $places581 = collect(array_diff($allSportsman, $winSportsman));
        $places581->prepend(0);
        $forgotten = collect();
        foreach($places58 as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 8);
            $sportsman->points = DB::table('summary')
                ->where('sportsman_id', '=', $sportsman->sportsman_id)
                ->where('contest_id', '=', $id)
                ->value('points');
            if ($places581->search($sportsman->sportsman_id)){
                $forgotten->push($sportsman);
            };
        }
        $playoffPlaces = collect();
        foreach(collect([$winnersPlaces, $losersPlaces->where('place', '=', 3)->values()->all(),
        $losersPlaces->where('place', '=', 4)->values()->all(), $forgotten]) as $first){
            foreach($first as $second){
                $playoffPlaces->push($second);
            }
        }
        return view('app.contest.guest-final-results', ['ct' => $ct, 'cnt' => $cnt, 'id' => $id,
        'contestName' => $contestName, 'summary' => $summary, 'playoffPlaces' => $playoffPlaces]);
    }

}
