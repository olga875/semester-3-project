<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timetable</title>
    <link rel="stylesheet" href="{{ asset('css/Timetable.css') }}">
    <link rel="stylesheet" href="{{ asset('css/CleaningStaff.css') }}">
</head>
<body>
    <header class="app-bar">
        <h1>Cleaning Staff Dashboard</h1>
        <div class="nav-buttons">
            <form method="GET" action="{{route('logout')}}">
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main class="main-container">

        <section class="main-section">
            <h2>Set the desks</h2>
            
            <div class="filters">
                <div class="filter-group">
                    <label for="building">Building</label>
                    <select id="building">
                        <option value="">Select building...</option>
                        <option value="main">Main Building</option>
                        <option value="north">North Wing</option>
                        <option value="south">South Wing</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="floor">Floor</label>
                    <select id="floor">
                        <option value="">Select floor...</option>
                        <option value="1">Floor 1</option>
                        <option value="2">Floor 2</option>
                        <option value="3">Floor 3</option>
                        <option value="4">Floor 4</option>
                    </select>
                </div>

                <div class="filter-group">
                    <label for="room">Room</label>
                    <select id="room">
                        <option value="">Select room...</option>
                        <option value="a">Room A</option>
                        <option value="b">Room B</option>
                        <option value="c">Room C</option>
                    </select>
                </div>

                <button>Cleaning Mode</button>
                <button>Reset</button>
            </div>
        </section>
    </main>
</body>
</html>
