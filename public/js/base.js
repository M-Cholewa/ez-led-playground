const drawerBtn = document.getElementById("base-drawer-btn");

if (drawerBtn != null) {
    drawerBtn.addEventListener("click", toggleDrawerGroupVisibility);
}

const overlay = document.getElementById("base-overlay");

if (overlay != null) {
    overlay.addEventListener("click", toggleDrawerGroupVisibility);
}

function toggleDrawerGroupVisibility() {
    try {
        document.querySelector("nav").classList.toggle("active");
        document.getElementById("base-overlay").classList.toggle("active");
    } catch (err) {
        console.error(err);
    }
}

function toggleAccoridionClick(btn) {
    // toggle accordion
    try {
        const parentRow = btn.closest("tr");
        const parentRowClasses = parentRow.classList;
        parentRowClasses.toggle("active"); // toggle active class to toggle accordion
    } catch {
    }
}

function isEmail(email) {
    return /\S+@\S+\.\S+/.test(email);
}

function markValidation(element, condition) {
    !condition ? element.classList.add('no-valid') : element.classList.remove('no-valid');
}

function validateEmail(element) {
    setTimeout(function () {
            markValidation(element, isEmail(element.value));
        },
        1000
    );
}

function validateInputValue(minValue, maxValue, element) {
    setTimeout(function () {
            const eValue = element.value;
            const condition = eValue > minValue && eValue < maxValue;
            markValidation(element, condition);
        },
        1000
    );
}

