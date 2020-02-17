var canvas = document.getElementById("canvas");
canvas.height = 250;
canvas.width = 400;
var signature = new SignaturePad(canvas);
const context = canvas.getContext('2d');

function reset() {

    context.clearRect(0, 0, canvas.width, canvas.height);
}

download_img = function(el) {
    var image = canvas.toDataURL("image/jpg");
    el.href = image;
};