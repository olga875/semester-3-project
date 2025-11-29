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
<<<<<<< HEAD
            <button>Timetable</button>
=======
            <button onclick="window.location.href='/timetable'">Timetable</button>
>>>>>>> 3718dc5504ad4c6853f95a254b951b2fd1a7921f
            <button onclick="goToIntervals()">Time Intervals</button>
            <button>Settings</button>
            <button>Logout</button>
        </div>
    </header>

    <main class="main-container">
        <section class="left-section">
            <h2>Desk Control</h2>
            
            <div class="height-control">
                <label>Height (mm)</label>
                <div class="height-input-group">
                    <input type="text" id="height-input" value="1000">
                    <div class="control-buttons">
                        <button onmousedown="startMoving('up')" onmouseup="stopMoving()" onmouseleave="stopMoving()" class="control-btn">↑</button>
                        <button onmousedown="startMoving('down')" onmouseup="stopMoving()" onmouseleave="stopMoving()" class="control-btn">↓</button>
                    </div>
                </div>
            </div>

            <div class="save-buttons">
                <button onclick="saveSittingHeight()">Save as Sitting Height</button>
                <button onclick="saveStandingHeight()">Save as Standing Height</button>
            </div>
        </section>

        <section class="middle-section">
            <!-- Empty space for future desk animation -->
        </section>

        <section class="right-section">
            <h2>Saved Preferences</h2>
            
            <div class="saved-heights">
                <div class="height-display">
                    <label>Sitting Height</label>
                    <div class="height-row">
                        <div id="sitting-display" class="height-value">Not set</div>
                        <button onclick="applySittingHeight()" id="sitting-apply-btn" class="apply-btn" disabled>Apply</button>
                    </div>
                </div>
                
                <div class="height-display">
                    <label>Standing Height</label>
                    <div class="height-row">
                        <div id="standing-display" class="height-value">Not set</div>
                        <button onclick="applyStandingHeight()" id="standing-apply-btn" class="apply-btn" disabled>Apply</button>
                    </div>
                </div>
            </div>

            <button onclick="resetToDefault()" class="reset-btn">Reset to Default</button>
        </section>
    </main>

    <!-- Current Height Display -->
    <div id="current-height" class="current-height">Current Height: 1000 mm</div>

    <script src="{{ asset('js/HeightControl.js') }}"></script>
</body>
</html>