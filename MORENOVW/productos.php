<?php
	/**
	 * 
	 */
	class productos
	{
		private $table='productos';
		private $table2='';
		private $actio1='detalle/?p=';
		
		function listar($c1,$rid){
			$inf = null;$cant=13;
			$inf.='<thead>';
				$inf.='<tr>';
					$inf.='<th><i class="fas fa-user-cog"></i></th>';
					$inf.='<th>Id</th>';
					$inf.='<th>Foto</th>';
					$inf.='<th>Nombre</th>';
					$inf.='<th>Tipo de producto</th>';
					$inf.='<th>Fecha de  Vencimiento</th>';
					$inf.='<th>Costo</th>';
					$inf.='<th>Marca</th>';
					$inf.='<th>Modelo</th>';
					$inf.='<th>Peso</th>';
					$inf.='<th>Unidad de Medida</th>';
					$inf.='<th>Cantidad Disponible</th>';
					$inf.='<th>Estado</th>';
				$inf.='</tr>';
			$inf.='</thead>';
			$inf.='<tbody>';
				if ($rid==1 || $rid==2) {
					$sql="SELECT id_prod, nombre_p, tipo_p, fechav_p, costo_p, marca_p, modelo_p, peso, unimedida_p,cantidad_p, foto1_p, status FROM ".$this->table." WHERE status <> 2 ORDER BY id_prod ASC;";
				}else{
					$sql="SELECT id_prod, nombre_p, tipo_p, fechav_p, costo_p, marca_p, modelo_p, peso, unimedida_p,cantidad_p, foto1_p, status FROM ".$this->table." WHERE status = 1 ORDER BY id_prod ASC;";
				}
				$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
				if ($res) {
					if (pg_num_rows($res) > 0) {
						while ($row = pg_fetch_array($res)) {
							$datos2 = base64_encode($row['id_prod']).'||'.$row['cantidad_p'];
							$inf.='<tr>';
								$inf.='<td>';
									$inf.='<a href="'.$this->actio1.base64_encode($row['id_prod']).'" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>';
									$inf .= "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar' onclick='eliminar(".'"'.$datos2.'"'.");' >";
										$inf .= "<i class='fas fa-trash' ></i>";
									$inf .= "</button>";
								$inf.='<td>'.$row['id_prod'].'</td>';
								$inf.='<td><img src="'.IMG.$row['foto1_p'].'" style="max-width: 100px;" ></td>';
								$inf.='<td>'.$row['nombre_p'].'</td>';
								$inf.='<td>'.$row['tipo_p'].'</td>';
								$inf.='<td>'.$row['fechav_p'].'</td>';
								$inf.='<td>'.$row['costo_p'].'</td>';
								$inf.='<td>'.$row['marca_p'].'</td>';
								$inf.='<td>'.$row['modelo_p'].'</td>';
								$inf.='<td>'.$row['peso'].'</td>';
								$inf.='<td>'.$row['unimedida_p'].'</td>';
								$inf.='<td>'.$row['cantidad_p'].'</td>';
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
		function cbo($c1,$rid){
			$inf = null;$cant=13;
			if ($rid==1 || $rid==2) {
				$sql="SELECT id_prod, concat(nombre_p, ' - ', marca_p, ' - ', modelo_p, ' | Total: ', cantidad_p) AS nombre FROM ".$this->table." WHERE status <> 2 ORDER BY id_prod ASC;";
			}else{
				$sql="SELECT id_prod, concat(nombre_p, ' - ', marca_p, ' - ', modelo_p, ' | Total: ', cantidad_p) AS nombre FROM ".$this->table." WHERE status = 1 ORDER BY id_prod ASC;";
			}
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			$inf.= '<option value="'.base64_encode(0).'">Seleccione el Producto</option>';
			if ($res) {
				if (pg_num_rows($res) > 0) {
					while ($row = pg_fetch_array($res)) {
						$inf.='<option value="'.base64_encode($row['id_prod']).'">';
							$inf.=$row['nombre'];
						$inf.='</option>';
					}
					pg_free_result($res);
				}else{
					$inf.= '<option value="'.base64_encode(0).'">No se encontraron registros</option>';
				}
			}else{
				$inf.= '<option value="'.base64_encode(0).'">No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'].'</option>';
			}
			pg_close($c1);
			return $inf;
		}
		function callID($c1,$pid){
			$inf = null;
			$sql="SELECT nombre_p, tipo_p, fechav_p, costo_p, descripcion_p, marca_p, modelo_p, peso, unimedida_p,cantidad_p, foto1_p, foto2_p, foto3_p, foto4_p, foto5_p, created_at,  status FROM ".$this->table." WHERE id_prod=".$pid.";"; 
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			$inf.='[';
				if ($res) {
					if (pg_num_rows($res) > 0) {
                        $inf .= '{';
							while ($row = pg_fetch_array($res)) {
								$inf .= '"nombre_p": "'.$row['nombre_p'].'",';
								$inf .= '"tipo_p": "'.$row['tipo_p'].'",';
								$inf .= '"fechav_p": "'.$row['fechav_p'].'",';
								$inf .= '"costo_p": "'.$row['costo_p'].'",';
								$inf .= '"descripcion_p": "'.base64_encode($row['descripcion_p']).'",';
								$inf .= '"marca_p": "'.$row['marca_p'].'",';
								$inf .= '"modelo_p": "'.$row['modelo_p'].'",';
								$inf .= '"peso": "'.$row['peso'].'",';
								$inf .= '"unimedida_p": "'.$row['unimedida_p'].'",';
								$inf .= '"cantidad_p": "'.$row['cantidad_p'].'",';
								$inf .= '"foto1_p": "'.$row['foto1_p'].'",';
								$inf .= '"foto2_p": "'.$row['foto2_p'].'",';
								$inf .= '"foto3_p": "'.$row['foto3_p'].'",';
								$inf .= '"foto4_p": "'.$row['foto4_p'].'",';
								$inf .= '"foto5_p": "'.$row['foto5_p'].'",';
								$inf .= '"created_at": "'.$row['created_at'].'",';
								$inf .= '"status": '.$row['status'].'';
							}
							$row=null;
                        $inf .= '},';
                        pg_free_result($res);
                    }else{
                        $inf .= '{"mensg": "No hay ningún reultado"},';
                    }
                }else{
                    $inf .= '{"mensg": "No se ejecutó la consulta"},';
                }
            $inf= substr($inf,0,-1).']';
			pg_close($c1);
			return $inf;
		}
		function add($cc_pg,$cc_my,$nombre_p,$tipo_p,$fechav_p,$costo_p,$descripcion_p,$marca_p,$modelo_p,$peso,$unimedida_p,$cantidad_p,$foto1_p){
			function validarAdd($nombre_p,$tipo_p,$fechav_p,$costo_p){
		        $er=1;
		        if (is_null($nombre_p)) { $er=0; }
		        if (is_null($tipo_p)) { $er=0; }
		        if (is_null($fechav_p)) { $er=0; }
		        if (is_null($costo_p)) { $er=0; }
		        return($er);
		    }
	        if (validarAdd($nombre_p,$tipo_p,$fechav_p,$costo_p) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	        	$nombre_p = str_replace("'", "´", $nombre_p);
	        	$marca_p = str_replace("'", "´", $marca_p);
	        	$foto1_p = str_replace(" ", "-", $foto1_p);
	            $sql = "INSERT INTO ".$this->table." (nombre_p, tipo_p, fechav_p, costo_p, descripcion_p, marca_p, modelo_p, peso, unimedida_p,cantidad_p, foto1_p) VALUES ('".$nombre_p."', '".$tipo_p."', '".$fechav_p."', '".$costo_p."', '".$descripcion_p."', '".$marca_p."', '".$modelo_p."', '".$peso."', '".$unimedida_p."','".$cantidad_p."', '".$foto1_p."');";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            //$res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res1) {
	                $inf = 1;
	            }else{
	                $inf = "No se Agregó el Registro. Error: ".$_SESSION['Mysqli_Error'];
	            }
	        }else{
	            $inf = "No se ejecutó la consulta. Error: ".$_SESSION['Mysqli_Error'];
	        }
	        pg_close($cc_pg);
	        mysqli_close($cc_my);
	        return $inf;
		}
		function edit($cc_pg,$cc_my,$pid,$nombre_p,$tipo_p,$fechav_p,$costo_p,$descripcion_p,$marca_p,$modelo_p,$peso,$unimedida_p,$cantidad_p,$foto1_p,$foto2_p,$foto3_p,$foto4_p,$foto5_p,$updated_at,$id_updated){
			function validarEdit($pid,$nombre_p,$tipo_p,$fechav_p){
		        $er=1;
		        if (is_null($pid)) { $er=0; }
		        if ($pid <= 0) { $er=0; }
		        if (is_null($nombre_p)) { $er=0; }
		        if (is_null($tipo_p)) { $er=0; }
		        if (is_null($fechav_p)) { $er=0; }
		        return($er);
		    }
	        if (validarEdit($pid,$nombre_p,$tipo_p,$fechav_p) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	        	if (strlen($costo_p) >= 6) {
	            	$rpta = password_hash($costo_p, PASSWORD_BCRYPT);
	        	}else{
	        		$rpta = $act_costo_p;
	        	}
	        	$foto1_p = str_replace(" ", "-", $foto1_p);
	        	$foto2_p = str_replace(" ", "-", $foto2_p);
	        	$foto3_p = str_replace(" ", "-", $foto3_p);
	        	$foto4_p = str_replace(" ", "-", $foto4_p);
	        	$foto5_p = str_replace(" ", "-", $foto5_p);
	            $sql = "UPDATE ".$this->table." SET nombre_p='".$nombre_p."', tipo_p='".$tipo_p."', fechav_p='".$fechav_p."', costo_p='".$costo_p."', descripcion_p='".$descripcion_p."', marca_p='".$marca_p."', modelo_p='".$modelo_p."', peso='".$peso."', unimedida_p='".$unimedida_p."',cantidad_p='".$cantidad_p."', foto1_p='".$foto1_p."', foto2_p='".$foto2_p."', foto3_p='".$foto3_p."', foto4_p='".$foto4_p."', foto5_p='".$foto5_p."', updated_at='".$updated_at."', id_updated=".$id_updated." WHERE id_prod=".$pid." ;";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            //$res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
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
	            $sql = "UPDATE ".$this->table." SET drop_at='".$drop_at."', id_drop=".$id_drop.", status=2 WHERE id_prod=".$pid." ;";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            //$res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
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
	