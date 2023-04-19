const drawCanvasDiv = document.getElementById("draw-canvas");

const canvasPlayground = new CanvasPlayground(drawCanvasDiv);
canvasPlayground.onWindowResize();

const changeToolboxItemActive = (activeItem) => {
  try {
    const toolboxItems = document.querySelectorAll(".tooblox-group-item");
    toolboxItems.forEach((tbxItem) => {
      tbxItem.classList.remove("active");
    });

    activeItem.closest(".tooblox-group-item").classList.add("active");
  } catch {}
};

const eraseBtn = document.getElementById("erase-btn");

const drawBtn = document.getElementById("draw-btn");

const uploadBtn = document.getElementById("upload-btn");

const saveBtn = document.getElementById("save-btn");

const colorPickerBtn = document.getElementById("color-picker-btn");
