<?php

require('core/core.php');

//Este index es el encargado de redireccionar y conectar todos los controladores y sus vistas

  if(isset($_GET['view']) ) {

    if(file_exists('core/controllers/' . strtolower($_GET['view']) . 'Controllers.php')){

      include('core/controllers/' . strtolower($_GET['view']) . 'Controllers.php');

    }
    else {
      include('core/controllers/errorControllers.php');
    }
  }
  else {
    include('core/controllers/indexControllers.php');
  }


?>
