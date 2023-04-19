const MAX_SIZE_PX = 2000;
const REDRAW_INTERVAL_MS = 25;
const BRUSH = 1;
const ERASER = 2;

const ERASER_COLOR = "#ffffff";
const CANVAS_STARTUP_DATA = "#ffffff";

function CanvasPlayground(canvasDiv) {
  if (canvasDiv == null) {
    console.error("provided canvas div does not exist");
    return;
  }

  // =============variables=============== //

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

  if (this.matrixW * this.matrixH > MAX_SIZE_PX) {
    console.error(`Max size cannot be higher than ${MAX_SIZE_PX} px`);
    return;
  }

  this.cellSizePX = 0;
  this.brushColor = "#000000";
  this.brushType = BRUSH;

  this.canvasData = new Array(this.matrixW * this.matrixH).fill(
    CANVAS_STARTUP_DATA
  ); // 3 bytes of color
  this.drawing = false;
  this.mousePoint = null;

  this.canvasDOMRect = null;

  var __redrawTask = setInterval(() => {
    try {
      this._redraw();
    } catch {}
  }, REDRAW_INTERVAL_MS);

  // =============functions=============== //

  this.clearCanvas = () => {
    this.ctx.clearRect(0, 0, canvasDiv.width, canvasDiv.height);
  };

  this.drawGrid = () => {
    this.ctx.lineWidth = 1;
    this.ctx.strokeStyle = "rgba(0, 0, 0, 0.1)";
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

  this.drawCanvasData = () => {
    for (var y = 0; y < this.matrixH; y++) {
      for (var x = 0; x < this.matrixW; x++) {
        //this.ctx.strokeStyle = this.canvasData[x * y];
        this.ctx.fillStyle = this.canvasData[x + y * this.matrixW];
        this.ctx.fillRect(
          x * this.cellSizePX,
          y * this.cellSizePX,
          this.cellSizePX,
          this.cellSizePX
        );
      }
    }
  };

  this._redraw = () => {
    this.clearCanvas();
    this.drawCanvasData();
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
    var canvasWidth = this.matrixW * this.cellSizePX;
    var canvasHeight = this.matrixH * this.cellSizePX;

    // create new canvas
    const canvas = document.createElement("canvas");

    // set dimensions to optimal (same as parent)
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;

    // add event handlers to canvas
    this.addCanvasEvents(canvas);

    // add new canvas to parent div, remove previous
    this.canvasDiv.innerHTML = "";
    this.canvasDiv.appendChild(canvas);

    //get DOMRect for positioning
    this.canvasDOMRect = canvas.getBoundingClientRect();

    //create new context
    this.ctx = canvas.getContext("2d");
  };

  this.addCanvasEvents = (canvas) => {
    canvas.addEventListener("mousedown", this.onMouseDown);
    canvas.addEventListener("mousemove", this.onMouseMove);
    canvas.addEventListener("mouseup", this.onMouseUp);
    canvas.addEventListener("mouseleave", this.onMouseLeave);
  };

  // =============control functions=============== //

  this.setBrushColor = (brushColor) => {
    this.brushColor = brushColor;
  };

  this.setBrushType = (brushType) => {
    this.brushType = brushType;
  };

  this.clearCanvasData = () => {
    this.canvasData.fill(CANVAS_STARTUP_DATA);
  };

  // =============event handlers=============== //

  this.onWindowResize = () => {
    this.recreateCanvasElement();
  };

  this.onMouseDown = (e) => {
    this.drawing = true;
    this.drawPixel(e.clientX, e.clientY);
    this.mousePoint = e;
  };

  this.onMouseMove = (e) => {
    if (!this.drawing) return;
    const x1 = this.mousePoint.clientX;
    const y1 = this.mousePoint.clientY;

    const x2 = e.clientX;
    const y2 = e.clientY;

    this.drawLine(x1, y1, x2, y2);

    this.mousePoint = e;
  };

  this.onMouseUp = () => {
    this.drawing = false;
  };

  this.onMouseLeave = () => {
    if (!this.drawing) return;
    this.drawing = false;
  };

  // =============drawing=============== //
  this.drawLine = (x1, y1, x2, y2) => {
    if (this.cellSizePX == 0) return;

    var _x1 = Math.min(x1, x2);
    var _x2 = Math.max(x1, x2);

    var _y1 = Math.min(y1, y2);
    var _y2 = Math.max(y1, y2);

    var lineLengthPX = Math.sqrt(
      Math.pow(_x2 - _x1, 2) + Math.pow(_y2 - _y1, 2)
    );

    if (lineLengthPX == 0) {
      this.drawPixel(_x1, _y1);
      return;
    }

    var lineLengthCells = lineLengthPX / this.cellSizePX;

    const dx = (_x2 - _x1) / lineLengthCells;
    const dy = (_y2 - _y1) / lineLengthCells;

    while (lineLengthPX >= 0) {
      this.drawPixel(_x1, _y1);
      lineLengthPX -= this.cellSizePX;
      _x1 += dx;
      _y1 += dy;
    }
  };

  this.drawPixel = (xPX, yPX) => {
    const gridX = this.xCoordToGridX(xPX);
    const gridY = this.yCoordToGridY(yPX);
    if (this.brushType == BRUSH) {
      this.canvasData[gridX + gridY * this.matrixW] = this.brushColor;
    } else {
      this.canvasData[gridX + gridY * this.matrixW] = ERASER_COLOR;
    }
  };

  // =============utility=============== //
  // x = window X position
  this.xCoordToGridX = (windowX) => {
    if (windowX == 0 || this.cellSizePX == 0 || this.canvasDOMRect == null)
      return 0;

    let _x = windowX - this.canvasDOMRect.x;

    var rawGridX = _x / this.cellSizePX;
    var parsedGridX = parseInt(rawGridX);
    if (parsedGridX > this.matrixW) parsedGridX = this.matrixW - 1;

    return parsedGridX;
  };

  // y = window Y position
  this.yCoordToGridY = (windowY) => {
    if (windowY == 0 || this.cellSizePX == 0 || this.canvasDOMRect == null)
      return 0;

    let _y = windowY - this.canvasDOMRect.y;

    var rawGridY = _y / this.cellSizePX;
    var parsedGridY = parseInt(rawGridY);
    if (parsedGridY > this.matrixH) parsedGridY = this.matrixH - 1;
    return parsedGridY;
  };
}
