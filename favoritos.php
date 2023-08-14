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
    ?>
    <?php $usuario = $_SESSION['iduser']; ?>
    <?php
        require 'links.html';
    ?>
    <style type="text/css">
        .titulo {
            color: red;
        }
        .titulo:hover{
            color: green;
        }
    </style>
    
</head>

<body style="background-color: white;">
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
            <a href="home.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">QUEEN CART</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="home.php" class="nav-link nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a> 
                    <a href="historial.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-receipt"></i></a>
                    <a href="micarrito.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-check"></i></a>
                    <a href="contact.php" class="nav-item nav-link"><img src="<?php
                    $conexion= new conexion();

                    $query=$conexion->prepare('SELECT * from users WHERE id_user = :usernamee');

                    $query->bindParam(':usernamee',$usuario);

                    $query->execute();
                    $campo = $query->fetch(); echo 'data:image/png;base64,' . base64_encode($campo['imagen_us']); ?>" style="border-radius: 50%;height: 40px;margin-left: 1%;"></a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Lista de favoritos -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container" style="margin-bottom: 110px">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Tus favoritos</h1>
                <div class="tab-class text-center wow fadeInUp mb-5" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <?php
                            $conexion = new conexion();
                            $query=$conexion->prepare('SELECT * from users, favoritos, productos WHERE users.id_user = favoritos.id_user AND productos.id_pro = favoritos.id_produc AND users.id_user = :idusuario');
                            $query->bindParam(':idusuario',$usuario);

                            $query->execute();
                            $count = $query->rowCount();

                            if ($count) {
                                
                                while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <form action="" method="post">
                            <div class="job-item p-4 mb-5">
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
                                            <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">
                                            <input type="text" style="display: none;" name="pass" id="pass" value="<?php echo $campo['precio']; ?>">
                                            <button type="button" class="btn btn-outline-dark" onclick="enviar('<?php echo $campo['id_pro']; ?>')">Detalles</button>&nbsp;
                                            <button type="submit" class="btn btn-outline-primary" name="favorito" id="favorito"><i class="fa-solid fa-heart"></i></button>&nbsp;
                                            <button type="submit" class="btn btn-outline-danger" name="carrito" id="carrito"><i class="fa-solid fa-cart-arrow-down"></i></button>&nbsp;
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <?php } 
                    }
                    else{
                        echo '<h4 class="text-center wow fadeInUp" data-wow-delay="0.1s">No hay productos que te hayan gustado aún</h4><h6 class="text-center wow fadeInUp" data-wow-delay="0.1s"><a href="home.php" class="titulo">Da clic en aquí para mostrarte nuestros fabulosos productos</a></h6>';
                        ?><center><div class="col-md-6"><img src="img/sonrisa.png" height="100%"></div></center><?php
                    }?>
			        </div>
                </div>
            </div>
        </div>

            
        <!-- PHP para eliminar producto favorito -->
        <?php
            if (isset($_POST['favorito'])) {
                $idprod = $_POST['id_prod'];

                $conexion= new conexion();

                $query=$conexion->prepare('SELECT * from users WHERE id_user = :usernamee');

                $query->bindParam(':usernamee',$usuario);

                $query->execute();

                $count=$query->rowCount();
                $campo = $query->fetch();

                $iduser = $campo['id_user'];

                if ($count) {
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
                            window.location="favoritos.php"
                        }); </script><?php
                    }
                }
                else{
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'success',
                      title: 'Se agregó a tus favoritos',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="favoritos.php"
                    }); </script><?php
                }
            }
            if (isset($_POST['carrito'])) {                
                $idprod = $_POST['id_prod'];
                $usuario = $_SESSION['iduser'];

                $query=$conexion->prepare('SELECT * from productos, tbl_carrito WHERE tbl_carrito.id_user = :idus and productos.id_pro = :idprod and tbl_carrito.id_producto = :idprod and productos.stock > 0 and tbl_carrito.estado = "pendiente" ');

                $query->bindParam(':idprod',$idprod);
                $query->bindParam(':idus',$usuario);
                $query->execute();

                $count=$query->rowCount();
                $campo = $query->fetch();

                if ($count) {
                    $prec_io = $campo['precio'];
                    $t_otal = $campo['total'];
                    $numepro = $campo['num_pro'];

                    $sumapro = $numepro + 1;
                    $totalcount = $prec_io + $t_otal;

                    $query = "UPDATE tbl_carrito, users SET tbl_carrito.num_pro = $sumapro, tbl_carrito.id_precio = $prec_io, tbl_carrito.total = $totalcount WHERE tbl_carrito.id_producto = $idprod and tbl_carrito.id_user = :idus and tbl_carrito.estado = 'pendiente' ";

                    $query = $conexion->prepare($query);
                    $query->bindParam(':idus',$usuario);
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
                            window.location="favoritos.php"
                        }); </script><?php
                    }
                }
                else{
                    $preciopro = $_POST['pass'];
                    $usuario = $_SESSION['iduser'];
                    $conexion= new conexion();
                    $query = "INSERT INTO tbl_carrito (id_producto, id_user, id_precio, num_pro, total, estado, date_time, entrega, fecha_entrega) VALUES ('$idprod', '$usuario',$preciopro, 1, $preciopro, 'pendiente', now(), 'sin entregar', null)";

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
                            window.location="favoritos.php"
                        }); </script><?php
                    }
                    else {
                        ?><script type="text/javascript">alert('holi <?php echo $usuario.$preciopro.$idprod; ?>');</script><?php
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
    
    <script type="text/javascript">
        
        /* Método para traer enviar datos del producto para detalles*/
        function enviar(dataValue){
            var datos = dataValue;
            window.location.href='mas_detalles2.php?idprod='+datos;
        } 
    </script>
</body>

</html>