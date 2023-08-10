<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>QUEEN CART</title>
    <link rel="shortcut icon" href="img/icono_main.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php
	    ob_start(); 
	    session_start();
	    require 'cnn.php';
	    $usuario = $_SESSION['iduser'];
	?>
    <?php
        require 'links.html';
    ?>
    
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="home.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">QUEEN CART</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="home.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a>
                    <a href="historial.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-receipt"></i></a>
                    <a href="favoritos.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bookmark-heart-fill"></i></a>
                    <a href="micarrito.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-check"></i></a>
                    <a href="contact.php" class="nav-item nav-link">Mi cuenta</a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Formulario para datos personales -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container ">

        <!-- PHP para procesar compra-->
        <?php 
        	$prueba = $_GET['pruebas'];

            $conexion= new conexion();

			$query=$conexion->prepare('SELECT * from users WHERE id_user = :idusuario and cam_colonia !="null"');

			$query->bindParam(':idusuario',$usuario);

			$query->execute();

			$count=$query->rowCount();
			if ($count) {
				$campo = $query->fetch();?>
			<div class="progress">
			  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50" style="width: 50%"></div>
			</div>
			<div class="row">
				<div class="col-4"><i class="bi bi-cart-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
				<div class="col-4 text-center"><i class="bi bi-house-door-fill col-md-4" style="font-size: 1.5rem;"></i></div>
				<div class="col-4" style="text-align: right;"><i class="bi bi-bag-dash-fill col-md-4" style="font-size: 1.5rem;"></i></div>
			</div><br>
			
            <form action="" method="post">
            	<div class="tab-class wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content job-item" style="padding: 30px">
                    	<h5 class="text-center wow fadeInUp" data-wow-delay="0.1s">Paso 2 de 3 para completar la compra</h5>
                    	<h5 class="text-center">Confirmar datos de tu domicilio</h5>
                    	<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect2" name="floatingSelect2" aria-label="Floating label select example" required>
							    <option value="Aguascalientes" <?php if($campo['cam_estado'] == 'Aguascalientes'){ echo 'selected';} ?>>Aguascalientes</option>
								<option value="Baja California" <?php if($campo['cam_estado'] == 'Baja California'){ echo 'selected';} ?>>Baja California</option>
								<option value="Baja California Sur" <?php if($campo['cam_estado'] == 'Baja California Sur'){ echo 'selected';} ?>>Baja California Sur</option>
								<option value="Campeche" <?php if($campo['cam_estado'] == 'Campeche'){ echo 'selected';} ?>>Campeche</option>
								<option value="Chiapas" <?php if($campo['cam_estado'] == 'Chiapas'){ echo 'selected';} ?>>Chiapas</option>
								<option value="Chihuahua" <?php if($campo['cam_estado'] == 'Chihuahua'){ echo 'selected';} ?>>Chihuahua</option>
								<option value="CDMX" <?php if($campo['cam_estado'] == 'CDMX'){ echo 'selected';} ?>>Ciudad de México</option>
								<option value="Coahuila" <?php if($campo['cam_estado'] == 'Coahuila'){ echo 'selected';} ?>>Coahuila</option>
								<option value="Colima" <?php if($campo['cam_estado'] == 'Colima'){ echo 'selected';} ?>>Colima</option>
								<option value="Durango" <?php if($campo['cam_estado'] == 'Durango'){ echo 'selected';} ?>>Durango</option>
								<option value="Estado de México" <?php if($campo['cam_estado'] == 'Estado de México'){ echo 'selected';} ?>>Estado de México</option>
								<option value="Guanajuato" <?php if($campo['cam_estado'] == 'Guanajuato'){ echo 'selected';} ?>>Guanajuato</option>
								<option value="Guerrero" <?php if($campo['cam_estado'] == 'Guerrero'){ echo 'selected';} ?>>Guerrero</option>
								<option value="Hidalgo" <?php if($campo['cam_estado'] == 'Hidalgo'){ echo 'selected';} ?>>Hidalgo</option>
								<option value="Jalisco" <?php if($campo['cam_estado'] == 'Jalisco'){ echo 'selected';} ?>>Jalisco</option>
								<option value="Michoacán" <?php if($campo['cam_estado'] == 'Michoacán'){ echo 'selected';} ?>>Michoacán</option>
								<option value="Morelos" <?php if($campo['cam_estado'] == 'Morelos'){ echo 'selected';} ?>>Morelos</option>
								<option value="Nayarit" <?php if($campo['cam_estado'] == 'Nayarit'){ echo 'selected';} ?>>Nayarit</option>
								<option value="Nuevo León" <?php if($campo['cam_estado'] == 'Nuevo León'){ echo 'selected';} ?>>Nuevo León</option>
								<option value="Oaxaca" <?php if($campo['cam_estado'] == 'Oaxaca'){ echo 'selected';} ?>>Oaxaca</option>
								<option value="Puebla" <?php if($campo['cam_estado'] == 'Puebla'){ echo 'selected';} ?>>Puebla</option>
								<option value="Querétaro" <?php if($campo['cam_estado'] == 'Querétaro'){ echo 'selected';} ?>>Querétaro</option>
								<option value="Quintana Roo" <?php if($campo['cam_estado'] == 'Quintana Roo'){ echo 'selected';} ?>>Quintana Roo</option>
								<option value="San Luis Potosí" <?php if($campo['cam_estado'] == 'San Luis Potosí'){ echo 'selected';} ?>>San Luis Potosí</option>
								<option value="Sinaloa" <?php if($campo['cam_estado'] == 'Sinaloa'){ echo 'selected';} ?>>Sinaloa</option>
								<option value="Sonora" <?php if($campo['cam_estado'] == 'Sonora'){ echo 'selected';} ?>>Sonora</option>
								<option value="Tabasco" <?php if($campo['cam_estado'] == 'Tabasco'){ echo 'selected';} ?>>Tabasco</option>
								<option value="Tamaulipas" <?php if($campo['cam_estado'] == 'Tamaulipas'){ echo 'selected';} ?>>Tamaulipas</option>
								<option value="Tlaxcala" <?php if($campo['cam_estado'] == 'Tlaxcala'){ echo 'selected';} ?>>Tlaxcala</option>
								<option value="Veracruz" <?php if($campo['cam_estado'] == 'Veracruz'){ echo 'selected';} ?>>Veracruz</option>
								<option value="Yucatán" <?php if($campo['cam_estado'] == 'Yucatán'){ echo 'selected';} ?>>Yucatán</option>
								<option value="Zacatecas" <?php if($campo['cam_estado'] == 'Zacatecas'){ echo 'selected';} ?>>Zacatecas</option>
						  </select>
						  <label for="floatingSelect">Seleccione su estado</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingCiudad2" name="floatingCiudad2" placeholder="holi" value="<?php echo $campo['cam_ciudad'] ?>">
							<label for="floatingCiudad">Ciudad</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingColonia2" name="floatingColonia2" placeholder="holi" value="<?php echo $campo['cam_colonia'] ?>">
							<label for="floatingColonia">Colonia</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingCalle2" name="floatingCalle2" placeholder="holi" value="<?php echo $campo['cam_calleyexterior'] ?>">
							<label for="floatingCalle">Calle y número exterior</label>
						</div>
						<div class="mb-3">
						  <label for="Textarea1" class="form-label" style="color: black;">Descripción del domicilio</label>
						  <textarea class="form-control" id="Textarea2" name="Textarea2" rows="2" placeholder="Descripción de la fachada, puntos de referencia para encontrarla, indicaciones de seguridad, etc." ><?php echo $campo['cam_descripcion'] ?></textarea>
						</div>
						<input type="text" style="display: none;" name="prueba2" id="prueba2" value="<?php echo $prueba ?>">
			        	<div class="mb-12 text-center">
			        		<button type="submit" class="btn btn-outline-dark" name="continuar2" id="continuar2">Confirmar datos</button>
			        	</div>
			        </div>
                </div>
            </form><?php
			}
			else {?>
				<form method="post" action=""><div class="progress">
				  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="50" style="width: 50%"></div>
				</div>
				<div class="row">
					<div class="col-4"><i class="bi bi-cart-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
					<div class="col-4 text-center"><i class="bi bi-house-door-fill col-md-4" style="font-size: 1.5rem;"></i></div>
					<div class="col-4" style="text-align: right;"><i class="bi bi-bag-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
				</div><br>
				
                <div class="tab-class wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content job-item" style="padding: 30px">
                    	<h5 class="text-center wow fadeInUp" data-wow-delay="0.1s">Paso 2 de 3 para completar la compra</h5>
                    	<h5 class="text-center">Confirmar datos de tu domicilio</h5>
                    	<div class="form-floating mb-3">
							<select class="form-select" id="floatingSelect" name="floatingSelect" aria-label="Floating label select example">
							    <option value="Aguascalientes" selected>Aguascalientes</option>
								<option value="Baja California">Baja California</option>
								<option value="Baja California Sur">Baja California Sur</option>
								<option value="Campeche">Campeche</option>
								<option value="Chiapas">Chiapas</option>
								<option value="Chihuahua">Chihuahua</option>
								<option value="CDMX">Ciudad de México</option>
								<option value="Coahuila">Coahuila</option>
								<option value="Colima">Colima</option>
								<option value="Durango">Durango</option>
								<option value="Estado de México">Estado de México</option>
								<option value="Guanajuato">Guanajuato</option>
								<option value="Guerrero">Guerrero</option>
								<option value="Hidalgo">Hidalgo</option>
								<option value="Jalisco">Jalisco</option>
								<option value="Michoacán">Michoacán</option>
								<option value="Morelos">Morelos</option>
								<option value="Nayarit">Nayarit</option>
								<option value="Nuevo León">Nuevo León</option>
								<option value="Oaxaca">Oaxaca</option>
								<option value="Puebla">Puebla</option>
								<option value="Querétaro">Querétaro</option>
								<option value="Quintana Roo">Quintana Roo</option>
								<option value="San Luis Potosí">San Luis Potosí</option>
								<option value="Sinaloa">Sinaloa</option>
								<option value="Sonora">Sonora</option>
								<option value="Tabasco">Tabasco</option>
								<option value="Tamaulipas">Tamaulipas</option>
								<option value="Tlaxcala">Tlaxcala</option>
								<option value="Veracruz">Veracruz</option>
								<option value="Yucatán">Yucatán</option>
								<option value="Zacatecas">Zacatecas</option>
						  </select>
						  <label for="floatingSelect">Seleccione su estado</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingCiudad" name="floatingCiudad" placeholder="holi">
							<label for="floatingCiudad">Ciudad</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingColonia" name="floatingColonia" placeholder="holi">
							<label for="floatingColonia">Colonia</label>
						</div>
						<div class="form-floating mb-3">
							<input type="text" class="form-control" id="floatingCalle" name="floatingCalle" placeholder="holi">
							<label for="floatingCalle">Calle y número exterior</label>
						</div>
						<div class="mb-3">
						  <label for="Textarea1" class="form-label" style="color: black;">Descripción del domicilio</label>
						  <textarea class="form-control" id="Textarea1" name="Textarea1" rows="2" placeholder="Descripción de la fachada, puntos de referencia para encontrarla, indicaciones de seguridad, etc."></textarea>
						</div>
			        	<div class="mb-12 text-center">
							<input type="text" style="display: none;" name="prueba" id="prueba" value="<?php echo $prueba ?>">
			        		<button type="submit" class="btn btn-outline-dark" name="continuar" id="continuar">Continuar</button>
			        	</div>
			        </div>
                </div></form><?php
			}
        
        ?>
            </div>
        </div>

        <!-- PHP para formulario de direccion -->
        <?php 
        	if (isset($_POST['continuar2'])) {
        		$prueba = $_POST['prueba2'];
        		$state = $_POST['floatingSelect2'];
        		$country = $_POST['floatingCiudad2'];
        		$colo_nia = $_POST['floatingColonia2'];
        		$street = $_POST['floatingCalle2'];
        		$descri_cion = $_POST['Textarea2'];

        		if (!empty($prueba) && !empty($state) && !empty($country) && !empty($colo_nia) && !empty($street)) {
        			$query=$conexion->prepare('UPDATE users SET cam_estado = :camestado, cam_ciudad = :camciudad, cam_colonia = :camcolonia, cam_calleyexterior = :calle, cam_descripcion = :camexterior WHERE id_user = :usernamee');

                    $query->bindParam(':camestado',$state);
                    $query->bindParam(':camciudad',$country);
                    $query->bindParam(':camcolonia',$colo_nia);
                    $query->bindParam(':calle',$street);
                    $query->bindParam(':camexterior',$descri_cion);
                    $query->bindParam(':usernamee',$usuario);
                    $query->execute();

                    $count4=$query->rowCount();
        			if ($count4) {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'success',
	                      title: 'Se guardaron los datos correctamente',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        			else {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'warning',
	                      title: 'Ocurrió un error, intentelo de nuevo',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="proceso.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        		}
        	}
        	if (isset($_POST['continuar'])) {
        		$prueba = $_POST['prueba'];
        		$state = $_POST['floatingSelect'];
        		$country = $_POST['floatingCiudad'];
        		$colo_nia = $_POST['floatingColonia'];
        		$street = $_POST['floatingCalle'];
        		$descri_cion = $_POST['Textarea1'];

        		if (!empty($prueba) && !empty($state) && !empty($country) && !empty($colo_nia) && !empty($street)) {
        			$query=$conexion->prepare('UPDATE users SET cam_estado = :camestado, cam_ciudad = :camciudad, cam_colonia = :camcolonia, cam_calleyexterior = :calle, cam_descripcion = :camexterior WHERE id_user = :usernamee');

                    $query->bindParam(':camestado',$state);
                    $query->bindParam(':camciudad',$country);
                    $query->bindParam(':camcolonia',$colo_nia);
                    $query->bindParam(':calle',$street);
                    $query->bindParam(':camexterior',$descri_cion);
                    $query->bindParam(':usernamee',$usuario);
                    $query->execute();

                    $count4=$query->rowCount();
        			if ($count4) {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'success',
	                      title: 'Se guardaron los datos correctamente',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        			else {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'warning',
	                      title: 'Ocurrió un error, intentelo de nuevo',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="proceso.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        		}
        		else{
        			$query=$conexion->prepare('UPDATE users SET cam_estado = :camestado, cam_ciudad = :camciudad, cam_colonia = :camcolonia, cam_calleyexterior = :calle, cam_descripcion = :camexterior WHERE id_user = :usernamee');

                    $query->bindParam(':camestado',$state);
                    $query->bindParam(':camciudad',$country);
                    $query->bindParam(':camcolonia',$colo_nia);
                    $query->bindParam(':calle',$street);
                    $query->bindParam(':camexterior',$descri_cion);
                    $query->bindParam(':usernamee',$usuario);
                    $query->execute();

                    $count4=$query->rowCount();
        			if ($count4) {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'success',
	                      title: 'Se guardaron los datos correctamente',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        			else {
        				?><script type="text/javascript">
	                    Swal.fire({
	                      icon: 'warning',
	                      title: 'Ocurrió un error, intentelo de nuevo',
	                      showConfirmButton: true,
	                      timer: 2500
	                    }).then(function(){
	                        window.location="proceso.php?pruebas=" + <?php echo $prueba; ?>;
	                    }); </script><?php
        			}
        		}
        	}
        ?>


		<!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">QUEEN CART - 2023</a>, All Right Reserved. 
              
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="home.php">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>