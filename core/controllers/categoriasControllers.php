<?php

  if(isset($_SESSION['app_id']) and $usuarios[$_SESSION['app_id']]['permisos'] >= 2) {

    $isset_id= isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
    require_once('core/models/classCategorias.php');
    $categorias= new Categorias();

    switch (isset($_GET['mode']) ?  $_GET['mode']: null) {
//------------------------------------------------------------------------------
      case 'agregar':

          if($_POST){
            $categorias->Add();
          }
          else {
            include(HTML_DIR . 'categorias/add.categoria.php');
          }

        break;
//------------------------------------------------------------------------------
      case 'editar':

          if($isset_id){

              if($_POST){
                $categorias->Edit();
              }
              else {
                include(HTML_DIR . 'categorias/edit.categoria.php');
              }
            } else {
              header('location: ?view=categorias');
            }


        break;
//------------------------------------------------------------------------------
      case 'borrar':

          if($isset_id){

            $categorias->Delete();
          }
          else {
            header('location: ?view=categorias');
          }

        break;
//------------------------------------------------------------------------------
      default:

          $db= new Datos_modelo();
          $sql= "SELECT * FROM categorias";
          $datos= $db->get_datos($sql);

          /*$query ya está fetcheado, hay que ver cómo acomodamos la variable en el html
          para que se muestre bien*/
          include(HTML_DIR . 'categorias/all.categoria.php');

        break;
    }

  }
  else {
    header('location: ../index.php?view=index');
  }


?>
