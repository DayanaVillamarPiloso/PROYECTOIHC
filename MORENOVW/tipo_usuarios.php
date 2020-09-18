<?php
	/**
	 * 
	 */
	class tipo_usuarios
	{
		private $table='tipo_usuarios';
		
		function cbo($c1,$rid){
			$inf = null;
			if ($rid==1) {
				$sql="SELECT id_tipo, nombre_tipo FROM ".$this->table." WHERE status = 1;";
			}else{
				$sql="SELECT id_tipo, nombre_tipo FROM ".$this->table." WHERE id_tipo > 1 AND status = 1;";
			}
			$res=pg_query($c1,$sql) or $_SESSION['Mysqli_Error'] = pg_last_error($c1);
			$inf.='<option value="'.base64_encode(0).'" >Seleccione el tipo de Usuario:</option>';
			if ($res) {
				if (pg_num_rows($res) > 0) {
					while ($row = pg_fetch_array($res)) {
						$inf.='<option value="'.base64_encode($row['id_tipo']).'" >'.$row['nombre_tipo'].'</option>';
					}
				}else{
					$inf.='<option value="'.base64_encode(0).'" >No hay registros</option>';
				}
			}else{
				$inf.='<option value="'.base64_encode(0).'" >No se ejecutó la consulta. Error: '.$_SESSION['Mysqli_Error'].'</option>';
			}
			pg_close($c1);
			return $inf;
		}
	}