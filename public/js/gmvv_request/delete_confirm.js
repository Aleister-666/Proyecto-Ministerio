/**
 * Metodo interno usado para agregar al formulario de eliminacion los datos necesarios
 * para su envio
 * @param  {DomElemnt} element -> elemento que origino el evento click en el metodo principal
 */
const set_action_form = (element) => {
	const $form = document.getElementById('delete-gmvv');

	let tag = element.nodeName.toLowerCase(),
		form_action;

	switch (tag) {
		case 'button':
			form_action = element.dataset.formAction;
			break;
		case 'svg':
			form_action = element.parentElement.dataset.formAction;
			break;
		case 'path':
			form_action = element.parentElement.parentElement.dataset.formAction;
			break;
	}
	
	$form.setAttribute('action', form_action);
};

/**
 * Metodo principal que se encarga de manejar el proceso de eliminacion de registros
 * @return {[type]} [description]
 */
function delete_confirm(){
	const d = document;

	d.addEventListener('click', (e) => {
		if (e.target.matches("button[data-delete='true']") || e.target.matches("button[data-delete] *")) {
			set_action_form(e.target);
		}
	})
}

delete_confirm()