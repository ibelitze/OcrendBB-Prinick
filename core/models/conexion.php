<?php

class Conexion {

		protected $conexion_db;

		public function Conexion(){

			try {

				$this->conexion_db= new PDO('mysql:host=localhost; dbname=ocrendbb', 'usuario', 'contraseña');
				$this->conexion_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

				$this->conexion_db->exec('SET CHARACTER SET utf8');

				return $this->conexion_db;

			} catch(Exception $e){

				echo "La línea del error es: " . $e->getLine() . "<br>";
				echo "El mensaje de error: " . $e->getMessage() . "<br>";
			}


		}

	}


?>
