@extends('layouts.app')

@section('content')
<div class="app">
    @include('components.sidebar')

    <main class="content">
        <header class="topbar">
            <div>
                <h1>Welcome, {{ Auth::user()->full_name }} 👋</h1>
                <p style="color: var(--muted); font-size: 14px;">System Overview</p>
            </div>
            <span class="badge">{{ strtoupper(Auth::user()->role) }}</span>
        </header>

        <section class="stats">
            <div class="card" style="border-color: #2ecc71">
                <p style="color: var(--muted)">Total Cases</p>
                <h2>{{ $totalCases }}</h2>
            </div>
            <div class="card" style="border-color: var(--primary)">
                <p style="color: var(--muted)">Staff Members</p>
                <h2>{{ $totalUsersCount }}</h2>
            </div>
            <div class="card" style="border-color: #f1c40f">
                <p style="color: var(--muted)">System Status</p>
                <h2 style="color: #2ecc71; font-size: 18px">● Online</h2>
            </div>
        </section>

        <div class="panel">
            <h3>Role Distribution</h3>
            <div style="height: 300px; margin-top: 20px;">
                <canvas id="usersChart"></canvas>
            </div>
        </div>
    </main>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('usersChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: @json($roles).map(r => r.toUpperCase()),
            datasets: [{
                data: @json($chartData),
                backgroundColor: ['#6c63ff', '#3498db', '#2ecc71', '#f1c40f'],
                borderWidth: 0
            }]
        },
        options: { responsive: true, maintainAspectRatio: false, cutout: '75%' }
    });
});
</script>
@endpush
@endsection
