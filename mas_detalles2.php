<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>VEROSA</title>
    <link rel="shortcut icon" href="img/icono_main.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php 
      require 'links.html';
      ob_start(); 
      session_start(); 
      require 'cnn.php';
      $conexion= new conexion();
      if (!isset($_SESSION['iduser']) || empty($_SESSION['iduser'])) {
            ?><script type="text/javascript">
                Swal.fire({
                    icon: "warning",
                    title: "Inicia sesión para acceder aquí",
                }).then(function() {
                    window.location.href = "index.php";
                });
              </script><?php
        }
      else {
        $usuario = $_SESSION['iduser'];
      }
    ?> 
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Star -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
            <a href="home.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">VEROSA</h1>
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
                    <a href="contact.php" class="nav-item nav-link"><img src="<?php
                    $conexion= new conexion();

                    $query=$conexion->prepare('SELECT * from users WHERE id_user = :usernamee');

                    $query->bindParam(':usernamee',$usuario);

                    $query->execute();
                    $campo = $query->fetch(); echo 'data:image/png;base64,' . base64_encode($campo['imagen_us']); ?>" style="border-radius: 50%;height: 40px;margin-left: 1%;"></a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <?php 
        	$idpro = $_GET['idprod'];
        	$conexion = new conexion();
			$sql = "SELECT * FROM productos WHERE id_pro = $idpro";
			$stmt = $conexion->prepare($sql);
			$stmt->execute();
			$count = $stmt->rowCount();
			$campo = $stmt->fetch();
        ?>

        <div class="container-xxl py-5">
            <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Datos del producto</h1>
            <form action="" method="post">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s"></h1>
                <div class="row g-4">
                    <div class="col-md-6 fadeInUp" data-wow-delay="0.1s">
                        <div class="container text-center">
                            <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" width="80%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="namepro" name="namepro" value="<?php echo $campo['name_pro']; ?>" readonly>
                                        <label for="na_me">Nombre del articulo:</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="catepro" name="catepro" value="<?php echo $campo['cate_pro']; ?>" readonly>
                                        <label for="tele_fono">Categoría:</label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="namepro" name="namepro" value="<?php echo $campo['name_pro']; ?>" readonly>
                                        <label for="na_me">Descripción del producto:</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <input type="text" class="form-control" id="pass" name="pass" value="$ <?php echo $campo['precio'] ?>" readonly>
                                        <label for="pass">Precio:</label>
                                    </div>
                                </div>
                                <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">
                                <input type="text" style="display: none;" name="pass" id="pass" value="<?php echo $campo['precio']; ?>">
                                <div class="col-12 text-center">
                                    <a href="home.php" class="btn btn-outline-success w-60" type="submit" id="guardar" name="guardar">Regresar</a>&nbsp;
                                    
                                    <?php 
                                        $idusuerio = $_SESSION['iduser'];

                                        $query=$conexion->prepare('SELECT *, (select COUNT(*) FROM favoritos WHERE favoritos.id_produc = P.id_pro and favoritos.id_user = :usuario) `favorito` FROM productos P WHERE P.id_pro = :idproduct');

                                        $query->bindParam(':usuario',$idusuerio);
                                        $query->bindParam(':idproduct',$campo['id_pro']);


                                        $query->execute();
                                        $count = $query->rowCount();

                                        if ($count) {
                                        ?>
                                        <button type="submit" class="btn btn-outline-primary" name="favorito" id="favorito">
                                            <?php 

                                        $favoritosD = $query->fetch();
                                        if ($favoritosD["favorito"] == '1') {
                                            echo '<i class="fa-solid fa-heart"></i>';
                                        }else{ 
                                            echo '<i class="fa-regular fa-heart"></i>'; 
                                        } 
                                    } ?>
                                            
                                    </button>&nbsp;
                                    <button type="submit" class="btn btn-outline-danger" name="carrito" id="carrito"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>

        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Productos similares de la misma categoria</h1>
                <div class="row g-4">
                    <div class="col-md-12 fadeInUp" data-wow-delay="0.1s">
			            <?php
			                $conexion = new conexion();
                            $idpro = $_GET['idprod'];
			                $cate = $campo['cate_pro'];
			                $sql = "SELECT * FROM productos WHERE cate_pro = '$cate' and id_pro != '$idpro' ";
			                $stmt = $conexion->prepare($sql);
			                $stmt->execute();
                            $count = $stmt->rowCount();
                            if ($count) {
			                while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
			            ?>
			            <div class="job-item p-4 mb-4">
			                <div class="row g-4">
			                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
			                        <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">
			                        <div class="text-start ps-4">
			                            <h5 class="mb-3"><?php echo $campo['name_pro'] ?></h5>
			                            <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>
			                            <span class="text-truncate me-3"><i class="far fa-clock text-primary me-2"></i>Full Time</span>
			                            <span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span>
			                        </div>
			                    </div>
			                    <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
			                        <div class="d-flex mb-3">
			                            <button type="button" class="btn btn-outline-dark" style="width: 100%" onclick="enviar('<?php echo $campo['id_pro']; ?>')">Ver detalles</button>&nbsp;
			                        </div>
			                    </div>
			                </div>
			            </div>
			        <?php }
                    }
                    else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay productos para mostrar</h4>';
                        ?><center><div class="col-md-6"><img src="img/triste.png" width="25%"></div></center><?php
                    }?>
			    	</div>
			    </div>
			</div>
		</div>


        <!-- PHP para favoritos y carrito--> 
        <?php
            if (isset($_POST['favorito'])) {
                $idprod = $_POST['id_prod'];
                $iduser = $_SESSION['iduser'];

                $query=$conexion->prepare('SELECT * from favoritos WHERE id_produc = :idprod and id_user = :idus');

                $query->bindParam(':idprod',$idprod);
                $query->bindParam(':idus',$iduser);
                $query->execute();

                $count3=$query->rowCount();

                if ($count3) {
                    $query=$conexion->prepare('DELETE from favoritos WHERE id_produc = :idprod and id_user = :idus');

                    $query->bindParam(':idprod',$idprod);
                    $query->bindParam(':idus',$iduser);
                    $query->execute();

                    $count4=$query->rowCount();
                    if ($count4) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'warning',
                          title: 'Se eliminó de tus favoritos el producto',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="mas_detalles2.php?idprod=" + <?php echo $idprod; ?>;
                        }); </script><?php
                    }
                }
                else{
                    $query = "INSERT INTO favoritos (id_produc, id_user) VALUES ('$idprod', '$iduser')";
                    $query = $conexion->prepare($query);
                    $query->execute();
                    $count2 = $query->rowCount();
                    if ($count2) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se agregó a tus favoritos',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="mas_detalles2.php?idprod=" + <?php echo $idprod; ?>;
                        }); </script><?php
                    }
                }
            }

            if (isset($_POST['carrito'])) {                
                $idprod = $_POST['id_prod'];
                $iduser = $_SESSION['iduser'];

                $query=$conexion->prepare('SELECT * from productos, tbl_carrito, users WHERE productos.id_pro = :idprod and tbl_carrito.id_producto = :idprod and users.id_user = :i_duser and productos.stock > 0 and tbl_carrito.estado = "pendiente" ');

                $query->bindParam(':idprod',$idprod);
                $query->bindParam(':i_duser',$iduser);
                $query->execute();

                $count=$query->rowCount();
                $campo = $query->fetch();

                if ($count) {
                    $prec_io = $campo['precio'];
                    $t_otal = $campo['total'];
                    $numepro = $campo['num_pro'];

                    $sumapro = $numepro + 1;
                    $totalcount = $prec_io + $t_otal;

                    $query = "UPDATE tbl_carrito, users SET tbl_carrito.num_pro = $sumapro, tbl_carrito.id_precio = $prec_io, tbl_carrito.total = $totalcount WHERE tbl_carrito.id_producto = $idprod and tbl_carrito.id_user = $iduser and tbl_carrito.estado = 'pendiente' ";

                    $query = $conexion->prepare($query);
                    $query->execute();
                    $count2 = $query->rowCount();

                    if ($count2) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se agregó a tu carrito exitosamente',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="mas_detalles2.php?idprod=" + <?php echo $idprod; ?>
                        }); </script><?php
                    }
                }
                else{
                    $preciopro = $_POST['pass'];
                    $query = "INSERT INTO tbl_carrito (id_producto, id_user, id_precio, num_pro, total, estado, date_time, entrega, fecha_entrega) VALUES ('$idprod', '$iduser',:pr_ecio, 1, :pr_ecio, 'pendiente', null, 'sin entregar', 'null')";

                    $query = $conexion->prepare($query);
                    $query->bindParam(':pr_ecio',$preciopro);
                    $query->execute();
                    $count2 = $query->rowCount();

                    if ($count2) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se agregó a tu carrito exitosamente',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="mas_detalles2.php?idprod=" + <?php echo $idprod; ?>
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
                            &copy; <a class="border-bottom" href="#">VEROSA 2022</a>, All Right Reserved. 
							
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

    <script type="text/javascript">
        function enviar(dataValue){
            var datos = dataValue;
            window.location.href='mas_detalles2.php?idprod='+datos;
        }
    </script>
</body>

</html>