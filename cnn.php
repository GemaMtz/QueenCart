<!DOCTYPE html>
<html>
<head>
	<title>QUEEN CART</title>
</head>
<body>
	<?php 
		class Conexion extends PDO
			{
				private $tipo_de_base='mysql';
				private $host='localhost';
				private $nombre_de_base='id18473012_5cuatri';
                private $usuario='id18473012_aplicaciones';
                private $contrasena='5Cuatriaplicaciones*';

				public function __construct()
				{
					try
					{
						parent::__construct($this->tipo_de_base.':host='.$this->host.';dbname='.$this->nombre_de_base, $this->usuario,$this->contrasena);
					}
					catch(PDOException $e)
					{
						echo 'Ha surgido un error y no se puede conecta a la B.D. Detalle: '.$e->getMessage();
					}
				}
			} 
	?>

</body>
</html>