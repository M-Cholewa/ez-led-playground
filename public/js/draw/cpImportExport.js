const exportCanvasData = () => {
    if (canvasPlayground == null) return 0;

    try {
        var bytes = [];

        canvasPlayground.canvasData.forEach((pixel) => {
            //convert pixel to bytes
            let b1 = Number("0x" + pixel.slice(1, 3));
            let b2 = Number("0x" + pixel.slice(3, 5));
            let b3 = Number("0x" + pixel.slice(5, 7));

            if (b1 == null || b2 == null || b3 == null)
                throw "Error while converting canvas to bytes";

            bytes.push(b1, b2, b3);
        });
    } catch (err) {
        console.error(err);
        bytes = [];
    } finally {
        return bytes;
    }
};

const importCanvasData = (bytes) => {
    try {
        if (canvasPlayground == null) throw "canvas playground is null";
        var pixels = [];

        for (let i = 0; i < bytes.length; i += 3) {
            var sl = bytes.slice(i, i + 3);
            var pixel = `#${__toHexStr(sl[0])}${__toHexStr(sl[1])}${__toHexStr(sl[2])}`;
            pixels.push(pixel);
        }

        if (pixels.length != canvasPlayground.canvasData.length)
            throw "imported size differs";

        canvasPlayground.canvasData = pixels;
    } catch (err) {
        canvasPlayground.canvasData.fill("#ffffff"); // fill white
        console.error(err ? err : "Could load this data");
    }
};

function saveWorkspace() {
    const id_workspace = drawCanvasDiv.getAttribute("workspace-id");
    const workspace_bytes = exportCanvasData();

    const data = {
        id_workspace: parseInt(id_workspace),
        workspace_bytes: workspace_bytes,
        setAsActive: true // set as active workspace for this device
    };

    fetch("/updateWorkspaceBytes", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function () {
        alert("workspace saved successfully!");
    }).catch((err) => {
        alert("couldn't save this workspace" + err);
    });
}

function loadWorkspace() {
    const id_workspace = drawCanvasDiv.getAttribute("workspace-id");
    const data = {id_workspace: parseInt(id_workspace)};

    fetch("/getWorkspaceBytes", {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    }).then(function (response) {
        return response.json();
    }).then((responseJson) => {
        importCanvasData(responseJson);
    }).catch((err) => {
        alert("couldn't load this workspace" + err);
    });
}

const __toHexStr = (val) => {
    return val.toString(16).padStart(2, "0");
};
