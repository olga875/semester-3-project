@extends('Base')

@section('title', 'Admin Panel')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endpush

@section('content')
    <section class="filters">
        <h1>Options</h1>
    </section>
    <section class="list">
        @for ($i = 0; $i < 5; $i++)
            <div class="user">
                <p>1</p>
                <p>Donat Otvos</p>
                <p>donat.otvos@sdu.dk</p>
                <P>2025-12-12</p>
                <div class="actions">
                <button id="ban"><i class="bi bi-ban"></i></button>
                <button id="approve"><i class="bi bi-check-circle"></i></button>
                </div>
            </div>
        @endfor
    </section>
@endsection