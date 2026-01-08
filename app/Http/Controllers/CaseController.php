<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CaseModel;
use Carbon\Carbon;

class CaseController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'case_id' => 'required|string|unique:cases,case_id',
            'status'  => 'required|string',
            'priority'=> 'nullable|string',
            'arrival_ts' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'origin_country' => ['required','alpha','size:2'],
            'destination_country' => ['required','alpha','size:2'],
        ]);

        $validated['arrival_ts'] = Carbon::parse($validated['arrival_ts'])->utc();

        $case = CaseModel::create($validated);

        return response()->json([
            'message' => 'Case izveidots',
            'case' => $case
        ]);
    }
}
