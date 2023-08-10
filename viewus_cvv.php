<?php
    ob_start(); 
    session_start();
    require 'cnn.php';
?>
<?php 
        $conexion = new conexion();
        $usuario = $_SESSION['iduser'];

        $sql = $conexion->prepare("SELECT * FROM tbl_mediopago WHERE id_user = :iduser and num_tar = '" . $_GET["num_tar"] . "' ");

        $sql->bindParam(':iduser',$usuario);
        $sql->execute();
        while ($campo = $sql->fetch(PDO::FETCH_ASSOC)) {
?>     

    <center><img class="flex-shrink-0 img-fluid border rounded" src="img/tarjeta.png" alt="" style="width: 200px; height: 100px;"></center><br>
    <label style="color: black;"><b>Número de la tarjeta:</b></label>
    <input type="text" class="form-control" id="numtar_je" name="numtar_je" style="width:100%;" value="<?php echo $campo['num_tar']; ?>" readonly><br>

    <label  style="color: black;"><b>Ingrese el CVV:</b></label>
    <input type="text" id="cv_v" name="cv_v" class="form-control" pattern="(\d\s?){3,3}" title="Ingrese un número válido de 3 dígitos" placeholder="Ej. 444" required><br>

<?php
        }
?>