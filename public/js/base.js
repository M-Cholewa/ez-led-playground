const drawerBtn = document.getElementById("base-drawer-btn");

if (drawerBtn != null) {
    drawerBtn.addEventListener("click", toggleDrawerGroupVisibility);
}

const overlay = document.getElementById("base-overlay");

if (overlay != null) {
    overlay.addEventListener("click", toggleDrawerGroupVisibility);
}


const addTableClicks = () => {
    const accorddionButtons = document.querySelectorAll(".base-table-first-cell a");
    const btns = [...accorddionButtons];

    btns.forEach((btn) => {
        btn.addEventListener("click", () => toggleAccoridionClick(btn));
    });

    const removeButtons = document.querySelectorAll(".device-remove-btn");
    removeButtons.forEach((btn) => {
        btn.addEventListener("click", removeDevice)
    });
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

//onload
addTableClicks();
