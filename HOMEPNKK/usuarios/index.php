<?php
	session_start();
	$rut='../../';
	$pagina='Usuarios';
	$singlr='Usuario';
	$action='usuarios.php';
	$cod_pg=2;
	require_once($rut.'config.php');
	require_once($rut.'permisos/sa.php');
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
                    <h3>Lista de <?= $pagina; ?></h3>
                </div>
                <div class="col-sm-4 text-right">
                    <button type="button" class="text-right btn btn-icon btn-primary" data-toggle="modal" data-target="#nuevo">
                        <i class="fa fa-plus"></i> Nuevo <?= $singlr; ?>
                    </button>
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
                    <div id="div1" class="col-sm-12">
                        <table id="example1" class="dataTable table table-bordered table-hover">
                            <?php
                                echo $inf;
                                $inf=null;
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
	</section>

	<?php include_once($rut.'java.php'); ?>

	<div class="modal fade" id="nuevo" tabindex="-1" aria-labelledby="nuevoLabel" aria-hidden="true">
	  <div class="modal-dialog">
	    <div class="modal-content">
	    	<form method="POST" action="<?= ACTI.$action; ?>" enctype="multipart/form-data">
		      <div class="modal-header">
		        <h5 class="modal-title" id="nuevoLabel">Nuevo <?= $singlr; ?></h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        	<div class="form-group">
	                  <label for="exampleInputEmail1">Tipo de Usuarios</label>
	                  <select class="form-control" name="id_tipo" required="required">
	                    <?php
	                      echo $cboTU;
	                      $cboTU = null;
	                    ?>
	                  </select>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Nombres y Apellidos</label>
	                  <input type="text" class="form-control" name="nombre_u" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Usuario</label>
	                  <input type="text" class="form-control" name="usuario_u" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Correo</label>
	                  <input type="email" class="form-control" name="correo_u" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputPassword1">Contraseña</label>
	                  <input type="password" class="form-control" id="pass" name="contra_u" required="required">
	                </div>
	                <div class="form-group form-check">
	                  <div class="icheck-primary">
	                    <input type="checkbox" id="ver_pass" onchange="document.getElementById('pass').type = this.checked ? 'text' : 'password'">
	                    <label for="ver_pass">Ver contraseña</label>
	                  </div>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Foto</label>
	                  <input type="file" class="form-control" name="foto_u">
	                </div>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		        <button type="submit" name="nuevo" class="btn btn-primary">Guardar <i class="fas fa-save"></i></button>
		      </div>
		    </form>
	    </div>
	  </div>
	</div>
    <!-- Large modal -->
    <div id="eliminar" class="modal fade bd-example-modal-lg" tabindex="-1" tipoe="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="background-color: red;color: #fff;">
                <form method="POST" enctype="multipart/form-data" action="<?= ACTI.$action; ?>">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">¿Está seguro de elimniar el registro?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Una vez eliminado el registro no podrá ser utilizado.<br>Esto podría causar daños en el sistema. Ya que todas las tablas se encuentran vinculadas entre sí.</label>
                            <input type="hidden" class="form-control" id="dropid" name="id">
                            <input type="hidden" name="id_drop" value="<?= base64_encode($uid); ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-dismiss="modal">Cancelar</button>
                        <button type="submit" name="drop" class="btn btn-primary">Eliminar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function eliminar(datos){
            var infor=datos.split("||");

            $('#dropid').val(infor[0]);
        }
    </script>
</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>