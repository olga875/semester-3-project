// Store preferences
let preferences = JSON.parse(localStorage.getItem('deskPreferences')) || {
    sitting: [],
    standing: []
};

let currentHeight = 100; // Default height in cm

// Initialize on page load
document.addEventListener('DOMContentLoaded', function() {
    loadPreferences();
    updateCurrentHeight();
    
    // Checkbox logic - only one at a time
    document.querySelectorAll('#save-sitting, #save-standing').forEach(cb => {
        cb.addEventListener('change', function() {
            if (this.checked) document.querySelectorAll('#save-sitting, #save-standing').forEach(other => { if (other !== this) other.checked = false; });
        });
    });
    
    // Dropdown logic - only one at a time
    document.getElementById('sitting-preset').addEventListener('change', function() { if (this.value) document.getElementById('standing-preset').value = ''; });
    document.getElementById('standing-preset').addEventListener('change', function() { if (this.value) document.getElementById('sitting-preset').value = ''; });
});

// Apply height from input
function applyHeight() {
    const height = document.getElementById('height-input').value;
    if (!height) return alert('Please enter a height value');
    updateDeskHeight(parseFloat(height) * 10);
    currentHeight = parseFloat(height);
    updateCurrentHeight();
}

// Save as default preference
function saveAsDefault() {
    const height = document.getElementById('height-input').value;
    const sitting = document.getElementById('save-sitting').checked;
    const standing = document.getElementById('save-standing').checked;
    
    if (!height) return alert('Please enter a height value');
    if (!sitting && !standing) return alert('Please select sitting or standing height');
    
    if (sitting) preferences.sitting.push(parseFloat(height));
    if (standing) preferences.standing.push(parseFloat(height));
    
    localStorage.setItem('deskPreferences', JSON.stringify(preferences));
    loadPreferences();
}

// Remove sitting height
function removeSittingHeight() {
    const value = document.getElementById('sitting-preset').value;
    if (!value) return alert('Please select a sitting height to remove');
    preferences.sitting = preferences.sitting.filter(h => h != value);
    localStorage.setItem('deskPreferences', JSON.stringify(preferences));
    loadPreferences();
    document.getElementById('sitting-preset').value = '';
}

// Remove standing height
function removeStandingHeight() {
    const value = document.getElementById('standing-preset').value;
    if (!value) return alert('Please select a standing height to remove');
    preferences.standing = preferences.standing.filter(h => h != value);
    localStorage.setItem('deskPreferences', JSON.stringify(preferences));
    loadPreferences();
    document.getElementById('standing-preset').value = '';
}

// Load saved preferences into dropdowns
function loadPreferences() {
    const sitting = document.getElementById('sitting-preset');
    const standing = document.getElementById('standing-preset');
    
    sitting.innerHTML = '<option value="">Select sitting height...</option>';
    standing.innerHTML = '<option value="">Select standing height...</option>';
    
    preferences.sitting.forEach(h => sitting.innerHTML += `<option value="${h}">${h} cm</option>`);
    preferences.standing.forEach(h => standing.innerHTML += `<option value="${h}">${h} cm</option>`);
}

// Apply selected preset
function applyPreset() {
    const height = document.getElementById('sitting-preset').value || document.getElementById('standing-preset').value;
    if (!height) return alert('Please select a preset height');
    updateDeskHeight(parseFloat(height) * 10);
    currentHeight = parseFloat(height);
    updateCurrentHeight();
}

// Quick stand button
function quickStand() {
    if (preferences.standing.length === 0) return alert('No standing height saved');
    const height = preferences.standing[preferences.standing.length - 1];
    updateDeskHeight(height * 10);
    currentHeight = height;
    updateCurrentHeight();
}

// Quick sit button
function quickSit() {
    if (preferences.sitting.length === 0) return alert('No sitting height saved');
    const height = preferences.sitting[preferences.sitting.length - 1];
    updateDeskHeight(height * 10);
    currentHeight = height;
    updateCurrentHeight();
}

// Reset to default
function quickReset() {
    updateDeskHeight(1000);
    currentHeight = 100;
    updateCurrentHeight();
}

// Update current height display
function updateCurrentHeight() {
    document.getElementById('current-height').textContent = `Current Height: ${currentHeight} cm`;
}

// API call to update desk height
async function updateDeskHeight(heightMm) {
    try {
        await fetch('/update-height', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
            body: JSON.stringify({ height: heightMm })
        });
    } catch (error) {
        console.error('Error:', error);
    }
}