<?php

  function Categorias(){

    $db= new Datos_modelo();
    $sql= "SELECT * FROM categorias";
    $query= $db->get_datos($sql);


    $db->close();
    return $query;
  }


?>
