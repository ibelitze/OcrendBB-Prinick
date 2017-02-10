<?php

  function LostpassTemplate($user, $link){

    $HTML = '
    <html>
    <body style="background: #FFFFFF;font-family: Verdana; font-size: 14px;color:#1c1b1b;">
    <div style="">
        <h2>Hola '.$user.'</h2>
        <p style="font-size:17px;">Te enviamos este correo desde: '. APP_TITLE .'.</p>
      <p>Si estás leyendo este correo es porque pediste un cambio de contraseña</p>
      <p style="padding:15px;background-color:#ECF8FF;">
          Para cambiar la contraseña haz <a style="font-weight:bold;color: #2BA6CB;" href="'.$link.'" target="_blank">clic aquí &raquo;</a>,
          Pero si no has solicitado este servicio, con simplemente ignorar este correo es suficiente. Muchas gracias!
      </p>
        <p style="font-size: 9px;">&copy; 2016 '.APP_TITLE.'. Todos los derechos reservados.</p>
    </div>
    </body>
    </html>';
    return $HTML;

  }



?>
