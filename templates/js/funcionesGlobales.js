function getDominioCorrecto() {
	var dominio = document.location.href.split('/');
	return `http://${dominio[2]}`;
}
