<?php

  if(isset($_GET['key'], $_SESSION['app_id'])) {

      $conexion= new Datos_modelo();
      $key= htmlentities(addslashes($_POST["key"]));
      $id= $_SESSION['app_id'];
      $sql= "SELECT id FROM usuarios WHERE id=$id AND keyreg=$key LIMIT 1";
      $resultado= $db->get_1datos($sql);

      if($resultado != null) {
          $query= "UPDATE usuarios SET activo='1', keyreg='' WHERE id=$id";
          $resul= $db->insertar();
          header("location: &success=true");
      }
      else {
          header("location: &error=true");
      }

      $conexion=null;

  }
  else {
    include('html/public/loguearte.php');
  }



?>
