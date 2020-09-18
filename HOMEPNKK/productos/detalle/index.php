<?php
	session_start();
	$rut='../../../';
	$padre='Productos';
	$pagina='Detalle del Producto';
	$singlr='Producto';
	$action='productos.php';
	$cod_pg=3;
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

		if(isset($inf->nombre_p)){ $nombre_p = $inf->nombre_p; }else{ $nombre_p=null; }
		if(isset($inf->tipo_p)){ $tipo_p = $inf->tipo_p; }else{ $tipo_p=null; }
		if(isset($inf->fechav_p)){ $fechav_p = $inf->fechav_p; }else{ $fechav_p=null; }
		if(isset($inf->costo_p)){ $costo_p = ($inf->costo_p > 0) ? number_format($inf->costo_p, 2, '.', '') : '0.00'; }else{ $costo_p='0.00'; }
		if(isset($inf->descripcion_p)){ $descripcion_p = base64_decode($inf->descripcion_p); }else{ $descripcion_p=null; }
		if(isset($inf->marca_p)){ $marca_p = $inf->marca_p; }else{ $marca_p=null; }
		if(isset($inf->modelo_p)){ $modelo_p = $inf->modelo_p; }else{ $modelo_p=null; }
		if(isset($inf->peso)){ $peso = $inf->peso; }else{ $peso=null; }
		if(isset($inf->unimedida_p)){ $unimedida_p = $inf->unimedida_p; }else{ $unimedida_p=null; }
		if(isset($inf->cantidad_p)){ $cantidad_p = $inf->cantidad_p; }else{ $cantidad_p=null; }
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
				                  <label for="exampleInputEmail1">Nombre del Producto</label>
				                  <input type="text" class="form-control" name="nombre_p" required="required" value="<?= $nombre_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Tipo de Producto</label>
				                  <input type="text" class="form-control" name="tipo_p" required="required" value="<?= $tipo_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Fecha de Vencimiento</label>
				                  <input type="date" class="form-control" name="fechav_p" required="required" value="<?= $fechav_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Costo</label>
				                  <input type="number"  class="form-control" step="0.01" name="costo_p" required="required" value="<?= $costo_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-12">
				                <div class="form-group">
				                  <label for="exampleInputEmail1"> Descripcion de Producto</label>
	                  			  <textarea class="form-control ckeditor" name="descripcion_p"><?= $descripcion_p; ?></textarea>
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Marca de Producto</label>
				                  <input type="text" class="form-control" name="marca_p" required="required" value="<?= $marca_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Modelo de Producto</label>
				                  <input type="text" class="form-control" name="modelo_p" required="required" value="<?= $modelo_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Peso</label>
				                  <input type="number"  class="form-control" step="0.01" name="peso" required="required" value="<?= $peso; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">Unidad de Medida</label>
				                  <input type="text" class="form-control" name="unimedida_p" required="required" value="<?= $unimedida_p; ?>">
				                </div>
	                    	</div>
	                    	<div class="col-sm-6">
				                <div class="form-group">
				                  <label for="exampleInputEmail1">cantidad</label>
				                  <input type="number"  class="form-control" name="cantidad_p" required="required" value="<?= $cantidad_p; ?>">
				                </div>
	                    	</div>
                    	</div>
                    	<div class="row col-sm-4">
	                    	<div class="col-sm-12 row">
				                <div class="col-sm-12 form-group">
				                  <label for="exampleInputEmail1">Foto de Protada</label>
				                  <?php if (strlen($foto1_p) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto1_p; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto1_p">
				                  <input type="hidden" class="form-control" name="act_foto1_p" value="<?= $foto1_p; ?>">
				                </div>
				                <div class="col-sm-12 form-group">
				                  <label for="exampleInputEmail1">Foto 2</label>
				                  <?php if (strlen($foto2_p) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto2_p; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto2_p">
				                  <input type="hidden" class="form-control" name="act_foto2_p" value="<?= $foto2_p; ?>">
				                </div>
				                <div class="col-sm-12 form-group">
				                  <label for="exampleInputEmail1">Foto 3</label>
				                  <?php if (strlen($foto3_p) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto3_p; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto3_p">
				                  <input type="hidden" class="form-control" name="act_foto3_p" value="<?= $foto3_p; ?>">
				                </div>
				                <div class="col-sm-12 form-group">
				                  <label for="exampleInputEmail1">Foto 4</label>
				                  <?php if (strlen($foto4_p) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto4_p; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto4_p">
				                  <input type="hidden" class="form-control" name="act_foto4_p" value="<?= $foto4_p; ?>">
				                </div>
				                <div class="col-sm-12 form-group">
				                  <label for="exampleInputEmail1">Foto 5</label>
				                  <?php if (strlen($foto5_p) > 4): ?>
				                  	<br>
				                  	<img src="<?= IMG.$foto5_p; ?>" class="col-sm-12">
				                  <?php endif ?>
				                  <input type="file" class="form-control" name="foto5_p">
				                  <input type="hidden" class="form-control" name="act_foto5_p" value="<?= $foto5_p; ?>">
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
		var id_prod = '<?= base64_encode($id_prod); ?>';

		document.getElementById('id_prod').value = id_prod;
	</script>
</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>
