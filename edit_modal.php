 <?php
        require 'cnn.php'; 
        $conexion = new conexion();

        $sql = "SELECT * FROM productos WHERE id_pro = '" . $_GET["matri"] . "'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        while ($campo = $stmt->fetch(PDO::FETCH_ASSOC)) {
?>

    <label><b>Id_producto: </b></label>
    <input type="text"  id="matric" name="matric"  class="form-control" style="width:100%;" value="<?php echo $campo['id_pro']; ?>" readonly><br>
    <label><b>Nombre del producto:</b></label>
    <input type="text" class="form-control" style="width:100%;" value="<?php echo $campo['name_pro']; ?>" readonly><br>

    <label><b>Agregar productos:</b></label>
    <input type="number" class="form-control" name="stock_new" id="stock_new" placeholder="Agregar productos al inventario" autofocus><br>

    <img class="flex-shrink-0 img-fluid border rounded" src="<?php echo 'data:image/png;base64,' . base64_encode($campo['imagen']) . ''; ?>" alt="" style="width: 80px; height: 80px;">
        
<?php
        }
?>