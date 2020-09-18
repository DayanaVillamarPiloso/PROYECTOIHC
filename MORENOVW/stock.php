<?php
	/**
	 * 
	 */
	class stock
	{
		private $table='entrada';
		private $table2='salida';
		private $table3='productos';
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
							$datos2 = base64_encode($row['id_prod']).'||';
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
		function addEntrada($cc_pg,$c3,$c4,$cc_my,$id_prod,$cant_entrada,$fecha_entrada){
			function validarAddE($id_prod,$cant_entrada,$fecha_entrada){
		        $er=1;
		        if (is_null($id_prod)) { $er=0; }
		        if ($id_prod <= 0) { $er=0; }
		        if (is_null($cant_entrada)) { $er=0; }
		        if (is_null($fecha_entrada)) { $er=0; }
		        return($er);
		    }
	        if (validarAddE($id_prod,$cant_entrada,$fecha_entrada) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	            $sql = "INSERT INTO ".$this->table." (id_prod, cant_entrada, fecha_entrada) VALUES (".$id_prod.", ".$cant_entrada.", '".$fecha_entrada."');";
	            $res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            //$res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res1) {
	                $inf = 1;
	                $sql3 = "SELECT cantidad_p FROM ".$this->table3." WHERE id_prod=".$id_prod." ;";
	            	$res3 = pg_query($c3,$sql3) or $_SESSION['Mysqli_Error'] .= (pg_last_error($c3));
	            	if ($res3) {
	            		if (pg_num_rows($res3) > 0) {
	            			while ($row = pg_fetch_array($res3)) {
	            				$cantidad_p = $row['cantidad_p'];
	            			}
	            			if ($cantidad_p > 0) {
	            				$cant = $cantidad_p + $cant_entrada;
	            			}else{
	            				$cant = $cant_entrada;
	            			}
		                	$sql4 = "UPDATE ".$this->table3." SET cantidad_p='".$cant."' WHERE id_prod=".$id_prod." ;";
		            		$res4 = pg_query($c4,$sql4) or $_SESSION['Mysqli_Error'] .= (pg_last_error($c4));
		                	if ($res4) {
		            			$_SESSION['resp2'] = " - Se actualizó el Stcok del Producto.";
		                	}else{
		            			$_SESSION['resp2'] = " - No actualizó el Stcok del Producto. Error: ".$_SESSION['Mysqli_Error'];
		                	}
	            		}else{
		            		$_SESSION['resp2'] = " - No se encontró el Producto.";
	            		}
	            	}else{
		            	$_SESSION['resp2'] = " - No se encontró el Producto. Error: ".$_SESSION['Mysqli_Error'];
	            	}
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
		function addSalida($cc_pg,$c3,$c4,$cc_my,$id_prod,$cant_salida,$fecha_salida){
			function validarAddS($id_prod,$cant_salida,$fecha_salida){
		        $er=1;
		        if (is_null($id_prod)) { $er=0; }
		        if ($id_prod <= 0) { $er=0; }
		        if (is_null($cant_salida)) { $er=0; }
		        if (is_null($fecha_salida)) { $er=0; }
		        return($er);
		    }
	        if (validarAddS($id_prod,$cant_salida,$fecha_salida) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
				$sql3 = "SELECT cantidad_p FROM ".$this->table3." WHERE id_prod=".$id_prod." ;";
	            $res3 = pg_query($c3,$sql3) or $_SESSION['Mysqli_Error'] .= (pg_last_error($c3));
	            //$res2 = mysqli_query($cc_my,$sql) or $_SESSION['Mysqli_Error'] .= (mysqli_error($cc_my));
	            if ($res3) {
	            	if (pg_num_rows($res3) > 0) {
	            		while ($row = pg_fetch_array($res3)) {
	            			$cantidad_p = $row['cantidad_p'];
	            		}
	            		if ($cantidad_p > $cant_salida) {
	            			$sql = "INSERT INTO ".$this->table2." (id_prod, cant_salida, fecha_salida) VALUES (".$id_prod.", ".$cant_salida.", '".$fecha_salida."');";
	            			$res1 = pg_query($cc_pg,$sql) or $_SESSION['Mysqli_Error'] .= (pg_last_error($cc_pg));
	            			if ($res1) {
	                			$inf = 1;
	            				$cant = $cantidad_p - $cant_salida;
			                	$sql4 = "UPDATE ".$this->table3." SET cantidad_p='".$cant."' WHERE id_prod=".$id_prod." ;";
			            		$res4 = pg_query($c4,$sql4) or $_SESSION['Mysqli_Error'] .= (pg_last_error($c4));
			                	if ($res4) {
			            			$_SESSION['resp2'] = " - Se actualizó el Stock del Producto.";
			                	}else{
			            			$_SESSION['resp2'] = " - No actualizó el Stock del Producto. Error: ".$_SESSION['Mysqli_Error'];
			                	}
	            			}else{
		            			$_SESSION['resp2'] = " - No se encontró el Producto.";
	            			}
	            		}else{
	            			$inf = "No existe el Stock suficciente para poceder con el registro de Salida.";
	            		}
	            	}else{
		            	$_SESSION['resp2'] = " - No se encontró el Producto. Error: ".$_SESSION['Mysqli_Error'];
	            	}
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
	}	