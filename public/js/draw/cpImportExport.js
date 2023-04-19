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
      var pixel = `#
      ${__toHexStr(sl[0])}
      ${sliced[1].toString(16)}
      ${sliced[2].toString(16)}`;
      pixels.push(pixel);
    }

    if (pixels.length != canvasPlayground.canvasData.length)
      throw "imported size differs";

    canvasPlayground.canvasData = pixels;
  } catch (err) {
    console.error(err ? err : "Could load this data");
  }
};

const __toHexStr = (val) => {
  return val.toString(16);
};
