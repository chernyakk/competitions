<?php

namespace App\Http\Controllers;

use Illuminate\Support\Collection;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            if($result) {
                return redirect()->route('viewContest', ['id' => $contest->id]);
            }else {

            }
        }

        return view('app.contest.create');
    }

    public function viewContest($id) {
        $qb = DB::table('results')
            ->where('contest_id', '=', $id)
            ->orderBy('sportsman_id');

        $ct = $qb->max('tour_id');
        $cnt = $qb->get();

        $sum = DB::table('results')
            ->select(DB::raw('sportsman_id, SUM(haul) as haul, SUM(point) as point'))
            ->groupBy(DB::raw('sportsman_id'))
            // ->orderBy('points', 'desc')
            ->get();

        return view('app.contest.view', ['ct' => $ct, 'cnt' => $cnt, 'sum' => $sum]);
    }

    public function editContest($id) {
        return view('app.contest.edit');
    }

    public function updateContest($id) {

    }

    public function configuration() {
        return view('app.configuration.index');
    }
}
