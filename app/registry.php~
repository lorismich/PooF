<?php
	/****
		*	File: registry.php
		*	Descrizione: Registro globale
		*
		*	Author: D4ng3R <mich.loris@gmail.com>

		    This file is part of :PooF.

		    :PooF is free software: you can redistribute it and/or modify
		    it under the terms of the GNU General Public License as published by
		    the Free Software Foundation, either version 3 of the License, or
		    (at your option) any later version.

		    :PooF is distributed in the hope that it will be useful,
		    but WITHOUT ANY WARRANTY; without even the implied warranty of
		    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
		    GNU General Public License for more details.

		    You should have received a copy of the GNU General Public License
		    along with :PooF.  If not, see <http://www.gnu.org/licenses/>.
	*****/	
	
	class registry {
		private $vars = array();
		
		function __construct() {
			$this->vars["POST"] = array();
			$this->vars["COOKIE"] = array();
			$this->vars["FILES"] = array();
		}
		
		public function __set($index, $value) {			// Metodo per registrare nell'array le variabili passate				
			$this->vars[$index] = $value;
		}
		
		public function __get($index) {				// Metodo per ritornare il valore di una variabile salvata		
			return $this->vars[$index];	
		}

		public function writeIntoDatabase($name, $value) {
			if(_ENABLE_DATABASE) {
				$system = system::getInstance(); 
				if($system->database->query("INSERT INTO "._REGISTRY_DATABASE_TABLE." SET(conf_name, conf_value) VALUES ('$name', '$value')", true, true)) {
					return 1;
				}
				return 0;
			}
		}
	}
?>
