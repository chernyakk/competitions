<?php

namespace App\Http\Controllers;

use App\Services\Randomizer;
use App\Services\ResultCounter;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\View\View;
use App\Models\Contest;
use App\Services\LoadDocsService;
use PhpOffice\PhpSpreadsheet\Reader\Exception;


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
     * @return Factory|View
     */
    public function index()
    {
        return view('home');
    }

    /**
     * @return Factory|View
     */
    public function listContest() {

        $contests = Contest::all();

        return view('app.contest.index', ['contests' => $contests]);
    }

    /**
     * @param LoadDocsService $loadDocsService
     * @param Request $request
     * @return Factory|RedirectResponse|View
     * @throws Exception
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    public function createContest(LoadDocsService $loadDocsService, Request $request) {

        if($request->isMethod('post')) {
            $contest = new Contest(['name' => $request->input('cup'), 'status' => $request->input('radioOption')]);
            $contest->save();

            $ids = $loadDocsService->write('sportsmen', 'sportsman', $request->file('file'));

            foreach ($ids as $key => $value) {
                $summaryData[] = [
                    'contest_id' => $contest->id,
                    'sportsman_id' => $value,
                ];
            }

            for($i = 1; $i <= $request->input('tours'); $i++) {
                foreach ($ids as $key => $value) {
                    $data[] = [
                        'contest_id' => $contest->id,
                        'sportsman_id' => $value,
                        'tour_id' => $i,
                        'created_at' => $loadDocsService->getDate(),
                        'updated_at' => $loadDocsService->getDate(),
                    ];
                }
            }
            $result = DB::table('results')->insert($data);

            $summary = DB::table('summary')->insert($summaryData);

            if($result and $summary) {
                return redirect()->route('listContest');
            }


        }

        return view('app.contest.create');
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
        return view('app.contest.view', ['ct' => $ct, 'cnt' => $cnt, 'sum' => $sum, 'id' => $id, 'contestName' => $contestName, 'summary' => $summary]);
    }

    public function editContest($id) {

        $cont = DB::table('contests')
            ->where('id', '=', $id)
            ->first();

        if (\request()->isMethod('post')) {
            DB::table('contests')
                ->where('id', '=', $id)
                ->update([
                    'name' => Input::get('cont'),
                    'status' => Input::get('status') === 'on' ? 1 : 0
                ]);

            return redirect()-> route('listContest');
        }

        return view('app.contest.edit', ['cont' => $cont]);
    }

    public function updateContest($id) {

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

        return view('app.contest.list-cards', ['contestId' => $contestId, 'sportsmenInComp' => $sportsmenInComp, 'tourCount' => $tourCount]);
    }

    public function getAllCards($contestId){

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

        $contestName = DB::table('contests')
            ->where('id', '=', $contestId)
            ->value('name');


        return view('app.contest.print-all-cards', ['contestId' => $contestId, 'sportsmenInComp' => $sportsmenInComp,'tourCount' => ($tourCount->tour_id), 'contestName' => $contestName]);
    }

    public function editCard ($id, $sportsmanId) {

        $data = DB::table('sportsmen')
            ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
            ->where('results.sportsman_id', '=', $sportsmanId)
            ->where('results.contest_id', '=', $id)
            ->select('sportsmen.sportsman', 'results.id', 'results.sportsman_id', 'results.contest_id', 'results.tour_id',
                'results.point', 'results.haul', 'results.place', 'results.sector', 'results.sector_type')
            ->get();

        $sportsman = DB::table('sportsmen')->where('id', $sportsmanId)->value('sportsman');
        $numberCard = DB::table('results')->where('sportsman_id', $sportsmanId)->value('sector');

        if(\request()->isMethod('post')) {
            $keys = \request()->all();
            $i = 0;
            foreach ($keys as $key => $value) {
                ++$i;
                if($i%2 === 0) {

                    DB::table('results')
                        ->where('id', '=', substr($key, 1))
                        ->update(['haul' => $value]);

                    $q = DB::table('results')
                        ->where('id', '=', substr($key, 1));

                    $tourId = $q->value('tour_id');

                    $place = $q->value('place');

                    $s1 = $sportsmanId;

                    $s2 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '<>', $sportsmanId)
                        ->value('sportsman_id');

                    $h1 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '=', $sportsmanId)
                        ->value('haul');

                    $h2 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '<>', $sportsmanId)
                        ->value('haul');

                    if(!is_null($h1) && !is_null($h2)) {
                        $point = new ResultCounter((int) $s1, (int) $s2, (int) $h1, (int) $h2, (int) $id, (int) $tourId);
                        $point->result();
                    }

                } else {

                    DB::table('results')
                        ->where('sportsman_id', '=', $sportsmanId)
                        ->where('contest_id',  '=',  $id)
                        ->where('tour_id', substr($key, 1))
                        ->update(['haul' => $value]);

                    $q = DB::table('results')
                        ->where('sportsman_id', '=', $sportsmanId)
                        ->where('contest_id',  '=',  $id)
                        ->where('tour_id', substr($key, 1));

                    $tourId = $q->value('tour_id');

                    $place = $q->value('place');

                    $s1 = $sportsmanId;

                    $s2 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '<>', $sportsmanId)
                        ->value('sportsman_id');

                    $h1 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '=', $sportsmanId)
                        ->value('haul');

                    $h2 = DB::table('results')
                        ->where('contest_id', '=', $id)
                        ->where('tour_id', '=', $tourId)
                        ->where('place', '=', $place)
                        ->where('sportsman_id', '<>', $sportsmanId)
                        ->value('haul');

                    if(!is_null($h1) && !is_null($h2)) {
                        $point = new ResultCounter((int) $s1, (int) $s2, (int) $h1, (int) $h2, (int) $id, (int) $tourId);
                        $point->result();
                    }
                }
            }
            return redirect('/cards/contest/'. $id);
        }

        return view('app.contest.edit-card', ['data' => $data, 'sportsman' => $sportsman, 'numberCard' => $numberCard]);
    }

    public function configuration() {
        return view('app.configuration.index');
    }


    public function deleteContest($contestId){

        DB::table('sportsmen')
            ->select('sportsmen.id', 'sportsmen.sportsman')
            ->join('results', 'sportsmen.id', '=', 'results.sportsman_id')
            ->where('results.contest_id', '=', $contestId)
            ->groupBy('sportsmen.id')
            ->delete();

        DB::table('contests')
            ->where('id', '=', $contestId)
            ->delete();

        DB::table('results')
            ->where('contest_id', '=', $contestId)
            ->delete();

        DB::table('summary')
            ->where('contest_id', '=', $contestId)
            ->delete();

        return redirect()-> route('listContest');
    }

    public static function changer ($contestId, Request $request1) {
        if($request1->isMethod('post')) {
            $toss = $request1->input('toss');

            $ids = DB::table('results')
                ->where('contest_id', '=', $contestId)
                ->where('tour_id', '=', 1);

            $min = $ids->min('sportsman_id');
            $max = $ids->max('sportsman_id');

            $rand = new Randomizer($min, $max, $toss);

            $rand->insertRecord($contestId);

            DB::table('contests')
                ->where('id', '=', $contestId)
                ->update(['rand' => 1]);
            return redirect()->route('listContest');}

        return view('app.contest.changer');
    }

    public function couplesOfFinal ($id) {

        foreach (range(1,16) as $now){
            DB::table('final')
                ->insert(['final.now_id' => $now, 'final.contest_id' => $id]);
        }

        $qb = DB::table('summary')
            ->where('contest_id', '=', $id)
            ->orderByRaw('points desc, hauls desc')
            ->select('sportsman_id')
            ->get();

        $winners = $qb -> slice(0,8) -> shuffle();

        $i = 1;

        foreach ($winners as $now){
            DB::table('final')
                ->where('contest_id', '=', $id)
                ->where('now_id', '=', $i)
                ->update(['final.sportsman_id' => $now->sportsman_id]);
            $i++;
        }

        return redirect()-> route('finalOfContest', ['id' => $id]);
    }

    public function semifinal($id){
        $data = DB::table('final')
            ->join('summary', 'final.sportsman_id', '=', 'summary.sportsman_id')
            ->where('final.contest_id', '=', $id)
            ->select('summary.hauls as old_hauls', 'final.contest_id', 'final.sportsman_id', 'final.hauls', 'final.now_id')
            ->orderBy('final.now_id','asc')
            ->get();
        $couple1 = $data
            ->whereIn('now_id', [1, 2])
            ->sortByDesc('hauls')
            ->values()
            ->all();
        $couple2 = $data
            ->whereIn('now_id', [3, 4])
            ->sortByDesc('hauls')
            ->values()
            ->all();
        $couple3 = $data
            ->whereIn('now_id', [5, 6])
            ->sortByDesc('hauls')
            ->values()
            ->all();
        $couple4 = $data
            ->whereIn('now_id', [7, 8])
            ->sortByDesc('hauls')
            ->values()
            ->all();
        $places = range(9, 12);
        shuffle($places);
        foreach([$couple1, $couple2, $couple3, $couple4] as $couple) {
            if ($couple[0]->hauls == $couple[1]->hauls) {
                $couple = collect($couple)
                ->sortByDesc('old_hauls')
                ->values()
                ->first();
            }
            else {$couple = collect($couple) -> values() -> first();};
            DB::table('final')
                ->where('contest_id', '=', $couple->contest_id)
                ->where('now_id', '=', $places[0])
                ->update(['sportsman_id' => $couple->sportsman_id]);
            array_shift($places);
        }
        return redirect()-> route('finalOfContest', ['id' => $id]);
    }

    public function finalCouples($id){
        $doneResults = [];
        $prevResults = [];
        $winners = [];
        $losers = [];
        $data = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', range(9, 12))
            ->orderBy('final.now_id','asc')
            ->get();
        foreach($data as $nowSportsman) {
            array_push($prevResults, $nowSportsman->sportsman_id);
        }
        foreach($prevResults as $key => $value) {
            $doneResults[$value] = DB::table('final')
                ->where('contest_id', '=', $id)
                ->whereIn('now_id', range(1, 8))
                ->where('sportsman_id', '=', $value)
                ->select('hauls')
                ->first()
                ->hauls;
        }
        foreach([9, 11] as $now){
            if($data[$now-9]->hauls > $data[$now-8]->hauls) {
                $winners[$now-9] = $data[$now-9];
                $losers[$now-9] = $data[$now-8];
            }
            else {
                if($data[$now-9]->hauls < $data[$now-8]->hauls) {
                    $winners[$now-9] = $data[$now-8];
                    $losers[$now-9] = $data[$now-9];
                }
                else {
                    if($doneResults[$data[$now-9]->sportsman_id] >= $doneResults[$data[$now-8]->sportsman_id]) {
                        $winners[$now-9] = $data[$now-9];
                        $losers[$now-9] = $data[$now-8];
                    }
                    else {
                        $winners[$now-9] = $data[$now-8];
                        $losers[$now-9] = $data[$now-9];
                    }
                }
            }
        }
        DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 13)
            ->update(['sportsman_id' => $winners[0]->sportsman_id]);

        DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 14)
            ->update(['sportsman_id' => $winners[2]->sportsman_id]);

        DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 15)
            ->update(['sportsman_id' => $losers[0]->sportsman_id]);

        DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id','=', 16)
            ->update(['sportsman_id' => $losers[2]->sportsman_id]);

        return redirect()-> route('finalOfContest', ['id' => $id]);
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
        dump($winnersPlaces);
        $losersPlaces = DB::table('final')
            ->where('contest_id', '=', $id)
            ->whereIn('now_id', [15, 16])
            ->orderBy('hauls', 'desc')
            ->get();
        dump($losersPlaces);
        foreach($winnersPlaces as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 12);
        }

        foreach($losersPlaces as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 12);
        }
        //ошибка в том, что массив обрезан так, словно места в summary с 5 по 8 - это и есть членоеды с 5 по 8, но по факту это не так
        $summary = DB::table('summary')
            ->where('contest_id', '=', $id)
            ->orderByRaw('points desc, hauls desc, last_haul desc')
            ->get();

        $places58 = $summary->slice(4, 4);
        foreach($places58 as $sportsman) {
            $sportsman->oldHauls = haulsCounter($sportsman, 8);
        }
        dump($places58);
        $playoffPlaces = collect();
        foreach(collect([$winnersPlaces, $losersPlaces, $places58]) as $first){
            foreach($first as $second){
                $playoffPlaces->push($second);
            }
        }
        /*for($i = 0; $i < 2; $i++) {
            $playoffPlaces->put($i, $winnersPlaces->$i);
        }
        for($i = 2; $i < 4; $i++) {
            $playoffPlaces->put($i, $losersPlaces->$i);
        }
        for($i = 4; $i < 8; $i++) {
            $playoffPlaces->put($i, $places58->$i);
        }*/
        // $playoffPlaces = $playoffPlaces->merge($winnersPlaces, $losersPlaces, $places58);
        dd($playoffPlaces);
        return view('app.contest.final-results', ['ct' => $ct, 'cnt' => $cnt, 'id' => $id,
        'contestName' => $contestName, 'summary' => $summary, 'winnersPlaces' => $winnersPlaces,
        'losersPlaces' => $losersPlaces, 'places58' => $places58]);
    }

    public function finalOfContest($id) {

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


        return view('app.contest.final', ['id' => $id, 'check1' => $check1, 'check2' => $check2, 'check3' => $check3, 'finalists' => $finalists]);
    }

    public function editSportsman($contestId, $id) {
        $s = DB::table('sportsmen')
            ->where('id', '=', $id)
            ->value('sportsman');

        $n = DB::table('results')
            ->where('sportsman_id', '=', $id)
            ->where('contest_id', '=', $contestId)
            ->groupBy('sector')
            ->value('sector');

        if (\request()->isMethod('post')) {
            DB::table('sportsmen')
                ->where('id', '=', $id)
                ->update(['sportsman' => Input::get('fio')]);
            DB::table('results')
                ->where('sportsman_id', '=', $id)
                ->where('contest_id', '=', $contestId)
                ->update(['sector' => Input::get('number')]);

            return redirect('/cards/contest/'. $contestId);
        }

        return view('app.contest.edit-sportsman', ['s' => $s, 'n' => $n]);
    }

    public function finalEdit($id, $id1, $id2){
        $sportsmanId1 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id', '=', $id1)
            ->value('sportsman_id');
        $sportsmanId2 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id', '=', $id2)
            ->value('sportsman_id');
        $hauls1 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id', '=', $id1)
            ->value('hauls');
        $hauls2 = DB::table('final')
            ->where('contest_id', '=', $id)
            ->where('now_id', '=', $id2)
            ->value('hauls');
        $contest = DB::table('contests')
            ->where('id', '=', $id)
            ->value('name');
        $sportsman1 = DB::table('sportsmen')
            ->where('id', '=', $sportsmanId1)
            ->value('sportsman');
        $sportsman2 = DB::table('sportsmen')
            ->where('id', '=', $sportsmanId2)
            ->value('sportsman');
        if (\request()->isMethod('post')) {
            DB::table('final')
                ->where('now_id', '=', $id1)
                ->where('contest_id', '=', $id)
                ->update(['hauls' => Input::get('hauls1')]);
            DB::table('final')
                ->where('now_id', '=', $id2)
                ->where('contest_id', '=', $id)
                ->update(['hauls' => Input::get('hauls2')]);
            return redirect('/contest/'. $id .'/final');
        }

        return view('app.contest.final-edit', ['contest' => $contest, 'sportsman1' => $sportsman1, 'sportsman2' => $sportsman2,
        'hauls1' => $hauls1, 'hauls2' => $hauls2]);
    }

}
