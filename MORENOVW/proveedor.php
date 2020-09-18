<?php
	/**
	 * 
	 */
	class proveedor
	{
		private $table='proveedor';
		private $table2='';
		private $actio1='detalle/?p=';
		
		function listar($c1,$rid){
			$inf = null;$cant=12;
			$inf.='<thead>';
				$inf.='<tr>';
					$inf.='<th><i class="fas fa-user-cog"></i></th>';
					$inf.='<th>Id</th>';
					/*$inf.='<th>Foto</th>';*/
					$inf.='<th>Nombre</th>';
					$inf.='<th>Ruta</th>';
					$inf.='<th>Telefono</th>';
					$inf.='<th>Estado</th>';
				$inf.='</tr>';
			$inf.='</thead>';
			$inf.='<tbody>';
				if ($rid==1 || $rid==2) {
					$sql="SELECT id_prov, nombre_prove, ruta_prove, tel_prove, status FROM ".$this->table." WHERE status <> 2 ORDER BY id_prov ASC;";
				}else{
					$sql="SELECT id_prov, nombre_prove, ruta_prove, tel_prove, status FROM ".$this->table." WHERE status = 1 ORDER BY id_prov ASC;";
				}
				$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
				if ($res) {
					if (pg_num_rows($res) > 0) {
						while ($row = pg_fetch_array($res)) {
							$datos2 = base64_encode($row['id_prov']).'||';
							$inf.='<tr>';
								$inf.='<td>';
									$inf.='<a href="'.$this->actio1.base64_encode($row['id_prov']).'" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>';
									$inf .= "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar' onclick='eliminar(".'"'.$datos2.'"'.");' >";
										$inf .= "<i class='fas fa-trash' ></i>";
									$inf .= "</button>";
								$inf.='</td>';
								$inf.='<td>'.$row['id_prov'].'</td>';
								/*$inf.='<td><img src="'.IMG.$row['foto1_p'].'" style="max-width: 100px;" ></td>';*/
								$inf.='<td>'.$row['nombre_prove'].'</td>';
								$inf.='<td>'.$row['ruta_prove'].'</td>';
								$inf.='<td>'.$row['tel_prove'].'</td>';
								/*$inf.='<td>'.$row[''].'</td>';
								$inf.='<td>'.$row[''].'</td>';*/
								$inf.='<td>';
									switch ($row['status']) {
										case 1:
											$inf.='<a href="" class="btn btn-outline-success">Activo</a>';
										break;
										case 2:
											$inf.='<a href="" class="btn btn-outline-danger">Eliminado</a>';
										break;
										default:
											$inf.='<a href="" class="btn btn-outline-warning">Inactivo</a>';
										break;
									}
								$inf.='</td>';
							$inf.='</tr>';
						}
						pg_free_result($res);
					}else{
						$inf.= '<tr><td colspan="'.$cant.'" class="alert alert-warning text-center">No se encontraron registros</td></tr>';
					}
				}else{
					$inf.= '<tr><td colspan="'.$cant.'" class="alert alert-danger text-center">No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'].'</td></tr>';
				}
			$inf.='</tbody>';
			pg_close($c1);
			return $inf;
		}
		function callID($c1,$pid){
			$inf = null;
			$sql="SELECT nombre_prove, ruta_prove, tel_prove, created_at, status FROM ".$this->table." WHERE id_prov=".$pid.";";
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			$inf.='[';
				if ($res) {
					if (pg_num_rows($res) > 0) {
                        $inf .= '{';
							while ($row = pg_fetch_array($res)) {
								$inf .= '"nombre_prove": "'.$row['nombre_prove'].'",';
								$inf .= '"ruta_prove": "'.$row['ruta_prove'].'",';
								$inf .= '"tel_prove": "'.$row['tel_prove'].'",';
								$inf .= '"created_at": "'.$row['created_at'].'",';
								$inf .= '"status": '.$row['status'].'';
							}
							$row=null;
                        $inf .= '},';
                        pg_free_result($res);
                    }else{
                        $inf .= '{"mensg": "No hay ningún resultado"},';
                    }
                }else{
                    $inf .= '{"mensg": "No se ejecutó la consulta"},';
                }
            $inf= substr($inf,0,-1).']';
			pg_close($c1);
			return $inf;
		}
		function add($cc_pg,$cc_my,$nombre_prove,$ruta_prove,$tel_prove){
			function validarAdd($nombre_prove,$ruta_prove,$tel_prove){
		        $er=1;
		        if (is_null($nombre_prove)) { $er=0; }
		        if (is_null($ruta_prove)) { $er=0; }
		        if (is_null($tel_prove)) { $er=0; }
		        return($er);
		    }
	        if (validarAdd($nombre_prove,$ruta_prove,$tel_prove) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	            $rpta = password_hash($tel_prove, PASSWORD_BCRYPT);
	            $sql = "INSERT INTO ".$this->table." (nombre_prove, ruta_prove, tel_prove) VALUES ('".$nombre_prove."', '" .$ruta_prove."', '".$tel_prove."');";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            $res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res1) {
	                $inf = 1;
	            }else{
	                $inf = "No se Agregó el Registro";
	            }
	        }else{
	            $inf = "No se ejecutó la consulta. Error: ".$_SESSION['Mysqli_Error'];
	        }
	        pg_close($cc_pg);
	        mysqli_close($cc_my);
	        return $inf;
		}
		function edit($cc_pg,$cc_my,$pid,$nombre_prove,$ruta_prove,$tel_prove,$updated_at,$id_updated){
			function validarEdit($pid,$nombre_prove,$ruta_prove,$tel_prove){
		        $er=1;
		        if (is_null($pid)) { $er=0; }
		        if ($pid <= 0) { $er=0; }
		        if (is_null($nombre_prove)) { $er=0; }
		        if (is_null($ruta_prove)) { $er=0; }
		        if (is_null($tel_prove)) { $er=0; }
		        return($er);
		    }
	        if (validarEdit($pid,$nombre_prove,$ruta_prove,$tel_prove) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	        	if (strlen($tel_prove) >= 6) {
	            	$rpta = password_hash($tel_prove, PASSWORD_BCRYPT);
	        	}else{
	        		$rpta = $act_tel_prove;
	        	}
	            $sql = "UPDATE ".$this->table." SET nombre_prove='".$nombre_prove."', ruta_prove='".$ruta_prove."', tel_prove='".$tel_prove."',  updated_at='".$updated_at."', id_updated=".$id_updated." WHERE id_prov=".$pid." ;";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            $res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res1) {
	                $inf = 1;
	            }else{
	                $inf = "No se Editó el Registro. ".$_SESSION['Mysqli_Error'];
	            }
	        }else{
	            $inf = "No se ejecutó la consulta. Error: ".$_SESSION['Mysqli_Error'];
	        }
	        pg_close($cc_pg);
	        mysqli_close($cc_my);
	        return $inf;
		}
		function drop($cc_pg,$cc_my,$pid,$drop_at,$id_drop){
			function validarEdit($pid,$drop_at,$id_drop){
		        $er=1;
		        if (is_null($pid)) { $er=0; }
		        if ($pid <= 0) { $er=0; }
		        if (is_null($drop_at)) { $er=0; }
		        if (is_null($id_drop)) { $er=0; }
		        return($er);
		    }
	        if (validarEdit($pid,$drop_at,$id_drop) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	            $sql = "UPDATE ".$this->table." SET drop_at='".$drop_at."', id_drop=".$id_drop.", status=2 WHERE id_prov=".$pid." ;";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            $res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res1) {
	                $inf = 1;
	            }else{
	                $inf = "No se Eliminó el Registro. ".$_SESSION['Mysqli_Error'];
	            }
	        }else{
	            $inf = "No se ejecutó la consulta. Error: ".$_SESSION['Mysqli_Error'];
	        }
	        pg_close($cc_pg);
	        mysqli_close($cc_my);
	        return $inf;
		}
	}