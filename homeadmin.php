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
                    <div class="nav-item dropdown">
                        <a href="homeadmin.php" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a>
                        <div class="dropdown-menu rounded-0 m-0">
                            <a href="#Container_1" class="dropdown-item" onclick="showcontent('Container_1')">Computadoras</a>
                            <a href="#Componentes" class="dropdown-item" onclick="showcontent('Componentes')">Componentes</a>
                            <a href="#Almacenamiento" class="dropdown-item" onclick="showcontent('Almacenamiento')">Almacenamiento</a>
                            <a href="#Monitores" class="dropdown-item" onclick="showcontent('Monitores')">Monitores</a>
                        </div>
                    </div>
                    
                    <a href="ag_pro.php" class="nav-item nav-link"  style="font-size: 1.5rem;"><i class="bi bi-cart-plus-fill"></i></a>
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

        <!-- Catagoría Computadoras -->
        <div class="container px-4 px-lg-5" id="Container_1" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad para Computadoras</h1>
                  <?php 

                    $conexion = new conexion();
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
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." width="130px" height="130px">
                                <form method="post" action="mas_detalles.php">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text">Stock: <?php echo $campo['stock'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>
                                    <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">

                                    <button type="submit" class="btn btn-outline-dark">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-danger" onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>
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

                  $conexion = new conexion();
                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Componentes' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px; width: ;">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="mas_detalles.php">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text">Stock: <?php echo $campo['stock'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>
                                    <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">

                                    <button type="submit" class="btn btn-outline-dark">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-danger" onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>
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
        <!-- Catagoría Componentes end -->

        <!-- Catagoría Almacenamiento -->
        <div class="container px-4 px-lg-5" id="Almacenamiento" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad para Almacenamiento</h1>
                <?php 

                  $conexion = new conexion();
                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Almacenamiento' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px; width: ;">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="mas_detalles.php">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text">Stock: <?php echo $campo['stock'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>
                                    <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">

                                    <button type="submit" class="btn btn-outline-dark">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-danger" onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>
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
        <!-- Catagoría Almacenamiento end -->

        <!-- Catagoría Monitores -->
        <div class="container px-4 px-lg-5" id="Monitores" style="display: none;">
            <div class="row gx-4 gx-lg-5">
                <h1 class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">Variedad de Monitores</h1>
                <?php 

                  $conexion = new conexion();
                  $sql = "SELECT * FROM productos WHERE cate_pro = 'Monitores' and stock>0";
                  $stmt = $conexion->prepare($sql);
                  $stmt->execute();
                  $count = $stmt->rowCount();
                    if ($count) {
                        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                    <div class="col-md-3 mb-3 mb-md-0" data-aos="fade-up">
                        <div class="card py-4 h-100" style=" font-size: 18px; width: ;">
                            <div class="card-body">
                                <img src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" class="card-img-top" alt="..." >
                                <form method="post" action="mas_detalles.php">
                                    <h5 class="card-title"><?php echo $campo['name_pro'] ?></h5>
                                    <p class="card-text">Stock: <?php echo $campo['stock'] ?></p>
                                    <p><span class="text-truncate me-0"><i class="far fa-money-bill-alt text-primary me-2"></i>$<?php echo $campo['precio'] ?></span></p>
                                    <input type="text" style="display: none;" name="id_prod" id="id_prod" value="<?php echo $campo['id_pro']; ?>">

                                    <button type="submit" class="btn btn-outline-dark">Detalles</button>&nbsp;
                                    <button type="button" class="btn btn-outline-danger" onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>
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
        <!-- Catagoría Hogar end -->


        <!-- Jobs Start -->
        <div class="container-xxl py-5">
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
                            <a class="d-flex align-items-center text-start mx-3 pb-3" data-bs-toggle="pill" href="#tab-2">
                                <h6 class="mt-n1 mb-0">Comentar</h6>
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
                                $conexion = new conexion();
                                $sql = "SELECT * FROM productos WHERE stock < 20 and stock>0";
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
                                            <button type="button" class="btn btn-outline-danger" onclick="showModalContent('<?php echo $campo['id_pro']; ?>')">Eliminar</button>&nbsp;
                                            <button type="submit" class="btn btn-outline-success" href="mas_detalles.php">Más detalles</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                </form>
                        <?php }?>
                        </div>


                        <div id="tab-2" class="tab-pane fade show p-0">
                            <div class="container-xxl ">
                                <div class="container">
                                    <div class="row g-4">
                                        <div class="col-md-6 fadeInUp" data-wow-delay="0.1s">
                                            <div class="container text-center">
                                                <img src="img/carousel-1.jpg" width="100%">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="wow fadeInUp" data-wow-delay="0.2s">
                                                <form method="post" action="">
                                                    <div class="row g-3">
                                                        <?php 
                                                            $usuario = $_SESSION['nombreuser'];

                                                            $conexion= new conexion();

                                                            $query=$conexion->prepare('SELECT * from users WHERE name_user = :usernamee');

                                                            $query->bindParam(':usernamee',$usuario);

                                                            $query->execute();

                                                            $count=$query->rowCount();
                                                            $campo = $query->fetch();        
                                                        ?>
                                                        <h3 class="text-center">Tu opinión es importante para nosotros</h3>
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" id="na_me" name="na_me" value="<?php echo $campo['name_user']; ?>" readonly>
                                                                <label for="na_me">Usuario:</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Leave a message here" id="des_cripcion" name="des_cripcion" style="height: 80px"></textarea>
                                                                <label for="des_cripcion">Escribe aquí tu opinión</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-12 text-center">
                                                            <button class="btn btn-outline-success w-40" type="submit" id="guardar" name="guardar">Guardar comentario</button>
                                                        </div>

                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php 
                            if(isset($_POST['guardar']))
                            {
                                $descripcion = $_POST['des_cripcion'];
                                $usuario = $_SESSION['nombreuser'];

                                $conexion = new conexion();

                                $sql=$conexion->prepare("INSERT INTO comentarios
                                    (usuario_com, mensaje_com, date_time) VALUES (:usuario_coom,:descripcionn, now())");

                                //Asignar el contenido de las variables a los parametros
                                $sql->bindParam(':usuario_coom',$usuario);
                                $sql->bindParam(':descripcionn',$descripcion);

                                //Ejecutar la variable $sql
                                $sql->execute();
                                $count = $sql->rowCount();
                                if ($count) {
                                  ?>
                                    <script type="text/javascript">
                                    Swal.fire({
                                      icon: 'success',
                                      title: 'Tu comentario se subió correctamente',
                                      showConfirmButton: true,
                                      timer: 2500
                                    }).then(function(){
                                        window.location="homeadmin.php"
                                    }); </script>
                                    <?php
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
                                        window.location="homeadmin.php"
                                }); 
                                </script><?php
                              }
                                unset($sql);  
                            }
                        ?>                       

                        <div id="tab-3" class="tab-pane fade show p-0">
                            <!-- Área de comentarios -->
                                <div class="container-xxl py-5 wow fadeInUp" data-wow-delay="0.1s">
                                    <div class="container">
                                        <div class="owl-carousel testimonial-carousel">
                                            <?php 
                                              $conexion = new conexion();
                                              $sql = "SELECT * FROM comentarios";
                                              $stmt = $conexion->prepare($sql);
                                              $stmt->execute();
                                              while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                              ?>
                                            <div class="testimonial-item bg-light rounded p-4">
                                                <i class="fa fa-quote-left fa-2x text-primary mb-3"></i>
                                                <p><?php echo $campo['mensaje_com']; ?></p>
                                                <div class="d-flex align-items-center">
                                                    <img class="img-fluid flex-shrink-0 rounded" src="img/confiuser.png" style="width: 50px; height: 50px;">              
                                                    <div class="ps-3">
                                                        <h5 class="mb-1"><?php echo $campo['usuario_com']; ?></h5>
                                                        <small><?php echo $campo['date_time']; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php }
                                             ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- Testimonial End -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- Jobs End -->


        <!-- Modal para eliminar producto -->
        <div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <form method="post">
                        <div class="modal-header" style="background-color: #9CDEDA; color: black;">
                          <h5 class="modal-title" id="staticBackdropLabel">Eliminar producto</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-center" style="color: black;">
                            <div id="conte-modal2"></div>
                        </div>
                        <div class="modal-footer" style="background-color: #9CDEDA;">
                          <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cerrar</button>
                          <input type="submit" name="delete1" id="delete1" class="btn btn-outline-danger" value="Confirmar eliminación">
                        </div>
                    </form>
                    <?php
                       if (isset($_POST['delete1'])) {
                        $idpro = $_POST['matric'];

                        $conexion= new conexion();

                        $query=$conexion->prepare('SELECT * from productos WHERE id_pro = :id_proo');

                        $query->bindParam(':id_proo',$idpro);
                        $query->execute();

                        $count=$query->rowCount();

                        if ($count) { ?>
                            <script type="text/javascript">
                                Swal.fire({
                                  title: 'Está seguro de eliminarlo?',
                                  text: "Una vez eliminado ya no estará en el catalogo de productos, ni se podrá recuperar!",
                                  icon: 'warning',
                                  showCancelButton: true,
                                  confirmButtonColor: '#3085d6',
                                  cancelButtonColor: '#d33',
                                  confirmButtonText: 'Si, eliminar'
                                }).then((result) => {
                                  if (result.isConfirmed) {
                                    <?php 
                                    $query=$conexion->prepare('DELETE FROM productos WHERE id_pro = :id_proo');

                                    $query->bindParam(':id_proo',$idpro);
                                    $query->execute();
                                    $count4=$query->rowCount();
                                    if ($count4) {
                                    ?>
                                    Swal.fire(
                                      'Eliminado!',
                                      'El producto fue eliminado correctamente',
                                      'success'
                                    ).then(function(){
                                        window.location="homeadmin.php"
                                    });
                                  }
                                })
                            </script>
                            <?php
                                }
                            }
                        else
                        {
                        ?><script>
                          Swal.fire({
                              icon: 'warning',
                              title: 'Ocurrió un error al eliminar, vuelvalo a intentar',
                              showConfirmButton: true,
                              timer: 2500
                            }).then(function(){
                                window.location="homeadmin.php"
                            }); 
                            </script><?php
                        }
                            unset($query);
                            unset($form);
                        } 
                    ?>
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
    <script src="js/consulta.js"></script>
    <script type="text/javascript">
        function showcontent(ContainerId){
            document.getElementById("Container_1").style.display = "none";
            document.getElementById("Componentes").style.display = "none";
            document.getElementById("Almacenamiento").style.display = "none";
            document.getElementById("Monitores").style.display = "none";

            document.getElementById(ContainerId).style.display = "";
        }
        /* Método para traer datos del producto a eliminar*/
        function showModalContent(dataValue){
            $('#conte-modal2').load('view_modal.php?matri=' + dataValue, function() {
                $('#staticBackdrop2').modal("show");
            });   
        }
    </script>
</body>

</html>