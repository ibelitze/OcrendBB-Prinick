<?php

  if($_POST){

  //Añadimos el core, y allí está incluida la conexión con sus clases
    require('core/core.php');



    switch (isset($_GET['mode'])? $_GET['mode'] : null) {

      case 'login':

          require('core/bin/ajax/goLogin.php');

        break;

      case 'reg':

          require('core/bin/ajax/goReg.php');

        break;

      case 'lostpass':

          require('core/bin/ajax/goLostpass.php');

        break;

      //Si la variable es nula, simplemente redirecciona.
      default:
        header("locacion: index.php");
        break;
    }

  }

  else {
    header("locacion: index.php");
  }



?>
