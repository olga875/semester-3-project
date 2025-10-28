<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/HeightControl.css') }}">
</head>
<body>
    <header class="app-bar">
        <h1>Employee Dashboard</h1>
        <div class="nav-buttons">
            <button>Timetable</button>
            <button>Settings</button>
            <button>Logout</button>
        </div>
    </header>

    <main class="main-container">
        <section class="left-section">
            <h2>Real-time Desk Control</h2>
            
            <div class="input-group">
                <form method="POST" action="{{ route('desk.update') }}">
                    @csrf
                    <label>Height (mm):
                        <input type="number" id="height-input" name="height" value="{{ $height ?? 750 }}" min="500" max="1300">
                    </label>
                    <button class="button-group" onclick="applyHeight()" type="submit">Adjust Height</button>
                </form>
            </div>

            <div class="checkbox-group">
                <label><input type="checkbox" id="save-sitting">Save as Sitting Height</label>
                <label><input type="checkbox" id="save-standing">Save as Standing Height</label>
            </div>

            <div class="button-group">
                <button onclick="saveAsDefault()">Save as Default</button>
            </div>
        </section>

        <section class="right-section">
            <h2>Saved Preferences</h2>
            
            <div class="dropdown-group">
                 <form method="POST" action="{{route('desk.save')}}" onsubmit="return savePreferences()">
                    @csrf
                    <div>
                        <label>Sitting Height</label>
                        <select id="sitting-preset">
                            <option name="sitting_height" value=""></option>
                        </select>
                        <button onclick="removeSittingHeight()" class="remove-btn">Remove Selected</button>
                    </div>

                    <div>
                        <label>Standing Height</label>
                        <select id="standing-preset">
                            <option name="standing_height" value=""></option>
                        </select>
                        <button onclick="removeStandingHeight()" class="remove-btn">Remove Selected</button>
                    </div>
                    <button type="submit">Save preferences</button>
                </form>
            </div>
            
            <!--
            <form method="POST" action="{{route('desk.save')}}" onsubmit="return applyPreset()">
                @csrf
                <input type="hidden" name="height" id="hidden-height">
                <button type="submit">Apply Selected Height</button>
            </form>
-->

        </section>
    </main>

    <!-- Current Height Display -->
    <div id="current-height" class="current-height">Current Height: 1000 mm</div>

    <footer class="bottom-bar">
        <form method="POST" action="{{route('desk.update')}}" onsubmit="return quickStand()">
            @csrf
            <input type="hidden" id="quick-stand-height" name="height" value="">     <!--value="{{ $preference->standing_height ?? 1000 }}"-->
            <button type="submit" class="stand-btn">Stand</button>
        </form>

        <form method="POST" action="{{route('desk.update')}}" onsubmit="return quickSit()">
            @csrf
            <input type="hidden" id="quick-sit-height" name="height">        <!-- value="{{ $preference->sitting_height ?? 750 }}"-->
            <button type="submit" class="sit-btn">Sit</button>
        </form>

        <form method="POST" action="{{route('desk.update')}}" onsubmit="return quickReset()">
            @csrf
            <input type="hidden" id="quick-reset-height" name="height" value="{{ 1000 }}">
            <button type="submit" class="reset-btn">Reset</button>
        </form>
    </footer>

    <script src="{{ asset('js/HeightControl.js') }}"></script>
</body>
</html>