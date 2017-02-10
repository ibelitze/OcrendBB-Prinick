<?php

function OnlineUsers() {
  //si el usuario está logueado...
  if(isset($_SESSION['app_id'])) {
    $id_usuario = $_SESSION['app_id'];

    //Si ya ha pasado más de 5min el usuario logueado...
    if(time() >= ($_SESSION['time_online'] + (60*3))) {

      //se saca el tiempo actual y se actualiza en la variable de sesión y de usuarios (variable global)
      $time = time();
      $_SESSION['time_online'] = $time;
      $usuarios[$id_usuario]['ultima_conexion'] = $time;

      //También se actualiza en la base de datos
      $db = new Datos_modelo();
      $sql="UPDATE usuarios SET ultima_conexion='$time' WHERE id='$id_usuario' LIMIT 1";
      $sql2= "UPDATE config SET timer= '$time' WHERE id=1";
      $query= $db->insertar($sql);
      $query2= $db->insertar($sql2);
      $db->close();

    }
  }
}

?>
