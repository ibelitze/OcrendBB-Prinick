<?php
  include(HTML_DIR . 'overall/header.php');
?>
<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE; ?></a></section>


<?php
  include(HTML_DIR . 'overall/topnav.php');
?>


<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

 <!-- ERRORES O ALERTAS A MOSTRAR CUANDO UNA ACCIÓN SE EJECUTE -->
  <?php
  if(isset($_GET['success'])) {
    echo '<div class="alert alert-dismissible alert-success">
      <strong>Activado!</strong> tu usuario ha sido activado correctamente.
    </div>';
  }

  if(isset($_GET['error'])) {
    echo '<div class="alert alert-dismissible alert-danger">
      <strong>Error!</strong></strong> no se ha podido activar tu usuario.
    </div>';
  }
  ?>

<div class="row container">

  <!-- BOTONES DE PERMISOS PARA ADMINISTRADORES -->

  <?php
      if(isset($_SESSION['app_id']) and $usuarios[$_SESSION['app_id']]['permisos'] >= 2) {
        echo '
        <div class="pull-right">
          <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=configforos">GESTIONAR FOROS</a>
          </li></ul></div>
          <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
            <a class="mbr-buttons__btn btn btn-danger" href="?view=categorias">GESTIONAR CATEGORÍAS</a>
          </li></ul></div>
        </div>
        ';
      }
  ?>

    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
    </ol>
</div>

  <!--_______ SI NO EXISTE NINGUNA CATEGORÍA DE FOROS EN LA BASE DE DATOS...________ -->
    <?php if($categoria == null) {

        echo '<div class="row titulo_categoria">Categorías</div>
        <div class="row foros">
          <div class="col-md-12" style="height:50px;line-height: 37px;">
                No existe ninguna categoría o foros por el momento.
          </div>
        </div>';

    }
    //SI EXISTEN entonces se hace una query para buscar todos los foros de esas categorías
        else {
          $sql= "SELECT * FROM foros WHERE id_categoria=?";
          $preparar= $db->prepare($sql);
          $preparar->bindParam(1, $id_categoria);

    //Un foreach para recorrer todas las categorías y que se pongan en el index
          foreach($categoria as $id => $link) {
              $id_categoria= $link['id'];
              $preparar->execute();
              $resul= $preparar->fetchAll(PDO::FETCH_ASSOC);


    // NOMBRE DE LA CATEGORÍA
                echo '<div class="row categorias_con_foros">
                        <div class="col-sm-12">
                          <div class="row titulo_categoria"> '. $link['nombre'] . ' </div>';

    // SI NO HAY FOROS EN LA CATEGORÍA SE DEJA EL MENSAJE
                         if ($resul == null) {

                      echo ' <div class="row foros">
                              <div class="col-md-12" style="height:50px;line-height: 37px;">
                                    No existen foros en esta categoría
                              </div>
                          </div>';

                          }
    // AQUÍ VA EL FOREACH DE LOS FOROS, BAJO SU CORRESPONDIENTE CATEGORÍA

                         foreach($resul as $id => $link2) { ?>

                          <div class="row foros">
    <!-- se comprueba si el estado del foro esta abierto o cerrado, para poner el icono -->
                          <?php  if($link2['estado'] == 1) {
                                    $extension = '.png';
                                  } else {
                                    $extension = '_bloqueado.png';
                                  }
                        //Icono del estado del foro...
                              echo '<div class="col-md-1" style="height:50px;line-height: 37px;">
                                    <img src="views/app/images/foros/foro_leido'.$extension.'" />
                                  </div>';
                              //-------------------------------------------------------------------
                                if ($id_categoria){

                                    if($link2['ultimo_tema']== ''){
                                      $ultimo_tema= 'No hay temas.';
                                    }
                                    else {
                                      $ultimo_tema= '<a href="temas/'. UrlAmigable($link2['id_ultimo_tema'],$link2['ultimo_tema'], $link2['id']) .'">'.$link2['ultimo_tema'].'</a>';
                                    }
                              //------------------------------------------------------------------
                                    echo '  <div class="col-md-7 puntitos" style="padding-left: 0px;">
                                           <a href="foros/'. UrlAmigable($link2['id'],$link2['nombre'], null) .'"> '. $link2['nombre'] .'</a><br/>
                                             '. $link2['descripcion'] .'
                                    </div>

                                    <div class="col-md-2 left_border" style="text-align: center;font-weight: bold;">
                                              '. $link2['cantidad_temas'] .'  Temas 
                                    </div>

                                    <div class="col-md-2 left_border puntitos" style="line-height: 37px;">
                                        '.$ultimo_tema.'
                                    </div>
                                    </div>';

                                  }

                              }

                          }
                                  ?>
                    </div>
                </div>

          <?php  }  ?>


</div>
</section>



<?php
  include(HTML_DIR. 'overall/footer.php');
?>

</body>
</html>
