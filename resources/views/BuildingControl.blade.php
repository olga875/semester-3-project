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
        <a>Building Control</a>
        <a>Access Requests</a>
    </section>
    <section class="content">
        <div class="form-container">
            <form class="from">
                @csrf
                <div class="input-container">
                    <label>Building</label>
                    <input type="radio" name="type" value="building" {{ old('type', 'building') === 'building' ? 'checked' : '' }} required>
                    <label>Floor</label>
                    <input type="radio" name="type" value="floor" {{ old('type') === 'floor' ? 'checked' : '' }} required>
                    <label>Office</label>
                    <input type="radio" name="type" value="room" {{ old('type') === 'room' ? 'checked' : '' }} required>
                </div>
                <div class="input-container">
                    <label>Name:</label>
                    <input type="string" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <label>Company:</label>
                    <input type="string" name="company" value="{{ old('company') }}" required>
                    @error('company')
                        <div class="err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <label>Address:</label>
                    <input type="string" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="err">{{ $message }}</div>
                    @enderror
                </div>
                <div class="input-container">
                    <label>Number of floors:</label>
                    <input min="0" type="number" name="entity_n" value="{{ old('entity_n') }}" required>
                    @error('entity_n')
                        <div class="err">{{ $message }}</div>
                    @enderror
                </div>
                
            </form>
        </div>
    </section>
@endsection