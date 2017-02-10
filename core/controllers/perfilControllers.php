<?php

  if(isset($_GET['id']) and array_key_exists($_GET['id'], $usuarios)){
    $id_usuario= $_GET['id'];

    $db= new Datos_modelo();
    $sql= "SELECT COUNT(id) FROM temas WHERE id_dueno='$id_usuario'";
    $temas_usuario= $db->contar($sql);
    
    include('html/perfil/perfil.php');
    $query= null;
    $db->close();
  }
  else {
    header('location: ?view=index');
  }



?>
