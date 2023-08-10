<?php
    ob_start(); 
    session_start();
    require 'cnn.php';
?>
<?php 
        $conexion = new conexion();
        $usuario = $_SESSION['iduser'];
        $idprodu = $_GET["idpro"];

        $query=$conexion->prepare('DELETE FROM tbl_carrito WHERE id_user = :usernamee and id_producto = :idpro and estado = "pendiente"');

        $query->bindParam(':idpro',$idprodu);
        $query->bindParam(':usernamee',$usuario);
        $query->execute();
        $count4=$query->rowCount();
        if ($count4){}
?>