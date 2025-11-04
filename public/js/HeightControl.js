let currentHeight = 1000;
let sittingHeight = localStorage.getItem('sittingHeight') || null;
let standingHeight = localStorage.getItem('standingHeight') || null;
let moveInterval = null;
let moveSpeed = 1;

// Initialize page and set up event listeners
document.addEventListener('DOMContentLoaded', function() {
    updateCurrentHeight();
    updateSavedHeights();
    
    const input = document.getElementById('height-input');
    
    // Handle real-time input changes
    input.addEventListener('input', function() {
        if (this.value === '') return;
        let value = parseInt(this.value);
        if (isNaN(value)) {
            this.value = this.value.replace(/[^0-9]/g, '');
            return;
        }
        if (value >= 600 && value <= 1300) {
            currentHeight = value;
            updateCurrentHeight();
            updateDeskHeight(value);
        }
    });
    
    // Validate input when user finishes editing
    input.addEventListener('blur', function() {
        let value = parseInt(this.value);
        if (isNaN(value) || this.value === '') {
            this.value = currentHeight;
            return;
        }
        value = Math.max(600, Math.min(1300, value));
        this.value = value;
        currentHeight = value;
        updateCurrentHeight();
        updateDeskHeight(value);
    });
    
    // Only allow numeric input
    input.addEventListener('keypress', function(e) {
        if (e.keyCode < 48 || e.keyCode > 57) e.preventDefault();
    });
});

// Movement controls - start continuous height adjustment
function startMoving(direction) {
    moveSpeed = 1;
    moveInterval = setInterval(() => {
        let newHeight = direction === 'up' ? 
            Math.min(1300, currentHeight + Math.round(moveSpeed)) : 
            Math.max(600, currentHeight - Math.round(moveSpeed));
        
        if (newHeight !== currentHeight) {
            currentHeight = newHeight;
            document.getElementById('height-input').value = currentHeight;
            updateCurrentHeight();
            updateDeskHeight(currentHeight);
        }
        moveSpeed = Math.min(10, moveSpeed * 1.1);
    }, 100);
}

// Stop continuous movement
function stopMoving() {
    if (moveInterval) {
        clearInterval(moveInterval);
        moveInterval = null;
        moveSpeed = 1;
    }
}

// Save functions - store current height as preference
function saveSittingHeight() {
    sittingHeight = currentHeight;
    localStorage.setItem('sittingHeight', sittingHeight);
    updateSavedHeights();
}

function saveStandingHeight() {
    standingHeight = currentHeight;
    localStorage.setItem('standingHeight', standingHeight);
    updateSavedHeights();
}

// Apply saved heights
function applySittingHeight() {
    if (!sittingHeight) return;
    applyHeight(parseInt(sittingHeight));
}

function applyStandingHeight() {
    if (!standingHeight) return;
    applyHeight(parseInt(standingHeight));
}

// Reset to default height
function resetToDefault() {
    applyHeight(1000);
}

// Helper function to apply any height value
function applyHeight(height) {
    currentHeight = height;
    document.getElementById('height-input').value = height;
    updateCurrentHeight();
    updateDeskHeight(height);
}

// UI update functions
function updateSavedHeights() {
    document.getElementById('sitting-display').textContent = sittingHeight ? `${sittingHeight} mm` : 'Not set';
    document.getElementById('standing-display').textContent = standingHeight ? `${standingHeight} mm` : 'Not set';
    document.getElementById('sitting-apply-btn').disabled = !sittingHeight;
    document.getElementById('standing-apply-btn').disabled = !standingHeight;
}

function updateCurrentHeight() {
    document.getElementById('current-height').textContent = `Current Height: ${currentHeight} mm`;
}

// Navigation placeholder
function goToIntervals() {
    alert('Time Intervals feature coming soon!');
}

// API communication - send height changes to server
async function updateDeskHeight(heightMm) {
    try {
        await fetch('/update-height', {
            method: 'POST',
            headers: { 
                'Content-Type': 'application/json', 
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
            },
            body: JSON.stringify({ height: heightMm })
        });
    } catch (error) {
        console.error('Error:', error);
    }
}