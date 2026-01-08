@extends('layouts.app')

@section('content')
<div class="app">
    @include('components.sidebar')

    <main class="content">
        <header class="topbar">
            <h1>User Management</h1>
            <a href="{{ route('dashboard') }}" class="btn-back">Dashboard</a>
        </header>

        <section class="panel">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th style="text-align:right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><strong>{{ $user->full_name }}</strong></td>
                            <td>{{ $user->email }}</td>
                            <td><span class="badge">{{ strtoupper($user->role) }}</span></td>
                            <td style="text-align:right">
                                <a href="{{ route('admin.users.edit', $user) }}" class="action-btn-edit">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="action-btn-delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>
</div>
@endsection
