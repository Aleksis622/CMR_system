<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\CaseRecord;
use Carbon\Carbon;

class CaseController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'hs_code'  => ['required', 'regex:/^[0-9]{10}$/'],
            'country'  => [
                'required',
                'alpha',
                'size:2',
                Rule::in(['LV', 'LT', 'EE', 'PL', 'DE', 'US']) // ISO country codes
            ],
            'currency' => ['required', 'alpha', 'size:3'],
            'amount'   => ['required', 'regex:/^\d+(\.\d{1,2})?$/'],
            'date'     => ['required', 'date_format:Y-m-d\TH:i:s\Z'],
        ]);

        // Convert date to UTC
        $validated['date'] = Carbon::parse($validated['date'])->setTimezone('UTC');

        $case = CaseRecord::create($validated);

        return response()->json([
            'message' => 'Case record created successfully.',
            'case' => $case
        ]);
    }
}
