<?php
	require_once($rut.'constant.php');

	if (isset($_SESSION['id_user'])) {
		$uid = $_SESSION['id_user'];
		$rid = $_SESSION['id_tipo'];
		$rna = $_SESSION['nombre_tipo'];
		$una = $_SESSION['nombre_u'];
		$uus = $_SESSION['usuario_u'];
		$uco = $_SESSION['correo_u'];
		$ufo = $_SESSION['foto_u'];
	}else{
		header("Location: ".URL);
		exit();
	}

	if (isset($_REQUEST['p'])) { $pid=base64_decode($_REQUEST['p']); }else{ $pid=0; }