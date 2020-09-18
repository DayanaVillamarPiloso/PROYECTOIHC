<?php
	$ru='../';
	$db='database';
	$cl1='stock';
	$cl2='productos';
	$di1='stock-producto/';
	$di2='stock-producto/detalle/?p=';

	function index($rut,$rid){
		global $db, $cl2;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl2.'.php');
		$_db = new $db();
		$_cl1 = new $cl2();

		$inf = $_cl1->cbo($_db->con_pg(),$rid);

		return $inf;
	}
	if (isset($_POST['entrada'])) {
		session_start();
		$subirfoto=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$id_prod = base64_decode($_POST['id_prod']);
		$cant_entrada = $_POST['cant_entrada'];
		$fecha_entrada = $_POST['fecha_entrada'];

		$res = $_cl1->addEntrada($_db->con_pg(),$_db->con_pg(),$_db->con_pg(),$_db->con_mysql(),$id_prod,$cant_entrada,$fecha_entrada);

		if ($res == 1) {
			$_SESSION['sms']='El Producto ah sido creado con éxito.'.$_SESSION['resp2'];
			if ($subirfoto) { move_uploaded_file($_FILES["foto1_p"]["tmp_name"], $destino.$foto1_p); }
			unset($_SESSION['resp2']);

			header("Location: ".HOME.$di1);
			exit();
		}else{
			$_SESSION['sms'] = $res.$_SESSION['resp2'];
			unset($_SESSION['resp2']);
			
			header("Location: ".HOME.$di1);
			exit();
		}
	}
	if (isset($_POST['salida'])) {
		session_start();
		$subirfoto=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$id_prod = base64_decode($_POST['id_prod']);
		$cant_salida = $_POST['cant_salida'];
		$fecha_salida = $_POST['fecha_salida'];

		$res = $_cl1->addSalida($_db->con_pg(),$_db->con_pg(),$_db->con_pg(),$_db->con_mysql(),$id_prod,$cant_salida,$fecha_salida);

		if ($res == 1) {
			$_SESSION['sms']='Registro guardado.'.$_SESSION['resp2'];
			unset($_SESSION['resp2']);
			if ($subirfoto) { move_uploaded_file($_FILES["foto1_p"]["tmp_name"], $destino.$foto1_p); }

			header("Location: ".HOME.$di1);
			exit();
		}else{
			$_SESSION['sms'] = $res.$_SESSION['resp2'];
			unset($_SESSION['resp2']);

			header("Location: ".HOME.$di1);
			exit();
		}
	}