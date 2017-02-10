<?php

    require_once("core/models/conexion.php");

    class Datos_modelo extends Conexion {

        public function Conectar(){
            parent::__construct();
        }


        //Devuelve un array asociativo con UNA fila de la BD:
        public function get_1datos($a)
        {
          $consulta= $this->conexion_db->prepare($a);
          $resultado=$consulta->execute();
          $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
          return $resultado;
        }
        //Ejecuta en general cualquier query
        public function insertar($sql)
        {
          $consulta= $this->conexion_db->prepare($sql);
          $resultado=$consulta->execute();
          return $resultado;
        }

        //Devuelve un array asociativo con tolas las filas de la BD:
        public function get_datos($a)
        {
          $consulta= $this->conexion_db->prepare($a);
          $resultado=$consulta->execute(array());
          $resultado=$consulta->fetchAll(PDO::FETCH_ASSOC);
          return $resultado;
        }
        //Para cuando hace falta hacer una consulta de conteo de columnas o datos
    		public function contar($a)
    		{
    			$consulta= $this->conexion_db->query($a);
    			$conteo=$consulta->fetchColumn();
    			return $conteo;
    		}
        //Función que ejecuta una query y devuelve el último id insertado
        public function ultimoId($sql)
        {
          $consulta= $this->conexion_db->prepare($sql);
          $consulta->execute();
          $id = $this->conexion_db->lastInsertId();
          return $id;
        }

        //Función para cerrar la conexión y limpiar la query
        public function close()
        {
          $this->conexion_db= null;
        }

}




?>
