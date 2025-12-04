<h1> YEEY LOGIN HAS WORKED!!! YOU ARE IN MAIN PAGE</h1>
@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Welcome, {{ $user->name ?? $user->full_name }}!</h1>

    <div class="grid grid-cols-2 gap-4">
        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-semibold">Total Cases</h2>
            <p class="text-xl">{{ $totalCases }}</p>
        </div>

        <div class="p-4 bg-white shadow rounded">
            <h2 class="text-lg font-semibold">Active Users</h2>
            <p class="text-xl">{{ $activeUsers }}</p>
        </div>
    </div>
</div>
@endsection
