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

