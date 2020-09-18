<?php
	/**
	 * 
	 */
	class usuarios
	{
		private $table='usuarios';
		private $table2='tipo_usuarios';
		private $actio1='detalle/?p=';
		
		function login_pg($c1,$user,$pass){
			$inf = null;
			$sql="SELECT u.id_user, u.id_tipo, tu.nombre_tipo, u.nombre_u, u.usuario_u, u.correo_u, u.contra_u, u.foto_u, u.status FROM ".$this->table." u INNER JOIN ".$this->table2." tu ON u.id_tipo=tu.id_tipo WHERE (u.usuario_u LIKE '".$user."%' OR u.correo_u LIKE '".$user."%' ) AND u.status = 1;";
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			if ($res) {
				if (pg_num_rows($res) > 0) {
					while ($row = pg_fetch_array($res)) {
						$id_user = $row['id_user'];
						$id_tipo = $row['id_tipo'];
						$nombre_tipo = $row['nombre_tipo'];
						$nombre_u = $row['nombre_u'];
						$usuario_u = $row['usuario_u'];
						$correo_u = $row['correo_u'];
						$contra_u = $row['contra_u'];
						$foto_u = $row['foto_u'];
						$status = $row['status'];
					}
					if ($status==1) {
						if (password_verify($pass, $contra_u)) {
							$_SESSION['id_user'] = $id_user;
							$_SESSION['id_tipo'] = $id_tipo;
							$_SESSION['nombre_tipo'] = $nombre_tipo;
							$_SESSION['nombre_u'] = $nombre_u;
							$_SESSION['usuario_u'] = $usuario_u;
							$_SESSION['correo_u'] = $correo_u;
							$_SESSION['foto_u'] = $foto_u;
							$inf = 1;
						}else{
							$inf = 'Contraseña Incorrecta';
						}
					}else{
						$inf = 'Usuario Restringido';
					}
				}else{
					$inf = 'Usuario Incorrecto';
				}
			}else{
				$inf = 'No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'];
			}
			pg_close($c1);
			return $inf;
		}
		function login_my($c1,$user,$pass){
			$inf = null;
			$sql="SELECT u.id_user, u.id_tipo, tu.nombre_tipo, u.nombre_u, u.usuario_u, u.correo_u, u.contra_u, u.foto_u, u.status FROM ".$this->table." u INNER JOIN ".$this->table2." tu ON u.id_tipo=tu.id_tipo WHERE (u.usuario_u LIKE '".$user."%' OR u.correo_u LIKE '".$user."%' ) AND u.status = 1;";
			$res=mysqli_query($c1,$sql) or $_SESSION['Mysqli_Error'] = mysqli_error($c1);
			if ($res) {
				if ($res->num_rows > 0) {
					while ($row = mysqli_fetch_array($res)) {
						$id_user = $row['id_user'];
						$id_tipo = $row['id_tipo'];
						$nombre_tipo = $row['nombre_tipo'];
						$nombre_u = $row['nombre_u'];
						$usuario_u = $row['usuario_u'];
						$correo_u = $row['correo_u'];
						$contra_u = $row['contra_u'];
						$foto_u = $row['foto_u'];
						$status = $row['status'];
					}
					if ($status==1) {
						if (password_verify($pass, $contra_u)) {
							$_SESSION['id_user'] = $id_user;
							$_SESSION['id_tipo'] = $id_tipo;
							$_SESSION['nombre_tipo'] = $nombre_tipo;
							$_SESSION['nombre_u'] = $nombre_u;
							$_SESSION['usuario_u'] = $usuario_u;
							$_SESSION['correo_u'] = $correo_u;
							$_SESSION['foto_u'] = $foto_u;
							$inf = 1;
						}else{
							$inf = 'Contraseña Incorrecta';
						}
					}else{
						$inf = 'Usuario Restringido';
					}
				}else{
					$inf = 'Usuario Incorrecto';
				}
			}else{
				$inf = 'No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'];
			}
			mysqli_close($c1);
			return $inf;
		}
		function listar($c1,$rid){
			$inf = null;$cant=8;
			$inf.='<thead>';
				$inf.='<tr>';
					$inf.='<th><i class="fas fa-user-cog"></i></th>';
					$inf.='<th>Id</th>';
					$inf.='<th>Foto</th>';
					$inf.='<th>Nombre</th>';
					$inf.='<th>Tipo de Usuario</th>';
					$inf.='<th>Usuario</th>';
					$inf.='<th>Correo</th>';
					$inf.='<th>Estado</th>';
				$inf.='</tr>';
			$inf.='</thead>';
			$inf.='<tbody>';
				if ($rid==1 || $rid==2) {
					$sql="SELECT u.id_user, u.id_tipo, tu.nombre_tipo, u.nombre_u, u.usuario_u, u.correo_u, u.contra_u, u.foto_u, u.status FROM ".$this->table." u INNER JOIN ".$this->table2." tu ON u.id_tipo=tu.id_tipo WHERE u.status <> 2 ORDER BY u.id_user ASC;";
				}else{
					$sql="SELECT u.id_user, u.id_tipo, tu.nombre_tipo, u.nombre_u, u.usuario_u, u.correo_u, u.contra_u, u.foto_u, u.status FROM ".$this->table." u INNER JOIN ".$this->table2." tu ON u.id_tipo=tu.id_tipo WHERE u.status = 1 ORDER BY u.id_user ASC;";
				}
				$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
				if ($res) {
					if (pg_num_rows($res) > 0) {
						while ($row = pg_fetch_array($res)) {
							$datos2 = base64_encode($row['id_user']).'||';
							$inf.='<tr>';
								$inf.='<td>';
									$inf.='<a href="'.$this->actio1.base64_encode($row['id_user']).'" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>';
									$inf .= "<button type='button' class='btn btn-danger' data-toggle='modal' data-target='#eliminar' onclick='eliminar(".'"'.$datos2.'"'.");' >";
										$inf .= "<i class='fas fa-trash' ></i>";
									$inf .= "</button>";
								$inf.='</td>';
								$inf.='<td>'.$row['id_user'].'</td>';
								$inf.='<td><img src="'.IMG.$row['foto_u'].'" style="max-width: 100px;" ></td>';
								$inf.='<td>'.$row['nombre_u'].'</td>';
								$inf.='<td>'.$row['nombre_tipo'].'</td>';
								$inf.='<td>'.$row['usuario_u'].'</td>';
								$inf.='<td>'.$row['correo_u'].'</td>';
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
						$inf = '<tr><td colspan="'.$cant.'" class="alert alert-warning text-center">Usuario Incorrecto</td></tr>';
					}
				}else{
					$inf = '<tr><td colspan="'.$cant.'" class="alert alert-danger text-center">No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'].'</td></tr>';
				}
			$inf.='</tbody>';
			pg_close($c1);
			return $inf;
		}
		function callID($c1,$pid){
			$inf = null;
			$sql="SELECT u.id_tipo, tu.nombre_tipo, u.nombre_u, u.usuario_u, u.correo_u, u.contra_u, u.foto_u, u.created_at, u.status FROM ".$this->table." u INNER JOIN ".$this->table2." tu ON u.id_tipo=tu.id_tipo WHERE u.id_user=".$pid.";";
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			$inf.='[';
				if ($res) {
					if (pg_num_rows($res) > 0) {
                        $inf .= '{';
							while ($row = pg_fetch_array($res)) {
								$inf .= '"id_tipo": '.$row['id_tipo'].',';
								$inf .= '"nombre_tipo": "'.$row['nombre_tipo'].'",';
								$inf .= '"nombre_u": "'.$row['nombre_u'].'",';
								$inf .= '"usuario_u": "'.$row['usuario_u'].'",';
								$inf .= '"correo_u": "'.$row['correo_u'].'",';
								$inf .= '"contra_u": "'.base64_encode($row['contra_u']).'",';
								$inf .= '"foto_u": "'.$row['foto_u'].'",';
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
		function add($cc_pg,$cc_my,$id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u,$foto_u){
			function validarAdd($id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u){
		        $er=1;
		        if (is_null($id_tipo)) { $er=0; }
		        if ($id_tipo <= 0) { $er=0; }
		        if (is_null($nombre_u)) { $er=0; }
		        if (is_null($usuario_u)) { $er=0; }
		        if (is_null($correo_u)) { $er=0; }
		        if (is_null($contra_u)) { $er=0; }
		        return($er);
		    }
	        if (validarAdd($id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	            $rpta = password_hash($contra_u, PASSWORD_BCRYPT);
	            $sql = "INSERT INTO ".$this->table." (id_tipo, nombre_u, usuario_u, correo_u, contra_u, foto_u) VALUES (".$id_tipo.", '".$nombre_u."', '".$usuario_u."', '".$correo_u."', '".$rpta."', '".$foto_u."');";
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
		function edit($cc_pg,$cc_my,$pid,$id_tipo,$nombre_u,$usuario_u,$correo_u,$contra_u,$act_contra_u,$foto_u,$updated_at,$id_updated){
			function validarEdit($pid,$id_tipo,$nombre_u,$usuario_u,$correo_u){
		        $er=1;
		        if (is_null($pid)) { $er=0; }
		        if ($pid <= 0) { $er=0; }
		        if (is_null($id_tipo)) { $er=0; }
		        if ($id_tipo <= 0) { $er=0; }
		        if (is_null($nombre_u)) { $er=0; }
		        if (is_null($usuario_u)) { $er=0; }
		        if (is_null($correo_u)) { $er=0; }
		        return($er);
		    }
	        if (validarEdit($pid,$id_tipo,$nombre_u,$usuario_u,$correo_u) == 1) {
	        	$_SESSION['Mysqli_Error']=null;
	        	if (strlen($contra_u) >= 6) {
	            	$rpta = password_hash($contra_u, PASSWORD_BCRYPT);
	        	}else{
	        		$rpta = $act_contra_u;
	        	}
	            $sql = "UPDATE ".$this->table." SET id_tipo=".$id_tipo.", nombre_u='".$nombre_u."', usuario_u='".$usuario_u."', correo_u='".$correo_u."', contra_u='".$rpta."', foto_u='".$foto_u."', updated_at='".$updated_at."', id_updated=".$id_updated." WHERE id_user=".$pid." ;";
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
	            $sql = "UPDATE ".$this->table." SET drop_at='".$drop_at."', id_drop=".$id_drop.", status=2 WHERE id_user=".$pid." ;";
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