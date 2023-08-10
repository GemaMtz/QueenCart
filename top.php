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
                <h1 class="m-0 text-primary">QUEEN CART</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="homeadmin.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a>
                    <a href="ag_pro.php" class="nav-item nav-link"  style="font-size: 1.5rem;"><i class="bi bi-cart-plus-fill"></i></a>
                    <a href="agotados.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-x-fill"></i></a>
                    <a href="entregas.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-truck"></i></a>
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

        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Productos más vendidos</h1>
                <div class="row g-4 mb-5">
                    <div class="col-md-12 fadeInUp mb-4" data-wow-delay="0.1s">
                        <?php
                            $conexion = new conexion();
                            $sql = "SELECT * FROM productos WHERE stock<=20 and stock>0 LIMIT 10";
                            $stmt = $conexion->prepare($sql);
                            $stmt->execute();
                            while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <form action="mas_detalles.php" method="post">
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
                                        <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">
                                        <button type="submit" class="btn btn-outline-dark">Más detalles</button>&nbsp;
                                    </div>
                                </div>
                            </div>
                        </div>
                            </form>
                    <?php }?>
                    </div>
                </div>
            </div>
        </div>

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