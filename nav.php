	<header>
		<nav class="navbar navbar-expand-lg " style="background-color: #C2D1F0
; color: black !important;">
			<a style=  "margin-left: 62px" class="navbar-brand" href="<?= HOME; ?>"> <img src="<?= IMG; ?>logo.png" style="max-width: 120px;"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>

			<div class="collapse navbar-collapse" id="navbarColor02" style=  "margin-left: 90px">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item <?php if($cod_pg==1){ echo 'active'; } ?>">
						<a class="nav-link h5.5" style=  "margin-left: 60px"  href="<?= HOME; ?>"><b>Inicio</b> <span class="sr-only">(current)</span></a>
					</li>
					<?php if ($rid==1 || $rid==2) { ?>
						<li class="nav-item <?php if($cod_pg==2){ echo 'active'; } ?>">
							<a class="nav-link h5.5" href="<?= HOME; ?>usuarios/"><b>Usuarios</b></a>
						</li>
					<?php } ?>
					<li class="nav-item <?php if($cod_pg==3){ echo 'active'; } ?>">
						<a class="nav-link h5.5" href="<?= HOME; ?>productos/"><b>Productos</b></a>
					</li>
					<li class="nav-item <?php if($cod_pg==4){ echo 'active'; } ?>">
						<a class="nav-link h5.5" href="<?= HOME; ?>proveedores/"><b>Proveedores</b></a>
					</li>
					<li class="nav-item <?php if($cod_pg==6){ echo 'active'; } ?>">
						<a class="nav-link h5.5 " href="<?= HOME; ?>stock-producto/"><b>Stock Producto</b></a>
					</li>
					<li class="nav-item <?php if($cod_pg==9){ echo 'active'; } ?>">
						<a class="nav-link h5.5"  href="<?= HOME; ?>informes/"><b>Informes</b></a>
					</li>
					<li class="nav-item <?php if($cod_pg==9){ echo 'active'; } ?>">
						<a class="nav-link h5.5"  href="<?= URL; ?>catalogo/" target="_blank"><b>Ver Catálogo</b></a>
					</li>
					<li class="nav-item">
						<a class="nav-link h5.5"  text-danger href="<?= ACTI; ?>exit.php"><b>Cerrar Session</b> <i class="fas fa-sign-out-alt"></i></a>
					</li>
				</ul>
				<!--<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
				</form>-->
			</div>
		</nav>
	</header>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb" >
			<?php if ($niv2): ?>
				<li class="breadcrumb-item"><a href="<?= HOME; ?>">Início</a></li>
			<?php endif ?>
			<?php if ($deta){ ?>
				<li class="breadcrumb-item" ><a href="../"><?= $padre; ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><?= $pagina; ?></li>
			<?php }else{ ?>
				<li class="breadcrumb-item active" aria-current="page"><?= $pagina; ?></li>
			<?php } ?>
		</ol>
	</nav>

