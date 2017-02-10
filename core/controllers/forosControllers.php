<?php

    if(isset($_GET['id']) and is_numeric($_GET['id']) and $_GET['id'] >= 1){

          $id_foro= intval($_GET['id']);
          $hay=0;
          $estado= $foro[$id_foro]['estado'];

            if(key_exists($id_foro, $foros)){
                $hay= 1;
            }


          // si de verdad existe el foro, entonces podemos sacar de la base de datos con seguridad
          if($hay != 0){
            $db= new Datos_modelo();
            $sql_anuncios= "SELECT * FROM temas WHERE id_foro= '$id_foro' AND tipo= 2 ORDER BY id DESC";
            $sql_no_anuncios= "SELECT * FROM temas WHERE id_foro= '$id_foro' AND tipo= 1 ORDER BY id DESC";
            $anuncios= $db->get_datos($sql_anuncios);
            $no_anuncios= $db->get_datos($sql_no_anuncios);
            include('html/temas/temas.php');
          }
          else {
           header('location: index.php?view=error');
          }



          //Cerramos la conexión
          $db=null;
          $query=null;
    }
    else {
      header('location: index.php?view=index');
    }


?>
