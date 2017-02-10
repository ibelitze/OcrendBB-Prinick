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


        <div class="alert alert-dismissible alert-success">
          <strong>LISTO!</strong> Tu contraseña ha sido modificada correctamente.<br>
          <p>Se ha generado una nueva contraseña para tí: </p><br><strong><?php echo $password; ?></strong><br><br>
          <p>Prueba iniciar sesión con tu nueva contraseña.</p><br>
          <a class="btn btn-primary" data-toggle="modal" data-target="#Login">INICIAR SESIÓN</a> Y podrás cambiarla nuevamente una vez que estés logueado.
        </div>


      </div>
    </section>








<?php
  include(HTML_DIR. 'overall/footer.php');
?>

</body>
</html>
