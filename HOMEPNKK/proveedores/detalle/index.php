<?php
	session_start();
	$rut='../../../';
	$padre='Proveedores';
	$pagina='Detalle del Proveedor';
	$singlr='Proveedor';
	$action='proveedor.php';
	$cod_pg=4;
	require_once($rut.'config.php');
	require_once($rut.'permisos/emp.php');
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

		if(isset($inf->nombre_prove)){ $nombre_prove = $inf->nombre_prove; }else{ $nombre_prove=null; }
		if(isset($inf->ruta_prove)){ $ruta_prove = $inf->ruta_prove; }else{ $ruta_prove=null; }
		if(isset($inf->tel_prove)){ $tel_prove = $inf->tel_prove; }else{ $tel_prove=null; }
		if(isset($inf->costo_p)){ $costo_p = ($inf->costo_p > 0) ? number_format($inf->costo_p, 2, '.', '') : '0.00';
 }else{ $costo_p='0.00'; }
		if(isset($inf->descripcion_p)){ $descripcion_p = base64_decode($inf->descripcion_p); }else{ $descripcion_p=null; }
		if(isset($inf->marca_p)){ $marca_p = $inf->marca_p; }else{ $marca_p=null; }
		if(isset($inf->modelo_p)){ $modelo_p = $inf->modelo_p; }else{ $modelo_p=null; }
		if(isset($inf->peso)){ $peso = $inf->peso; }else{ $peso=null; }
		if(isset($inf->unimedida_p)){ $unimedida_p = $inf->unimedida_p; }else{ $unimedida_p=null; }
		if(isset($inf->foto1_p)){ $foto1_p = $inf->foto1_p; }else{ $foto1_p=null; }
		if(isset($inf->foto2_p)){ $foto2_p = $inf->foto2_p; }else{ $foto2_p=null; }
		if(isset($inf->foto3_p)){ $foto3_p = $inf->foto3_p; }else{ $foto3_p=null; }
		if(isset($inf->foto4_p)){ $foto4_p = $inf->foto4_p; }else{ $foto4_p=null; }
		if(isset($inf->foto5_p)){ $foto5_p = $inf->foto5_p; }else{ $foto5_p=null; }
		if(isset($inf->status)){ $status = $inf->status; }else{ $status=null; }
	?>
</head>
<body>
	<?php include_once($rut.'nav.php'); ?>

	<section class="container pt-4 mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-4"></div>
                <div class="col-sm-4 text-center">
                    <h3><?= $pagina; ?></h4>
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
                    	<div class="row col-sm-12">
	                    	<div class="col-sm-8">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Nombre del Proveedor</label>
				                  <input type="text" class="form-control" name="nombre_prove" required="required" value="<?= $nombre_prove; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-8">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Ruta de Proveedor</label>
				                  <input type="text" class="form-control" name="ruta_prove" required="required" value="<?= $ruta_prove; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Telefono Proveedor</label>
				                  <input type="text" class="form-control" name="tel_prove" required="required" value="<?= $tel_prove; ?>">
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
