<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>QUEEN CART </title>
    <link rel="shortcut icon" href="img/icono_main.png">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <?php 
      require 'links.html';
      ob_start(); 
      session_start(); 
      require 'cnn.php';
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
        .negro {
            color: #167973;
            border-color: #167973;
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
            <a href="homeadmin.php" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">QUEEN CART </h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="homeadmin.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a> 
                    <a href="ag_pro.php" class="nav-item nav-link"  style="font-size: 1.5rem;"><i class="bi bi-cart-plus-fill"></i></a>
                    <a href="top.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bar-chart-line"></i></a>
                    <a href="agotados.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-x-fill"></i></a>
                    <a href="contact2.php" class="nav-item nav-link"><img src="<?php
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


        <!-- Lista de entregas pendientes -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Entregas pendientes</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <?php
                            $conexion = new conexion();
                            $query=$conexion->prepare('SELECT * FROM tbl_carrito, productos WHERE tbl_carrito.estado = "pagado" AND tbl_carrito.entrega = "sin entregar" and tbl_carrito.id_producto = productos.id_pro');

                            $query->execute();
                            $count = $query->rowCount(); 
                            if ($count) {?>
                        <form method="post" action="">
                            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">

                                <?php
                                    while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <div class="tab-content">
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">

                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3"><?php echo $campo['name_pro'] ?>&nbsp;&nbsp;(<?php echo 'ID = '.$campo['id_pro'] ?>)</h5>

                                                    <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>

                                                    <span class="text-truncate me-0"><i class="bi bi-check2-square"></i> <?php echo $campo['num_pro'] ?> artículos</span>&nbsp;

                                                    <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">
                                                    <input type="text" style="display: none;" name="idu_ser" id="idu_ser" value="<?php echo $campo['id_user']; ?>">

                                                    <span class="text-truncate me-0"><button type="button" class="btn btn-outline-warning negro" onclick="showModalContent2('<?php echo $campo['id_user']; ?>')">Datos del cliente</button></span>&nbsp;

                                                    <span class="text-truncate me-0"><button type="submit" class="btn btn-outline-success" name="change2" id="change2">Cambiar a entregado</button></span>&nbsp;

                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-4 d-flex flex-column  align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <p style="margin-top: 15px"><i class="bi bi-check2"></i> Pagado</p>&nbsp;&nbsp;&nbsp;
                                                    <p style="margin-top: 15px"> <?php if ($campo['entrega'] == 'sin entregar') {
                                                        echo '<i class="bi bi-emoji-neutral"></i>&nbsp;'.$campo['entrega'];
                                                    }else echo '<i class="bi bi-emoji-laughing-fill"></i>&nbsp;'.$campo['entrega'];  ?></p>&nbsp;
                                                </div>
                                            </div> 
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }} else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay entregas pendientes</h4>';
                        ?><center><div class="col-md-6"><img src="img/emoji.png" width="25%"></div></center><?php
                    }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- Lista de entregas -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Entregas completadas</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <?php
                            $conexion = new conexion();
                            $query=$conexion->prepare('SELECT * FROM tbl_carrito, productos WHERE tbl_carrito.estado = "pagado" AND tbl_carrito.entrega = "entregado" and tbl_carrito.id_producto = productos.id_pro');

                            $query->execute();
                            $count = $query->rowCount(); 
                            if ($count) {?>
                        <form method="post" action="">
                            <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">

                                <?php
                                    while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                                ?>
                                <div class="tab-content">
                                    <div class="job-item p-4 mb-4">
                                        <div class="row g-4">
                                            <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                                <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">

                                                <div class="text-start ps-4">
                                                    <h5 class="mb-3"><?php echo $campo['name_pro'] ?>&nbsp;&nbsp;(<?php echo 'ID = '.$campo['id_pro'] ?>)</h5>

                                                    <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>

                                                    <span class="text-truncate me-0"><i class="bi bi-check2-square"></i> <?php echo $campo['num_pro'] ?> artículos vendidos</span>&nbsp;

                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-4 d-flex flex-column  align-items-md-end justify-content-center">
                                                <div class="d-flex mb-3">
                                                    <p style="margin-top: 15px"><i class="bi bi-check2"></i> Pagado</p>&nbsp;&nbsp;&nbsp;
                                                    <p style="margin-top: 15px"> <?php if ($campo['entrega'] == 'sin entregar') {
                                                        echo '<i class="bi bi-emoji-neutral"></i>&nbsp;'.$campo['entrega'];
                                                    }else echo '<i class="bi bi-emoji-laughing-fill"></i>&nbsp;'.$campo['entrega'];  ?></p>&nbsp;
                                                </div>
                                            </div> 
                                    </div>
                                </div>
                            </div>
                            <?php 
                            }} else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay entregas completadas</h4>';
                        ?><center><div class="col-md-6"><img src="img/emoji.png" width="25%"></div></center><?php
                    }?>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <!-- PHP para cambiar a entregado -->
        <?php 
            if (isset($_POST['change2'])) {
                $idusuario = $_POST['idu_ser'];
                $idproducto = $_POST['id_prod'];
                $conexion = new conexion();

                $query = "UPDATE tbl_carrito SET entrega = 'entregado', fecha_entrega = now() WHERE id_user = :i_d and id_producto = :id_p and estado = 'pagado' ";

                $query = $conexion->prepare($query);
                $query->bindParam(':i_d',$idusuario);
                $query->bindParam(':id_p',$idproducto);
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
                          title: 'Se verificó correctamente la entrega',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                        window.location="entregas.php";
                        });
                    }); </script><?php
                }
                else {
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'warning',
                      title: 'No se pudo verificar la entrega, intentelo de nuevo',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                    window.location="entregas.php";
                    });</script><?php

                }
            }
        ?>

        <!-- Modal para datos del usuario -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Atención dale buen uso a la siguiente información!!</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Formulario de login -->
                  <div style="background-image: url(''); background-repeat:no-repeat;">
                    <div class="container">
                        <form action="" method="post">
                            <div id="conte-modal"></div>                        
                    </div>
                  </div>
                </div>
                <div class="modal-footer text-start" style=" margin-right: 10px; margin-left: 0px;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
              </form> 
                </div>
              </div>
            </div>
        </div>

    </div>


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    
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
                            <a href="homeadmin.php">Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->


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
        /* Método para traer datos del cliente */
        function showModalContent2(dataValue){
            $('#conte-modal').load('viewus2_modal.php?iduser=' + dataValue, function() {
                $('#staticBackdrop').modal("show");
            });   
        } 
    </script>
</body>

</html>