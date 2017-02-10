<?php

  $db= new Datos_modelo();
  $email= $_POST['email'];

  $query= "SELECT id,usuario FROM usuarios WHERE email='$email' LIMIT 1";
  $sql= $db->get_1datos($query);

    //Si el email existe en la base de datos (es de un usuario)
    if($sql[id] != null){

        $link= APP_URL . '?view=lostpass&key=' . $keypass;
        $id= $sql[id];
        $usuario= $sql[usuario];
        $keypass= md5(time());
        //substr agarra un string y lo corta desde el índice (0) hasta el segundo número puesto (8)
        //sha1 es también otra manera de encriptar (descontinuado)
        $newpass= strtoupper(substr(sha1(time()), 0 , 8));


        /*--------------------PHP MAILER-----------------------*/

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
        $mail->Port = 465;


        $mail->setFrom('public@ocrend.com', 'OcrendBB');         //Quien manda el correo..

        $mail->addAddress($email, $usuario);     // a quien le está enviando ese correo (el nombre es opcional)..
                                                              //este método se puede copiar y pegar muchas veces, para enviarle correo a varias personas

        // $mail->addAttachment('/var/tmp/file.tar.gz');         // agregar archivos adjuntos..
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // nombre opcional..
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Cambio de contraseña';
        $mail->Body    = LostpassTemplate($usuario, $link);
        $mail->AltBody = 'Hola, '. $usuario .'Para hacer tu cambio de contraseña debes ir a este enlace: '. $link . 'Si no has pedido un
        cambio de contraseña: no hagas nada. '; //por si la persona no puede leer HTML.


        if(!$mail->send()) {
            $HTML= '<div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>ERROR:</strong> <a href="#" class="alert-link"></a>
                No se pudo enviar el correo.'. $mail->ErrorInfo .'</div>';

        } else {
            //Si el correo se pudo enviar satisfactoriamente, hacemos el registro.
            $query2= "UPDATE usuarios SET keypass='$keypass', newpass='$newpass' WHERE id='$id'";
            $resul= $db->insertar($query2);

            $HTML= 1; //Aquí se coloca 1, porque en registro.js ese número se recibe para determinar que la consulta se ha recibido
                      //satisfactoriamente con AJAX
        }


    }
    //si no se consiguió el email en la base de datos..
    else {
      $HTML= '<div class="alert alert-dismissible alert-danger">
          <button type="button" class="close" data-dismiss="alert">x</button>
          <strong>ERROR:</strong> El email que introdujo no existe en el sistema. </div>';
    }




  $db->close();
  $query=null;
  $query2=null;
  $resul=null;
  $sql=null;

  echo $HTML;

?>
