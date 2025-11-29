@extends('Base')

@section('title', 'Admin Panel')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/Admin.js') }}"></script>
    
@endpush

@section('content')
    <section class="filters">
        <h1>Options</h1>
<<<<<<< HEAD
=======
        <a>Building Control</a>
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
    </section>
    <section class="list">
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
    </section>
@endsection