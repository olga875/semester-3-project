@extends('Base')

@section('title', 'Admin Panel')

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/Timetable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/buildings.css') }}">
    <script>
        BUILDING_URL = "{{ route('building.post') }}"
        FLOOR_URL = "{{ route('floor.post') }}"
        OFFICE_URL = "{{ route('office.post') }}"
    </script>
    <script src="{{ asset('js/Buildings.js') }}"></script>

@endpush

@section('content')
    <section class="app-bar">
        <h1>Options</h1>
        <div class="nav-buttons">
            <button onclick="window.location.href='{{route('admin.panel') }}'">Main Panel</button>
            <form method="GET" action="{{route('logout')}}">
                <button type="submit">Logout</button>
            </form>
        </div>
    </section>
    <section class="content">
        <h2>Edit building structure</h2>
        <form class="form" id="structure-form" action="{{ route('building.post') }}" method="POST">
            @csrf
            <div class="radio-imput">
                <label>
                    <input 
                    type="radio" 
                    name="type" 
                    value="building" 
                    {{ old('type', 'building') === 'building' ? 'checked' : '' }} 
                    required>
                    Building
                </label>
                <label>
                    <input 
                    type="radio" 
                    name="type" 
                    value="floor" 
                    {{ old('type') === 'floor' ? 'checked' : '' }} 
                    required>
                    Floor
                </label>
                <label>
                    <input 
                    type="radio" 
                    name="type" 
                    value="room" 
                    {{ old('type') === 'room' ? 'checked' : '' }} 
                    required>Office
                </label>
                
            </div>
            <div class="input-container">
                <label>Name:</label>
                <input type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <div id="building-drop" style="{{ old('type') !== 'floor' ? 'display:none;' : '' }}" class="input-container">
                <label>Building</label>
                <input id="building-search" type="search" name="search-field" placeholder="Search">
                <select id="building" class="dropdown" name="building_id" @disabled(old('type') !== 'floor')>
                    <option value=""></option>
                    @if (isset($buildings) && is_iterable($buildings))
                        @foreach ($buildings as $building)
                        <option 
                        data-comp="{{ $building->company }}" 
                        value="{{ $building->id }}"
                        {{ old('building_id') == $building->id ? 'selected' : '' }}>{{ $building->name }}</option> 
                        @endforeach
                    @endif
                </select>
                @error('building_id')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <div id="floor-drop" style="{{ old('type') !== 'room' ? 'display:none;' : '' }}" class="input-container">
                <label>Floor</label>
                <input id="floor-search" type="search" name="search-field" placeholder="Search">
                <select id="floor" class="dropdown" name="floor_id" @disabled(old('type') !== 'room')>
                    <option value=""></option>
                    @if (isset($floors) && is_iterable($floors))
                        @foreach ($floors as $floor)
                        <option 
                        data-comp="{{ $floor->company }}" 
                        value="{{ $floor->id }}"
                        {{ old('floor_id') == $floor->id ? 'selected' : '' }}>{{ $floor->building->name }} {{ $floor->name }}</option> 
                        @endforeach
                    @endif
                </select>
                @error('floor_id')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <div class="input-container">
                <label>Company:</label>
                <input id="company" type="text" name="company" value="{{ old('company') }}" required>
                @error('company')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <div  id="address-input" class="input-container" style="{{ old('type', "building") !== 'building' ? 'display:none;' : '' }}">
                <label>Address:</label>
                <input type="text" name="address" value="{{ old('address') }}" @disabled(old('type', 'building') !== 'building')>
                @error('address')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <div id="number-input" class="input-container">
                <label>Number of floors:</label>
                <input min="0" type="number" name="entity_n" value="{{ old('entity_n') }}" required>
                @error('entity_n')
                    <div class="err">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="submit-bt">Save</button>


        </form>

    </section>
@endsection