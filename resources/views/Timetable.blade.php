<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Timetable</title>
    <link rel="stylesheet" href="{{ asset('css/Timetable.css') }}">
</head>
<body>
    <header class="app-bar">
        <h1>Employee Dashboard</h1>
        <div class="nav-buttons">
            <button onclick="window.location.href='{{route('home') }}'">Main Panel</button>
            <button onclick="window.location.href='{{route('booking.viewBooking') }}'">Back to Booking</button>
            <form method="GET" action="{{route('logout')}}">
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>

    <main class="main-container">
        <section class="left-section">
            <h2>Office Layout</h2>
            <div class="office-room">
                <div class="desk desk-1">1</div>
                <div class="desk desk-2">2</div>
                <div class="desk desk-3">3</div>
                <div class="desk desk-4">4</div>
                <div class="desk desk-5">5</div>
                <div class="desk desk-6">6</div>
                <div class="desk desk-7">7</div>
                <div class="desk desk-8">8</div>
                <div class="desk desk-9">9</div>
                <div class="desk desk-10">10</div>
                <div class="desk desk-11">11</div>
                <div class="desk desk-12">12</div>
                <div class="desk desk-13">13</div>
                <div class="desk desk-14">14</div>
                <div class="desk desk-15">15</div>
                <div class="desk desk-16">16</div>
            </div>
        </section>

        <section class="right-section">
            <h2>Navigate</h2>
            
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
            </div>
        </section>
    </main>

    <script src="{{ asset('js/Timetable.js') }}"></script>
</body>
</html>
