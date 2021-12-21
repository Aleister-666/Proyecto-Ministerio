/**
 * Metodo usado para crear un relog simple
 * @return {[type]} [description]
 */
export default function relog() {
	const d = document;
	const $relog = d.getElementById('relog');
	

	setInterval(() => {
		let time = new Date().toLocaleString();
		$relog.children[0].textContent = time;
	},1000)
}