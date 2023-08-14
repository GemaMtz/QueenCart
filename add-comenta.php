<?php 
  ob_start(); 
  session_start();
  
?>
<?php 
    $usuario = $_SESSION['nombreuser'];

    $conexion= new conexion();

    $query=$conexion->prepare('SELECT * from users WHERE name_user = :usernamee');

    $query->bindParam(':usernamee',$usuario);

    $query->execute();

    $count=$query->rowCount();
    $campo = $query->fetch();
    if($count)
    {
        $descripcion = $_POST['des_cripcion'];
        $usuario = $_SESSION['nombreuser'];
        $imagen = $campo['imagen_us'];
        $conexion = new conexion();
        if(!empty($descripcion))
        {
            $sql=$conexion->prepare("INSERT INTO comentarios
                (usuario_com, mensaje_com, date_time, imagen_user) VALUES (:usuario_coom,:descripcionn, now(),  :imagen)");

            //Asignar el contenido de las variables a los parametros
            $sql->bindParam(':usuario_coom',$usuario);
            $sql->bindParam(':descripcionn',$descripcion);
            $sql->bindParam(':imagen',$imagen, PDO::PARAM_LOB);

            //Ejecutar la variable $sql
            $sql->execute();

        }
        echo $conexion->prepare($sql); 
    }
?>