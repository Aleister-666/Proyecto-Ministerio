
/**
 * Metodo que recoje la direccion del archivo insertado en los navs del modal file
 * y lo inserta en el src de la vista previa. este metodo es llamado como metodo interno en
 * el metodo rincipal file_control
 * @param  {DomElemnt} element -> Elemento que origino el evento click, se le pasa como paramentro
 * en la funcion principal
 */
const set_file = (element) => {
	const $frame = document.getElementById('frame-document');

	$frame.src = element.dataset.filePath;
	$frame.classList.remove('d-none');
};


/**
 * Metodo para control de archivos en la vista previa del modal.
 */
function file_control() {
	const d = document;

	d.addEventListener('click', (e) => {
		if (e.target.matches("button[data-file-path]")) {
			set_file(e.target);
		}
	})
};

file_control();