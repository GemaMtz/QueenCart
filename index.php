<?php 
    ob_start(); 
    session_start();
    require 'cnn.php';
    $conexion = new conexion();
?>
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
    ?>
      <script src="https://www.google.com/recaptcha/api.js" async defer></script>
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
        <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-2">
            <a href="index.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">QUEEN CART</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <div class="nav-item dropdown">
                        <a href="index.html" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="font-size: 1.3rem;"><i class="bi bi-house-door"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#Container_1" class="dropdown-item" onclick="showcontent('Container_1')">Computadoras</a>
                            <a href="#Componentes" class="dropdown-item" onclick="showcontent('Componentes')">Componentes</a>
                            <a href="#Almacenamiento" class="dropdown-item" onclick="showcontent('Almacenamiento')">Almacenamiento</a>
                            <a href="#Monitores" class="dropdown-item" onclick="showcontent('Monitores')">Monitores</a>
                        </div>
                    </div>
                </div>
                <a href="" class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">Regístrate</a>
                <a class="btn btn-primary rounded-0 py-4 px-lg-5 d-lg-block" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Iniciar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->

        <!-- Modal para registro -->
        <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header" style="background-color: #9CDEDA;">
                  <h5 class="modal-title" id="staticBackdropLabel">Registro</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" id="registro">
                    <div class="modal-body" style="color: black;">
                  <!-- Formulario de registro -->
                  <div style="background-image: url(''); background-repeat:no-repeat;">
                    <div class="container">
                        <input type="text" name="nam_user" id="nam_user" class="form-control" placeholder="Ingresa tu nombre de usuario" autofocus><br>
                
                        <input type="email" name="em_ail" id="em_ail" class="form-control" placeholder="Ingresa tu correo electronico" ><br>
                
                        <input type="tel" name="tele_fono" id="tele_fono" class="form-control" placeholder="Ingresa tu número de telefono" required="" maxlength="10" oninput="validarInput()" pattern="[0-9]+"><br>
                        <p id="mensaje_error" style="display: none;"></p>
                
                        <input type="password" name="passwor_d" id="passwor_d" class="form-control" placeholder="Ingresa tu contraseña">
                
                    </div>
                  </div>
                </div>
                    <div class="modal-footer" style="background-color: #9CDEDA;">
                      <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                      <input type="submit" name="register" id="register" class="btn btn-outline-dark" value="Continuar">
                    </div>
                </form> 
              </div>
            </div>
        </div>

        <!-- Modal para inicio de sesión -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header" style="background-color: #9CDEDA; color: black;">
                  <h5 class="modal-title" id="staticBackdropLabel" style="color: black;">Inicio de sesión</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post">
                    <div class="modal-body">
                      <!-- Formulario de login -->
                      <div style="background-image: url(''); background-repeat:no-repeat;">
                        <div class="container" style="color: black;">
                            <label><b>Username:</b></label>
                            <input type="text" name="user" id="user" class="form-control" placeholder="Ingresa tu usuario" style="width: 100%;" autofocus><br>
    
                            <label><b>Password: </b></label>
                            <input type="password" name="pass" id="pass" class="form-control" placeholder="Ingresa tu contraseña" style="width: 100%;" >
                            <div class="mb-2 ml-4 mt-3">
                               <label for="showPassword">Mostrar contraseña&nbsp;&nbsp;</label>
                               <input type="checkbox" id="showPassword" onclick="togglePasswordVisibility()"><br>
                               <label id="linkPassword">¿Olvidaste tu contraseña?&nbsp;<a href="#" class="links" onclick="Recuperar()"  class="btn btn-primary">Recuperar</a> </label>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer" style="background-color: #9CDEDA;">
                        <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                        <input type="submit" name="login" id="login" class="btn btn-outline-dark" value="Acceder">
                    </div>
                </form>
              </div>
            </div>
        </div>


        <div class="container-xxl py-5 bg-dark page-header mb-5">
            <div class="container my-5 pt-5 pb-4">
                <h1 class="text-white mb-3 animated slideInDown">Todo lo que deseas en un solo lugar</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item text-white active" aria-current="page">Disfruta lo mejor de nuestros productos</li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container" style="width: 100%; padding: 20px 20px 0px 20px;" data-aos="fade-up">
            <div class="row" style="margin-bottom: 20px;">
                <div class="col-2" style="text-align: right;">
                    <label for="user" class="form-label">Buscar producto: </label>
                </div>
                <div class="col-8">
                    <input type="text" name="caja_busqueda" id="caja_busqueda" class="form-control" style="width: 100%;" autofocus>
                </div>
            </div>
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5" id="datos">
                </div>
            </div>
        </div>


        <!-- Menú de categorías Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Explora nuestras categorias</h1>
                <div class="row g-4">
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s" onclick="showcontent('Container_1')">
                        <a class="cat-item rounded p-4" href="#Container_1">
                            <i class="fa fa-3x fa-solid fa-computer text-primary mb-4"></i>
                            <h6 class="mb-3">Computadoras</h6>
                            <p class="mb-0"><?php
                                $sql = "SELECT * FROM productos WHERE cate_pro = 'Computadoras' and stock>0";
                                $stmt = $conexion->prepare($sql);
                                $stmt->execute(); $count=$stmt->rowCount();
                                echo $count;?> productos</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s" onclick="showcontent('Componentes')">
                        <a class="cat-item rounded p-4" href="#Componentes">
                            <i class="fa fa-3x fa-solid fa-layer-group text-primary mb-4"></i>
                            <h6 class="mb-3">Componentes</h6>
                            <p class="mb-0"><?php 
                                $sql = "SELECT * FROM productos WHERE cate_pro = 'Componentes' and stock>0";
                                $stmt = $conexion->prepare($sql);
                                $stmt->execute(); $count=$stmt->rowCount();
                                echo $count;?> productos</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s" onclick="showcontent('Almacenamiento')">
                        <a class="cat-item rounded p-4" href="#Almacenamiento">
                            <i class="fa fa-3x fa-solid fa-database text-primary mb-4"></i>
                            <h6 class="mb-3">Almacenamiento</h6>
                            <p class="mb-0"><?php 
                                $sql = "SELECT * FROM productos WHERE cate_pro = 'Almacenamiento' and stock>0";
                                $stmt = $conexion->prepare($sql);
                                $stmt->execute(); $count=$stmt->rowCount();
                                echo $count;?> productos</p>
                        </a>
                    </div>
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s" onclick="showcontent('Monitores')">
                        <a class="cat-item rounded p-4" href="#Monitores">
                            <i class="fa fa-3x fa-solid fa-desktop text-primary mb-4"></i>
                            <h6 class="mb-3">Monitores</h6>
                            <p class="mb-0"><?php 
                                $sql = "SELECT * FROM productos WHERE cate_pro = 'Monitores' and stock>0";
                                $stmt = $conexion->prepare($sql);
                                $stmt->execute(); $count=$stmt->rowCount();
                                echo $count;?> productos</p>
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Menú de categorías End -->

     
        <!-- Categorias Computadoras -->
        <div class="container px-4 px-lg-5" id="Container_1" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad para Computadoras</h1>
                  <?php 
                    $sql = "SELECT * FROM productos WHERE cate_pro = 'Computadoras' and stock>0";
                    $stmt = $conexion->prepare($sql);
                    $stmt->execute();
                    $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up" >
                        <div class="card h-100" style=" font-size: 18px;">
                            <div class="card-body">
                                <form method="post" action="">
                                    <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." width="130px" height="130px">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text"><?php echo $campo['descripcion'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>

                                    <button type="button" class="btn btn-outline-dark" onclick="hacer_click()">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-primary" name="favorito" id="favorito" onclick="hacer_click()"><i class="fa-regular fa-heart"></i></button>
                                    <button type="button" class="btn btn-outline-danger" name="carrito" id="carrito" onclick="hacer_click()"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                    }else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay productos para mostrar</h4>';
                        ?><center><div class="col-md-6"><img src="img/triste.png" height="100%"></div></center><?php
                    }
                 ?>                   
                           
            </div>
        </div>
        <!-- Catagoría Computadoras end -->


        <!-- Catagoría Componentes -->
        <div class="container px-4 px-lg-5" id="Componentes" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad para Componentes</h1>
                <?php 

                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Componentes' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px;">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text"><?php echo $campo['descripcion'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>

                                    <button type="button" class="btn btn-outline-dark" onclick="hacer_click()">Detalles</button>&nbsp;

                                    <button type="button" class="btn btn-outline-primary" name="favorito" id="favorito" onclick="hacer_click()"><i class="fa-regular fa-heart"></i></button>

                                    <button type="button" class="btn btn-outline-danger" name="carrito" id="carrito" onclick="hacer_click()"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                    }else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay productos para mostrar</h4>';
                        ?><center><div class="col-md-6"><img src="img/triste.png" height="100%"></div></center><?php
                    }
                 ?>       
            </div>
        </div>
        <!-- Catagoría caballero end -->

        <!-- Catagoría Almacenamiento -->
        <div class="container px-4 px-lg-5" id="Almacenamiento" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad para Almacenamiento</h1>
                <?php 

                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Almacenamiento' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px; ">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text"><?php echo $campo['descripcion'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>

                                    <button type="button" class="btn btn-outline-dark" onclick="hacer_click()">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-primary" name="favorito" id="favorito" onclick="hacer_click()"><i class="fa-regular fa-heart"></i></button>
                                    <button type="button" class="btn btn-outline-danger" name="carrito" id="carrito" onclick="hacer_click()"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                    }else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay productos para mostrar</h4>';
                        ?><center><div class="col-md-6"><img src="img/triste.png" height="100%"></div></center><?php
                    }
                 ?>        
            </div>
        </div>
        <!-- Catagoría niños end -->

        <!-- Catagoría Monitores -->
        <div class="container px-4 px-lg-5" id="Monitores" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad de Monitores</h1>
                <?php 
                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Hogar' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px;">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text"><?php echo $campo['descripcion'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>

                                    <button type="button" class="btn btn-outline-dark" onclick="hacer_click()">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-primary" name="favorito" id="favorito" onclick="hacer_click()"><i class="fa-regular fa-heart"></i></button>
                                    <button type="button" class="btn btn-outline-danger" name="carrito" id="carrito" onclick="hacer_click()"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                    }else{
                        echo '<h4 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">No hay productos para mostrar</h4>';
                        ?><center><div class="col-md-6"><img src="img/triste.png" height="100%"></div></center><?php
                    }
                 ?>        
            </div>
        </div>
        <!-- Catagoría Monitores end -->

    
        <!-- About Start -->
        <div class="container-xxl py-5" id="prueba">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="row g-0 about-bg rounded overflow-hidden">
                            <div class="col-6 text-start">
                                <img class="img-fluid w-100" src="img/parte_1.png">
                            </div>
                            <div class="col-6 text-end">
                                <img class="img-fluid w-100" src="img/parte_2.png">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">Nuestro objetivo es brindarte un buen servicio</h1>
                        <p class="mb-4">Conoce los productos que se están agotando, aprovecha antes
                        de que sea tarde, checa las promociones que tenemos para ti, si deseas informarte sobre las opiniones de nuestros usuarios hacia nosotros, da clic en el siguiente botón</p>
                        <a class="btn btn-primary py-3 px-5 mt-3" href="#comentarios">Leer Más</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Sobre nosotros</h1>
                <div class="tab-class text-center wow fadeInUp" data-wow-delay="0.3s">
                    <ul class="nav nav-pills d-inline-flex justify-content-center border-bottom mb-5">
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 ms-0 pb-3 active" data-bs-toggle="pill" href="#tab-1">
                                <h6 class="mt-n1 mb-0">Últimos productos</h6>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-3">
                                <h6 class="mt-n1 mb-0">Comentarios</h6>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="tab-1" class="tab-pane fade show p-0 active">
                            <?php
                                $sql = "SELECT * FROM productos WHERE stock<=15 and stock>0 LIMIT 10";
                                $stmt = $conexion->prepare($sql);
                                $stmt->execute();
                                while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <form method="post" action="">
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
                                                
                                                <button type="button" class="btn btn-outline-dark" onclick="hacer_click()">Detalles</button>&nbsp;
                                                <button type="button" class="btn btn-outline-primary" name="favorito" id="favorito" onclick="hacer_click()"><i class="fa-regular fa-heart"></i></button>&nbsp;
                                                <button type="button" class="btn btn-outline-danger" name="carrito" id="carrito" onclick="hacer_click()"><i class="fa-solid fa-cart-arrow-down"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php }?>
                        </div>
                   

                        <div id="tab-3" class="tab-pane fade show p-0">
                            <!-- Área de comentarios -->
                            <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="container">
                                    <div class="owl-carousel testimonial-carousel">
                                        <?php 
                                          $sql = "SELECT * FROM comentarios";
                                          $stmt = $conexion->prepare($sql);
                                          $stmt->execute();
                                          while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                          ?>
                                        <div class="testimonial-item bg-light rounded p-4">
                                            <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                            <p><?php echo $campo['mensaje_com']; ?></p>
                                            <div class="d-flex align-items-center">
                                                <?php $user = $campo['usuario_com'];
                                                $query = "SELECT * FROM users WHERE name_user = '$user'";
                                                $stmt2 = $conexion->prepare($query);
                                                $stmt2->execute();
                                                $campo = $stmt2->fetch();        
                                                $count=$stmt2->rowCount(); 
                                                if ($count) {
                                                    ?><img class="img-fluid flex-shrink-0 rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen_us']) . ''; ?>" style="width: 50px; height: 50px;">              
                                                <div class="ps-3">
                                                    <h5 class="mb-1"><?php echo $campo['name_user']; ?></h5><?php
                                                }?>
                                                    <small><?php echo $campo['date_time']; ?></small>
                                                </div>
                                            </div>
                                        </div>
                                        <?php }
                                         ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->

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
                                <a href="#">Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        <!-- Modal -->
      <div class="modal fade" id="Prueba" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered ">
            <div class="modal-content">
               <form action="" method="POST" id="form-recovery">
                  <div class="modal-header" style="color: white">
                     <h3 class="modal-title" id="staticBackdropLabel">Recuperar contraseña</h3>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" >
                     <h4 for="emailfound">Correo electrónico</h4>
                     <input type="email" class="form-control" name="emailfound" id="emailfound" placeholder="Escribe aquí...">
                     <br/>
                     <div class="col-12 text-center">
                        <div class="g-recaptcha" data-sitekey="6LepNUEmAAAAAL_3L-7ZeV8WTz2WrAelTAJzEkms"></div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-outline-secondary" data-dismiss="modal" onclick="ClearForm()">Cerrar</button>
                     <button type="button" id="btnrecovery" name="btnrecovery" class="btn btn-outline-success" onclick="captchaValido()">Enviar contraseña</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
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
    <script src="js/consulta.js"></script>
   <script type="text/javascript">
        var formrecovery = document.getElementById('form-recovery');
        var miModal = new bootstrap.Modal(document.getElementById("Prueba"));
        function showcontent(ContainerId){
            document.getElementById("Container_1").style.display = "none";
            document.getElementById("Componentes").style.display = "none";
            document.getElementById("Almacenamiento").style.display = "none";
            document.getElementById("Monitores").style.display = "none";

            document.getElementById(ContainerId).style.display = "";
        }

        // Función para limpiar el formulario
        function ClearForm()
        {
          formrecovery.reset();
          miModal.hide();
          grecaptcha.reset();
        }

        // Función para validar el captcha
        function captchaValido() {
          // Verificar si el captcha es válido
          var response = grecaptcha.getResponse();
          
          if (response.length === 0 || $("#emailfound").val() == "") {
            // El captcha no ha sido validado
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 2500,
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })

            Toast.fire({
              icon: 'error',
              title: 'El captcha y el correo deben de ser completados'
            });
            return false;
          } else {
            // Realizar acciones adicionales aquí
            var myButton = document.getElementById('btnrecovery');
  myButton.type = 'submit';
          
            return true;
          }
        }

        // Función para alertar de que el usuario inicie sesión
        function hacer_click()
        {
            const Toast = Swal.mixin({
              toast: true,
              position: 'center',
              showConfirmButton: false,
              timer: 3000,
              background: '#9CDEDA',
              iconColor: '#D70C02',
              color: '#040000',
              timerProgressBar: true,
              didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
              }
            })
            Toast.fire({
              icon: 'warning',
              title: 'Es necesario iniciar sesión o registrarse para hacer uso de esta opción'
            })
        }

        // Función para validar el número de telefono
        function validarInput() {
          console.log("correcto");
          var input = document.getElementById("tele_fono");
          var mensajeError = document.getElementById("mensaje_error");
          
          var valor = input.value;
          
          if (/[a-zA-Z]/.test(valor) && valor.length < 10) {
            mensajeError.innerHTML = "El número de teléfono es incorrecto (no debe incluir letras, y debe ser de 10 dígitos)";
            mensajeError.style.display = "none";
            $("#tele_fono").addClass('is-invalid');
          } else {
            mensajeError.style.display = "block";
            $("#tele_fono").addClass('is-valid');
          }
        }

        // Función para mostrar la contraseña
        function togglePasswordVisibility() {
          var pssw = document.getElementById('pass');
          var control = 0;
          if (pssw.type === 'password' && control === 0){
            pssw.type = 'text';
            control++;
          }
          if (pssw.type === 'text' && control === 0){
            pssw.type = 'password';
            control++;
          }
        }

        // Funcion para mostrar modal de recuperación
        function Recuperar()
        {
          miModal.show();
        }
    </script>
    
    <!-- PHP para registro -->
    <?php 
      
        $rutaImagen = 'https://thumbs.dreamstime.com/b/icono-del-vector-de-la-persona-en-nuevo-estilo-plano-usuario-s%C3%ADmbolo-humano-con-sombra-larga-ejemplo-internet-horas-servicio-141808591.jpg';
        if (isset($_POST['register'])) {
            $userna = $_POST['nam_user'];
            $ema_il = $_POST['em_ail'];
            $telef_ono = $_POST['tele_fono'];
            $pass = $_POST['passwor_d'];
            
            $imagen = fopen($rutaImagen, 'rb');

            $stmt=$conexion->prepare('SELECT * from users WHERE name_user = :usernamee ');
            $stmt->bindParam(':usernamee', $userna);
            $stmt->execute();
            $count=$stmt->rowCount();

            if($count)
            {
                ?><script>
                Swal.fire({
                    icon: 'warning',
                    title: 'El nombre de usuario ya existe, intente con otro',
                    showConfirmButton: true,
                    timer: 5000
                  });
                </script><?php
            }
            else 
            {
                $query = "INSERT INTO users (name_user, e_mail, tel_fono, pass_word, imagen_us, date_time, cam_estado, cam_ciudad, cam_colonia, cam_calleyexterior, cam_descripcion) VALUES (:username, :email, $telef_ono, :password, :imagen, now(), 'null', 'null', 'null', 'null', 'null')";

                $query = $conexion->prepare($query);

                $query->BindParam(':username',$userna);  
                $query->BindParam(':email',$ema_il); 
                $query->BindParam(':password',$pass);
                $query->bindParam(':imagen', $imagen, PDO::PARAM_LOB);

                $query->execute();

                $count=$query->rowCount();

                if ($count) {
                    $_SESSION['nombreuser'] = $_POST['nam_user'];
                    $query=$conexion->prepare('SELECT * from users WHERE name_user = :usernamee ');
                    $query->bindParam(':usernamee',$_SESSION['nombreuser']);
                    $query->execute();

                    $campo = $query->fetch();
                    $_SESSION['iduser'] = $campo['id_user'];
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'success',
                      title: 'Bienvenid@',
                      showConfirmButton: true,
                      timer: 5000
                    }).then(function(){
                        window.location="home.php"
                    }); </script><?php
                }else
                {
                    ?><script>
                  Swal.fire({
                      icon: 'warning',
                      title: 'Ocurrió un error, favor de intentarlo nuevamente',
                      showConfirmButton: true,
                      timer: 5000
                    }).then(function(){
                        window.location="index.php"
                    });
                    </script><?php
                }
            }
        }
        
        if (isset($_POST['login'])) {
          session_start();

          $conexion = new conexion();
          $usuario = $_POST['user'];
          $pssw = $_POST['pass'];

          $query=$conexion->prepare('SELECT * from users WHERE name_user = :usernamee and pass_word = :password');

          $query->bindParam(':usernamee',$usuario);
          $query->bindParam(':password',$pssw);

          $query->execute();

          $count=$query->rowCount();
          $campo = $query->fetch();

          if ($count) 
          {
            $_SESSION['nombreuser'] = $campo['name_user'];
            $_SESSION['iduser'] = $campo['id_user'];
            if ($campo['name_user'] == 'admin') {
                ?>
                <script type="text/javascript">
                Swal.fire({
                  icon: 'success',
                  title: 'Bienvenid@ administrad@r',
                  showConfirmButton: true,
                  timer: 5000
                }).then(function(){
                    window.location="homeadmin.php"
                }); </script>
                <?php
                unset($query);
                unset($form);
             }
             else{
                    ?>
                    <script type="text/javascript">
                    Swal.fire({
                      icon: 'success',
                      title: 'Bienvenid@ nuevamente',
                      showConfirmButton: true,
                      timer: 5000
                    }).then(function(){
                        window.location="home.php"
                    }); </script>
                    <?php
                    unset($query);
                    unset($form);
              }
              
            }
            else
              {
                ?><script>
                  Swal.fire({
                      icon: 'warning',
                      title: 'Los datos son incorrectos, favor de intentarlo nuevamente',
                      showConfirmButton: true,
                      timer: 5000
                    }).then(function(){
                        window.location="index.php"
                    }); 
                    </script><?php
                    unset($query);
                    unset($form);
              }
        }

        // Función para resetar la contraseña para su recuperación
        if (isset($_POST['btnrecovery'])) 
        { 
          $foundemail = $_POST['emailfound'];
          $caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
          $nuevaContraseña = "";

          for ($i = 0; $i < 8; $i++) 
          {
             $nuevaContraseña .= $caracteres[rand(0, strlen($caracteres) - 1)];
          }

          $cipherpssw3 = md5($nuevaContraseña);

          $query3 = $conexion->prepare('SELECT * from users WHERE e_mail = :e_mail');

          $query3->bindParam(':e_mail',$foundemail);
          $query3->execute();
          $campo3 = $query3->fetch();

          $count3 = $query3->rowCount();

          if ($count3) 
          {
             $mensaje = '<html>
             <head>
             <title>Recuperación de contraseña</title>
             </head>
             <body>
             <h1>Hola '+ $campo['Chr_Username'] +',</h1><br/><br/>
             <p>Se solicito una recuperación de la contraseña de su cuenta.</p><br/><br/>
             <h2>Su nueva contraseña: <b style="color: blue">'+ $nuevaContraseña +'</b>,</h2><br/><br/>
             <p>Si la solicitud no la realizo usted, favor de comunicarse con nosotros.</p><br/>
             <p>¡Gracias por utilizar nuestro servicio!</p>
             </body>
             </html>';

             $mensaje = wordwrap($mensaje, 70, "\r\n");

             if(mail($foundemail, 'Nueva contraseña para click travel', $mensaje, 'From: clicktravel@gmail.com' . "\r\n" .
             'Reply-To: clicktravel@gmail.com' . "\r\n" .
             'Content-type: text/html; charset=utf-8' . "\r\n"))
             {
                $query4 = $conexion->prepare('UPDATE users SET pass_word = :pass_word WHERE e_mail = :e_mail');

                $query4->bindParam(':pass_word', $cipherpssw3);
                $query4->bindParam(':e_mail', $foundemail); 
                $query4->execute();

                $count4 = $query4->rowCount();
                if($count4)
                {
                   ?>
                   <script type="text/javascript">
                   Swal.fire({
                   icon: 'success',
                   title: 'Se envió correctamente el correo con su nueva contraseña a la dirección:\n' + $foundemail,
                   showConfirmButton: true,
                   timer: 6000
                   }); </script><?php
                }
                else 
                {
                   ?>
                   <script type="text/javascript">
                   Swal.fire({
                   icon: 'warning',
                   title: 'Ocurrión un error al resetear su contraseña, favor de intentar nuevamente',
                   showConfirmButton: true,
                   timer: 6000
                   }); </script><?php
                }
             }
             else 
             {
                ?>
                   <script type="text/javascript">
                   Swal.fire({
                   icon: 'warning',
                   title: 'Ocurrión un error al enviar el correo, favor de intentar nuevamente',
                   showConfirmButton: true,
                   timer: 6000
                   }); </script><?php
             }
          
          }
          else 
          {
             ?>
             <script type="text/javascript">
             Swal.fire({
             icon: 'warning',
             title: 'No se encontro el correo registrado, favor de intentar con uno valido',
             showConfirmButton: true,
             timer: 6000
             }); </script><?php
             unset($query3);
             unset($form);
          }
          
        }
        ob_end_flush();

    ?>

</body>

</html>