/**
 * Metodo asincrono que realiza una peticion de los datos al servidor para obtener
 * las url de los documentos asociados a la solicitud GMVV y los setea como atributo data
 * en los botonos del modal. Se llama en la funcion set_file_data como metodo interno de la funcion.
 *
 * Cuando los datos son obtenidos los navs del modal son actividados
 * 
 * @param  {DomElement} element -> elemento que genero el evento click en la funcion principal
 */
const set_client_data = async (element) => {
	const $modal = document.getElementById('files'),
		$btn_download_all = document.getElementById('download-all-btn'),
		$iframe = document.getElementById('frame-document');

	let tag = element.nodeName.toLowerCase(),
		client_id, client_cedula, client_names,
		client_surnames, client_files, path_download,
		path_files, url, $event_btn, $nav_tabs;

	switch (tag) {
		case 'button':
			$event_btn = element;
			break;
		case 'svg':
			$event_btn = element.parentElement;
			break;
		case 'path':
			$event_btn = element.parentElement.parentElement;
			break;
	}

	client_id = $event_btn.dataset.clientId;
	path_download = $event_btn.dataset.pathDownload;
	path_files = $event_btn.dataset.pathFiles;
	url = `${path_files}?client_id=${client_id}`;

	client_cedula = document.getElementById(`cedula-${client_id}`).innerText;
	client_names = document.getElementById(`names-${client_id}`).innerText;
	client_surnames = document.getElementById(`surnames-${client_id}`).innerText;

	$modal.querySelector('.modal-title').innerText = `V-${client_cedula}  ${client_names} ${client_surnames}`;
	$btn_download_all.href = path_download;

	try {
		let res = await fetch(url);	
		client_files = await res.json();

	} catch(err) {
		alert(err);
	}

	datos = client_files;

	$nav_tabs = $modal.querySelectorAll('.modal-body button.nav-link');

	let n = 0;
	for (key in client_files) {
		if (client_files[key] != null) {
			$nav_tabs[n].classList.remove('disabled');
		}
		$nav_tabs[n].setAttribute('data-file-path', client_files[key]);
		n++;
	}

};

/**
 * Se encarga de esconder modal, limpiar direccion src del iframe y desabilitar los navs del modal
 */
const dimiss_modal = () => {
	const $modal = document.getElementById('files'),
		$nav_tabs = $modal.querySelectorAll('.modal-body button.nav-link')
		$iframe = $modal.querySelector('iframe');

	let active;

	$iframe.src = '';
	$iframe.classList.add('d-none');
	for (let i = 0; i < $nav_tabs.length; i++) {
		$nav_tabs[i].classList.add('disabled');
	}

	active = $modal.querySelector('button.nav-link.active');

	if (active) active.classList.remove('active');
};

/**
 * Metodo para setear o quitar del modal los datos de los archivos 
 * de la solicitud GMVV de los clientes.
 */
function set_file_data() {
	const d = document;

	d.addEventListener('click', (e) => {
		if (e.target.matches("button[data-download]") || e.target.matches("button[data-download='true'] *")) {
			set_client_data(e.target);
		} else if (e.target.matches("button[data-bs-dismiss]")) {
			dimiss_modal();
		}
	});
}

set_file_data();