<?php include(HTML_DIR . 'overall/header.php'); ?>

<body>
<section class="engine"><a rel="nofollow" href="#"><?php echo APP_TITLE ?></a></section>

<?php include(HTML_DIR . '/overall/topnav.php'); ?>

<section class="mbr-section mbr-after-navbar">
<div class="mbr-section__container container mbr-section__container--isolated">

<div class="row container">


            <!-- BOTON DE RESPONDER Y DE CERRAR TEMA (PARA ADMINISTRADORES, O DUEÑO DEL TEMA) -->

  <?php
        $permisos_dueno= $usuarios[$_SESSION['app_id']]['permisos'] > 0 or $resul_temas['id_dueno'] == $_SESSION['app_id'];

        //Esto de abajo solo le saldrá al dueño del post, o a los administradores/admin
        if($permisos_dueno){

              if($resul_temas['estado'] == 1 ){
                  echo '<div class="pull-right">
                  <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                       <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=cerrar&id='. $_GET["id"] .'&id_foro='.$resul_temas['id_foro'].'&estado=0">CERRAR TEMA</a>
                   </li></ul></div>
                    </div>';
              }
              else if($resul_temas['estado'] == 0) {
                echo '<div class="pull-right">
                <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                     <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=cerrar&id='. $_GET["id"] .'&id_foro='.$resul_temas['id_foro'].'&estado=1">ABRIR TEMA</a>
                 </li></ul></div>
              </div>';
              }

              echo '<div class="pull-right">
              <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                   <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=borrar&id='. $_GET["id"] .'&id_foro='.$resul_temas['id_foro'].'">BORRAR TEMA</a>
               </li></ul></div>
            </div>';
        }
        //Esta condición de abajo se cumplirá cuando el foro o tema esté abierto, sin importar si el usuario es administrador o no..
        //lo que quiere decir que el botón de responder estará disponible para todos.
        if($resul_temas['estado'] == 1 ){
            echo '<div class="pull-right">
            <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item">
                 <a class="mbr-buttons__btn btn btn-danger" href="?view=temas&mode=responder&id='. $_GET["id"] .'&id_foro='.$resul_temas['id_foro'].'">RESPONDER</a>
            </li></ul></div>
            </div>';
          }
  ?>



    <ol class="breadcrumb">
      <li><a href="?view=index"><i class="fa fa-user"></i> Foro </a></li>
    </ol>
</div>

<div class="row categorias_con_foros">
  <div class="col-sm-12">
      <div class="row titulo_categoria"><?php echo $resul_temas['titulo']; ?></div>

      <div class="row cajas">
        <div class="col-md-2">
          <center>

            <img src="views/app/images/users/<?php echo $usuarios[$resul_temas['id_dueno']]['img'];?>" class="thumbnail" height="120" />
            <strong><?php echo $usuarios[$resul_temas['id_dueno']]['usuario']; ?></strong> <br/>
            <b><?php echo $usuarios[$resul_temas['id_dueno']]['rango']; ?></b> <br />
            <?php echo $usuarios[$resul_temas['id_dueno']]['edad']; ?> años<br />
            Registrado el <?php echo $usuarios[$resul_temas['id_dueno']]['fecha_registro']; ?>

          </center>

        </div>
        <div class="col-md-10">
          <blockquote>
            <?php echo BBcode($resul_temas['contenido']); ?>
          </blockquote>

          <?php
                  //BOTON PARA EDITAR EL TEMA (PARA ADMINISTRADORES O EL DUEÑO DEL POST)
              if($permisos_dueno){
                echo '<hr />
                <a class="btn btn-primary" href="index.php?view=temas&mode=editar&id='.$_GET['id'].'&id_foro='.$_GET['id_foro'].'">Editar tema</a><br>';
              }
          ?>

          <hr />
          <p>
            <?php echo BBcode($usuarios[$resul_temas['id_dueno']]['firma']); ?>
          </p>
        </div>
      </div>
  </div>
</div>

<?php
    if($respuestas != false){

      foreach($respuestas as $resp){

        echo       '<div class="row categorias_con_foros">
                <div class="col-sm-12">

                    <div class="row cajas">
                      <div class="col-md-2">
                        <center>

                          <img src="views/app/images/users/'. $usuarios[$resp["id_dueno"]]["img"] .'" class="thumbnail" height="120" />
                          <strong>'. $usuarios[$resp["id_dueno"]]["usuario"] .'</strong> <br/>
                          <b>'. $usuarios[$resp["id_dueno"]]["rango"] .'</b> <br />
                          '. $usuarios[$resp["id_dueno"]]["edad"] .' años<br />
                          Registrado el'. $usuarios[$resp["id_dueno"]]["fecha_registro"] .'

                        </center>

                      </div>
                      <div class="col-md-10">
                        <blockquote>
                          '. BBcode($resp['contenido']) .'
                        </blockquote>
                        <hr />
                        <p>
                          '. BBcode($usuarios[$resp["id_dueno"]]["firma"]) .'
                        </p>
                      </div>

                    </div>
                </div>
              </div>';
      }//Fin del foreach
    }//Fin del if

?>

</div>
</section>

<?php include(HTML_DIR . 'overall/footer.php'); ?>

</body>
</html>
