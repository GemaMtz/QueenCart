
function buscar_datos(consulta){
	$.ajax({
		url: 'buscar.php',
		type: 'POST',
		dataType: 'html',
		data: {consulta:consulta},
	})
	.done(function (respuesta) {
		$('#datos').html(respuesta);
	})
	.fail(function() {
		console.log("error");
	})
}


$("#caja_busqueda").on('input', function () {
	var valor = $(this).val();
	if (valor != "") {
		buscar_datos(valor);
	}
	else{
		document.getElementById("datos").innerHTML = "";
	}
})