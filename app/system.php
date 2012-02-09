<?php
/****
		*	File: system.php
		*	Descrizione: Classe di sistema
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
	
	class system {		
		/*
			VARS:
				$instance: instance of system object ( Singleton Object )
				$globalObject: (array) array of global object
				$function: (array) array virtual object
				$databaseTable: (array) database table load into system object ( See app/table.php )
				$registry: system registry
				$loadObject: Flag if the global object are loaded
				$lang: site language
				
			METHOD:
				__construct(): create the system registry
				__get(): return a global object
				getInstance(): return an instance of a system class
				loadTable(): load a database table into the system
				loadDatabase(): load the database
				syncConfiguration(): syncronize the configuration in database
				loadConfiguration(): load the configuration save in database
				callEvent(): call a system event
				loadGlobalObject(): load all global object
				loadVirtualFunction(): load the functions save into database
				loadLanguage(): load the right language dictionary.				// COMPLETE ME
				setLanguage(): set a language
				set%onRegistry: write into registry the % array
				SafeArray(): check the array
				ValidateEmail(): validate email
				secure_link(): make a secure link. Link with the SID
				sidValidate(): check if a sid is valid and if is an admin's SID
				setCookie(): set a cookie
				readCookie(): read a cookie
		*/
																		
		private static $instance = null; 
		private $globalObject = array();
		public $function = array();
		public $databaseTable = array();
		public $registry = null;
		public $loadobject = false;
		public static $lang = null;

		static function getInstance() { 
			if (system::$instance == null){ 	
			  system::$instance = new system(); 
			} 	
			return system::$instance; 
		} 
		
		private function __construct() { 	
			$this->registry = new registry();	
		} 

		public function __get($index) {												
			return $this->globalObject[$index];	
		}

		public function loadTable($nameTable) {
			$this->databaseTable[$nameTable] = new table($nameTable);
		}

		public function loadDatabase() {
			$this->globalObject["log"] = new log();
			if(_ENABLE_DATABASE) {
				$type = _DB_TYPE;
				$this->globalObject["database"] = new $type();
			}
		}

		public function syncConfiguration() {
			foreach($GLOBALS["_configTable"] as $key=>$value) {
				if(!$this->globalObject["database"]->query("UPDATE "._DYNAMIC_CONFIGURATION_TABLE." SET conf_value = '".serialize($value)."' WHERE conf_name='".$key."'", true, true))
					$this->log->error("System: impossibile aggiornare la configurazione ". "UPDATE "._DYNAMIC_CONFIGURATION_TABLE." SET conf_value = '".$value."' WHERE conf_name='".$key."'", __LINE__);
			}	
		}

		public function loadConfiguration() {
			if(_ENABLE_DATABASE) {
				foreach($GLOBALS["_configTable"] as $key=>$value) {
					if($this->globalObject["database"]->numRows("SELECT * FROM "._DYNAMIC_CONFIGURATION_TABLE ." WHERE conf_name='".$key."'") == 0) {
						if(!$this->globalObject["database"]->query("INSERT INTO "._DYNAMIC_CONFIGURATION_TABLE." (conf_name, conf_value) VALUES ('$key', '".serialize($value)."');", true ,true))
							$this->globalObject["log"]->error("System: impossibile caricare la configurazione", __LINE__);	
					}	
				}

				$query = $this->database->query("SELECT * FROM "._DYNAMIC_CONFIGURATION_TABLE, true, true);
				while($config = $this->globalObject["database"]->fetch_assoc($query)) {
					
						$GLOBALS["_configTable"][$config["conf_name"]] = unserialize($config["conf_value"]);
						if(!is_array(unserialize($config["conf_value"])))
							DEFINE($config["conf_name"],  unserialize($config["conf_value"]));
				}	
			} 
		}

		public function callEvent($function, $args=array()) {									
			if(!is_callable($function)) 
				$this->log->warning("System: evento non richiamabile", __LINE__);
			else
				$function($this, $args);
		}
		
		public function loadGlobalObject() {
			if(_GLOBAL_OBJECT) {
				foreach($GLOBALS["_globalObject"] as $key=>$value) {
					$this->globalObject[$key] = new $value();	
				}
				$this->loadobject = true;
			}
		}
		
		public function loadVirtualFunction() {												
			if(_VIRTUAL_FUNCTION_ENABLE) {
				$query = $this->database->query("SELECT * FROM "._VIRTUAL_FUNCTION_DB_TABLE, true, true);
				while($function = $this->database->fetch_assoc($query)) {
					$this->function[$function["name"]] = create_function($function["args"], $function["code"]);
				}
				$this->callEvent("loadVirtualFunctEvent", array());
			}
		}
		
		public function loadLanguage() {
			system::$lang = new language();
			if(_MULTILANG_GEOLOC and _GEO_IP_ENABLE) {
				if(!$this->readCookie(_NAME_COOKIE_MULTILANG)) {
					$glob = _GEO_GLOB_NAME;
					$this->$glob->IpToCountry();
					// COMPLETE ME
				}				
			}
		}

		public function setLanguage($lang) {
			if(system::$lang != null) {
				system::$lang->setLang($lang);
			}
		}
		
		public function setPOSTonRegistry($array) {										
			if(!is_array($array)) {														
				$this->log->warning("Tentativo set POST non array", __LINE__);
				return false;
			}
			if(_SAFE_POST)																
				$this->registry->POST = $this->SafeArray($array);
			else
				$this->registry->POST = $array;
		}
		
		public function setCOOKIEonRegistry($array) {											
			if(!is_array($array)) {												
				$this->log->warning("Tentativo set COOKIE non array", __LINE__);
				return false;
			}
			$this->registry->COOKIE = $array;
		}
		
		public function setFILESonRegistry($array) {
			if(!is_array($array)) {												
				$this->log->warning("Tentativo set FILES non array", __LINE__);
				return false;
			}
			$this->registry->FILES = $array;
		}
		
		public function SafeArray($array) {															
			foreach($array as $key => &$value) {
				$array[$key] = trim(htmlspecialchars(htmlentities($value), ENT_QUOTES));
			}
			return $array;
		}
		
		public function ValidateEmail($email) {												
	  		$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		
		public function secure_link($controller, $method="", $label) {									
			if(_LOGIN_ENABLE) {
				return '<a href="index.php?'._GET_PAGE_NAME.'='.$controller.'/'.$method.'/sid='.$this->users->sid.'">'.$label.'</a>';
			}	
			else {
				$this->log->error("Secure Link: impossibile scrivere correttamente il link", __LINE__);
				return '';
			}	
		}
		
		public function sidValidate($sid, $admin = _SID_VALIDATE_ADMIN) {						
			if($user = $this->database->query("SELECT * FROM "._DB_TABLE_USERS." WHERE sid='".$sid."'")) {				
				if($admin) {
					if($this->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE id='".$user->group."' AND admin='1'") == 1)
						return true;
				}
				else {
					if($this->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE id='".$user->group."'") == 1)
						return true;
				}
			}
			return 0;
		}
		
		public function setCookie($name, $value, $expire = 3600) {								
			if(!setcookie($name, $value, time()+$expire))
				$this->log->error("Impossibile settare il cookie!", __LINE__);
		}
		
		public function readCookie($name, $defaultValue = _DEFAULT_COOKIE_VALUE) {				
			if(isset($_COOKIE[$name]) && $_COOKIE[$name]!="") {
				return $_COOKIE[$name];
			}	
			else {
				if($defaultValue != null) {
					$this->setCookie($name, $defaultValue);
					return $defaultValue;
				}
				else
					return false;
			}
		}	
	}
?>
