<?php

    // Si hubo $_POST, si se recibieron datos en el formulario:
  if(!empty($_POST['user']) and !empty($_POST['pass'])){

    //Creamos la conexión:
    $conexion= new Datos_modelo();
    $conexion->Conectar();

    $user= htmlentities(addslashes($_POST["user"]));
    $pass= md5($_POST["pass"]);  //password_verify($passDB , $_POST['pass']);

    $sql="SELECT * FROM usuarios WHERE (usuario='$user' OR email='$user') AND password='$pass' LIMIT 1";
    $resulset= $conexion->get_1datos($sql);


    if($resulset!=0){

      //Si se chequeó la casilla de recordar usuario:
        if($_POST['sesion']){
          //se crea una cookie de sesión:
          ini_set('session.cookie_lifetime', 1800 );
        }

        //se le abre sesión al usuario por su id
        $_SESSION['app_id']= $resulset[id];
        $_SESSION['app_usuario']= $resulset[usuario];
        $_SESSION['time_online']= time() - (60*6);
        //Pongo echo 1 para que ajax lo tome como un success y me redireccione al index
        echo 1;


    }
    else {
      echo '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>ERROR:</strong> <a href="#" class="alert-link"></a>
          Usuario o email no encontrado. Su contraseña pudiera ser incorrecta. Vuelva a intentarlo.
          </div>';
    }



  }

  //No se recibieron datos en el formulario:
  else {

    echo '<div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">x</button>
        <strong>Debe rellenar los datos!</strong>
        Por favor, rellene todo el formulario y vuelva a intentarlo.
        </div>';
  }

  $conexion=null;
  $sql=null;
  $resulset=null;

?>
