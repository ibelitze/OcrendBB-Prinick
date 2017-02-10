<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

  <?php

  if(isset($_GET['error'])) {

    if($_GET['error'] == 1){
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> el nombre o la descripción del foro no pueden estar vacíos.
      </div>';
    }
    else if($_GET['error'] == 2){
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> el título del tema debe contener más de '.MIN_TITULO_LONG.' caracteres.
      </div>';
    }
    else if($_GET['error'] == 3){
      echo '<div class="alert alert-dismissible alert-danger">
        <strong>Error!</strong></strong> el contenido del tema debe contener más de '.MIN_CONTENT_LONG.' caracteres.
      </div>';
    }


  }
  ?>

<div class="row container">

    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-tags"></i>Edición de Tema</a></li>
    </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria">Edición de tema en "<?php echo $foros[$id_foro]['nombre'];  ?>"</div>

      <div class="row cajas">
        <div class="col-md-9">
          <form class="form-horizontal" action="?view=temas&mode=editar&id_foro=<?php echo $id_foro; ?>&id=<?php echo $_GET['id']; ?>" method="POST" enctype="application/x-www-form-urlencoded">
            <fieldset>
              <div class="form-group">
                <label for="nombre" class="col-lg-2 control-label">Título:</label>
                <div class="col-lg-10">
                  <input type="text" class="form-control" maxlength="250" name="titulo" value="<?php echo $resul_temas['titulo']; ?>">
                </div>
                <label for="descripcion" class="col-lg-2 control-label">Contenido:</label>
                <div class="col-lg-10">
                  <textarea class="form-control tema_textarea" name="contenido"><?php echo $resul_temas['contenido']; ?></textarea>
                </div>

              </div>

                  <!-- SI EL USUARIO ES MODERADOR O ADMINISTRADOR, ENTONCES PUEDE EDITAR TEMAS COMO ANUNCIOS -->
              <?php if($usuarios[$_SESSION['app_id']]['permisos'] > 0 and $resul_temas['tipo'] == 1){

                    echo '<div class="form-group">
                      <div class="col-lg-10">
                        <label class="col-lg-4 control-label"><input type="checkbox" value="2" name="anuncio">Convertir tema en anuncio</label>
                      </div>
                    </div>';
                  }
                  else if($usuarios[$_SESSION['app_id']]['permisos'] > 0 and $resul_temas['tipo'] == 2){
                    echo '<div class="form-group">
                      <div class="col-lg-10">
                        <label class="col-lg-4 control-label"><input type="checkbox" value="1" name="anuncio">Convertir anuncio en tema</label>
                      </div>
                    </div>';
                  }
              ?>

              <br>
              <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                  <button type="reset" class="btn btn-default">Resetear</button>
                  <button type="submit" class="btn btn-primary">Editar</button>
                </div>
              </div>


            </fieldset>
          </form>

        </div>

        <!-- BBCODE PARA EL CONTENIDO -->
          <div class="col-md-3">
            <div class="resaltado_caja">
              <strong><center>BBCode</center></strong>
              <ul class="no_style_list">
                <li>[b]Negrita[/b]</li>
                <li>[i]Italic[/i]</li>
                <li>[u]Subrayado[/u]</li>
                <li>[s]Tachado[/s]</li>
                <li>[img]URL image[/img]</li>
                <li>[center]Centrar[/center]</li>
                <li>[h1]Titulo gigante[/h1]</li>
                <li>[h2]Titulo medianamete grande[/h2]</li>
                <li>[h3]Titulo mediano[/h3]</li>
                <li>[h4]Titulo normal[/h4]</li>
                <li>[h5]Titulo pequeño[/h5]</li>
                <li>[h6]Titulo muy pequeño[/h6]</li>
                <li>[quote]Cita[/quote]</li>
                <li>[size=20]Texto en 20px[/size]</li>
                <li>[url=URL LINK]Texto a hacer clic[/url]</li>
                <li>[font=Arial]Texto en arial[/font]</li>
                <li>[bgimage=URL IMAGEN]Texto donde habrá imagen de fondo[/bgimage]</li>
                <li>[color=red]Color Rojo[/color]</li>
                <li>[bgcolor=red]Color de fondo Rojo[/bgcolor]</li>
              </ul>
            </div>
          </div>

      </div>
  </div>
</div>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
