<?php
	$ru='../';
	$db='database';
	$cl1='proveedor';
	$cl2='';
	$di1='proveedores/';
	$di2='proveedores/detalle/?p=';

	function index($rut,$rid){
		global $db, $cl1;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$inf = $_cl1->listar($_db->con_pg(),$rid);

		return $inf;
	}
	function detalle($rut,$rid,$pid){
		global $db, $cl1;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$data = $_cl1->callID($_db->con_pg(),$pid);

		$inf = json_decode(substr($data, 1, -1));

		return $inf;
	}
	if (isset($_POST['nuevo'])) {
		session_start();
		$subirfoto=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$nombre_prove = $_POST['nombre_prove'];
		$ruta_prove = $_POST['ruta_prove'];
		$tel_prove = $_POST['tel_prove'];
		
		$res = $_cl1->add($_db->con_pg(),$_db->con_mysql(),$nombre_prove,$ruta_prove,$tel_prove);

		if ($res == 1) {
			$_SESSION['sms']='El Proveedor creado con exito.';
		}else{
			$_SESSION['sms'] = $res;
		}
		
		header("Location: ".HOME.$di1);
		exit();
	}
	if (isset($_POST['editar'])) {
		session_start();
		
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$pid = base64_decode($_POST['pid']);
		$nombre_prove = $_POST['nombre_prove'];
		$ruta_prove = $_POST['ruta_prove'];
		$tel_prove = $_POST['tel_prove'];
		
		$updated_at = date('Y-m-d H:i:s');
		$id_updated = base64_decode($_POST['id_updated']);

		$res = $_cl1->edit($_db->con_pg(),$_db->con_mysql(),$pid,$nombre_prove,$ruta_prove,$tel_prove,$updated_at,$id_updated);

		if ($res == 1) {
			$_SESSION['sms']='Proveedor  ah sido editado con éxito.';
		
			header("Location: ".HOME.$di2.base64_encode($pid));
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".HOME.$di2.base64_encode($pid));
			exit();

		}
	}
	if (isset($_POST['drop'])) {
		session_start();
		$subirfoto=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$pid = base64_decode($_POST['id']);
		$drop_at = date('Y-m-d H:i:s');
		$id_drop = base64_decode($_POST['id_drop']);

		$res = $_cl1->drop($_db->con_pg(),$_db->con_mysql(),$pid,$drop_at,$id_drop);

		if ($res == 1) {
			$_SESSION['sms']='Registro Eliminado con éxito.';
			if ($subirfoto) {
            	move_uploaded_file($_FILES["foto_u"]["tmp_name"], $destino.$foto_u);
			}
			header("Location: ".HOME.$di1);
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".HOME.$di1);
			exit();
		}
	}