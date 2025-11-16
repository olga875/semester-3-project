
@extends('Base')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endpush

@section('content')
    <div class="header">
        <h2>Welcome to</h2>
        <h1>WeDesk</h1>
    </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-container">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
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

            <button class="login-bt" type="login">Login</button>
            <a class="text-bt" href="{{ route('register') }}">Already have an account? Click here to login.</a>
        </form>

        <form method="POST" action="{{ route('blink') }}">
            @csrf
            <button type="submit">Blink LED</button>
        </form>

</body>

@endsection