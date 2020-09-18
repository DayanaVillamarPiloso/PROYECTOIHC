<?php
	session_start();
	$rut='../';
	$db='database';
	$cl1='usuarios';

	if (isset($_POST['entrar_pg'])) {
		require_once($rut.'constant.php');

		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$user = $_POST['user'];
		$pass = $_POST['pass'];

		$res = $_cl1->login_pg($_db->con_pg(),$user,$pass);

		if ($res == 1) {
			header("Location: ".HOME);
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".URL);
			exit();
		}
	}
	if (isset($_POST['entrar_my'])) {
		require_once($rut.'constant.php');

		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$user = $_POST['user'];
		$pass = $_POST['pass'];

		$res = $_cl1->login_my($_db->con_mysql(),$user,$pass);

		if ($res == 1) {
			header("Location: ".HOME);
			exit();
		}else{
			$_SESSION['sms'] = $res;
			header("Location: ".URL);
			exit();
		}
	}