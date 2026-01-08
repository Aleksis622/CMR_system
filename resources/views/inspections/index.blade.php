@extends('layouts.app')

@section('content')
<div class="content">
    <div class="topbar">
    <h1>Inspections</h1>

    <div style="display:flex; gap:10px;">
        <a href="{{ route('dashboard') }}" class="btn-back">
            Dashboard
        </a>

        <a href="{{ url()->previous() }}" class="btn-back">
            Back
        </a>
    </div>
</div>
    <div class="table-container">
        <table>
        <thead>
<tr>
         <th>ID</th>
         <th>Inspection</th>
         <th>Case</th>
         <th>Type</th>
         <th>Start</th>
         <th>Location</th>
         <th>Status</th>
         <th style="text-align:right">Action</th>
</tr>
</thead>

<tbody>
@foreach($inspections as $inspection)
<tr>
    <td>{{ $inspection->id }}</td>
    <td>{{ $inspection->inspection_id }}</td>
    <td>{{ $inspection->case_id }}</td>
    <td>
        <span class="badge">{{ strtoupper($inspection->type) }}</span>
    </td>
    <td>{{ optional($inspection->start_ts)->format('Y-m-d H:i') }}</td>
    <td>{{ $inspection->location }}</td>

    <td>
        @php
            $decision = $inspection->checks['decision'] ?? null;
        @endphp

        @if($decision === 'approved')
            <span class="badge" style="background:#e8fff3;color:#2ecc71">PASSED</span>
        @elseif($decision === 'rejected')
            <span class="badge" style="background:#fff0f0;color:#e74c3c">FAILED</span>
        @else
            <span class="badge" style="background:#fff7e6;color:#f39c12">PENDING</span>
        @endif
    </td>
    <td style="text-align:right">
        <a href="{{ route('inspections.show', $inspection->id) }}"
           class="action-btn-edit">
            Open
        </a>
    </td>
</tr>
@endforeach
</tbody>

        </table>
    </div>
</div>
@endsection
