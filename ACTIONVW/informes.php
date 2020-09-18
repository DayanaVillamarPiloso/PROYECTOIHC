<?php
	$ru='../';
	$db='database';
	$cl1='informes';
	$cl2='';
	$di1='informes/';
	$di2='informes/detalle/?p=';

	function index($rut,$rid){
		global $db, $cl1;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$inf = $_cl1->listarEnt($_db->con_pg(),$rid);
		$_SESSION['listarSal'] = $_cl1->listarSal($_db->con_pg(),$rid);

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