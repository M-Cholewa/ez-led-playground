const onEraseClick = () => {};
const onDrawClick = () => {};
const onUploadClick = () => {};
const onSaveClick = () => {};
const onColorPick = () => {};

var eraseBtn = document.getElementById("erase-btn");

if (eraseBtn != null) {
  eraseBtn.addEventListener("click", onEraseClick);
}

var drawBtn = document.getElementById("draw-btn");

if (drawBtn != null) {
  drawBtn.addEventListener("click", onDrawClick);
}

var uploadBtn = document.getElementById("upload-btn");

if (uploadBtn != null) {
  uploadBtn.addEventListener("click", onUploadClick);
}

var saveBtn = document.getElementById("save-btn");

if (saveBtn != null) {
  saveBtn.addEventListener("click", onSaveClick);
}

var colorPickerBtn = document.getElementById("color-picker-btn");

if (colorPickerBtn != null) {
  colorPickerBtn.addEventListener("input", onColorPick);
}

function CanvasPlayground(canvasDiv) {
  if (canvasDiv == null) {
    console.error("provided canvas div does not exist");
    return;
  }

  this.canvasDiv = canvasDiv;
  this.ctx = null;

  this.matrixW = canvasDiv.getAttribute("matrixW");
  this.matrixH = canvasDiv.getAttribute("matrixH");

  if (this.matrixW == null || this.matrixW == 0) {
    this.matrixW = 1;
  }

  if (this.matrixH == null || this.matrixH == 0) {
    this.matrixH = 1;
  }

  this.cellSizePX = 0;

  this.clearCanvas = () => {
    this.ctx.clearRect(0, 0, canvasDiv.width, canvasDiv.height);
  };

  this.drawGrid = () => {
    this.ctx.lineWidth = 1;
    this.ctx.strokeStyle = "rgba(0, 0, 0, 0.3)";
    for (var y = 0; y < this.matrixH; y++) {
      for (var x = 0; x < this.matrixW; x++) {
        this.ctx.strokeRect(
          x * this.cellSizePX,
          y * this.cellSizePX,
          this.cellSizePX,
          this.cellSizePX
        );
      }
    }
  };

  this.redraw = () => {
    this.clearCanvas();
    this.drawGrid();
  };

  this.recreateCanvasElement = () => {
    // get parent dimensions
    const canvasDivWidthPX = this.canvasDiv.offsetWidth;
    const canvasDivHeightPX = this.canvasDiv.offsetHeight;

    // get max cell size based on parent dimensions
    const maxWidthCellSize = canvasDivWidthPX / this.matrixW;
    const maxHeightCellSize = canvasDivHeightPX / this.matrixH;

    // lower value is cell size for better fit
    this.cellSizePX = Math.min(
      parseInt(maxHeightCellSize),
      parseInt(maxWidthCellSize)
    );

    // calculate new optimal dimensions
    const canvasWidth = this.matrixW * this.cellSizePX;
    const canvasHeight = this.matrixH * this.cellSizePX;

    // create new canvas
    const canvas = document.createElement("canvas");

    // set dimensions to optimal (same as parent)
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    // add new canvas to parent div
    this.canvasDiv.innerHTML = "";
    this.canvasDiv.appendChild(canvas);

    //create new context
    this.ctx = canvas.getContext("2d");
  };

  this.onWindowResize = () => {
    this.recreateCanvasElement();
    this.redraw();
  };
}

window.addEventListener("load", () => {
  var drawCanvasDiv = document.getElementById("draw-canvas");

  var canvasPlayground = new CanvasPlayground(drawCanvasDiv);
  window.addEventListener("resize", canvasPlayground.onWindowResize);

  canvasPlayground.onWindowResize();
});
