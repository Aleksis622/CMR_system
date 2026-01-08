@extends('layouts.app')

@section('content')
<div class="content">
    <div class="topbar">
    <h1>Inspection {{ $inspection->inspection_id }}</h1>

    <div style="display:flex; gap:10px;">
        <a href="{{ route('dashboard') }}" class="btn-back">
            Dashboard
        </a>

        <a href="{{ route('inspections.index') }}" class="btn-back">
            Inspections
        </a>
    </div>
</div>

    <div class="details-grid">
        <div class="panel">
            <h3>Summary</h3>
            <p><strong>Case:</strong> {{ $inspection->case_id }}</p>
            <p><strong>Type:</strong> {{ strtoupper($inspection->type) }}</p>
            <p><strong>Location:</strong> {{ $inspection->location }}</p>
            <p><strong>Start:</strong> {{ optional($inspection->start_ts)->format('Y-m-d H:i') }}</p>
        </div>

        <div class="panel">
            <h3>Inspection Decision</h3>

            <form method="POST" action="{{ route('inspections.decide', $inspection->id) }}">
                @csrf

                <label>Decision</label>
                <select name="decision" required>
                    <option value="pending">Pending</option>
                    <option value="approved">Pass</option>
                    <option value="rejected">Fail</option>
                </select>

                <label>Notes</label>
                <textarea name="notes" rows="4"
                    placeholder="Inspector notes...">{{ $inspection->checks['notes'] ?? '' }}</textarea>

                <button type="submit">Save Decision</button>
            </form>
        </div>
    </div>
</div>
@endsection
