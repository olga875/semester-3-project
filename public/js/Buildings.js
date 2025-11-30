document.addEventListener('DOMContentLoaded', function () {
    const numberLabel = document.querySelector("#number-input label");
    const addressInput = document.getElementById("address-input")
    const buildingDropDown = document.getElementById("building-drop")
    const companyInput = document.getElementById("company")
    const form = document.getElementById("structure-form")

    const buildingSearch = buildingDropDown.querySelector("#building-search");


    const floorDropDown = document.getElementById("floor-drop");
    const floorSearch = floorDropDown.querySelector("#floor-search");

    document.querySelectorAll('input[name="type"]').forEach(radio => {
        radio.addEventListener('change', () => {
            const selected = document.querySelector('input[name="type"]:checked').value;
            
            if (selected == "building") {
                form.action = BUILDING_URL
                addressInput.style.display = ""; 
                addressInput.querySelectorAll("input, select").forEach(el => {
                    el.disabled = false;
                });
                buildingDropDown.style.display = "none"; 
                buildingDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
                floorDropDown.style.display = "none"; 
                floorDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
                numberLabel.textContent = "Number of floors:";
            } else if (selected == "floor") {
                form.action = FLOOR_URL
                addressInput.style.display = "none";
                addressInput.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
                numberLabel.textContent = "Number of rooms:";
                buildingDropDown.style.display = ""; 
                buildingDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = false;
                });
                floorDropDown.style.display = "none"; 
                floorDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
            } else {
                form.action = OFFICE_URL
                addressInput.style.display = "none";
                addressInput.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
                numberLabel.textContent = "Number of tables:";
                buildingDropDown.style.display = "none"; 
                buildingDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = true;
                });
                floorDropDown.style.display = ""; 
                floorDropDown.querySelectorAll("input, select").forEach(el => {
                    el.disabled = false;
                });
            }
        })
    })

    buildingDropDown.querySelector("#building").addEventListener("change", function () {
        const company = this.options[this.selectedIndex].getAttribute("data-comp");
        companyInput.value = company
    })

    floorDropDown.querySelector("#floor").addEventListener("change", function () {
        const company = this.options[this.selectedIndex].getAttribute("data-comp");
        companyInput.value = company
    })

    floorSearch.addEventListener('input', function () {
    const searchText = this.value.toLowerCase();
    const selection = floorDropDown.querySelector("#floor")
        Array.from(selection.options).forEach(option => {
            const text = option.text.toLowerCase();

            if (text.includes(searchText)) {
                option.style.display =""
            } else {
                option.style.display ="none"
            }
        })
})


    buildingSearch.addEventListener('input', function () {
    const searchText = this.value.toLowerCase();
    const selection = buildingDropDown.querySelector("#building")
        Array.from(selection.options).forEach(option => {
            const text = option.text.toLowerCase();

            if (text.includes(searchText)) {
                option.style.display =""
            } else {
                option.style.display ="none"
            }
        })
})

})