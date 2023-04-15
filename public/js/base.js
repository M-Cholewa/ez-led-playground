var drawerBtn = document.getElementById("base-drawer-btn");

if (drawerBtn != null) {
  drawerBtn.addEventListener("click", toggleDrawerGroupVisibility);
}

var overlay = document.getElementById("base-overlay");

if (overlay != null) {
  overlay.addEventListener("click", toggleDrawerGroupVisibility);
}

var accorddionButtons = document.querySelectorAll(".base-table-first-cell a");

if (accorddionButtons != null) {
  accorddionButtons = [...accorddionButtons];

  accorddionButtons.forEach((btn) => {
    btn.addEventListener("click", () => toggleAccoridionClick(btn));
  });
}

var searchInput = document.getElementById("base-search-input");

if (searchInput != null) {
  searchInput.addEventListener("input", () => {
    alert("todo!");
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
    var parentRow = btn.closest("tr");
    var parentRowClasses = parentRow.classList;
    parentRowClasses.toggle("active"); // toggle active class to toggle accordion
  } catch {}
}
