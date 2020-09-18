<?php
	/**
	 * 
	 */
	class catalogo
	{
		private $table='productos';
		private $table2='';
		private $actio1='detalle/?p=';
		
		function listar($c1,$c2){
			$inf=null;$inf2=null;
			$_SESSION['Mysqli_Error']=null;
			$inf.='<ul class="filter__controls">';
				$sql="SELECT DISTInCT(tipo_p) FROM ".$this->table." WHERE status=1 ORDER BY tipo_p ASC;";
				$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
				$inf.='<li class="active" data-filter="*">Todos</li>';
				if ($res) {
					if (pg_num_rows($res) > 0) {
						while ($row = pg_fetch_array($res)) {
							$tipo_p = strtolower(str_replace(array(' ', "'"), '',$row['tipo_p']));

							$inf.='<li data-filter=".'.$tipo_p.'">'.$row['tipo_p'].'</li>';
						}
						pg_free_result($res);
					}else{
						$inf.= '<li data-filter=".men">No hay tipos de Productos</li>';
					}
				}else{
					$inf.= '<li data-filter=".men">No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'].'</li>';
				}
			$inf.='</ul>';
			
			$sql2="SELECT id_prod, nombre_p, tipo_p, costo_p, marca_p, modelo_p, foto1_p, status FROM ".$this->table." WHERE status = 1 ORDER BY nombre_p ASC;";
			$res2=pg_query($c2,$sql2) or $_SESSION['Mysqli_Error'] = pg_last_error($c2);
			if ($res2) {
				if (pg_num_rows($res2) > 0) {
					while ($row2 = pg_fetch_array($res2)) {
						$tipo_p = strtolower(str_replace(array(' ', "'"), '',$row2['tipo_p']));
						$foto = str_replace(' ', '%20', $row2['foto1_p']);
						
						$inf2.='<div class="col-lg-3 col-md-4 col-sm-6 mix '.$tipo_p.'">';
							$inf2.='<div class="product__item">';
								$inf2.='<div class="product__item__pic set-bg" data-setbg="'.IMG.$foto.'">';
									$inf2.='<div class="label new">Nuevo</div>';
									$inf2.='<ul class="product__hover">';
										$inf2.='<li><a href="'.IMG.$row2['foto1_p'].'" class="image-popup"><span class="arrow_expand"></span></a></li>';
										$inf2.='<li><a href="#"><span class="icon_bag_alt"></span></a></li>';
									$inf2.='</ul>';
								$inf2.='</div>';
								$inf2.='<div class="product__item__text">';
									$inf2.='<h6><a href="'.$this->actio1.base64_encode($row2['id_prod']).'">'.$row2['nombre_p'].'</a></h6>';
									$inf2.='<div class="product__price">$ '.$row2['costo_p'].'</div>';
								$inf2.='</div>';
							$inf2.='</div>';
						$inf2.='</div>';
					}
					$_SESSION['cuerpo_List'] = $inf2;
					$inf2=null;
				}
			}

			pg_close();
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
	