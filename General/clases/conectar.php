<?php
	//crear la clase conectar
	class conectar
	{
		private $cn;//declarar variable ambito privado
		//funcion publica conectar
                public function __construct(){
			//utilizar la clase msqli p' conectarnos
                        $this->cn = pg_connect("host=10.0.0.73 dbname=inscritos_docentes_catedraticos user=postgres password=manager")
    or die('No se ha podido conectar: ' . pg_last_error());
			//retornamos (devolver) la conexion
        	return $this->cn;
		}
		public function conectar(){
			//utilizar la clase msqli p' conectarnos
                        $this->cn = pg_connect("host=10.0.0.73 dbname=inscritos_docentes_catedraticos user=postgres password=manager")
    or die('No se ha podido conectar: ' . pg_last_error());
			//retornamos (devolver) la conexion
        	return $this->cn;
		}
		//funcion para controlar caracteres espciales
		public function setNames(){
			//return $this->cn->query("SET NAMES 'utf8'");
		}
	}
 ?>
