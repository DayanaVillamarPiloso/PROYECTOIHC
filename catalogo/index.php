<?php
    session_start();
    $rut='../';
    $pagina='Catálogo de Productos';
    $action='catalogo.php';
    require_once($rut.'constant.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once($rut.'catalogo/css.php'); ?>

    <?php
        $inf=null;
        
        require_once($rut.DIRACT.$action);
        $inf = index($rut);

        if (isset($_SESSION['cuerpo_List'])) {
            $inf2= $_SESSION['cuerpo_List']; unset($_SESSION['cuerpo_List']);
        }else{
            $inf2=null;
        }
    ?>
</head>
<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
        <?php require_once($rut.'catalogo/nav.php'); ?>
    <!-- Header Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>Productos</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <?php echo $inf; $inf=null; ?>
                </div>
            </div>
            <div class="row property__gallery">
                <?php
                    echo $inf2; $inf2=null;
                ?>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <!-- Banner Section End -->

    <!-- Footer Section Begin -->
        <?php require_once($rut.'catalogo/footer.php'); ?>
    <!-- Footer Section End -->

        <?php require_once($rut.'catalogo/java.php'); ?>
</body>

</html>