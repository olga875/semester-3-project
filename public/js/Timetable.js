function goToDeskControl() {
    window.location.href = '/';
}

// Placeholder for future functionality
document.addEventListener('DOMContentLoaded', function() {
    const building = document.getElementById('building');
    const floor = document.getElementById('floor');
    const room = document.getElementById('room');

    building.addEventListener('change', function() {
        console.log('Building selected:', this.value);
    });

    floor.addEventListener('change', function() {
        console.log('Floor selected:', this.value);
    });

    room.addEventListener('change', function() {
        console.log('Room selected:', this.value);
    });

    const desks = document.querySelectorAll('.desk');
    desks.forEach(desk => {
        desk.addEventListener('click', function() {
            console.log('Desk clicked:', this.textContent);
        });
    });
});
