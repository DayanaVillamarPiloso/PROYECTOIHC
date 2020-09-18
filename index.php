<?php
	session_start();
	$rut='./';
	$pagina='Ingresar';
	$action='login.php';
	require_once($rut.'constant.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<?php include_once($rut.'css.php'); ?>
</head>
<body>
	<section class="container pt-4 mt-4">
		<div class="container pt-4 mt-4">
			<div class="row">
				<div class="col-sm-4"></div>
				<div class="col-sm-4">
					<h5 class="card-title text-center">EL INGRESO RESTRINGIDO SOLO PERSONAL ADMINISTRATIVO </h5>
					<div class="card col-sm-12" style="width: auto;">
						<div class="card-body">
							<h5 class="card-title text-center">Ingresar al Sistema</h5>
							<hr>
							<p class="card-text text-center">Para Acceder al sistema necesitas ingresar tus credenciales.</p>
							<hr>
							<form method="POST" action="<?= ACTI.$action; ?>">
								<div class="form-group">
									<label for="exampleInputEmail1">Usuario o Correo</label>
									<input type="text" class="form-control" name="user" required="required">
								</div>
								<div class="form-group">
									<label for="exampleInputPassword1">Contraseña</label>
									<input type="password" class="form-control" id="pass" name="pass" required="required">
								</div>
								<div class="form-group form-check">
									<div class="icheck-primary">
										<input type="checkbox" id="ver_pass" onchange="document.getElementById('pass').type = this.checked ? 'text' : 'password'">
										<label for="ver_pass">Ver contraseña</label>
									</div>
								</div>
								<?php if (isset($_SESSION['sms'])): ?>
									<div class="row">
										<div class="col-sm-12 text-center">
											<p class="text-alert alert-warning">
												<?= $_SESSION['sms']; ?>
											</p>
										</div>
									</div>
								<?php endif ?>
								<div class="row">
									<div class="col-sm-12 pb-3">
										<button type="submit" name="entrar_pg" class="btn btn-success btn-block">Entrar <i class="fas fa-sign-in-alt"></i></button>
										<!--<div class="btn-group btn-block" role="group">
											<button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												Ingresar <i class="fas fa-sign-in-alt"></i>
											</button>
											<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
												<button type="submit" name="entrar_pg" class="dropdown-item">PostgreSQL</button>
												<hr>
												<button type="submit" name="entrar_my" class="dropdown-item">Mysql</button>
											</div>
										</div>-->
									</div>
									<hr>
									<div class="col-sm-12">
										<a href="<?= URL; ?>catalogo/" class="btn btn-info btn-block">Ver Catálogo de Productos <i class="fas fa-eye"></i></a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-sm-4"></div>
			</div>
		</div>
	</section>

	<?php include_once($rut.'java.php'); ?>
</body>
</html>
<?php
	if (isset($_SESSION['sms'])) {
		unset($_SESSION['sms']);
	}
?>