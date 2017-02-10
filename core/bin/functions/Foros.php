<?php

  function Foros(){

    $conexion= new PDO('mysql:host=localhost; dbname=ocrendbb', 'root', 'iz171089');
    $consulta= "SELECT * FROM foros";
    $sql= $conexion->query($consulta);


    //Si la consulta no es nula o vacía:
    if($sql != null){
        //Tenemos que recorrer todo el array de resultados:
        while($resul= $sql->fetch(PDO::FETCH_ASSOC))
          { //Hacemos un array de 2 dimensiones:
            $foros[$resul[id]]= array(
            'nombre' => $resul[nombre],
            'descripcion'=> $resul[descripcion],
            'cantidad_temas' => $resul[cantidad_temas],
            'id_categoria' => $resul[id_categoria],
            'estado' => $resul[estado],
            'ultimo_tema' => $resul[ultimo_tema],
            'id_ultimo_tema' => $resul[id_ultimo_tema]
              );
          }

    }
    else {
      $foros= false;
    }

    $conexion=null;
    return $foros;
  }


?>
