window.addEventListener("resize", canvasPlayground.onWindowResize);

const ERASE_LONGCLICK_MS = 3000;
var eraseTimeout = null;

const onEraseClick = () => {
  canvasPlayground.setBrushType(ERASER);
  changeToolboxItemActive(eraseBtn);

  if (eraseTimeout != null) clearTimeout(eraseTimeout);

  eraseTimeout = setTimeout(() => {
    canvasPlayground.clearCanvasData();
  }, ERASE_LONGCLICK_MS);
};

const onDrawClick = () => {
  canvasPlayground.setBrushType(BRUSH);
  changeToolboxItemActive(drawBtn);
};

const onUploadClick = () => {};

const onSaveClick = () => {};

const onColorPick = () => {
  canvasPlayground.setBrushColor(colorPickerBtn.value);
};

if (eraseBtn != null) {
  eraseBtn.addEventListener("click", onEraseClick);
}

if (drawBtn != null) {
  drawBtn.addEventListener("click", onDrawClick);
}

if (uploadBtn != null) {
  uploadBtn.addEventListener("click", onUploadClick);
}

if (saveBtn != null) {
  saveBtn.addEventListener("click", onSaveClick);
}

if (colorPickerBtn != null) {
  colorPickerBtn.addEventListener("change", onColorPick);
}
