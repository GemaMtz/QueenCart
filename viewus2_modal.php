<?php
    ob_start(); 
    session_start();
    require 'cnn.php';
?>
<?php 
        $conexion = new conexion();

        $sql = $conexion->prepare("SELECT * from users WHERE id_user = '" . $_GET["iduser"] . "' ");

        $sql->execute();
        while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
?>     

    <label><b>Nombre del usuario:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['name_user']; ?>" readonly><br>

    <label><b>Telefono de contacto:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['tel_fono']; ?>" readonly><br>

    <label><b>Dirección:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['cam_colonia'].", ".$campo['cam_calleyexterior'].", ".$campo['cam_estado'].", ".$campo['cam_estado']; ?>" readonly><br>

    <label><b>Descripción de la fachada:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['cam_descripcion']; ?>" readonly><br>

<?php
        }
?>