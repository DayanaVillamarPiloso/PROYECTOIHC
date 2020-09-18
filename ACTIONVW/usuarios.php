<?php
	$ru='../';
	$db='database';
	$cl1='usuarios';
	$cl2='tipo_usuarios';
	$di1='usuarios/';
	$di2='usuarios/detalle/?p=';

	function index($rut,$rid){
		global $db, $cl1, $cl2;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		require_once($rut.DIRMOR.$cl2.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();
		$_cl2 = new $cl2();

		$inf = $_cl1->listar($_db->con_pg(),$rid);
		$_SESSION['cboTU'] = $_cl2->cbo($_db->con_pg(),$rid);

		return $inf;
	}
	function detalle($rut,$rid,$pid){
		global $db, $cl1, $cl2;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		require_once($rut.DIRMOR.$cl2.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();
		$_cl2 = new $cl2();

		$data = $_cl1->callID($_db->con_pg(),$pid);
		$_SESSION['cboTU'] = $_cl2->cbo($_db->con_pg(),$rid);

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

		$res = $_cl1->add($_db->con_pg(),$_db->con_mysql(),$id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u,$foto_u);

		if ($res == 1) {
			$_SESSION['sms']='Tu cuenta ah sido creado con éxito.';
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
	if (isset($_POST['editar'])) {
		session_start();
		$subirfoto=false;
		require_once($ru.'constant.php');

		require_once($ru.DIRMOR.$db.'.php');
		require_once($ru.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$pid = base64_decode($_POST['pid']);
		$id_tipo = base64_decode($_POST['id_tipo']);
		$nombre_u = $_POST['nombre_u'];
		$usuario_u = $_POST['usuario_u'];
		$correo_u = $_POST['correo_u'];
		$contra_u = $_POST['contra_u'];
		$act_contra_u = base64_decode($_POST['act_contra_u']);
		if (is_uploaded_file($_FILES["foto_u"]["tmp_name"])) {
            $nombfile=$_FILES["foto_u"]["name"];
            $taman=$_FILES["foto_u"]["size"];
            $type=$_FILES["foto_u"]["type"];
            $destino=DIRIMG;
            $foto_u=date('YmdHis').'-'.$nombfile;
			$subirfoto = true;
		}else{
			$foto_u = $_POST['act_foto_u'];
		}
		$updated_at = date('Y-m-d H:i:s');
		$id_updated = base64_decode($_POST['id_updated']);

		$res = $_cl1->edit($_db->con_pg(),$_db->con_mysql(),$pid,$id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u,$act_contra_u,$foto_u,$updated_at,$id_updated);

		if ($res == 1) {
			$_SESSION['sms']='Tu cuenta ah sido editada con éxito.';
			if ($subirfoto) {
            	move_uploaded_file($_FILES["foto_u"]["tmp_name"], $destino.$foto_u);
			}
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