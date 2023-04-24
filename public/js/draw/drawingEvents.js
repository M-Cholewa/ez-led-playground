window.addEventListener("resize", canvasPlayground.onWindowResize);

window.addEventListener("load", () => {
    //fetch data from server
    loadWorkspace();
});

if (eraseBtn != null) {
    const ERASE_LONGCLICK_MS = 1500;
    var eraseTimeout = null;

    const onEraseMouseDown = () => {
        canvasPlayground.setBrushType(ERASER);
        changeToolboxItemActive(eraseBtn);

        eraseTimeout = setTimeout(() => {
            canvasPlayground.clearCanvasData();
        }, ERASE_LONGCLICK_MS);
    };

    const onEraseMouseUp = () => {
        if (eraseTimeout != null) clearTimeout(eraseTimeout);
    };

    const onEraseMouseOut = () => {
        if (eraseTimeout != null) clearTimeout(eraseTimeout);
    };

    eraseBtn.addEventListener("mousedown", onEraseMouseDown);
    eraseBtn.addEventListener("mouseout", onEraseMouseOut);
    eraseBtn.addEventListener("mouseup", onEraseMouseUp);
}

if (drawBtn != null) {
    const onDrawClick = () => {
        canvasPlayground.setBrushType(BRUSH);
        changeToolboxItemActive(drawBtn);
    };
    drawBtn.addEventListener("click", onDrawClick);
}

if (uploadBtn != null) {
    const onUploadClick = () => {
    };
    uploadBtn.addEventListener("click", onUploadClick);
}

if (saveBtn != null) {
    const onSaveClick = () => {
        saveWorkspace();
    };
    saveBtn.addEventListener("click", onSaveClick);
}

if (colorPickerBtn != null) {
    const onColorPick = () => {
        canvasPlayground.setBrushColor(colorPickerBtn.value);
    };
    colorPickerBtn.addEventListener("change", onColorPick);
}
