<?php

  if(isset($_SESSION['app_id']) and $usuarios[$_SESSION['app_id']]['permisos'] >= 2) {

      $isset_id= isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
      require_once('core/models/classConfigForos.php');
      $config_foro= new ConfigForos();


      switch (isset($_GET['mode']) ?  $_GET['mode']: null) {
  //------------------------------------------------------------------------------
        case 'agregar':

            if($_POST){
              $config_foro->Add();
            }
            else {
              include(HTML_DIR . 'foros/add.foros.php');
            }

          break;
  //------------------------------------------------------------------------------
        case 'editar':

            if($isset_id){

                if($_POST){
                  $config_foro->Edit();
                }
                else {
                  include(HTML_DIR . 'foros/edit.foros.php');
                }
              } else {
                header('location: ?view=configforos');
              }


          break;
  //------------------------------------------------------------------------------
        case 'borrar':

            if($isset_id){

              $config_foro->Delete();
            }
            else {
              header('location: ?view=configforos');
            }

          break;
  //------------------------------------------------------------------------------
        default:

            include(HTML_DIR . 'foros/all.foros.php');

          break;
      }


  }
  else {
    header('location: ../index.php?view=index');
  }




?>
