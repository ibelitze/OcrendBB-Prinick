<?php

  function aumentarVisitas($id){
    $db= new Datos_modelo();
    $sql="UPDATE temas SET visitas=visitas+1 WHERE id='$id' LIMIT 1";
    $query= $db->insertar($sql);
    $db->close();
  }




?>
