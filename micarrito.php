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
        .cambiar:before {
            content: "Total del carrito ";
        }
        .cambiar:hover:before {
            content: "Pagar ";
        }
        .titulo {
            color: red;
        }
        .titulo:hover{
            color: green;
        }
        .otro{
            color: black;
            border-color: black;
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
                    <a href="favoritos.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bookmark-heart-fill"></i></a>
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
        <div class="container-xxl py-5 mb-3" id="comentarios">
            <div class="container">
                <form method="post">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Tu carrito<i class="bi bi-cart-fill"></i></h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <div class="tab-content">
                        <?php
                            $conexion = new conexion();
                            $query=$conexion->prepare('SELECT * from tbl_carrito, productos WHERE tbl_carrito.id_user = :idusuario and tbl_carrito.id_producto = productos.id_pro and tbl_carrito.estado = "pendiente"');

                            $query->bindParam(':idusuario',$id_usuario);
                            $query->execute();
                            $count = $query->rowCount();

                            while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="job-item p-4 mb-4">
                            <div class="row g-4">
                                <div class="col-sm-12 col-md-8 d-flex align-items-center">
                                    <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">

                                    <div class="text-start ps-4">
                                        <h5 class="mb-3"><?php echo $campo['name_pro'] ?></h5>

                                        <span class="text-truncate me-3"><i class="fa fa-cubes text-primary me-2"></i><?php echo $campo['cate_pro'] ?></span>


                                        <span class="text-truncate me-3"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span>

                                        <span class="text-truncate me-0"><i class="bi bi-cart-check me-2"></i><?php echo $campo['num_pro'] ?> artículos</span>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 d-flex flex-column align-items-start align-items-md-end justify-content-center">
                                    <div class="d-flex mb-3">
                                        <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">

                                        <button type="button" class="btn btn-outline-warning otro" onclick="enviar('<?php echo $campo['id_pro']; ?>')">Más detalles</button>&nbsp;

                                        <button type="button" class="btn btn-outline-danger" name="delete" id="delete"  onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php  
                    }
                    if ($count) {
                        $conexion = new conexion();
                        $query=$conexion->prepare('SELECT SUM( DISTINCT total) FROM tbl_carrito WHERE id_user = :idusuario and estado = "pendiente"');
                        $query->bindParam(':idusuario',$id_usuario);
                        $query->execute();
                        $total = $query->fetch(PDO::FETCH_NUM);
                        echo '<input type="text" style="display: none;" name="total_com" id="total_com" value="'.$total[0].'">';

                        echo '<button type="submit" class="btn btn-outline-dark cambiar" name="pagar" id="pagar"> &nbsp;$'.$total_income = $total[0].'</button>';
                    }
                    else{
                        echo '<h4 class="text-center wow fadeInUp" data-wow-delay="0.1s">No hay productos en su carrito para mostrar</h4><h6 class="text-center wow fadeInUp" data-wow-delay="0.1s"><a href="home.php" class="titulo">Da clic en aquí para mostrarte nuestros fabulosos productos</a></h6>';
                        ?><center><div class="col-md-6"><img src="img/sonrisa.png" height="100%"></div></center><?php
                    }?>
                    </div>
                </div>
                </form>
            </div>
        </div><br>
        <div style="display: none;" id="testingdelete"></div>

        <!-- Modal editar número de productos -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header" style="background-color: #9CDEDA;">
                  <h5 class="modal-title" id="staticBackdropLabel">Editando carrito</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Formulario de login -->
                  <div style="background-image: url(''); background-repeat:no-repeat;">
                    <div class="container">
                        <form action="" method="post">
                            <div id="conte-modal2"></div>                        
                    </div>
                  </div>
                </div>
                <div class="modal-footer text-start" style=" margin-right: 10px; margin-left: 0px; background-color: #9CDEDA;">
                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-warning otro" id="change" name="change">Guardar cambios</button>
                    <button type="submit" class="btn btn-outline-danger" id="delete" name="delete">Eliminar todos</button>
              </form> 
                </div>
              </div>
            </div>
        </div>

        <!-- PHP para eliminar o cambiar producto del carrito -->
        <?php
            if (isset($_POST['change'])) {
                $s_tock = $_POST['numero'];
                $usuario = $_SESSION['iduser'];
                $idprodu = $_POST['id_pro'];
                $preciofinal = $_POST['precio'];

                $conexion= new conexion();

                $query=$conexion->prepare('SELECT * from tbl_carrito WHERE id_user = :usernamee and id_producto = :idpro and estado = "pendiente" ');

                $query->bindParam(':usernamee',$usuario);
                $query->bindParam(':idpro',$idprodu);

                $query->execute();

                $count=$query->rowCount();
                $campo = $query->fetch();

                $totalprecio = $campo['id_precio'] * $s_tock;

                if ($count) {
                    $query=$conexion->prepare('UPDATE tbl_carrito SET num_pro = :st_ock, total = :total_precio WHERE id_user = :usernamee and id_producto = :idpro and estado = "pendiente"');

                    $query->bindParam(':idpro',$idprodu);
                    $query->bindParam(':usernamee',$usuario);
                    $query->bindParam(':st_ock',$s_tock);
                    $query->bindParam(':total_precio',$totalprecio);
                    $query->execute();

                    $count4=$query->rowCount();
                    if ($count4) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se realizó el cambió correctamente',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="micarrito.php"
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
            if (isset($_POST['delete'])) {
                $s_tock = $_POST['numero'];
                $usuario = $_SESSION['iduser'];
                $idprodu = $_POST['id_pro'];
                $preciofinal = $_POST['precio'];

                $conexion= new conexion();

                $query=$conexion->prepare('SELECT * from tbl_carrito WHERE id_user = :usernamee and id_producto = :idpro and estado = "pendiente"');

                $query->bindParam(':usernamee',$usuario);
                $query->bindParam(':idpro',$idprodu);

                $query->execute();

                $count=$query->rowCount();
                $campo = $query->fetch();

                $totalprecio = $campo['id_precio'] * $s_tock;

                if ($count) { ?>
                <script type="text/javascript">
                    Swal.fire({
                      title: 'Está seguro de eliminarlo?',
                      text: "Una vez eliminado ya no estará en su carrito!",
                      icon: 'warning',
                      showCancelButton: true,
                      confirmButtonColor: '#3085d6',
                      cancelButtonColor: '#d33',
                      confirmButtonText: 'Si, eliminar'
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $('#testingdelete').load('deleteall.php?idpro=' + <?php echo $idprodu ?>, function() {
                            Swal.fire(
                              'Eliminado!',
                              'El producto fue eliminado correctamente',
                              'success'
                            ).then(function(){
                                window.location="micarrito.php"
                            });
                        });                      }
                  });
                </script>
                <?php
                }
                else{
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'warning',
                      title: 'Ocurrió un error, intentelo de nuevo',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="micarrito.php"
                    }); </script><?php
                }
            }
            if (isset($_POST['pagar'])) {
                $prueba = $_POST['total_com'];
                ?><script type="text/javascript">
                Swal.fire({
                  title: 'Procesando',
                  showConfirmButton: false,
                  html:`<div class="spinner-border text-primary" role="status">
                  <span class="visually-hidden">Loading...</span>
                </div>`,
                  timer: 1500
                }).then(function(){
                    window.location="proceso.php?pruebas=" + <?php echo $prueba; ?>;
                }); </script><?php
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
        function enviar(dataValue){
            var datos = dataValue;
            window.location.href='mas_detalles2.php?idprod='+datos;
        }
        /* Método para traer datos del producto a eliminar*/
        function showModalContent(dataValue){
            $('#conte-modal2').load('viewus_modal.php?idpro=' + dataValue, function() {
                $('#staticBackdrop').modal("show");
            });   
        } 
    </script>
</body>

</html>