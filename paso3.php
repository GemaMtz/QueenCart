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
    <?php 
        $usuario = $_SESSION['iduser'];
        $prueba = $_GET['pruebas']; 
        $envío = 109.90; 
        $total = $prueba + $envío; ?>
    <?php
        require 'links.html';
    ?>
    <style type="text/css">
        .cvv {
            color: black;
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
            <a href="home.html" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
                <h1 class="m-0 text-primary">QUEEN CART</h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="home.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-house-door"></i></a> 
                    <a href="historial.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-receipt"></i></a>
                    <a href="micarrito.php" class="nav-item nav-link" style="font-size: 1.5rem;"><i class="bi bi-cart-check"></i></a>
                    <a href="contact.php" class="nav-item nav-link mt-1">Mi cuenta</a>
                </div>
                <a href="logout.php" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Cerrar sesión<i class="fa fa-arrow-right ms-3"></i></a>
            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Formulario para datos personales -->
        <div class="container-xxl py-5" id="comentarios">
            <div class="container ">
				<div class="progress">
				  <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
				</div>
				<div class="row">
					<div class="col-4"><i class="bi bi-cart-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
					<div class="col-4 text-center"><i class="bi bi-patch-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
					<div class="col-4" style="text-align: right;"><i class="bi bi-bag-check-fill col-md-4" style="font-size: 1.5rem;"></i></div>
				</div><br>
                <h5 class="text-center">¡Ya casi es tuya!</h5>
				<h5 class="text-center">Seleccione la forma de pago</h5>
                <div class="accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        En efectivo &nbsp;<i class="bi bi-cash-stack" style="font-size: 1.5rem;"></i>
                      </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body" style="background-color: white;">
                            <form method="post" action="">
                                <div class="mb-3 text-center">
                                    <h5>Lista de tiendas en la que puedes realizar tu pago</h5>
                                    <center><img src="img/lista.png" width="100%"></center>
                                </div>
                                <div class="mb-3 row">
                                    <?php  $alea = rand(1,10); $codigo_p = ($usuario * 12345678913) + $alea;  ?>
                                    <div class="col-md-4"><label  style="color: black;">Total del carrito</label>
                                    <input type="text" class="form-control" value="$ <?php echo $prueba; ?>" disabled></div>
                                    <div class="col-md-4"><label  style="color: black;">Costo del envío</label>
                                    <input type="text" class="form-control" value="$ <?php echo $envío; ?>" disabled></div>
                                    <div class="col-md-4"><label  style="color: black;">Total de la compra: </label>
                                    <input type="text" class="form-control" value="$ <?php echo $total; ?>" disabled></div>
                                </div>
                                <div class="mb-3 p-2 text-center" style="background-color: yellow; color: black;">
                                    <label><b>Recuerde que tiene 24 hrs para completar el pago, ya que después se proseguirá a eliminar su artículos del carrito</b></label>
                                </div>
                                <div class="mb-3 col-4 text-center" style="margin-left: 30%">
                                    <label style="color: black;">Al finalizar se le mostrará el código en el apartado de historial para finalizar el pago</label>
                                    <input type="text" name="codigo" id="codigo" class="form-control text-center" style="display: none;" value="<?php echo $codigo_p; ?>">
                                </div>
                                <div class="mb-3 text-center">
                                    <input type="submit" class="btn btn-outline-dark" name="efectivo" id="efectivo" value="Finalizar compra">&nbsp;
                                    <a href="micarrito.php" class="btn btn-outline-danger">Cancelar</a>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Con tarjeta &nbsp;<i class="bi bi-credit-card" style="font-size: 1.5rem;"></i>
                      </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse text-center" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                      <div class="accordion-body" style="background-color: white;">
                        <p>
                          <a href="#tarjetas" class="btn btn-outline-dark" onclick="showcontent('tarjetas')">
                            Tarjetas guardadas
                          </a>
                          <a href="#aggtarjeta" class="btn btn-outline-dark" onclick="showcontent('aggtarjeta')">
                            Agregar tarjeta
                          </a>
                        </p>
                        <div class="container" id="tarjetas" style="display: none;">
                            <?php
                                $conexion = new conexion();
                                $query=$conexion->prepare('SELECT * from tbl_mediopago WHERE id_user = :idusuario and num_tar != "null" ');
                                $query->bindParam(':idusuario',$usuario);

                                $query->execute();
                                $count = $query->rowCount();
                                if ($count) {
                                while ($campo = $query->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <form action="" method="post">
                                <div class="job-item p-4 mb-4">
                                    <div class="row g-4">
                                        <div class="col-sm-12 col-md-5 d-flex align-items-center">
                                            <img class="flex-shrink-0 img-fluid border rounded" src="img/tarjeta.png" alt="" style="width: 90px; height: 60px;">

                                            <div class="text-start ps-2">
                                                <p>Número de tarjeta</p>
                                                <h6 class="mb-3"><?php echo $campo['num_tar'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-3 d-flex align-items-center">
                                            <div class="text-start ps-2">
                                                <p>Caducidad</p>
                                                <h6 class="mb-3"><?php echo $campo['caducidad'] ?></h6>
                                            </div>
                                        </div>
                                        <div class="col-sm-12 col-md-4 d-flex align-items-center">
                                            <div class="d-flex mb-3" style="text-align: right;">
                                                <button type="button" class="btn btn-outline-success" onclick="showModalContent('<?php echo $campo['num_tar']; ?>')">Utilizar tarjeta</button>&nbsp;
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form><?php }}
                            else{
                                echo '<center><h6>Por el momento no tienes ninguna agregada</h6><img src="img/caritaenojo.jpeg" width="20%" style="border-radius: 30px;"></center>';
                            }?>
                        </div>
                        <div class="container" id="aggtarjeta" style="display: none;">
                          <div class="card card-body">
                            <h5 class="text-center">Bancos aceptados</h5>
                            <center><img src="img/bancos.png" style="width: 50%;"></center>
                            <form action="" method="post">
                                <div class="container row">
                                    <div class="mb-3 row">
                                        <?php  $alea = rand(1,10); $codigo_p = ($usuario * 12345678913) + $alea;  ?>
                                        <div class="col-md-4"><label  style="color: black;">Total del carrito</label>
                                        <input type="text" class="form-control" value="$ <?php echo $prueba; ?>" disabled></div>
                                        <div class="col-md-4"><label  style="color: black;">Costo del envío</label>
                                        <input type="text" class="form-control" value="$ <?php echo $envío; ?>" disabled></div>
                                        <div class="col-md-4"><label  style="color: black;">Total de la compra: </label>
                                        <input type="text" class="form-control" value="$ <?php echo $total; ?>" disabled></div>
                                    </div>
                                    <div class="mb-3 col-4">
                                      <label style="color: black;">Número de tarjeta</label>
                                      <input type="text" id="tarjetaa" name="tarjetaa" class="form-control" pattern="(\d\s?){16,16}" title="Ingrese un número válido de 16 dígitos" placeholder="Ej. 4444444444444444" maxlength="16" required autofocus />
                                    </div>
                                    <div class="mb-3 col-4 row">
                                      <label style="color: black;">Caducidad</label>
                                      <div class="col-md-1"><i class="bi bi-calendar-date" style="font-size: 1.5rem;"></i></div>&nbsp;
                                      <div class="col-md-4"><select class="form-select" id="floatingSelect" name="floatingSelect" aria-label="Floating label select example" required>
                                          <option selected disabled>mm</option>
                                          <option value="01">01</option>
                                          <option value="02">02</option>
                                          <option value="03">03</option>
                                          <option value="04">04</option>
                                          <option value="05">05</option>
                                          <option value="06">06</option>
                                          <option value="07">07</option>
                                          <option value="08">08</option>
                                          <option value="09">09</option>
                                          <option value="10">10</option>
                                          <option value="11">11</option>
                                          <option value="12">12</option>
                                      </select></div>
                                      <div class="col-md-1"><p style="font-size: 1.5rem;">/</p></div>
                                      <div class="col-md-4"><select class="form-select" id="floatingSelect2" name="floatingSelect2" aria-label="Floating label select example" required>
                                          <option selected disabled>aa</option>
                                          <option value="22">22</option>
                                          <option value="23">23</option>
                                          <option value="24">24</option>
                                          <option value="25">25</option>
                                          <option value="26">26</option>
                                          <option value="27">27</option>
                                          <option value="28">28</option>
                                          <option value="29">29</option>
                                          <option value="30">30</option>
                                          <option value="31">31</option>
                                      </select></div>
                                    </div>
                                    <div class="mb-3 col-4 row">
                                      <label style="color: black;">CVV</label>
                                      <div class="col-md-1"><i class="bi bi-lock-fill" style="font-size: 1.3rem;"></i></div>
                                      <div class="col-md-6"><input type="text" id="cvv_v" name="cvv_v" class="form-control" pattern="(\d\s?){3,3}" title="Ingrese un número válido de 3 dígitos" placeholder="Ej. 444" required /></div>
                                    </div>
                                    <div class="mb-3 text-center">
                                        <input type="submit" class="btn btn-outline-dark" name="con_tarjeta" id="con_efectivo" value="Finalizar compra">&nbsp;
                                        <a href="micarrito.php" class="btn btn-outline-danger">Cancelar</a>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>
        </div><br>

        <!-- Modal para verificar cvv -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title" id="staticBackdropLabel">Atención!!</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
              <form action="" method="post">
                <div class="modal-body">
                  <!-- Formulario de login -->
                  <div style="background-image: url(''); background-repeat:no-repeat;">
                    <div class="container">
                        <div id="conte-modal2"></div>                        
                    </div>
                  </div>
                </div>
                <div class="modal-footer text-start" style=" margin-right: 10px; margin-left: 0px;">
                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-outline-warning cvv" id="veri_cvv" name="veri_cvv">Continuar</button>
              </form> 
                </div>
              </div>
            </div>
        </div>

        <!-- PHP para pagar -->
        <?php 
            if (isset($_POST['efectivo'])) {

                $conexion= new conexion();

                $query = "INSERT INTO tbl_mediopago ( num_tar, cvv, caducidad, saldo, id_user, codigo_efec, deuda, estado, date_time) VALUES ('null', null, 'null', null, '$usuario', '$codigo_p', '$total', 'en proceso', now())";

                $query = $conexion->prepare($query);
                $query->execute();
                $count = $query->rowCount();

                if ($count) {
                    $query = "UPDATE tbl_carrito SET estado = 'en proceso', entrega = 'sin entregar', codigo = $codigo_p WHERE id_user = :usernamee and estado = 'pendiente'";

                    $query = $conexion->prepare($query);
                    $query->bindParam(':usernamee',$usuario);
                    $query->execute();
                    $count2 = $query->rowCount();
                    if ($count2) {
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'success',
                          title: 'Se realizó exitosamente ',
                          showConfirmButton: true,
                          timer: 2500
                        }).then(function(){
                            window.location="historial.php"
                        }); </script><?php
                    }else{
                        ?><script type="text/javascript">
                        Swal.fire({
                          icon: 'warning',
                          title: 'Ocurrió un error, favor de interntarlo nuevamente ',
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
                      icon: 'warning',
                      title: 'Ocurrió un error, favor de interntarlo nuevamente ',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="micarrito.php"
                    }); </script><?php
                }
            }
            if (isset($_POST['con_tarjeta'])) {
                $num_tarjeta = $_POST['tarjetaa'];
                $mm = $_POST['floatingSelect'];
                $string = '/';
                $aa = $_POST['floatingSelect2'];
                $caducida_d = $mm . $string . $aa;
                $cvv = $_POST['cvv_v'];

                $conexion= new conexion();

                $query=$conexion->prepare('SELECT * from tbl_mediopago WHERE id_user = :usernamee and num_tar = :nose');

                $query->bindParam(':usernamee',$usuario);
                $query->bindParam(':nose',$num_tarjeta);

                $query->execute();

                $count2=$query->rowCount();
                /* $campo = $query->fetch();*/

                if ($count2) {
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'warning',
                      title: 'Está tarjeta ya la tiene agregada, favor de verificarlo',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>
                    }); </script><?php
                    unset($query);
                }
                else {
                    $saldo = 2000;
                    $resta = $saldo - $total;
                    if ($resta > 0) {
                        $query = "INSERT INTO tbl_mediopago (num_tar, cvv, caducidad, saldo, id_user, codigo_efec, deuda, estado, date_time) VALUES (:nose, :c_vv, '$caducida_d', :restante, :usernamee, 'null', :deudaa, 'pagado', now())";

                        $query = $conexion->prepare($query);
                        $query->bindParam(':usernamee',$usuario);
                        $query->bindParam(':nose',$num_tarjeta);
                        $query->bindParam(':c_vv',$cvv);
                        $query->bindParam(':restante',$resta);
                        $query->bindParam(':deudaa',$total);
                        $query->execute();
                        $count2 = $query->rowCount();
                        if ($count2) {
                            $query = "
                            UPDATE productos SET stock = (SELECT new_stock FROM (SELECT id_pro `id_producto`, new_stock FROM (SELECT id_pro, name_pro, stock - (SELECT num_pro FROM tbl_carrito c where c.id_user = :usernamee and c.id_producto = id_pro and c.estado = 'pendiente') `new_stock` FROM productos) AS P WHERE new_stock IS NOT NULL) as N WHERE N.id_producto = id_pro)
                            WHERE id_pro IN (SELECT d.id_producto from tbl_carrito d where d.id_user = :usernamee and d.estado = 'pendiente');
                            UPDATE tbl_carrito SET estado = 'pagado', date_time = now(), entrega = 'sin entregar', total = :deudaa WHERE id_user = :usernamee and estado = 'pendiente' ";

                            $query = $conexion->prepare($query);
                            $query->bindParam(':deudaa',$total);
                            $query->bindParam(':usernamee',$usuario);
                            $query->execute();
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
                                  title: 'Operación exitosa',
                                  showConfirmButton: true,
                                  timer: 2500
                                }).then(function(){
                                    window.location="historial.php";
                                });
                            }); </script><?php
                            unset($query);
                        }else{
                            ?><script type="text/javascript">
                            Swal.fire({
                              icon: 'warning',
                              title: 'Ocurrió un error, favor de interntarlo nuevamente',
                              showConfirmButton: true,
                              timer: 2500
                            }).then(function(){
                                window.location="micarrito.php"
                            }); </script><?php
                            unset($query);
                        }
                    }
                    else{
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
                              icon: 'warning',
                              title: 'Saldo insuficiente',
                              text: 'Intentelo con otra tarjeta',
                              showConfirmButton: true,
                              timer: 5000
                            }).then(function(){
                                window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
                            });
                        }); </script><?php
                        unset($query);
                    }
                }
            }
            if (isset($_POST['veri_cvv'])) {
                $numer_tar = $_POST['numtar_je'];
                $c_vv = $_POST['cv_v'];

                $conexion = new conexion();

                $sql = $conexion->prepare("SELECT * FROM tbl_mediopago WHERE num_tar = :numtar and cvv = :cv_v and id_user = :iduser ");

                $sql->bindParam(':iduser',$usuario);
                $sql->bindParam(':numtar',$numer_tar);
                $sql->bindParam(':cv_v',$c_vv);
                $sql->execute();

                $count4 = $sql->rowCount();
                $campo = $sql->fetch();

                if ($count4) {
                    $sald_o = $campo['saldo'];
                    $resta2 = $sald_o - $total;
                    if ($resta2 >= 0) {
                        $query = "
                        UPDATE productos SET stock = (SELECT new_stock FROM (SELECT id_pro `id_producto`, new_stock FROM (SELECT id_pro, name_pro, stock - (SELECT num_pro FROM tbl_carrito c where c.id_user = :usernamee and c.id_producto = id_pro and c.estado = 'pendiente') `new_stock` FROM productos) AS P WHERE new_stock IS NOT NULL) as N WHERE N.id_producto = id_pro)
                        WHERE id_pro IN (SELECT d.id_producto from tbl_carrito d where d.id_user = :usernamee and d.estado = 'pendiente');
                        UPDATE tbl_carrito SET estado = 'pagado', date_time = now(), entrega = 'sin entregar', total = :deudaa WHERE id_user = :usernamee and estado = 'pendiente';
                        UPDATE tbl_mediopago SET saldo = :restante, date_time = now(), deuda = :deudaa WHERE id_user = :usernamee and num_tar = '$numer_tar' ";

                        $query = $conexion->prepare($query);
                        $query->bindParam(':deudaa',$total);
                        $query->bindParam(':usernamee',$usuario);
                        $query->bindParam(':restante',$resta2);
                        $query->execute();
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
                              title: 'Operación exitosa',
                              showConfirmButton: true,
                              timer: 2500
                            }).then(function(){
                                window.location="historial.php";
                            });
                        }); </script><?php
                        unset($query);
                    }
                    else{
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
                              icon: 'warning',
                              title: 'Saldo insuficiente',
                              text: 'Intentelo con otra tarjeta',
                              showConfirmButton: true,
                              timer: 5000
                            }).then(function(){
                                window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
                            });
                        }); </script><?php
                        unset($query);
                    }
                }else{
                    ?><script type="text/javascript">
                    Swal.fire({
                      icon: 'warning',
                      title: 'CVV incorrecto',
                      text: 'Favor de intentarlo nuevamente',
                      showConfirmButton: true,
                      timer: 2500
                    }).then(function(){
                        window.location="paso3.php?pruebas=" + <?php echo $prueba; ?>;
                    }); </script><?php
                    unset($query);
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
        function showcontent(ContainerId){
            document.getElementById("tarjetas").style.display = "none";
            document.getElementById("aggtarjeta").style.display = "none";

            document.getElementById(ContainerId).style.display = "";
        }
        /* Método para verificar cvv para seguridad de la tarjeta*/
        function showModalContent(dataValue){
            $('#conte-modal2').load('viewus_cvv.php?num_tar=' + dataValue, function() {
                $('#staticBackdrop').modal("show");
            });   
        } 
    </script>
</body>

</html>