<?php
	class conectar
	{
		private $cn;
                public function __construct(){
                        $this->cn = pg_connect("host=10.238.12.66 dbname=inscritos_docentes_catedraticos_2024 user=insweb_2024 password=#^ztr")
    or die('No se ha podido conectar: ' . pg_last_error());
        	return $this->cn;
		}
		public function conectar(){
                        $this->cn = pg_connect("host=10.238.12.66 dbname=inscritos_docentes_catedraticos_2024 user=insweb_2024 password=#^ztr")
    or die('No se ha podido conectar: ' . pg_last_error());
        	return $this->cn;
		}
		public function setNames(){
		}
	}
