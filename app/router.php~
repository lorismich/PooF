<?php
	/****
		*	File: router.php
		*	Descrizione: File per identificare il controller adatto per una pagina
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
	class router {
		private $args = array();					// Argomenti da passare al controller     
		private $path = _CONTROLLER_PATH;			// Cartella di default per i controller
		private $system;
		public  $file = null;						// Indirizzo controller
		public  $controller = null;					// Nome controller	
		public  $action = null;						// Metodo del controller da chiamare
		
		function __construct() {
			$this->system = system::getInstance(); 	// Carico la classe di sistema
		}
		
		public function changePath($path) {														// Metodo per cambiare la directory di default per i controller
			if (is_dir($path) == false) {														// Controllo che la directory sia valida
				$this->system->log->error("Router: Indirizzo controller non valido: ` $path `", __LINE__);
			}
			$this->path = $path;																// Imposto il nuovo indirizzo
		}
		
		public function load() {
			$this->getController();									
			if(!is_readable($this->file)) {								
				$this->system->log->warning("Router: Controller non trovato: ` $this->file `", __LINE__);						
				$this->changePath(_CONTROLLER_PATH_ROUTER);
				$this->file = $this->path._CONTROLLER_404.'.php';
				$this->controller = _CONTROLLER_404;			
			}
			include($this->file);									
			$controller = new $this->controller($this->args);					
			if (!is_callable(array($controller, $this->action))){					
				$this->system->log->warning("Router: Metodo non richiamabile: ` $this->action `", __LINE__);
				$action = 'index';			
			}	
			else
				$action = $this->action;
			$this->system->callEvent("getControllerEvent", array("page" => $this->controller));		// Richiamo l'evento associato all'identifiazione del controlelr
			$controller->$action();																	// Eseguo il metodo del controller
		}
		
		private function getController()	{
			$route = (!isset($_GET[_GET_PAGE_NAME])) ? '' : $_GET[_GET_PAGE_NAME];				// Recupero il controller richiesto 
			$this->action = 'index';									// Imposto il metodo di default da richiamare
			if (empty($route))										// Se non è specificato nessun controller carico quello di default
				$this->controller = _DEFAULT_CONTROLLER;	
			else
			{
				$parts = explode('/', $route);										// Determino il nome del controller e il metodo da attivare
				$this->controller = $parts[0];				
				if(isset($parts[1])) {
					$this->action = $parts[1];
				}				
				for($i=2; $i<count($parts); $i++) {									// Recupero eventuali parametri GET
					$var = explode('=', $parts[$i]);
					$key = $var[0];
					if(isset($var[1])) 
						$val = $var[1];
					else
						$val = '';
					$this->args[$key] = $val;			
				}				
			}
			
			if(in_array($_SERVER['REMOTE_ADDR'], $GLOBALS["_configTable"]["_router_bans_ip"])) {
				$this->changePath(_CONTROLLER_PATH_ROUTER);
				$this->file = $this->path._CONTROLLER_BAN.'.php';
				$this->controller = _CONTROLLER_BAN;	
				return;
			}
					
			if($this->controller == _ADMIN_DEVIATION_NAME) {
				$this->file = _ADMIN_DEVIATION_FILE;							// Determino la posizione del controller amministrativo
			}
			else {																// Determino la posizione del controller
				if(array_key_exists($this->controller, $GLOBALS["_configTable"]["_router_deviation"])) {
					$array = $GLOBALS["_configTable"]["_router_deviation"];
					if(_ROUTER_DEVIATON_ENABLE)
						$this->controller = $array[$this->controller];			
				}						
				$this->file = $this->path . $this->controller .'.php';					
			}
		
		}
	}
?>
