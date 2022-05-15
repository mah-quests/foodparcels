
var clearButton = document.getElementById('clear-signature-btn'),
	savePNGButton = document.getElementById('save-signature-btn'),
	canvas = document.getElementById('signature-canvas'),
	signaturePad;

function resizeCanvas() {
	var ratio =  Math.max(window.devicePixelRatio || 1, 1);
	canvas.width = canvas.offsetWidth * ratio;
	canvas.height = canvas.offsetHeight * ratio;
	canvas.getContext("2d").scale(ratio, ratio);
}

window.onresize = resizeCanvas;
resizeCanvas();

signaturePad = new SignaturePad(canvas);

clearButton.addEventListener('click', function (event) {
	signaturePad.clear();
});

savePNGButton.addEventListener('click', function (event) {
	if (signaturePad.isEmpty()) {
		alert('Signature pad is blank. Please draw your signature.');
	} else {
		var sdata = signaturePad.toDataURL();
		document.getElementById('signature-data').value = sdata;
		document.getElementById('signature-form').submit();
	}
});