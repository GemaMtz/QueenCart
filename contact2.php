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
                    <a href="homeadmin.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a>
                    <a href="ag_pro.php" class="nav-item nav-link"  style="font-size: 1.5rem;"><i class="bi bi-cart-plus-fill"></i></a>
                    <a href="top.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bar-chart-line"></i></a>
                    <a href="agotados.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-x-fill"></i></a>
                    <a href="entregas.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-truck"></i></a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Header End -->
        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="display-3 text-white mb-3 animated slideInDown">Mi cuenta</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="homeadmin.php">Home</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Mis favoritos</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Header End -->

        <?php 

            $query=$conexion->prepare('SELECT * from users WHERE id_user = :usernamee');

            $query->bindParam(':usernamee',$usuario);

            $query->execute();

            $count=$query->rowCount();
            $campo = $query->fetch();        
        ?>

        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Datos de tu cuenta</h1>
                <div class="row g-4">
                    <div class="col-md-6 fadeInUp" data-wow-delay="0.1s">
                        <div class="container text-center">
                            <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen_us']) . ''; ?>" width="80%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class=" fadeInUp" data-wow-delay="0.5s">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <h3 class="text-center">Editar datos de mi cuenta</h3>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="na_me" name="na_me" value="<?php echo $campo['name_user']; ?>" readonly>
                                            <label for="na_me">Tu nombre:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="e_mail" name="e_mail" value="<?php echo $campo['e_mail']; ?>" readonly>
                                            <label for="e_mail">Tú Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="tele_fono" name="tele_fono" maxlength="10" value="<?php echo $campo['tel_fono']; ?>" autofocus>
                                            <label for="tele_fono">Telefono:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="pass" name="pass" value="<?php echo $campo['pass_word']; ?>">
                                            <label for="pass">Contraseña:</label>
                                        </div>
                                    </div>
                                    <div class="col-12 invoiceBox">

                                      <label for="file">
                                        <div class="boxFile" data-text="Seleccionar archivo">
                                          <span  id="inputGroupFileAddon01"><i class="fas fa-cloud-upload-alt"></i>Seleccionar nueva imagen de perfil</span>
                                        </div>
                                      </label>
                                      <input id="file" multiple="" name="imagen" id="image" size="16000" type="file" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button class="btn btn-outline-success w-40" type="submit" id="guardar" name="guardar">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->

        <!-- PHP para guardar cambios -->
        <?php 
            if (isset($_POST['guardar'])) {
                $telefon = $_POST['tele_fono'];
                $pssw = $_POST['pass'];
                $usuario2 = $_SESSION['iduser'];

                $size = getimagesize($_FILES["imagen"]["tmp_name"]);
                if($size !== false)
                {
                    $cargarImagen = $_FILES['imagen']['tmp_name'];
                    $imagen = fopen($cargarImagen,'rb');

                    $query=$conexion->prepare('UPDATE users SET tel_fono=:telefono, pass_word=:password, imagen_us=:imagen WHERE id_user = :usernamee');

                    $query->bindParam(':usernamee',$usuario2);
                    $query->bindParam(':telefono',$telefon);
                    $query->bindParam(':password',$pssw);
                    $query->bindParam(':imagen',$imagen, PDO::PARAM_LOB);
                    $query->execute();

                    $count=$query->rowCount();
                    $campo = $query->fetch();

                    if ($count) 
                    {
                        ?>
                        <script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se editaron los datos correctamente',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="contact2.php"
                        }); </script>
                        <?php
                      
                    }
                    else
                      {
                        ?><script>
                          Swal.fire({
                              icon: 'warning',
                              title: 'Ocurrió un error, favor de intentarlo',
                              showConfirmButton: true,
                              timer: 2500
                            }).then(function(){
                                window.location="contact2.php"
                            }); 
                            </script><?php
                      }
                unset($sql);   
                }
                else
                {
                ?><script>
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ocurrió un error, favor de intentarlo',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="contact2.php"
                    }); 
                    </script><?php
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
    <script type="text/javascript">
        document.querySelector('#file').addEventListener('change', function(e) {
          var boxFile = document.querySelector('.boxFile');
          boxFile.classList.remove('attached');
          boxFile.innerHTML = boxFile.getAttribute("data-text");
              boxFile.innerHTML = e.target.files[0].name;
              boxFile.classList.add('attached');
        });
    </script>
</body>

</html>