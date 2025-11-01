@extends('Base')

@section('title', 'Register')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
    <div class="header">
        <h2>Welcome to</h2>
        <h1>WeDesk</h1>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-container">
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-container">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-container">
            <label>Password:</label>
            <input type="password" name="password" required>
            @error('password')
                <div class="err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-container">
            <label>Password Again:</label>
            <input type="password" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="err">{{ $message }}</div>
            @enderror
        </div>
        <div class="input-container access">
            <label>
                <input type="radio" name="access" value="user" {{ old('access') == 'user' ? 'checked' : '' }} required>
                User
            </label>

            <label>
                <input type="radio" name="access" value="staff" {{ old('access') == 'staff' ? 'checked' : '' }}>
                Staff
            </label>
        </div>
        <button class="submit-bt" type="submit">Sign Up</button>
        <a class="text-bt" href="{{ route('register') }}">Already have an account? Click here to login.</a>
    </form>

    </body>

@endsection