<?php
	session_start();
	$rut='../../../';
	$padre='Usuarios';
	$pagina='Detalle del Usuario';
	$singlr='Usuario';
	$action='usuarios.php';
	$cod_pg=2;
	require_once($rut.'config.php');
	require_once($rut.'permisos/sa.php');
	$niv2=true;$niv3=true;$deta=true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once($rut.'css.php'); ?>
	<?php
		$inf=null;

		require_once($rut.DIRACT.$action);
		$inf = detalle($rut,$rid,$pid);

		if(isset($inf->id_tipo)){ $id_tipo = $inf->id_tipo; }else{ $id_tipo=null; }
		if(isset($inf->nombre_tipo)){ $nombre_tipo = $inf->nombre_tipo; }else{ $nombre_tipo=null; }
		if(isset($inf->nombre_u)){ $nombre_u = $inf->nombre_u; }else{ $nombre_u=null; }
		if(isset($inf->usuario_u)){ $usuario_u = $inf->usuario_u; }else{ $usuario_u=null; }
		if(isset($inf->correo_u)){ $correo_u = $inf->correo_u; }else{ $correo_u=null; }
		if(isset($inf->contra_u)){ $contra_u = $inf->contra_u; }else{ $contra_u=null; }
		if(isset($inf->foto_u)){ $foto_u = $inf->foto_u; }else{ $foto_u=null; }
		if(isset($inf->status)){ $status = $inf->status; }else{ $status=null; }
		if(isset($_SESSION['cboTU'])){ $cboTU = $_SESSION['cboTU']; unset($_SESSION['cboTU']); }else{ $cboTU=null; }
	?>
</head>
<body>
	<?php include_once($rut.'nav.php'); ?>

	<section class="container pt-4 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <h3><?= $pagina; ?></h3>
                </div>
                <div class="col-sm-4 text-right">
                </div>
            </div>
                
			<?php if (isset($_SESSION['sms'])): ?>
            	<hr>
            	<div class="row">
            		<div class="col-sm-12 text-center">
            			<div class="alert alert-info"><?= $_SESSION['sms']; ?></div>
            		</div>
            	</div>
			<?php endif ?>
                
            <hr>

            <div class="row mb-4">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
                    <form method="POST" action="<?= ACTI.$action; ?>" enctype="multipart/form-data" class="row">
                    	<div class="row col-sm-8">
	                    	<div class="col-sm-6">
		                    	<div class="form-group">
				                  <label for="exampleInputEmail1">Tipo de Usuarios</label>
				                  <select class="form-control" id="id_tipo" name="id_tipo" required="required">
				                    <?php
				                      echo $cboTU;
				                      $cboTU = null;
				                    ?>
				                  </select>
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Nombres y Apellidos</label>
				                  <input type="text" class="form-control" name="nombre_u" required="required" value="<?= $nombre_u; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Usuario</label>
				                  <input type="text" class="form-control" name="usuario_u" required="required" value="<?= $usuario_u; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Correo</label>
				                  <input type="email" class="form-control" name="correo_u" required="required" value="<?= $correo_u; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputPassword1">Contraseña</label>
				                  <input type="password" class="form-control" id="pass" name="contra_u" placeholder="Minimo 6 dígitos (Opcional)">
				                  <input type="hidden" name="act_contra_u" value="<?= $contra_u; ?>">
				                </div>
				                <div class="form-group form-check">
				                  <div class="icheck-primary">
				                    <input type="checkbox" id="ver_pass" onchange="document.getElementById('pass').type = this.checked ? 'text' : 'password'">
				                    <label for="ver_pass">Ver contraseña</label>
				                  </div>
				                </div>
	                    	</div>
                    	</div>
                    	<div class="row col-sm-4">
	                    	<div class="col-sm-12">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Foto</label>
				                  <?php if (strlen($foto_u) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto_u; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto_u">
				                  <input type="hidden" class="form-control" name="act_foto_u" value="<?= $foto_u; ?>">
				                </div>
	                    	</div>
	                    </div>
                    	<div class="row col-sm-12">
                    		<div class="col-sm-6">
                    			<a href="../" class="btn btn-danger btn-block"><i class="fas fa-arrow-left"></i> Regresar</a>
	                    	</div>
                    		<div class="col-sm-6">
                    			<input type="hidden" name="pid" value="<?= base64_encode($pid); ?>">
                    			<input type="hidden" name="id_updated" value="<?= base64_encode($uid); ?>">
                    			<button type="submit" name="editar" class="btn btn-success btn-block">Editar <i class="fas fa-edit"></i></button>
	                    	</div>
	                    </div>
                    </form>
                </div>
            </div>
        </div>
	</section>

	<?php include_once($rut.'java.php'); ?>

	<script type="text/javascript">
		var id_tipo = '<?= base64_encode($id_tipo); ?>';

		document.getElementById('id_tipo').value = id_tipo;
	</script>
</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>