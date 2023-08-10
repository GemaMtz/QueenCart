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
        <!--Spinner End -->


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
                    <a href="top.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-bar-chart-line"></i></a>
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


        <!-- Formulario para agregar producto -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Agregando un producto</h1>
                <div class="row g-4">
                    <div class="col-md-12">
                        <div class="wow fadeInUp" data-wow-delay="0.5s">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label style="color: black;">ID del producto:</label>
                                        <input type="text" id="id_pro" name="id_pro" class="form-control" pattern="(\d\s?){8,8}" title="Ingrese un número válido de 8 dígitos" maxlength="8" placeholder="Ej. 12345678" required autofocus />
                                    </div>
                                    <div class="col-md-6" style="color: black;">
                                        <label>Nombre del producto</label>
                                        <input type="text" class="form-control" name="name_pro" id="name_pro" placeholder="El nombre del producto" required>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" id="cate_goria" name="cate_goria" required>
                                            <option selected disabled>Categoría</option>
                                            <option value="Computadoras">Computadoras</option>
                                            <option value="Componentes">Componentes</option>
                                            <option value="Almacenamiento">Almacenamiento</option>
                                            <option value="Monitores">Monitores</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Leave a message here" id="des_cripcion" name="des_cripcion" rows="3"></textarea>
                                            <label for="des_cripcion">Descripción del producto</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="pre_cio" id="pre_cio" placeholder="Ingresa el precio">
                                            <label for="pre_cio">Precio</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="number" class="form-control" name="stock" id="stock" placeholder="Ingresa el numero de productos">
                                            <label for="stock">Número de productos</label>
                                        </div>
                                    </div>
                                    <div class="input-group col-12 form-control">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupFileAddon01"><i class="fas fa-cloud-upload-alt"></i> </span>
                                      </div>
                                      <div class="custom-file">
                                        <input type="file" accept="image/jpg" name="imagen" class="custom-file-input"  id="image" aria-describedby="inputGroupFileAddon01" lang="es">
                                        <label class="custom-file-label" for="image">Selecciona una imagen (.jpg)</label>
                                      </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <input type="submit" name="guardar" id="guardar" value="Agregar producto" class="btn btn-outline-dark w-30 py-2">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Formulario para agregar producto end -->

        <?php
            require_once 'cnn.php'; 
            if(isset($_POST["guardar"]))
            {
                $idpro = $_POST['id_pro'];
                $namepro = $_POST['name_pro'];
                $categoria = $_POST['cate_goria'];
                $descripcion = $_POST['des_cripcion'];
                $precio = $_POST['pre_cio'];
                $num_stock = $_POST['stock'];
                $conexion = new conexion();
                
                if(!empty(getimagesize($_FILES["imagen"]["tmp_name"])))
                {
                    $cargarImagen = $_FILES['imagen']['tmp_name'];
                    $imagen = fopen($cargarImagen,'rb');

                    $sql=$conexion->prepare("INSERT INTO productos
                        (id_pro, name_pro, cate_pro, descripcion, precio, stock, imagen) VALUES (:id_proo, :name_pro, :cate_proo, :descripcionn, :precioo, :stockk, :imagen)");

                    //Asignar el contenido de las variables a los parametros
                    $sql->bindParam(':id_proo',$idpro);
                    $sql->bindParam(':name_pro',$namepro);
                    $sql->bindParam(':cate_proo',$categoria);
                    $sql->bindParam(':descripcionn',$descripcion);
                    $sql->bindParam(':precioo',$precio);
                    $sql->bindParam(':stockk',$num_stock);
                    $sql->bindParam(':imagen',$imagen, PDO::PARAM_LOB);

                    //Ejecutar la variable $sql
                    $sql->execute();
                    $count=$sql->rowCount();

                    if ($count) 
                    {
                        ?>
                        <script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se subió el producto correctamente',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="ag_pro.php"
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
                                window.location="ag_pro.php"
                            }); 
                            </script><?php
                      }
                    unset($sql);   
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
</body>

</html>