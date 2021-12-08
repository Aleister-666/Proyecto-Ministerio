d = document;

$form = d.querySelector('form');

$form.addEventListener('submit', (e) => {
	d.querySelector("input[type='submit']").disabled = true;
});