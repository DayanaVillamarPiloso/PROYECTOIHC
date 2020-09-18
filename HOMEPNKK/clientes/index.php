<?php
	session_start();
	$rut='../../';
	$pagina='Clientes';
	$singlr='Cliente';
	$action='clientes.php';
	$cod_pg=5;
	require_once($rut.'config.php');
	require_once($rut.'permisos/emp.php');
	$niv2=true;$niv3=true;$deta=false;
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once($rut.'css.php'); ?>
</head>
<body>
	<?php include_once($rut.'nav.php'); ?>

	<section class="container pt-4 mt-4">
		<div class="row pb-3">
			<div class="col-sm-4 col-xs-12">
				<div class="card bg-light mb-3" style="max-width: auto;">
					<div class="card-header text-center"><b>Hola</b> <cite><?= $una; ?></cite></div>
					<div class="card-body">
						<h5 class="card-title">Bienvenido al minimarket THE TWINS</h5>
						<div class="text-center">
							<img src="<?= IMG.$ufo; ?>" style="max-height: 220px;">
						</div>
						<p class="card-text">
							En nuestro sitio Web usted encontrará productos de primera necesidad.<br>
							Ademas en nuestro Local tendrá atención Preferencial y Personalizada.
						</p>
					</div>
				</div>
			</div>
			<div class="col-sm-8 col-xs-12">
				<img src="<?= IMG; ?>minimark.jpg" class="col-sm-12">
			</div>
		</div>
		<div class="row pb-3">
			<div class="col-sm-12">
				<div class="card-group">
					<?php if ($rid==1 || $rid==2) { ?>
						<div class="card text-white bg-primary">
							<div class="card-img-top text-center pt-3">
								<i class="fas fa-plus fa-5x"></i>
							</div>
							<div class="card-body text-center">
								<h5 class="card-title">Nuevo Usuario</h5>
								<p class="card-text">Cree un nuevo usuario para el sistema.</p>
								<a href="<?= HOME; ?>usuarios/" class="btn btn-info btn-block">Crear</a>
							</div>
						</div>
					<?php } ?>
					<div class="card text-white bg-success">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title">Nuevo Producto</h5>
							<p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
							<a href="" class="btn btn-info btn-block">Crear</a>
						</div>
					</div>
					<div class="card text-white bg-warning">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title">Nuevo Proveedor</h5>
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
							<a href="" class="btn btn-info btn-block">Crear</a>
						</div>
					</div>
					<div class="card text-white bg-danger">
						<div class="card-img-top text-center pt-3">
							<i class="fas fa-plus fa-5x"></i>
						</div>
						<div class="card-body text-center">
							<h5 class="card-title"></h5>
							<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
							<a href="" class="btn btn-info btn-block">Crear</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<?php include_once($rut.'java.php'); ?>
</body>
</html>