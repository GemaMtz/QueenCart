<?php
    ob_start(); 
    session_start();
    require 'cnn.php';
?>
<?php 
        $conexion = new conexion();
        $usuario = $_SESSION['iduser'];

        $sql = $conexion->prepare("SELECT * FROM tbl_carrito, productos WHERE tbl_carrito.id_user = :iduser and tbl_carrito.estado = 'pendiente' and tbl_carrito.id_producto = '" . $_GET["idpro"] . "' and productos.id_pro = '" . $_GET["idpro"] . "'");

        $sql->bindParam(':iduser',$usuario);
        $sql->execute();
        while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
?>     

    <center><img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 100px; height: 100px;"></center><br>
    <label><b>Nombre del producto:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['name_pro']; ?>" readonly><br>

    <label>Cambiar el N° de productos en tu carrito</label>
    <input type="number" class="form-control" style="width:100%;" id="numero" name="numero" value="<?php echo $campo['num_pro']; ?>"><br>

    <input type="text" id="id_pro" name="id_pro" value="<?php echo $_GET['idpro']; ?>" style="display: none;">
    <input type="text" id="precio" name="precio" value="<?php echo $campo['precio']; ?>" style="display: none;">

<?php
        }
?>