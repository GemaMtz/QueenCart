<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<?php
      require 'links.html';
  ?>

	<meta charset="utf-8">
	<style type="text/css">
		*
		{
			text-align: center;
		}
	</style>
</head>
<body>
    <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: 'Vuelva pronto',
      text: 'Se cerró sesión correctamente',
      showConfirmButton: true,
      timer: 2500
    }).then(function(){
        window.location="index.php"
    }); </script>
    <?php

	?>

</body>
</html>