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
                    <a href="favoritos.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bookmark-heart-fill"></i></a>
                    <a href="micarrito.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-check"></i></a>
                    <a href="contact.php" class="nav-item nav-link"><img src="<?php
                    $conexion= new conexion();

                    $query=$conexion->prepare('SELECT * from users WHERE id_user = :usernamee');

                    $query->bindParam(':usernamee',$id_usuario);

                    $query->execute();
                    $campo = $query->fetch(); echo 'data:image/png;base64,' . base64_encode($campo['imagen_us']); ?>" style="border-radius: 50%;height: 40px;margin-left: 1%;"></a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Lista de mi carrito -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container">
                <form method="post">
                <h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Pagos pendientes <i class="bi bi-emoji-smile" style="font-size: 1.5rem;"></i></h4> 
                <?php
                $conexion = new conexion();
                $query=$conexion->prepare('SELECT * from tbl_carrito, productos, tbl_mediopago WHERE tbl_carrito.id_user = :idusuario and tbl_carrito.id_producto = productos.id_pro and tbl_carrito.estado = "en proceso" and tbl_carrito.entrega = "sin entregar" and tbl_carrito.codigo = tbl_mediopago.codigo_efec');

                $query->bindParam(':idusuario',$id_usuario);
                $query->execute();
                $count = $query->rowCount(); 
                    if ($count) { ?> 
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <?php
                                    while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">

                                    <div class="text-start ps-4">
                                        <h5 class="mb-3"><?php echo $campo['name_pro'] ?></h5>

                                        <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>


                                        <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php $total = $campo['deuda']; echo $total; ?></span>

                                        <span class="text-truncate me-0"><i class="bi bi-check2-square"></i> <?php echo $campo['num_pro'] ?> artículos</span>
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 d-flex flex-column  align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <p style="margin-top: 15px"><i class="bi bi-check2"></i> Adquirido</p>&nbsp;&nbsp;&nbsp;
                                        <p style="margin-top: 15px"><i class="bi bi-emoji-neutral"></i> <?php echo $campo['entrega'] ?></p>&nbsp;
                                    </div>
                                </div> 
                                <?php 
                                    $codig = $campo['codigo_efec'];
                                }
                            ?>
                            </div>
                            <center><div style="background-color: #CBCAC9;" class="col-md-6 p-2"><h6 style="color: black;">Código de compra: &nbsp;<?php
                                echo $codig; ?></h6></div></center><br>
                            <button type="submit" class="btn btn-outline-danger" id="actualizar" name="actualizar">Actualizar pago</button>
                    <?php } 
                    else{
                        echo '<center><div class="col-md-6"><h5 class="text-center wow fadeInUp" data-wow-delay="0.1s">No tienes ningún pago pendiente</h5>';
                        ?><img src="img/caritafeli.jpg" width="60%" style="border-radius: 30px"></div></center><?php
                    }?>
                        </div>
                    </div>
                </div>
                </form>
            </div>

            <div class="container">
                <form method="post">
                <h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s" style="margin-top: 20px">Historial de compras <i class="bi bi-emoji-smile" style="font-size: 1.5rem;"></i></h4>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                <?php
                    $conexion = new conexion();
                    $query=$conexion->prepare('SELECT * from tbl_carrito, productos WHERE tbl_carrito.id_user = :idusuario and tbl_carrito.id_producto = productos.id_pro and tbl_carrito.estado = "pagado" and tbl_carrito.entrega IN ("sin entregar", "entregado")');

                    $query->bindParam(':idusuario',$id_usuario);
                    $query->execute();
                    $count = $query->rowCount();

                    if ($count) { ?>
                    <div class="tab-content">
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <?php
                                        while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                    <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                        <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">

                                        <div class="text-start ps-4">
                                            <h5 class="mb-3"><?php echo $campo['name_pro'] ?></h5>

                                            <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>


                                            <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php $total_com = $campo['total']; echo $total_com; ?></span>

                                            <span class="text-truncate me-0"><i class="bi bi-check2-square"></i> <?php  echo $campo['num_pro'] ?> artículos</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-4 d-flex flex-column  align-items-md-end justify-content-center">
                                        <div class="d-flex mb-3">
                                            <p style="margin-top: 15px"><i class="bi bi-check2"></i> Adquirido</p>&nbsp;&nbsp;&nbsp;
                                            <p style="margin-top: 15px"><?php if ($campo['entrega'] == 'sin entregar') {
                                                        echo '<i class="bi bi-emoji-neutral"></i>&nbsp;'.$campo['entrega'];
                                                    }else echo '<i class="bi bi-emoji-laughing-fill"></i>&nbsp;'.$campo['entrega'];  ?></p>&nbsp;
                                        </div>
                                    </div> 
                                    <?php
                                } }
                                else{
                                    echo '<center><div class="col-md-6"><h5 class="text-center wow fadeInUp" data-wow-delay="0.1s">Aún no tienes ninguna compra almacenada, ¿Qué esperas?</h5><h6 class="text-center wow fadeInUp" data-wow-delay="0.1s"><a href="home.php" class="titulo">Da clic en aquí para mostrarte nuestros fabulosos productos</a></h6>';
                                ?><img src="img/caritaenojo.jpeg" width="60%" style="border-radius: 30px;"></div></center><?php
                            }?>
                                </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
        <div style="margin-top: 100px;"></div>

        <!-- PHP para simular pago en efectivo -->
        <?php 
            if (isset($_POST['actualizar'])) {
                $conexion = new conexion();
                $query = "UPDATE productos SET stock = (SELECT new_stock FROM (SELECT id_pro `id_producto`, new_stock FROM (SELECT id_pro, name_pro, stock - (SELECT num_pro FROM tbl_carrito c where c.id_user = :usernamee and c.id_producto = id_pro and c.estado = 'en proceso') `new_stock` FROM productos) AS P WHERE new_stock IS NOT NULL) as N WHERE N.id_producto = id_pro)
                            WHERE id_pro IN (SELECT d.id_producto from tbl_carrito d where d.id_user = :usernamee and d.estado = 'en proceso');
                            UPDATE tbl_carrito SET estado = 'pagado', date_time = now(), entrega = 'sin entregar', total = :deudaa WHERE id_user = :usernamee and estado = 'en proceso';
                            UPDATE tbl_mediopago SET estado = 'pagado', date_time = now() WHERE id_user = :usernamee and estado = 'en proceso' ";

                    $query = $conexion->prepare($query);
                    $query->bindParam(':deudaa',$total);
                    $query->bindParam(':usernamee',$id_usuario);
                    $query->execute();
                    $count2 = $query->rowCount();
                    if ($count2) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          title: 'Procesando',
                          showConfirmButton: false,
                          html:`<div class="spinner-border text-primary" role="status">
                          <span class="visually-hidden">Loading...</span>
                        </div>`,
                          timer: 1500
                        }).then(function(){
                            Swal.fire({
                              icon: 'success',
                              title: 'Se realizó exitosamente el pago',
                              showConfirmButton: true,
                              timer: 2500
                            }).then(function(){
                            window.location="historial.php";
                            });
                        }); </script><?php
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