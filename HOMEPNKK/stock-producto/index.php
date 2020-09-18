<?php
	session_start();
	$rut='../../';
	$pagina='Stock de Productos';
	$singlr='Stock';
	$action='stock.php';
	$cod_pg=6;
	require_once($rut.'config.php');
	require_once($rut.'permisos/emp.php');
	$niv2=true;$niv3=true;$deta=false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once($rut.'css.php'); ?>
	<?php
		$inf=null;

		require_once($rut.DIRACT.$action);
		$inf = index($rut,$rid);
	?>
</head>
<body>
	<?php include_once($rut.'nav.php'); ?>

	<section class="container">
                
		<?php if (isset($_SESSION['sms'])): ?>
            <hr>
            <div class="row">
            	<div class="col-sm-12 text-center">
            		<div class="alert alert-info"><?= $_SESSION['sms']; ?></div>
            	</div>
            </div>
		<?php endif ?>

		<div class="row pb-3 pt-4">
			<div class="col-sm-12">
				<div class="card-group">
					<div class="card text-white bg-info">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title">Entrada de Producto</h6>
							<p class="card-text">Registrar la Entrada de Productos.</p>
							<button type="button" class="btn btn-light" data-toggle="modal" data-target="#entrada" >
								<i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="card text-white bg-secondary">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title">Salida de Producto</h7>
							<p class="card-text">Registrar la Salida de Productos.</p>
							<button type="button" class="btn btn-light" data-toggle="modal" data-target="#salida" >
								<i class="fas fa-plus"></i>
							</button>
						</div>
					</div>
					<div class="card text-white bg-primary">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title">Movimientos</h5>
							<p class="card-text">Mostrar el Informe de Movimientos.</p>
							<a href="<?= HOME; ?>informes/" class="btn btn-light">Ver</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include_once($rut.'java.php'); ?>

	<div class="modal fade" id="entrada" tabindex="-1" aria-labelledby="nuevoLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<form method="POST" action="<?= ACTI.$action; ?>" enctype="multipart/form-data">
		      <div class="modal-header">
		        <h5 class="modal-title" id="nuevoLabel">Nueva Entrada de <?= $singlr; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Nombres</label>
	                  <select class="form-control" name="id_prod">
	                  	<?= $inf; ?>
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Cantidad</label>
	                  <input type="number" step="1" min="1" class="form-control" name="cant_entrada" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Fecha</label>
	                  <input type="date" class="form-control" name="fecha_entrada" required="required">
	                </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="entrada" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
		      </div>
		    </form>
	    </div>
	  </div>
	</div>
	<div class="modal fade" id="salida" tabindex="-1" aria-labelledby="nuevoLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<form method="POST" action="<?= ACTI.$action; ?>" enctype="multipart/form-data">
		      <div class="modal-header">
		        <h5 class="modal-title" id="nuevoLabel">Nueva Salida de <?= $singlr; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Nombres</label>
	                  <select class="form-control" name="id_prod">
	                  	<?php echo $inf; $inf=null; ?>
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Cantidad</label>
	                  <input type="number" step="1" min="1" class="form-control" name="cant_salida" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Fecha</label>
	                  <input type="date" class="form-control" name="fecha_salida" required="required">
	                </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="salida" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
		      </div>
		    </form>
	    </div>
	  </div>
	</div>
</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>

