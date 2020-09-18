<?php
	session_start();
	$rut='../../';
	$pagina='Productos';
	$singlr='Producto';
	$action='productos.php';
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
<!-------------->
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
                            <div id="texto_Cant"></div>
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
            //document.getElementById("texto_Cant").innerHTML = '<label for="recipient-name" class="col-form-label">Tenga en cuenta que Actualmente existen <b>'+infor[1]+'</b> Unidades de este Producto</label>';
        }
    </script>

</body>
</html>
<?php if (isset($_SESSION['sms'])) {
	unset($_SESSION['sms']);
} ?>
