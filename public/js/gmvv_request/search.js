/**
 * Metodo que realiza una peticion al servidor para realizar funcion de busqueda de registros GMVV,
 * usando el numero de cedula como filtro de busqueda
 */
function search() {
	const d = document;

	d.addEventListener('DOMContentLoaded', () => {
		const $search_bar = d.getElementById('search'),
			$spinner_box = d.getElementById('spinner-box'),
			$results = d.getElementById('results');

		let base_url = $search_bar.dataset.searchPath;

		$search_bar.addEventListener('keyup', () => {

			let cedula = $search_bar.value.trim();	
			
			if (cedula != "") {
				$spinner_box.classList.remove('visually-hidden');
				let url = `${base_url}?cedula=${cedula}`;

				fetch(url)
				.then(res => res.text())
				.then(html => {
					$results.innerHTML = html;
					$spinner_box.classList.add('visually-hidden');
				})
				.catch(err => alert(err))

			} else {

				fetch(base_url)
				.then(res => res.text())
				.then(html => {
					$results.innerHTML = html;
					$spinner_box.classList.add('visually-hidden');

				})
				.catch(err => alert(err))
			}
		})
	})
}

search();