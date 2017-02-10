<?php

  if(!isset($_SESSION['app_id']) and isset($_GET['key'])){


    $db= new Datos_modelo();
    $keypass= $_GET['key'];

    $sql= "SELECT id,newpass FROM usuarios WHERE keypass='$keypass' LIMIT 1";
    $query= $db->get_1datos($sql);

    if($query['newpass'] != null ){

      $id= $query['id'];
      $new_pass= md5($query['newpass']);
      $password= $query['newpass'];
      $sql2= "UPDATE usuarios SET keypass='', newpass='', pass='$new_pass' WHERE id='$id'";
      $query2= $db->insertar($sql2);

      include('html/lostpass_mensaje.php');

    }
    else {
      header('location: ../index.php?view=index');
    }


    $db=null;
    $query=null;
    $sql=null;
    $sql2=null;
  }
  else {
    header('location: ../index.php?view=index');
  }





?>
