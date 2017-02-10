<?php
  require_once('core/models/classDatos.php');
  //Función para optener todos los usuarios de la base de datos:
    function usuarios(){

        $usuarios_actuales= 0;
        $conexion= new Datos_modelo();
        $sql= "SELECT timer FROM config WHERE id=1 LIMIT 1";
        $query= $conexion->get_1datos($sql);

        $consulta= "SELECT * FROM usuarios";
        $sql= $conexion->get_datos($consulta);

        //Hacemos un foreach para contar la cantidad de usuarios en la bd
        //No utilicé arriba el método de contar registros porque voy a necesitar los datos que vienen con FETCH_ASSOC
        foreach($sql as $id => $link) {
          $usuarios_actuales= $usuarios_actuales+1;
        }

        //En la variable de sesión vienen todos los usuarios totales de la base de datos (en número)
        if(!isset($_SESSION['cantidad_usuarios'])) {
          $_SESSION['cantidad_usuarios'] = $usuarios_actuales;
        }
        //Si se ha registrado una persona nueva (en la variable de usuarios totales hay más gente que en la variable de sesión actual)
        //Si aparte de eso, difiere el tiempo actual (menos 1min) del tiempo de la base de datos....
        //Entonces actualicemos toda mierda con una nueva variable que almacene todos los datos de todos los usuarios
        if($_SESSION['cantidad_usuarios'] != $usuarios_actuales or (time() - 60) <= $timer) {

            foreach($sql as $id => $link){
              $usuarios[$link[id]]= array(
              'usuario' => $link[usuario],
              'password'=> $link[password],
              'email' => $link[email],
              'permisos' => $link[permisos],
              'activo' =>$link[activo],
              'ultima_conexion' =>$link[ultima_conexion],
              'no_leidos' => $link[no_leidos],
              'img' => $link[img],
              'firma' => $link[firma],
              'rango' => $link[rango],
              'edad' => $link[edad],
              'fecha_registro' => $link[fecha_registro],
              'biografia' => $link[biografia],
              'mensajes' =>$link[mensajes]
                );
            }// FIN DEL FOREACH


          //Si no ha habido cambios...
        }else {

              //Igualito hacemos la variable de sesión si no existe (con todos los datos de los usuarios)
              if(!isset($_SESSION['usuarios'])) {

                foreach($sql as $id => $link){
                  $usuarios[$link[id]]= array(
                  'usuario' => $link[usuario],
                  'password'=> $link[password],
                  'email' => $link[email],
                  'permisos' => $link[permisos],
                  'activo' =>$link[activo],
                  'ultima_conexion' =>$link[ultima_conexion],
                  'no_leidos' => $link[no_leidos],
                  'img' => $link[img],
                  'firma' => $link[firma],
                  'rango' => $link[rango],
                  'edad' => $link[edad],
                  'fecha_registro' => $link[fecha_registro],
                  'biografia' => $link[biografia],
                  'mensajes' =>$link[mensajes]
                    );
                }// FIN DEL FOREACH

              //Si ya existe la malparía XD entonces creamos la variable $usuarios y la dejamos como estaba
              } else {
              $usuarios = $_SESSION['usuarios'];
              }

        }

        $_SESSION['usuarios'] = $usuarios;

        $conexion=null;
        return $usuarios;
    }



?>
