/**
 * Metodo para desabilitar boton de submit de un formulario, ademas de visualizar loader
 * es necesario que el formulario tenga un id formulario,
 * @return {[type]} [description]
 */
function disabled_form() {
	const d = document;

	const $form = d.getElementById('formulario');

	$form.addEventListener('submit', (e) => {
		d.querySelector("input[type='submit']").disabled = true;
		d.getElementById('loader').classList.toggle('visually-hidden');
	});

}

disabled_form();