<?php

//Este archivo es el NUCLEO de la aplicación

//se inicia la sesión para que los usuarios puedan usarla:
session_start();
date_default_timezone_set('America/Caracas');


//CONSTANTES DE LA APP
define('HTML_DIR', 'html/');
define('APP_TITLE', 'OcrendBB');
define('APP_COPY', 'Copyright (c) 2016 Ocrend Software.');
define('APP_URL', 'http://localhost/OcrendBB/');

//CONSTANTES BÁSICAS DE CONFIGURACIÓN
define('MIN_TITULO_LONG', 9);
define('MIN_CONTENT_LONG', 200);


//ESTRUCTURA Y CONEXION A BASE DE DATOS
require('vendor/autoload.php');
require('core/models/conexion.php');
require('core/models/classDatos.php');
require('core/bin/functions/users.php');
require('core/bin/functions/categorias.php');
require('core/bin/functions/emailtemplate.php');
require('core/bin/functions/lostpassTemplate.php');
require('core/bin/functions/Foros.php');
require('core/bin/functions/urlAmigable.php');
require('core/bin/functions/BBcode.php');
require('core/bin/functions/onlineUsers.php');
require('core/bin/functions/getStatusUser.php');
require('core/bin/functions/aumentarVisitas.php');


  $usuarios= usuarios();
  $categoria= Categorias();
  $foros= Foros();
  OnlineUsers();

?>
