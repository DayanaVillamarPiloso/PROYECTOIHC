<?php
  session_start();
  $rut='./';
  $pagina='Registrarme';
  $action='registro.php';
  require_once($rut.'constant.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <title><?= $pagina.TIT; ?></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="imagen/png" href="<?= IMG; ?>favicon.ico">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="<?= $rut; ?>style.css">
  <?php
    $inf = null;
    require_once($rut.DIRACT.$action);
    $inf = index();
  ?>
</head>
<body>
  <section class="container pt-4 mt-4">
    <div class="container pt-4 mt-4">
      <div class="row">
        <div class="col-sm-4"></div>
        <div class="col-sm-4">
          <div class="card col-sm-12" style="width: auto;">
            <div class="card-body">
              <h5 class="card-title text-center">Ingresar al Sistema</h5>
              <hr>
              <p class="card-text text-center">Para Acceder al sistema necesitas ingresar tus credenciales.</p>
              <hr>
              <form method="POST" action="<?= ACTI.$action; ?>" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tipo de Usuarios</label>
                  <select class="form-control" name="id_tipo" required="required">
                    <?php
                      echo $inf;
                      $inf = null;
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombres y Apellidos</label>
                  <input type="text" class="form-control" name="nombre_u" value="<?= $_SERVER['DOCUMENT_ROOT']; ?>" required="required">
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
                    <button type="submit" name="registro" class="btn btn-success btn-block">Registrarme</button>
                  </div>
                  <hr>
                  <div class="col-sm-12">
                    <a href="<?= URL; ?>" class="btn btn-warning btn-block">Ingresar</a>
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
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/9ffe9c42e9.js" crossorigin="anonymous"></script>
</body>
</html>
<?php
  if (isset($_SESSION['sms'])) {
    unset($_SESSION['sms']);
  }
?>