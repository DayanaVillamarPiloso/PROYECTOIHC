<?php
    session_start();
    $rut='../../';
    $padre='Catálogo de Productos';
    $pagina='Detalle del Producto';
    $action='catalogo.php';
    require_once($rut.'constant.php');

    if (isset($_REQUEST['p'])) {
        $pid=base64_decode($_REQUEST['p']);
    }else{
        header("Location: ../");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include_once($rut.'catalogo/css.php'); ?>

    <?php
        $inf=null;
        
        require_once($rut.DIRACT.$action);
        $inf = detalle($rut,$pid);

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
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
        <?php require_once($rut.'catalogo/nav.php'); ?>
    <!-- Header Section End -->

    <!-- Product Section Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="<?= URLC; ?>"><i class="fa fa-home"></i> Catálogo</a>
                        <a href="#"><?= $tipo_p; ?> </a>
                        <span><?= $nombre_p; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            <a class="pt active" href="#product-1">
                                <img src="<?= IMG.$foto1_p; ?>" alt="">
                            </a>
                            <?php if (strlen($foto2_p) > 5): ?>
                                <a class="pt" href="#product-2">
                                    <img src="<?= IMG.$foto2_p; ?>" alt="">
                                </a>
                            <?php endif ?>
                            <?php if (strlen($foto3_p) > 5): ?>
                                <a class="pt" href="#product-3">
                                    <img src="<?= IMG.$foto3_p; ?>" alt="">
                                </a>
                            <?php endif ?>
                            <?php if (strlen($foto4_p) > 5): ?>
                                <a class="pt" href="#product-4">
                                    <img src="<?= IMG.$foto4_p; ?>" alt="">
                                </a>
                            <?php endif ?>
                            <?php if (strlen($foto5_p) > 5): ?>
                                <a class="pt" href="#product-5">
                                    <img src="<?= IMG.$foto5_p; ?>" alt="">
                                </a>
                            <?php endif ?>
                        </div>
                        <div class="product__details__slider__content">
                            <div class="product__details__pic__slider owl-carousel">
                                <img data-hash="product-1" class="product__big__img" src="<?= IMG.$foto1_p; ?>" alt="">
                                <?php if (strlen($foto2_p) > 5): ?>
                                    <img data-hash="product-2" class="product__big__img" src="<?= IMG.$foto2_p; ?>" alt="">
                                <?php endif ?>
                                <?php if (strlen($foto3_p) > 5): ?>
                                    <img data-hash="product-3" class="product__big__img" src="<?= IMG.$foto3_p; ?>" alt="">
                                <?php endif ?>
                                <?php if (strlen($foto4_p) > 5): ?>
                                    <img data-hash="product-4" class="product__big__img" src="<?= IMG.$foto4_p; ?>" alt="">
                                <?php endif ?>
                                <?php if (strlen($foto5_p) > 5): ?>
                                    <img data-hash="product-5" class="product__big__img" src="<?= IMG.$foto5_p; ?>" alt="">
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product__details__text">
                        <h3><?= $nombre_p; ?> <span>Código: SKM</span></h3>
                        <!--<div class="rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <span>( 138 reviews )</span>
                        </div>-->
                        <div class="product__details__price">$ <?= $costo_p; ?> <span>$ <?= ($costo_p + 12.5); ?></span></div>
                        <!--<p>Nemo enim ipsam voluptatem quia aspernatur aut odit aut loret fugit, sed quia consequuntur
                        magni lores eos qui ratione voluptatem sequi nesciunt.</p>
                        <div class="product__details__button">
                            <div class="quantity">
                                <span>Quantity:</span>
                                <div class="pro-qty">
                                    <input type="text" value="1">
                                </div>
                            </div>
                            <a href="#" class="cart-btn"><span class="icon_bag_alt"></span> Add to cart</a>
                            <ul>
                                <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                <li><a href="#"><span class="icon_adjust-horiz"></span></a></li>
                            </ul>
                        </div>-->
                        <div class="product__details__widget">
                            <ul>
                                <li>
                                    <span>Disponivilidad:</span>
                                    <div class="stock__checkbox">
                                        <label for="stockin">
                                            Disponible
                                            <input type="checkbox" id="stockin" <?php if($cantidad_p>0){ echo 'checked="checked"'; } ?>>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </li>
                                <!--<li>
                                    <span>Available color:</span>
                                    <div class="color__checkbox">
                                        <label for="red">
                                            <input type="radio" name="color__radio" id="red" checked>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label for="black">
                                            <input type="radio" name="color__radio" id="black">
                                            <span class="checkmark black-bg"></span>
                                        </label>
                                        <label for="grey">
                                            <input type="radio" name="color__radio" id="grey">
                                            <span class="checkmark grey-bg"></span>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <span>Available size:</span>
                                    <div class="size__btn">
                                        <label for="xs-btn" class="active">
                                            <input type="radio" id="xs-btn">
                                            xs
                                        </label>
                                        <label for="s-btn">
                                            <input type="radio" id="s-btn">
                                            s
                                        </label>
                                        <label for="m-btn">
                                            <input type="radio" id="m-btn">
                                            m
                                        </label>
                                        <label for="l-btn">
                                            <input type="radio" id="l-btn">
                                            l
                                        </label>
                                    </div>
                                </li>-->
                                <li>
                                    <span>Promoción:</span>
                                    <p>Internet</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Descripción</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Especificaciones</a>
                            </li>
                            <!--<li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                            </li>-->
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Descripción</h6>
                                <?= $descripcion_p;?>
                            </div>
                            <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Especificaciones</h6>
                                <?= $descripcion_p;?>
                            </div>
                            <!--<div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( 2 )</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                quis, sem.</p>
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Footer Section Begin -->
        <?php require_once($rut.'catalogo/footer.php'); ?>
    <!-- Footer Section End -->

        <?php require_once($rut.'catalogo/java.php'); ?>
</body>

</html>