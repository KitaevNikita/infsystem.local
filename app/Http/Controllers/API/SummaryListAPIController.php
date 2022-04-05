<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Discipline;

class SummaryListAPIController extends Controller
{
    public function getData(Request $request)
    {
        $discipline = Discipline::with(['lessons', 'group'])->find($request->discipline_id);
        return response()->json([
            'discipline' => $discipline,
        ]);
    }
}
