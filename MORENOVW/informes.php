<?php
	/**
	 * 
	 */
	class informes
	{
		private $table='productos';
		private $table2='entrada';
		private $table3='salida';
		private $actio1='detalle/?p=';
		
		function listarEnt($c1,$rid){
			$inf = null;$cant=10;
			$inf.='<thead>';
				$inf.='<tr>';
					$inf.='<th><i class="fas fa-user-cog"></i></th>';
					$inf.='<th>Id</th>';
					$inf.='<th>Foto</th>';
					$inf.='<th>Nombre</th>';
					$inf.='<th>Tipo de producto</th>';
					$inf.='<th>Costo</th>';
					$inf.='<th>Cantidad Disponible</th>';
					$inf.='<th>Ingresaron</th>';
					$inf.='<th>Fecha Ingreso</th>';
					$inf.='<th>Estado</th>';
				$inf.='</tr>';
			$inf.='</thead>';
			$inf.='<tbody>';
				if ($rid==1 || $rid==2) {
					$sql="SELECT p.id_prod, p.nombre_p, p.tipo_p, p.costo_p, p.cantidad_p, e.cant_entrada, e.fecha_entrada, p.foto1_p, p.status FROM ".$this->table." p INNER JOIN ".$this->table2." e ON p.id_prod=e.id_prod WHERE p.status <> 2 ORDER BY p.id_prod ASC;";
				}else{
					$sql="SELECT p.id_prod, p.nombre_p, p.tipo_p, p.costo_p, p.cantidad_p, e.cant_entrada, e.fecha_entrada, p.foto1_p, p.status FROM ".$this->table." p INNER JOIN ".$this->table2." e ON p.id_prod=e.id_prod WHERE p.status = 1 ORDER BY p.id_prod ASC;";
				}
				$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
				if ($res) {
					if (pg_num_rows($res) > 0) {
						while ($row = pg_fetch_array($res)) {
							$datos2 = base64_encode($row['id_prod']).'||'.$row['cantidad_p'];
							$inf.='<tr>';
								$inf.='<td>';
								/*	$inf.='<a href="'.$this->actio1.base64_encode($row['id_prod']).'" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>';
									$inf .= "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar' onclick='eliminar(".'"'.$datos2.'"'.");' >";
										$inf .= "<i class='fas fa-trash' ></i>";
									$inf .= "</button>";*/
								$inf.='<td>'.$row['id_prod'].'</td>';
								$inf.='<td><img src="'.IMG.$row['foto1_p'].'" style="max-width: 100px;" ></td>';
								$inf.='<td>'.$row['nombre_p'].'</td>';
								$inf.='<td>'.$row['tipo_p'].'</td>';
								$inf.='<td>'.$row['costo_p'].'</td>';
								$inf.='<td>'.$row['cantidad_p'].'</td>';
								$inf.='<td>'.$row['cant_entrada'].'</td>';
								$inf.='<td>'.$row['fecha_entrada'].'</td>';
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
		function listarSal($c1,$rid){
			$inf = null;$cant=10;
			$inf.='<thead>';
				$inf.='<tr>';
					$inf.='<th><i class="fas fa-user-cog"></i></th>';
					$inf.='<th>Id</th>';
					$inf.='<th>Foto</th>';
					$inf.='<th>Nombre</th>';
					$inf.='<th>Tipo de producto</th>';
					$inf.='<th>Costo</th>';
					$inf.='<th>Cantidad Disponible</th>';
					$inf.='<th>Salieron</th>';
					$inf.='<th>Fecha Salida</th>';
					$inf.='<th>Estado</th>';
				$inf.='</tr>';
			$inf.='</thead>';
			$inf.='<tbody>';
				if ($rid==1 || $rid==2) {
					$sql="SELECT p.id_prod, p.nombre_p, p.tipo_p, p.costo_p, p.cantidad_p, s.cant_salida, s.fecha_salida, p.foto1_p, p.status FROM ".$this->table." p INNER JOIN ".$this->table3." s ON p.id_prod=s.id_prod WHERE p.status <> 2 ORDER BY p.id_prod ASC;";
				}else{
					$sql="SELECT p.id_prod, p.nombre_p, p.tipo_p, p.costo_p, p.cantidad_p, s.cant_salida, s.fecha_salida, p.foto1_p, p.status FROM ".$this->table." p INNER JOIN ".$this->table3." s ON p.id_prod=s.id_prod WHERE p.status = 1 ORDER BY p.id_prod ASC;";
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
								$inf.='<td>'.$row['costo_p'].'</td>';
								$inf.='<td>'.$row['cantidad_p'].'</td>';
								$inf.='<td>'.$row['cant_salida'].'</td>';
								$inf.='<td>'.$row['fecha_salida'].'</td>';
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
	}
	