<?php
	$ru0='./';
	$rut='../';
	$db='database';
	$cl1='usuarios';
	$cl2='tipo_usuarios';

	function index(){
		global $ru0, $db, $cl2;
		require_once($ru0.DIRMOR.$db.'.php');
		require_once($ru0.DIRMOR.$cl2.'.php');
		$_db = new $db();
		$_cl2 = new $cl2();

		$inf = $_cl2->cbo($_db->con_pg(),0);

		return $inf;
	}
	if (isset($_POST['registro'])) {
		session_start();
		$subirfoto=false;
		require_once($rut.'constant.php');

		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$id_tipo = base64_decode($_POST['id_tipo']);
		$nombre_u = $_POST['nombre_u'];
		$usuario_u = $_POST['usuario_u'];
		$correo_u = $_POST['correo_u'];
		$contra_u = $_POST['contra_u'];
		if (is_uploaded_file($_FILES["foto_u"]["tmp_name"])) {
            $nombfile=$_FILES["foto_u"]["name"];
            $taman=$_FILES["foto_u"]["size"];
            $type=$_FILES["foto_u"]["type"];
            $destino=DIRIMG;
            $foto_u=date('YmdHis').'-'.$nombfile;
			$subirfoto = true;
		}else{
			$foto_u = 'user.png';
		}

		$res = $_cl1->registro($_db->con_pg(),$_db->con_mysql(),$id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u,$foto_u);

		if ($res == 1) {
			$_SESSION['sms']='Tu cuenta ah sido creado con éxito.';
			if ($subirfoto) {
            	move_uploaded_file($_FILES["foto_u"]["tmp_name"], $destino.$foto_u);
			}
			header("Location: ".URL);
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".URL);
			exit();
		}
	}