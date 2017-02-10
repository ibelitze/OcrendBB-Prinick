<?php

  $db= new Datos_modelo(); //establecemos la conexión.

  $user= htmlentities(addslashes($_POST["user"]));
  $pass= md5($_POST["pass"]);  //password_verify($passDB , $_POST['pass']);
  $email= htmlentities(addslashes($_POST["email"]));

  $sql= "SELECT usuario FROM usuarios WHERE usuario='$user' OR email='$email' LIMIT 1";
  $query= $db->get_1datos($sql);

    if($query == 0){

      $keyreg= md5(time()); //Esta es la llave de activación para poder registrar el usuario.

      $link= APP_URL . '?view=activar&key='. $keyreg;  //este es el link de activación.
      //quedaría algo como así:
      /*http://localhost/OcrendBB/?view=activar&key=(aquí la keyreg)*/

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output
      $mail->CharSet= "UTF-8";
      $mail->Encoding= 'quoted_printable';
      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'p3plcpnl0173.prod.phx3.secureserver.net';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'public@ocrend.com';                 // SMTP username
      $mail->Password = 'Prinick2016';                           // SMTP password
      $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
      $mail->SMTPOptions = array(
        'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true)
        );
      $mail->Port = 465;                                    // TCP port to connect to

      $mail->setFrom('public@ocrend.com', 'OcrendBB');         //Quien manda el correo..

      $mail->addAddress($email, $user);     // a quien le está enviando ese correo (el nombre es opcional)..
                                                            //este método se puede copiar y pegar muchas veces, para enviarle correo a varias personas

      // $mail->addAttachment('/var/tmp/file.tar.gz');         // agregar archivos adjuntos..
      // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // nombre opcional..


      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Activación de tu cuenta';
      $mail->Body    = emailTemplate($user, $link);
      $mail->AltBody = 'Hola, '. $user .'Para validar tu cuenta: haz click en el siguiente link: '. $link; //por si la persona no puede leer HTML.

      //Si el correo no se pudo enviar
      if(!$mail->send()) {
          $HTML= '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>ERROR:</strong> <a href="#" class="alert-link"></a>
              Error al hacer el registro.'. $mail->ErrorInfo .'</div>';

        $sql=null;
      } else {
        $fecha_reg= date('d/m/Y', time());
          //Si el correo se pudo enviar satisfactoriamente, hacemos el registro.
          $sql= "INSERT INTO usuarios (usuario, password, email, keyreg, fecha_registro, ) VALUES ('$user','$pass','$email', '$keyreg', '$fecha_reg')";
          $resulset= $db->insertar($sql);
          $resul= $resulset->rowCount();

            if($resul!=0){
                $consulta= "SELECT MAX(id) AS id FROM usuarios";
                $resultado= $db->get_1datos($consulta);

                $_SESSION['app_id']= $resultado[id];
                $_SESSION['app_usuario']= $resultado[usuario];
            }

          $HTML= 1; //Aquí se coloca 1, porque en registro.js ese número se recibe para determinar que la consulta se ha recibido
                    //satisfactoriamente con AJAX
      }

    }
    //Si la consulta en la base de datos arroja 1 resultado.. quiere decir que hay alguien registrado
    //con ese usuario o ese email. Aquí abajo están los errores a mostrar.
    else {

        $usuario= $query['usuario'];

        if(strtolower($usuario)== strtolower($user)){
          $HTML= '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>ERROR:</strong> <a href="#" class="alert-link"></a>
              Nombre de usuario ya existe.
              </div>';
        }
        else {

          $HTML= '<div class="alert alert-dismissible alert-danger">
              <button type="button" class="close" data-dismiss="alert">x</button>
              <strong>ERROR:</strong> <a href="#" class="alert-link"></a>
              Email ya registrado, por favor ingrese otro email.'. $usuario .'
              </div>';
        }


    }

  $db->close();

  echo $HTML;

?>
