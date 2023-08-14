<?php 
	$mysqli = new mysqli("localhost","root","","bd_queencart");

	$salida = "";
	$string = "data:image/png;base64, ";
	$query = "SELECT * FROM productos ORDER BY id_pro";

	if (isset($_POST['consulta'])) {
		$q = $_POST['consulta'];
		$query = "SELECT name_pro, descripcion, precio, id_pro, imagen FROM productos WHERE name_pro LIKE '%".$q."%' OR descripcion LIKE '%".$q."%' ";
	}

	$resultado = $mysqli->query($query);

	if ($resultado->num_rows > 0) {
		while($fila = $resultado->fetch_assoc()){
			$salida .= '<div class="col-md-3 mb-3  pt-5 mb-md-0" data-aos="fade-up">
						<div class="card h-100" style=" font-size: 18px;">
							<div class="card-body"><form method="post" action="">';
			$salida .= '<img src="'.$string.base64_encode($fila['imagen']).'" class="card-img-top" alt="..." width="130px" height="130px">';
			$salida .= '<h5 class="card-title">'.$fila['name_pro'].'</h5>';
			$salida .= '<p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$'. $fila['precio'].'</span></p>';
			$salida .= '<input type="text" style="display: none;" name="id_prod" id="id_prod" value=" '.$fila['id_pro']. '">';
			$salida .= '<input type="text" style="display: none;" name="pass" id="pass" value=" '.$fila['precio'].' ">';
			$salida .= '<button type="button" class="btn btn-outline-dark" onclick="enviar('.$fila['id_pro'].')">Detalles</button>&nbsp;';
			$salida .= '</form></div>
                        </div>
                    </div>';
		}
	}
	else {
		$salida .= "No hay datos :(";
	}

	echo $salida;

	$mysqli->close();
?>