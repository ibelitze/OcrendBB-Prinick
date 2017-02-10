<?php

  //Deslogueamos al usuario
  unset($_SESSION['app_id']);
  unset($_SESSION['app_usuario']);
  unset($_SESSION['cantidad_usuarios']);
  unset($_SESSION['usuarios']); 

  //Redireccionamos
  header('location: index.php?view=index');

?>
