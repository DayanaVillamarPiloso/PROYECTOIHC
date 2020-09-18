<?php
	$ru='../';
	$db='database';
	$cl1='catalogo';
	$cl2='';
	$di1='catalogo/';
	$di2='catalogo/detalle/?p=';

	function index($rut){
		global $db, $cl1;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$inf = $_cl1->listar($_db->con_pg(),$_db->con_pg());

		return $inf;
	}
	function detalle($rut,$pid){
		global $db, $cl1;
		require_once($rut.DIRMOR.$db.'.php');
		require_once($rut.DIRMOR.$cl1.'.php');
		$_db = new $db();
		$_cl1 = new $cl1();

		$data = $_cl1->callID($_db->con_pg(),$pid);

		$inf = json_decode(substr($data, 1, -1));

		return $inf;
	}