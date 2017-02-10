<?php

  class Categorias {

    private $db;
    private $id;
    private $nombre;

    public function __construct(){
      $this->db= new Datos_modelo();
    }

    private function Errors($url){

        try{

            if(empty($_POST['nombre'])){
              throw new Exception(1);
            }
            else {
              $this->nombre= $_POST['nombre'];
            }
        }
        catch(Exception $e){
          header('location: '. $url . $e->getMessage());
          exit;
        }

    }

    public function Add(){
      $this->id= intval($_GET['id']);
      $this->Errors('?view=categorias&mode=agregar&error=true');
      $sql= "INSERT INTO categorias (nombre) VALUES ('$this->nombre')";
      $query= $this->db->insertar($sql);
      header('location: ?view=categorias&mode=agregar&success=true');
    }

    public function Edit(){
      $this->id= intval($_GET['id']);
      $this->Errors('?view=categorias&mode=editar&id='. $this->id .'&error=true');
      $sql= "UPDATE categorias SET nombre='$this->nombre' WHERE id='$this->id'";
      $query= $this->db->insertar($sql);
      header('location: ?view=categorias&mode=editar&id='. $this->id .'&success=true');

    }

    public function Delete(){
      $this->id= intval($_GET['id']);

      $q0= "SELECT id FROM foros WHERE id_categoria= '$this->id'";
      $query0= $this->db->get_datos($q0);

      //Borramos las categorías, y borramos los foros de esas categorías
      $q1= "DELETE FROM categorias WHERE id='$this->id'";
      $q2= "DELETE FROM foros WHERE id_categoria='$this->id'";
      $query1= $this->db->insertar($q1);
      $query2= $this->db->insertar($q2);

      //Agarramos en un arreglo todos los id de los foros que correspondan a esa categoría borrada
      foreach($query0 as $d => $link){
            $foro.= intval($link['id']) . ',';
      }

      $q3= "DELETE FROM temas WHERE id_foro='$foro';";
      $query3= $this->db->insertar($q3);

      header('location: ?view=categorias');
    }
    
    public function __destruct(){
      $this->db->close();
    }



  }// FIN DE LA CLASE





?>
