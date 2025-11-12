<?php
		
		$destino="informatica@impsr.gob.ar";
		$nombre= $_POST["nombre"];
		$correo= $_POST["email"];
		$mensaje= $_POST["mensaje"];
		$contenido = "Nombre: " . $nombre ."\nCorreo: " . $correo . "\nMensaje: " . $mensaje;
		mail($destino,"Contacto", $contenido);
		header("location: gracias.php");

?>