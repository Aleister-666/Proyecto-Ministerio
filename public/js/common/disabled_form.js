const d = document;

const $form = d.getElementById('formulario');

$form.addEventListener('submit', (e) => {
	d.querySelector("input[type='submit']").disabled = true;
	d.getElementById('loader').classList.toggle('visually-hidden');
});