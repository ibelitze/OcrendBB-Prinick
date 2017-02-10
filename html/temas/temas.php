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

<?php      $boton = '<div class="pull-right">
     <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
       <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=crear&id_foro='.$id_foro.'">NUEVO TEMA</a>
     </li></ul></div>
   </div>';
    if(isset($_SESSION['app_id']) and ($foros[$id_foro]['estado'] == 1 or $usuarios[$_SESSION['app_id']]['permisos'] == 2)) {
     echo $boton;
    }
?>

        <ol class="breadcrumb">
          <li><a href="?view=index"><i class="fa fa-home"></i> Inicio</a></li>
          <li><a href="?view=index"><i class="fa fa-comment"></i> <?php echo $foros[$id_foro]['nombre'];  ?></a></li>
        </ol>
    </div>

    <!-- AQUI VAN LOS ANUNCIOS DEL FORO CORRESPONDIENTE -->

  <div class="row categorias_con_foros">
      <div class="col-md-12">
         <div class="row titulo_categoria">Anuncios</div>

         <!--_______ SI NO EXISTE NINGUN ANUNCIO DE ESE FORO EN LA BASE DE DATOS...________ -->
           <?php if($anuncios == null) {

               echo '
               <div class="row foros">
                 <div class="col-md-12" style="height:50px;line-height: 37px;">
                       No existe ningun anuncio por el momento.
                 </div>
               </div>';

           }
           //SI EXISTEN entonces se hace una query para buscar todos los anuncios de ese foro
               else {

                 //Hacemos un foreach de los anuncios que se encontraron en la base de datos
                 foreach($anuncios as $id => $link2) {
                   //Si el estado de dicho foro que contiene el anuncio está cerrado... entonces el icono es un candado
                   if($link2['estado'] == 1) {
                             $extension = '.png';
                           } else {
                             $extension = '_bloqueado.png';
                           }

                        echo '<div class="row foros">
                        <div class="col-md-1" style="height:50px;line-height: 30px;">
                            <img src="views/app/images/foros/anuncio_leido'.$extension.'" />
                            </div>
                            <div class="col-md-7 puntitos" style="line-height: 37px;">
                                   <a href="temas/'. UrlAmigable($link2['id'], $link2['titulo'], $link2['id_foro']) .'"> '. $link2['titulo'] .'</a><br/>
                                     '. $link2['descripcion'] .'
                            </div>
                            <div class="col-md-2 left_border" style="text-align: center;line-height: 37px;font-weight: bold;">
                                      '. $link2['visitas'] .'  Visitas,
                                      '. $link2['respuestas'] .'  Respuestas
                            </div>

                            <div class="col-md-2 left_border puntitos">
                                Por <a href="?view=perfil&id='.$link2['id_ultimo'].'">'. $usuarios[$link2['id_ultimo']]['usuario'] .'</a><br>
                                '. $link2['fecha_ultimo'] .'
                            </div> </div>';

                 }

              }

                 ?>

      </div>
  </div>


    <!-- AQUI VAN LOS TEMAS DEL FORO CORRESPONDIENTE -->


    <div class="row categorias_con_foros">
      <div class="col-md-12">
          <div class="row titulo_categoria">Foros</div>

          <!--_____ SI NO EXISTE NINGUN ANUNCIO DE ESE FORO EN LA BASE DE DATOS..._____ -->
            <?php if($no_anuncios == null) {

                echo '
                <div class="row foros">
                  <div class="col-md-12" style="height:50px;line-height: 37px;">
                        No existe ningun tema en el foro por el momento.
                  </div>
                </div>';

            }
            //SI EXISTEN entonces se hace una query para buscar todos los anuncios de ese foro
                else {

                  //Hacemos un foreach de los anuncios que se encontraron en la base de datos
                  foreach($no_anuncios as $id => $link2) {
                    //Si el estado de dicho foro que contiene el anuncio está cerrado... entonces el icono es un candado
                    if($link2['estado'] == 1) {
                              $extension = '.png';
                            } else {
                              $extension = '_bloqueado.png';
                            }

                         echo '<div class="row foros">
                         <div class="col-md-1" style="height:50px;line-height: 30px;">
                             <img src="views/app/images/foros/foro_leido'.$extension.'" />
                             </div>
                             <div class="col-md-7 puntitos" style="line-height: 37px;">
                                    <a href="temas/'. UrlAmigable($link2['id'], $link2['titulo'], $link2['id_foro']) .'"> '. $link2['titulo'] .'</a><br/>
                                      '. $link2['descripcion'] .'
                             </div>
                             <div class="col-md-2 left_border" style="text-align: center;line-height: 37px;font-weight: bold;">
                                       '. $link2['visitas'] .'  Visitas,
                                       '. $link2['respuestas'] .'  Respuestas
                             </div>

                             <div class="col-md-2 left_border puntitos">
                                 Por <a href="?view=perfil&id='.$link2['id_ultimo'].'">'. $usuarios[$link2['id_ultimo']]['usuario'] .'</a><br>
                                 '. $link2['fecha_ultimo'] .'
                             </div> </div>';

                  }

               }

              ?>

      </div>
    </div>


</div>
</section>



<?php
  include(HTML_DIR. 'overall/footer.php');
?>

</body>
</html>
