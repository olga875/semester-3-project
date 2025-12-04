@extends('Base')

@section('title', 'Admin Panel')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <script src="{{ asset('js/Admin.js') }}"></script>
    
@endpush

@section('content')

    @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <section class="filters">
        <h1>Options</h1>
        <a>Building Control</a>
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
                    <form action="{{ route('admin.user.delete', $rec->user) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete {{ $rec->user->name }}?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                    <button id="ban"><i class="bi bi-ban"></i></button>
                    <button id="approve"><i class="bi bi-check-circle"></i></button>
                </div>
            </div>
        @endforeach
    </section>
@endsection