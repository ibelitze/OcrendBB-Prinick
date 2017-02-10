<?php



  class Temas{

    private $db;
    private $id;
    private $titulo;
    private $contenido;
    private $id_foro;
    private $id_dueno;
    private $anuncio;

        public function __construct(){
          $this->db= new Datos_modelo();
          $this->id= isset($_GET['id'])? intval($_GET['id']) : null;
          $this->id_foro= intval($_GET['id_foro']);
          $this->id_dueno= isset($_SESSION['app_id'])? $_SESSION['app_id']: null;
        }
//------------------------------------------------------------------------------
        private function Errors($url){

            try {

                if(empty($_POST['titulo']) or empty($_POST['contenido'])){
                  throw new Exception(1);
                }
                else {
                  $this->titulo= $_POST['titulo'];
                  $this->contenido= $_POST['contenido'];
                }

                if(strlen($this->titulo) < MIN_TITULO_LONG){
                  throw new Exception(2);
                }
                if(strlen($this->contenido) < MIN_CONTENT_LONG){
                  throw new Exception(3);
                }

                if($_POST['anuncio'] and $_POST['anuncio']== 2){
                  $this->anuncio= 2;
                }
                else {
                  $this->anuncio= 1;
                }
            }
            catch(Exception $e){
              header('location: '. $url . $e->getMessage());
              exit;
            }

        }
//------------------------------------------------------------------------------
        public function checkTema(){

          $sql= "SELECT * FROM temas WHERE id='$this->id' LIMIT 1";
          $query= $this->db->get_1datos($sql);
          if($query != null){
            $tema= $query;
          }
          else {
            $tema= false;
          }
          $sql=null;
          return $tema;
        }
//------------------------------------------------------------------------------
        public function GetRespuestas(){
            $sql= "SELECT * FROM respuestas WHERE id_tema='$this->id'";
            $query= $this->db->get_datos($sql);
            if($query != null){
                foreach($query as $id => $link){
                  $respuestas[$link[id]]= array(
                    'id_dueno' => $link[id_dueno],
                    'id_tema' => $link[id_tema],
                    'id_foro' => $link[id_foro],
                    'contenido' => $link[contenido]);
                }
            }
            else {
              $respuestas= false;
            }
            $sql=null;
            return $respuestas;
        }
//------------------------------------------------------------------------------
        public function crear(){
          $this->Errors('?view=temas&mode=crear&id_foro='.$this->id_foro.'&error=');
          $f = time();
          $fecha = date("d-m-Y (H:i a)", $f);

          $sql="INSERT INTO temas (titulo, contenido, id_foro, id_dueno, fecha, id_ultimo, fecha_ultimo, tipo)
          VALUES ('$this->titulo', '$this->contenido',
          '$this->id_foro', '$this->id_dueno', '$fecha','$this->id_dueno', '$fecha', '$this->anuncio')";
          //Hay que ejecutar la query y al mismo tiempo
          //sacar el último id agregado para luego ponerlo en la url y dejar al usuario en el view de su mensaje creado
          $id_ultimo= $this->db->ultimoId($sql);
          //Aumentamos la cantidad de temas que hay en el foro correspondiente
          $sql2= "UPDATE foros SET cantidad_temas=cantidad_temas+1, ultimo_tema='$this->titulo', id_ultimo_tema='$id_ultimo' WHERE id='$this->id_foro'";
          $resul= $this->db->insertar($sql2);
          //Aumentamos la cantidad de mensajes que tiene el usuario que acaba de crear el tema
          $sql3= "UPDATE usuarios SET mensajes=mensajes+1 WHERE id='$this->id_dueno'";
          $resul2=$this->db->insertar($sql3);

          $sql2=null;
          $resul2=null;
          $sql=null;
          header('location: foros/'. UrlAmigable($this->id_foro, $this->titulo, $id_ultimo));
        }
//------------------------------------------------------------------------------
        public function editar(){
          $this->Errors('?view=temas&mode=editar&id='.$this->id.'&id_foro='.$this->id_foro.'&error=');

          $sql="UPDATE temas SET titulo='$this->titulo', contenido='$this->contenido', tipo='$this->anuncio'
          WHERE id='$this->id' LIMIT 1";
          $edicion= $this->db->insertar($sql);

          header('location: foros/'. UrlAmigable($this->id_foro, $this->titulo, $id_ultimo));
        }
//------------------------------------------------------------------------------
        public function responder(){

          if(empty($_POST['contenido'])){
            header('location: index.php?view=temas&id='. $this->id .'&id_foro='. $this->id_foro);
            exit;
          }
          else {
            $this->contenido= $_POST['contenido'];
          }
          //Agregamos la respuesta a la bd
          $q1= "INSERT INTO respuestas (id_dueno, id_tema, id_foro, contenido)
          VALUES('$this->id_dueno', '$this->id', '$this->id_foro', '$this->contenido')";

          //incrementar la cantidad de mensajes del usuario que responde..
          $q2= "UPDATE usuarios SET mensajes= mensajes+1 WHERE id= '$this->id_dueno' LIMIT 1";

          //Incrementar la cantidad de respuestas en el tema correspondiente
          $q3= "UPDATE temas SET respuestas= respuestas+1 WHERE id= '$this->id' LIMIT 1";

          $query1= $this->db->insertar($q1);
          $query2= $this->db->insertar($q2);
          $query3= $this->db->insertar($q3);

          header('location: index.php?view=temas&id='. $this->id .'&id_foro='. $this->id_foro);
        }
//------------------------------------------------------------------------------
        public function borrar(){
          $sql= "DELETE FROM temas WHERE id='$this->id' LIMIT 1";
          $sql2= "UPDATE foros SET cantidad_temas= cantidad_temas-1 WHERE id='$this->id_foro' LIMIT 1";
          $sql3= "DELETE FROM respuestas WHERE id_tema='$this->id'";

          $this->db->insertar($sql);
          $this->db->insertar($sql2);
          $this->db->insertar($sql3);

          header('location: ?view=foros&id_foro='.$this->id_foro);
        }
//------------------------------------------------------------------------------
        public function cerrarAbrir($estado){
          $sql= "UPDATE temas SET estado='$estado' WHERE id='$this->id' LIMIT 1";
          $this->db->insertar($sql);
          //Si hay un error: entonces arreglar esta url de abajo...
          header('location: ?view=foros&id_foro='.$this->id_foro);
        }

//------------------------------------------------------------------------------

        public function __destruct(){
          $this->db->close();
        }


  } //FIN DE LA CLASE

?>
