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
		/*
			VARS:
				$args: (array) URL var
				$path: controller's path
				$system: system object
				$file: controller file
				$controller: controller name
				$action: controller method
				
			METHOD:
				__construct(): get the system object and check the controller's path
				load(): (event getControllerEvent) load the controller and call the method
				getController(): search the controller and manage the deviation.
		*/
	
		private $args = array();					 
		private $path = _CONTROLLER_PATH;			
		private $system;
		public  $file = null;						
		public  $controller = null;					
		public  $action = null;						
		
		function __construct() {
			$this->system = system::getInstance(); 	
		}
		
		public function changePath($path) {														
			if (is_dir($path) == false) {														
				$this->system->log->error("Router: Indirizzo controller non valido: ` $path `", __LINE__);
			}
			$this->path = $path;																
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
			$this->system->callEvent("getControllerEvent", array("page" => $this->controller));		
			$controller->$action();																	
		}
		
		private function getController()	{
			$route = (!isset($_GET[_GET_PAGE_NAME])) ? '' : $_GET[_GET_PAGE_NAME];				
			$this->action = 'index';									
			if (empty($route))										
				$this->controller = _DEFAULT_CONTROLLER;	
			else
			{
				// Get the URL controller, URL action and URL args
				$parts = explode('/', $route);										
				$this->controller = $parts[0];				
				if(isset($parts[1])) {
					$this->action = $parts[1];
				}				
				for($i=2; $i<count($parts); $i++) {									
					$var = explode('=', $parts[$i]);
					$key = $var[0];
					if(isset($var[1])) 
						$val = $var[1];
					else
						$val = '';
					$this->args[$key] = $val;			
				}				
			}
			
			// If IP Ban
			if(in_array($_SERVER['REMOTE_ADDR'], $GLOBALS["_configTable"]["_router_bans_ip"])) {
				$this->changePath(_CONTROLLER_PATH_ROUTER);
				$this->file = $this->path._CONTROLLER_BAN.'.php';
				$this->controller = _CONTROLLER_BAN;	
				return;
			}
			
			// Manage the deviation		
			if($this->controller == _ADMIN_DEVIATION_NAME) {
				$this->file = _ADMIN_DEVIATION_FILE;							
			}
			else {																
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
