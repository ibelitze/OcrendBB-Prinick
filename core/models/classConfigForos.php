<?php

  class ConfigForos {

    private $db;
    private $nombre;
    private $categorias;
    private $id;
    private $descripcion;
    private $estado;

    public function __construct(){
      $this->db= new Datos_modelo();
    }

//------------------------------------------------------------------------------
    private function Errors($url){

        try{


            if(empty($_POST['nombre']) or empty($_POST['descripcion']) ){
              throw new Exception(1);
            }
            else {
              $this->nombre= $_POST['nombre'];
              $this->descripcion= $_POST['descripcion'];
              $this->descripcion= str_replace(
                array('<script>', '</script>', '<script src', '<script type'),
                '',
                $this->descripcion
              );
            }
            if(!isset($_POST['estado']) or !is_numeric($_POST['categorias'])){
              throw new Exception(2);
            }
            else {

              if($_POST['estado'] == 1){
                $this->estado= 1;
              }
              else {
                $this->estado= 0;
              }
              $this->categorias= intval($_POST['categorias']);
            }

        }
        catch(Exception $e){
          header('location: '. $url . $e->getMessage());
          exit;
        }
    }

//------------------------------------------------------------------------------

    public function Add(){
      $this->id= intval($_GET['id']);
      $this->Errors('?view=configforos&mode=agregar&error=true');
      $sql= "INSERT INTO foros (nombre, descripcion, id_categoria, estado) VALUES ('$this->nombre', '$this->descripcion',
      '$this->categorias', '$this->estado')";
      $query= $this->db->insertar($sql);
      header('location: ?view=configforos&mode=agregar&success=true');
    }

//------------------------------------------------------------------------------

    public function Edit(){
      $this->id= intval($_GET['id']);
      $this->Errors('?view=configforos&mode=editar&id='. $this->id .'&error=true');
      $sql= "UPDATE foros SET nombre='$this->nombre', descripcion='$this->descripcion', id_categoria='$this->categorias',
      estado='$this->estado' WHERE id='$this->id'";
      $query= $this->db->insertar($sql);
      header('location: ?view=configforos&mode=editar&id='. $this->id .'&success=true');

    }

//------------------------------------------------------------------------------

    public function Delete(){
      $this->id= intval($_GET['id']);
      $this->Errors('?view=configforos&mode=borrar&id='. $this->id .'&error=true');
      $q1= "DELETE FROM foros WHERE id='$this->id'";
      $q2= "DELETE FROM temas WHERE id_foro='$this->id'";
      $q3= "DELETE FROM respuestas WHERE id_foro='$this->id'";
      $query1= $this->db->insertar($q1);
      $query2= $this->db->insertar($q2);
      $query3= $this->db->insertar($q3);
      header('location: ?view=configforos&success=true');
    }

//------------------------------------------------------------------------------
    public function __destruct(){
      $this->db->close();
    }


  }// FIN DE LA CLASE

?>
