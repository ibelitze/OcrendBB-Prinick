<?php

  require_once('core/models/classTemas.php');
  $mode=isset($_GET['mode'])? $_GET['mode'] : null;

  //---------------------------------------------------------------------------
        //ES IMPORTANTE RECIBIR EL ID_FORO PARA PODER CONTINUAR CON TODO..

  if(isset($_GET['id_foro']) and is_numeric($_GET['id_foro']) and $_GET['id_foro'] >= 1){

    //nos aseguramos que el id_foro exista dentro del array de todos los foros en la BD
      $id_foro= intval($_GET['id_foro']);

      if(!array_key_exists($id_foro, $foros)){
        $foro_existe= false;
        header('location: ../index.php?view=index');
        exit;
      }
      else {
        $foro_existe= true;
      }

      //nos aseguramos que el usuario esté logueado, que el id por GET exista, que el id del tema exista...
      $loged= isset($_SESSION['app_id']);
      $isset_id= isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1;
      $id_tema= intval($_GET['id']);

      //Comprobación de que el usuario esté logueado, que el foro esté abierto (o que sea un administrador haciendo modificaciones)
        if($loged){
          $cerrado= $foros[$id_foro]['estado']== 1 or $usuarios[$_SESSION['app_id']]['permisos'] == 2;
        }else {
          $cerrado=false;
        }
      //Creamos la conexión
      $temas= new Temas();

//------------------------------------------------------------------------------

      switch ($mode) {

        case 'crear':

          if($loged and $cerrado and $foro_existe){

            if($_POST){
              $temas->crear();
            }
            else {
              include('html/temas/add.temas.php');
            }
          }
          else{
            header('location: ../index.php?view=index');
          }

        break;

    //-----------------------------------------------------------------------------------
        case 'editar':

          if($isset_id and $loged){

              $resul_temas= $temas->checkTema();
              if($resul_temas != false){
                if($_POST){
                  $temas->editar();
                }
                else{
                  include('html/temas/editar.tema.php');
                }
              }
              else {
                header('location: ../index.php?view=index');
              }
          }
          else {
            header('location: index.php?view=index');
          }

        break;
    //-----------------------------------------------------------------------------------

        case 'responder':

        if($isset_id and $loged){

            $resul_temas= $temas->checkTema();
            if($resul_temas != false){
              //Si el tema existe pero está cerrado hay que rebotar al index...
              if($resul_temas['estado'] == 0){
                  header('location: index.php?view=index');
              }
              if($_POST){
                $temas->responder();
              }
              else{
                include('html/temas/responder.php');
              }
            }
            else {
              header('location: index.php?view=index');
            }
        }
        else {
          header('location: index.php?view=index');
        }
        break;

    //-----------------------------------------------------------------------------------
        case 'convertir':

            if($isset_id and $loged){
              $temas->convertir();
            }
            else {
              header('location: index.php?view=index');
            }

        break;

    //-----------------------------------------------------------------------------------
        case 'borrar':

            if($isset_id and $loged){
              $temas->borrar();
            }
            else {
              header('location: ../index.php?view=index');
            }

          break;

    //-----------------------------------------------------------------------------------
        case 'cerrar':

          if($isset_id and $loged and isset($_GET['estado']) and in_array($_GET['estado'],[0,1]) ){
            $estado= intval($_GET['estado']);
            $temas->cerrarAbrir($estado);
          }
          else {
            header('location: ../index.php?view=index');
          }

        break;


    //-----------------------------------------------------------------------------------
        default:

            if($isset_id){

              $resul_temas= $temas->checkTema();
                if($resul_temas != false){

                  $respuestas= $temas->GetRespuestas();
                  aumentarVisitas($id_tema);
                  include('html/temas/ver.temas.php');
                }
                else {
                  header('location: ../index.php?view=index');
                }
            }
            else {
              header('location: ../index.php?view=index');
            }
          break;

      }// FIN DE SWITCH


  }
  else {
    //Hay un peo aquí con las url, así que todo depende de si hay $mode o NO en el url
      if($mode == null){
        header('location: ../index.php?view=index');
      }
      else {
        header('location: index.php?view=index');
      }

  }


?>
