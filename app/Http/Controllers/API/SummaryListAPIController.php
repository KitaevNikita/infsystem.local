<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\SummaryList;
use App\Http\Requests\SummaryListRequest;

class SummaryListAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::with(['lessons', 'group'])->find($request->discipline_id);
        $summaryLists = SummaryList::where('discipline_id', $discipline->id)->get();
        return response()->json([
            'discipline' => $discipline,
            'summaryLists' => $summaryLists,
        ]);
    }

    public function save(SummaryListRequest $request)
    {
        $summaryList = SummaryList::find($request->summary_list_id);
        $summaryList->update([
            'estimation' => $request->estimation,
            'interim' => $request->interim,
        ]);
    }
}
