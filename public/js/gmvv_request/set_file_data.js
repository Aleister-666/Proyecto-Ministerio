/**
 * Metodo asincrono que realiza una peticion de los datos al servidor para obtener
 * las url de los documentos asociados a la solicitud GMVV y los setea como atributo href
 * en los botonos del modal. Se llama en la funcion set_file_data como metodo interno de la funcion.
 *
 * Cuando los datos son obtenidos los navs del modal son actividados
 * 
 * @param  {DomElement} element -> elemento que genero el evento click en la funcion principal
 */
const set_client_data = async (element) => {
	const $modal = document.getElementById('files'),
		$btn_download_all = document.getElementById('download-all-btn');

	let client_data = {},
		files_data = {};
	let tag = element.nodeName.toLowerCase(),
	  $event_btn,
	  $nav_tabs;

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

	client_data['client_id'] = $event_btn.dataset.clientId;
	client_data['client_cedula'] = document.getElementById(`cedula-${client_data.client_id}`).innerText;
	client_data['client_names'] = document.getElementById(`names-${client_data.client_id}`).innerText;
	client_data['client_surnames'] = document.getElementById(`surnames-${client_data.client_id}`).innerText;

	files_data['path_files'] = $event_btn.dataset.pathFiles;
	files_data['path_download'] = $event_btn.dataset.pathDownload;

	files_data['end_point'] = `${files_data.path_files}?client_id=${client_data.client_id}`;


	$modal.querySelector('.modal-title').innerText = `V-${client_data.client_cedula}  ${client_data.client_names} ${client_data.client_surnames}`;
	$btn_download_all.href = files_data.path_download;

	try {
		let res = await fetch(files_data.end_point);	
		client_data['client_files'] = await res.json();

	} catch(err) {
		alert(err);
	}

	$nav_tabs = $modal.querySelectorAll('.modal-body a.nav-link');

	let n = 0;
	for (key in client_data['client_files']) {
		if (client_data['client_files'][key] != null) {
			$nav_tabs[n].classList.remove('disabled');
		}
		$nav_tabs[n].href = client_data.client_files[key]
		n++;
	}

};

/**
 * Se encarga de esconder modal, limpiar direccion src del iframe y desabilitar los navs del modal
 */
const dimiss_modal = () => {
	const $modal = document.getElementById('files'),
		$nav_tabs = $modal.querySelectorAll('.modal-body a.nav-link');

	let active;

	for (let i = 0; i < $nav_tabs.length; i++) {
		$nav_tabs[i].href = "#";
		$nav_tabs[i].classList.add('disabled');
	}

	// active = $modal.querySelector('button.nav-link.active');

	// if (active) active.classList.remove('active');
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