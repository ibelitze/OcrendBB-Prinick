<?php

function UrlAmigable($id, $titulo, $id_foro = null) {
  if($id_foro==null) {
    $titulo = $id . '-' . $titulo;
  } else {
    $titulo = $id . '-' . $id_foro . '-' . $titulo;
  }
  $titulo = trim($titulo);
  $titulo = str_replace(
      array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
      'a',
      $titulo
  );
  $titulo = str_replace(
      array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
      'e',
      $titulo
  );
  $titulo = str_replace(
      array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
      'i',
      $titulo
  );
  $titulo = str_replace(
      array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
      'o',
      $titulo
  );
  $titulo = str_replace(
      array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
      'u',
      $titulo
  );
  $titulo = str_replace(
      array('ñ', 'Ñ', 'ç', 'Ç'),
      array('n', 'N', 'c', 'C',),
      $titulo
  );
    $titulo = str_replace(
        array("\\", "¨", "º", "-", "~",
             "#", "@", "|", "!", "\"",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "`", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             ".", " "),
        '-',
        $titulo
    );
  return $titulo;
}


?>
