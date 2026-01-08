<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inspection;

class InspectionController extends Controller
{
    public function index()
    {
        $inspections = Inspection::orderBy('start_ts', 'desc')->get();
        return view('inspections.index', compact('inspections'));
    }

    public function show($id)
    {
        $inspection = Inspection::findOrFail($id);
        return view('inspections.show', compact('inspection'));
    }

    public function decide(Request $request, $id)
    {
        $inspection = Inspection::findOrFail($id);

        $inspection->update([
            'checks' => array_merge($inspection->checks ?? [], [
                'decision' => $request->decision,
                'notes' => $request->notes,
                'completed_at' => now(),
            ])
        ]);

        return redirect()->route('inspections.index');
    }
}
