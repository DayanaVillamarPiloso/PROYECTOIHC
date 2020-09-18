<?php
	$ru='../';
	$db='database';
	$cl1='productos';
	$cl2='';
	$di1='productos/';
	$di2='productos/detalle/?p=';

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

		$nombre_p = $_POST['nombre_p'];
		$tipo_p = $_POST['tipo_p'];
		$fechav_p = $_POST['fechav_p'];
		$costo_p = ($_POST['costo_p'] > 0) ? number_format($_POST['costo_p'], 2, '.', '') : '0.00';
		$descripcion_p = $_POST['descripcion_p'];
		$marca_p = $_POST['marca_p'];
		$modelo_p = $_POST['modelo_p'];
		$peso = $_POST['peso'];
		$unimedida_p = $_POST['unimedida_p'];
		$cantidad_p = $_POST['cantidad_p'];

		if (is_uploaded_file($_FILES["foto1_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto1_p"]["name"];
            $taman=$_FILES["foto1_p"]["size"];
            $type=$_FILES["foto1_p"]["type"];
            $destino=DIRIMG;
            $foto1_p=date('YmdHis').'-'.$nombfile;
			$subirfoto = true;
		}else{
			$foto1_p = null;
		}

		$res = $_cl1->add($_db->con_pg(),$_db->con_mysql(),$nombre_p,$tipo_p,$fechav_p,$costo_p,$descripcion_p,$marca_p,$modelo_p,$peso,$unimedida_p,$cantidad_p,$foto1_p);

		if ($res == 1) {
			$_SESSION['sms']='El Producto ah sido creado con éxito.';
			if ($subirfoto) { move_uploaded_file($_FILES["foto1_p"]["tmp_name"], $destino.$foto1_p); }
			header("Location: ".HOME.$di1);
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".HOME.$di1);
			exit();
		}
	}
	if (isset($_POST['editar'])) {
		session_start();
		$subirfoto=false;
		$subirfoto2=false;
		$subirfoto3=false;
		$subirfoto4=false;
		$subirfoto5=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$pid = base64_decode($_POST['pid']);
		$nombre_p = $_POST['nombre_p'];
		$tipo_p = $_POST['tipo_p'];
		$fechav_p = $_POST['fechav_p'];
		$costo_p = ($_POST['costo_p'] > 0) ? number_format($_POST['costo_p'], 2, '.', '') : '0.00';
		$descripcion_p = $_POST['descripcion_p'];
		$marca_p = $_POST['marca_p'];
		$modelo_p = $_POST['modelo_p'];
		$peso = $_POST['peso'];
		$unimedida_p = $_POST['unimedida_p'];
		$cantidad_p = $_POST['cantidad_p'];
		if (is_uploaded_file($_FILES["foto1_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto1_p"]["name"];
            $taman=$_FILES["foto1_p"]["size"];
            $type=$_FILES["foto1_p"]["type"];
            $destino=DIRIMG;
            $foto1_p=date('YmdHis').'-'.$nombfile;
			$subirfoto = true;
		}else{
			$foto1_p = $_POST['act_foto1_p'];
		}
		if (is_uploaded_file($_FILES["foto2_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto2_p"]["name"];
            $taman=$_FILES["foto2_p"]["size"];
            $type=$_FILES["foto2_p"]["type"];
            $destino=DIRIMG;
            $foto2_p=date('YmdHis').'-'.$nombfile;
			$subirfoto2 = true;
		}else{
			$foto2_p = $_POST['act_foto2_p'];
		}
		if (is_uploaded_file($_FILES["foto3_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto3_p"]["name"];
            $taman=$_FILES["foto3_p"]["size"];
            $type=$_FILES["foto3_p"]["type"];
            $destino=DIRIMG;
            $foto3_p=date('YmdHis').'-'.$nombfile;
			$subirfoto3 = true;
		}else{
			$foto3_p = $_POST['act_foto3_p'];
		}
		if (is_uploaded_file($_FILES["foto4_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto4_p"]["name"];
            $taman=$_FILES["foto4_p"]["size"];
            $type=$_FILES["foto4_p"]["type"];
            $destino=DIRIMG;
            $foto4_p=date('YmdHis').'-'.$nombfile;
			$subirfoto4 = true;
		}else{
			$foto4_p = $_POST['act_foto4_p'];
		}
		if (is_uploaded_file($_FILES["foto5_p"]["tmp_name"])) {
            $nombfile=$_FILES["foto5_p"]["name"];
            $taman=$_FILES["foto5_p"]["size"];
            $type=$_FILES["foto5_p"]["type"];
            $destino=DIRIMG;
            $foto5_p=date('YmdHis').'-'.$nombfile;
			$subirfoto5 = true;
		}else{
			$foto5_p = $_POST['act_foto5_p'];
		}
		$updated_at = date('Y-m-d H:i:s');
		$id_updated = base64_decode($_POST['id_updated']);

		$res = $_cl1->edit($_db->con_pg(),$_db->con_mysql(),$pid,$nombre_p,$tipo_p,$fechav_p,$costo_p,$descripcion_p,$marca_p,$modelo_p,$peso,$unimedida_p,$cantidad_p,$foto1_p,$foto2_p,$foto3_p,$foto4_p,$foto5_p,$updated_at,$id_updated);

		if ($res == 1) {
			$_SESSION['sms']='Producto  ah sido editado con éxito.';
			if ($subirfoto) { move_uploaded_file($_FILES["foto1_p"]["tmp_name"], $destino.$foto1_p); }
			if ($subirfoto2) { move_uploaded_file($_FILES["foto2_p"]["tmp_name"], $destino.$foto2_p); }
			if ($subirfoto3) { move_uploaded_file($_FILES["foto3_p"]["tmp_name"], $destino.$foto3_p); }
			if ($subirfoto4) { move_uploaded_file($_FILES["foto4_p"]["tmp_name"], $destino.$foto4_p); }
			if ($subirfoto5) { move_uploaded_file($_FILES["foto5_p"]["tmp_name"], $destino.$foto5_p); }
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