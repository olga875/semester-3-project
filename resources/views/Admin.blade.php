@extends('Base')

@section('title', 'Admin Panel')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/Admin.js') }}"></script>
    
@endpush

@section('content')
    <header class="app-bar">
        <h1>Admin Dashboard</h1>
        <div class="nav-buttons">
            <form method="GET" action="{{route('logout')}}">
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main>
        <section class="filters">
            <h1>Options</h1>
            <a>Building Control</a>
        </section>
        <section class="list">
            @if (isset($requests) && is_iterable($requests))
                @foreach ($requests as $rec)
                    <div class="request"  data-id="{{ $rec->id }}">
                        <p>{{ $rec->id }}</p>
                        <p>{{ $rec->user->name }}</p>
                        <p>{{ $rec->user->email  }}</p>
                        <P>{{ $rec->created_at }}</p>
                        <p>{{ $rec->level }}</p>
                        <div class="actions">
                            <button id="ban"><i class="bi bi-ban"></i></button>
                            <button id="approve"><i class="bi bi-check-circle"></i></button>
                        </div>
                    </div>
                @endforeach
            @endif
        </section>
    </main>
@endsection