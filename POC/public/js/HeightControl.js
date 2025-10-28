// Store preferences
let preferences = JSON.parse(localStorage.getItem('deskPreferences')) || {
    sitting: [],
    standing: []
};
let sittingHeight = null;
let standingHeight = null;

let currentHeight = 1000; // Default height in mm

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

    const stored = JSON.parse(localStorage.getItem('deskGlobals')) || {};
    if (stored.sitting) document.getElementById('quick-sit-height').value = stored.sitting;
    if (stored.standing) document.getElementById('quick-stand-height').value = stored.standing;
    
    // Dropdown logic - only one at a time
    //document.getElementById('sitting-preset').addEventListener('change', function() { if (this.value) document.getElementById('standing-preset').value = ''; });
    //document.getElementById('standing-preset').addEventListener('change', function() { if (this.value) document.getElementById('sitting-preset').value = ''; });
});

// Apply height from input
function applyHeight() {
    const height = document.getElementById('height-input').value;
    if (!height) return alert('Please enter a height value');
    updateDeskHeight(parseFloat(height) * 10);
    currentHeight = parseFloat(height);
    updateCurrentHeight();
}

//storing temporarily since our database isn't fully functional yet
function savePreferences() {
    let sitting = document.getElementById('sitting-preset').value;
    let standing = document.getElementById('standing-preset').value;

    if (sitting) sittingHeight = parseFloat(sitting) ?? 750;
    if (standing) standingHeight = parseFloat(standing) ?? 1000;

    localStorage.setItem('deskGlobals', JSON.stringify({
        sitting: sittingHeight,
        standing: standingHeight
    }));

    document.getElementById('quick-sit-height').value = sittingHeight;
    document.getElementById('quick-stand-height').value = standingHeight;

    loadPreferences();

    return true;
}

// Save as default preference
function saveAsDefault() {
    let height = document.getElementById('height-input').value;
    let sitting = document.getElementById('save-sitting').checked;
    let standing = document.getElementById('save-standing').checked;
    
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
    
    preferences.sitting.forEach(h => sitting.innerHTML += `<option value="${h}">${h} mm</option>`);
    preferences.standing.forEach(h => standing.innerHTML += `<option value="${h}">${h} mm</option>`);
}

// Apply selected preset
function applyPreset() {
    const height = document.getElementById('sitting-preset').value || document.getElementById('standing-preset').value;
    if (!height) return alert('Please select a preset height');
    newHeight = parseFloat(height) * 10 || 750;
    updateDeskHeight(newHeight);

    currentHeight = parseFloat(height);
    updateCurrentHeight();

    document.getElementById('hidden-height').value = newHeight;
    return true;
}

// Quick stand button
function quickStand() {
    if (preferences.standing.length === 0) return alert('No standing height saved');
    //const height = preferences.standing[preferences.standing.length - 1];
    const height = document.getElementById('quick-stand-height').value;
    updateDeskHeight(height * 10);
    currentHeight = height;
    updateCurrentHeight();
    return true;
}

// Quick sit button
function quickSit() {
    if (preferences.sitting.length === 0) return alert('No sitting height saved');
    //const height = preferences.sitting[preferences.sitting.length - 1];
    const height = document.getElementById('quick-sit-height').value;
    updateDeskHeight(height * 10);
    currentHeight = height;
    updateCurrentHeight();
    return true;
}

// Reset to default
function quickReset() {
    updateDeskHeight(1000);
    currentHeight = 100;
    updateCurrentHeight();
    return true;
}

// Update current height display
function updateCurrentHeight() {
    document.getElementById('current-height').textContent = `Current Height: ${currentHeight}mm`;
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