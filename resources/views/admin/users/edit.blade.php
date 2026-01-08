@extends('layouts.app')

@section('content')
<div class="app">
    <main class="content">
        <header class="topbar">
            <div>
                <h1>Edit User Profile</h1>
                <p class="subtitle">Modifying: <strong>{{ $user->full_name }}</strong></p>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn-back">Back to List</a>
        </header>

        <section class="panel" style="max-width: 600px;">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ $user->full_name }}" required>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" value="{{ $user->email }}" required>
                </div>

                <div class="form-group">
                    <label>System Access Level (Role)</label>
                    <select name="role" required>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="inspector" {{ $user->role == 'inspector' ? 'selected' : '' }}>Inspector</option>
                        <option value="analyst" {{ $user->role == 'analyst' ? 'selected' : '' }}>Analyst</option>
                        <option value="broker" {{ $user->role == 'broker' ? 'selected' : '' }}>Broker</option>
                    </select>
                </div>

                <button type="submit">Update User Information</button>
            </form>
        </section>
    </main>
</div>
@endsection