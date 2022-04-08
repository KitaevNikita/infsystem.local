<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;
use App\Models\SummaryList;

class SummaryListAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::with(['lessons', 'group'])->find($request->discipline_id);
        $summaryLists = SummaryList::where('discipline_id', $discipline->id)->get();
        return response()->json([
            'discipline' => $discipline,
            'summary_lists' => $summaryLists,
        ]);
    }
}
