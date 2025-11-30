<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking page</title>
    <link rel="stylesheet" href="{{ asset('css/Booking.css') }}">
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
        <h1>Timetable</h1><br>
            <section class="grid-container">
                <div style="grid-column: 2">Mon</div>
                <div style="grid-column: 3">Tue</div>
                <div style="grid-column: 4">Wed</div>
                <div style="grid-column: 5">Thu</div>
                <div style="grid-column: 6">Fri</div>
                <div style="grid-column: 7">Sat</div>
                <div style="grid-column: 8">Sun</div>
            </section>

            <section class="grid-container tables">
                <div class="hours" style="grid-row: 1">08:00</div>
                <div class="hours" style="grid-row: 2">09:00</div>
                <div class="hours" style="grid-row: 3">10:00</div>
                <div class="hours" style="grid-row: 4">11:00</div>
                <div class="hours" style="grid-row: 5">12:00</div>
                <div class="hours" style="grid-row: 6">13:00</div>
                <div class="hours" style="grid-row: 7">14:00</div>
                <div class="hours" style="grid-row: 8">15:00</div>
                <div class="hours" style="grid-row: 9">16:00</div>

                <div class="timeslot" style="grid-row: 1">Timeslot1</div>
                <div class="timeslot" style="grid-row: 1; grid-column:3">Timeslot3</div>
                <div class="timeslot" style="grid-row: 3/5; grid-column: 8">Timeslot2</div>
            </section>

        </section>

        <section class="right-section">
            
            <label style="margin-top: 4rem">Select Desk</label>
            <button class="buttons" onclick="window.location.href='{{route('timetable') }}'">View Desks</button><br><br>
            <label>Start Time</label>
            <input type="datetime-local"><br><br>
            <label>End Time</label>
            <input type="datetime-local"><br><br><br><br>
            <button class="buttons">Book</button><br><br>
            <button class="buttons">Cancel</button>
        </section>
    </main>

</body>
</html>