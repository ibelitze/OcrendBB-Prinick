<section class="mbr-navbar mbr-navbar--freeze mbr-navbar--absolute mbr-navbar--sticky mbr-navbar--auto-collapse" id="ext_menu-0">
    <div class="mbr-navbar__section mbr-section">
        <div class="mbr-section__container container">
            <div class="mbr-navbar__container">
                <div class="mbr-navbar__column mbr-navbar__column--s mbr-navbar__brand">
                    <span class="mbr-navbar__brand-link mbr-brand mbr-brand--inline">
                        <span class="mbr-brand__logo"><a href="#"><img class="mbr-navbar__brand-img mbr-brand__img" src="views/images/logo.png" alt="Mobirise"></a></span>
                    </span>
                </div>
                <div class="mbr-navbar__hamburger mbr-hamburger text-white"><span class="mbr-hamburger__line"></span></div>
                <div class="mbr-navbar__column mbr-navbar__menu">
                    <nav class="mbr-navbar__menu-box mbr-navbar__menu-box--inline-right">
                        <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-decorator mbr-buttons--active"><li class="mbr-navbar__item">
                          <a class="mbr-buttons__link btn text-white" href="#">INICIO</a></li><li class="mbr-navbar__item">

                            <!--Si no hay usuario Logueado, hay que pedirle que se loguee añadiendo los botones:-->
                          <?php
                              if(!isset($_SESSION['app_id'])){
                                  echo '<a class="mbr-buttons__link btn text-white" data-toggle="modal" data-target="#Login">INICIAR SESIÓN</a></li><li class="mbr-navbar__item">
                                 <div class="mbr-navbar__column"><ul class="mbr-navbar__items mbr-navbar__items--right mbr-buttons mbr-buttons--freeze mbr-buttons--right btn-inverse mbr-buttons--active"><li class="mbr-navbar__item"><a class="mbr-buttons__btn btn btn-danger" data-toggle="modal" data-target="#Registro">REGISTRO</a></li></ul></div>
                                ';
                              }
                              else{
                                echo '<a class="mbr-buttons__link btn text-white" href="?view=perfil&id='.$_SESSION['app_id'].'">'. $_SESSION[app_usuario] .'</a></li><li class="mbr-navbar__item">';
                                echo '<a class="mbr-buttons__link btn text-white" href="?view=cuenta">MI PERFIL</a></li><li class="mbr-navbar__item">';
                                echo '<a class="mbr-buttons__link btn text-white" href="?view=logout">CERRAR SESIÓN</a></li><li class="mbr-navbar__item">';
                              }
                          ?>

                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
  //Si no hay un usuario Logueado, se añade el login y el registro de usuario:
  if(!isset($_SESSION['app_id'])){
    include(HTML_DIR . 'public/login.html');
    include(HTML_DIR . 'public/reg.html');
    include(HTML_DIR . 'public/lostpass.html');
  }

?>
