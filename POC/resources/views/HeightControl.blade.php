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
                <label>Desk Height (cm)</label>
                <input type="number" id="height-input" placeholder="Enter height" min="60" max="130">
            </div>

            <div class="checkbox-group">
                <label><input type="checkbox" id="save-sitting">Save as Sitting Height</label>
                <label><input type="checkbox" id="save-standing">Save as Standing Height</label>
            </div>

            <div class="button-group">
                <button onclick="applyHeight()">Apply Height</button>
                <button onclick="saveAsDefault()">Save as Default</button>
            </div>
        </section>

        <section class="right-section">
            <h2>Saved Preferences</h2>
            
            <div class="dropdown-group">
                <div>
                    <label>Sitting Height</label>
                    <select id="sitting-preset">
                        <option value="">Select sitting height...</option>
                    </select>
                    <button onclick="removeSittingHeight()" class="remove-btn">Remove Selected</button>
                </div>
                
                <div>
                    <label>Standing Height</label>
                    <select id="standing-preset">
                        <option value="">Select standing height...</option>
                    </select>
                    <button onclick="removeStandingHeight()" class="remove-btn">Remove Selected</button>
                </div>
            </div>

            <button onclick="applyPreset()">Apply Selected Height</button>
        </section>
    </main>

    <!-- Current Height Display -->
    <div id="current-height" class="current-height">Current Height: 100 cm</div>

    <footer class="bottom-bar">
        <button onclick="quickStand()" class="stand-btn">Stand</button>
        <button onclick="quickSit()" class="sit-btn">Sit</button>
        <button onclick="quickReset()" class="reset-btn">Reset</button>
    </footer>

    <script src="{{ asset('js/HeightControl.js') }}"></script>
</body>
</html>