<?php
	session_start();
	$rut='../../';
	$pagina='Informes';
	$singlr='Informe';
	$action='informes.php';
	$cod_pg=3;
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

		if(isset($_SESSION['listarSal'])){ $inf2=$_SESSION['listarSal']; unset($_SESSION['listarSal']); }else{ $inf2=null; }	
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
                    <!--<button type="button" class="text-right btn btn-icon btn-primary" data-toggle="modal" data-target="#nuevo">
                        <i class="fa fa-plus"></i> Nuevo <?= $singlr; ?>
                    </button>-->
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
					<div class="card card-primary card-tabs">
						<div class="card-header p-0 pt-1">
							<ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="false">Ingresos</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Salidas</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="custom-tabs-one-tabContent">
								<div class="tab-pane active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
				                    <div id="div1" class="col-sm-12">
				                        <table id="example1" class="dataTable table table-bordered table-hover">
				                            <?php
				                                echo $inf;
				                                $inf=null;
				                            ?>
				                        </table>
				                    </div> 
								</div>
								<div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">
				                    <div id="div2" class="col-sm-12">
				                        <table id="example2" class="dataTable table table-bordered table-hover">
				                            <?php
				                                echo $inf2;
				                                $inf2=null;
				                            ?>
				                        </table>
				                    </div> 
								</div>
							</div>
						</div>
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
	                  <label for="exampleInputEmail1">Nombre del Producto</label>
	                  <input type="text" class="form-control" name="nombre_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Tipo</label>
	                  <input type="text" class="form-control" name="tipo_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Fecha de Vencimiento</label>
	                  <input type="date" class="form-control" name="fechav_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputPassword1">Costo</label>
	                  <input type="number" class="form-control" step="0.01" name="costo_p" required="required">
	                </div>	          
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Descripción del Producto</label>
	                  <textarea class="form-control ckeditor" name="descripcion_p" required="required"></textarea>
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Marca</label>
	                  <input type="text" class="form-control" name="marca_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Modelo</label>
	                  <input type="text" class="form-control" name="modelo_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Peso</label>
	                  <input type="number" class="form-control" step="0.01" name="peso" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Unidad de Medida</label>
	                  <input type="text" class="form-control" name="unimedida_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">cantidad</label>
	                  <input type="number" class="form-control" name="cantidad_p" required="required">
	                </div>
	                <div class="form-group">
	                  <label for="exampleInputEmail1">Foto de Portada</label>
	                  <input type="file" class="form-control" name="foto1_p" required="required">
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

</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>
