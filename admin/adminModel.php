<?php
	class adminModel extends Models {
		public function loginAdmin($username, $password) {
			if(_LOGIN_ENABLE) {
				if($this->system->users->auth($username, $password)) {
					$this->system->users->dataUser();
					return $this->system->users->data["sid"];
				}
				return false;
			}	
			else {
				$this->system->log->warning("Gestione amministrazione: Login disabilitato", __LINE__);
				return 0;
			}				
		}
	
		public function logout() {
			$this->system->users->logout();
		}

		public function configArrayToText($varConfig, $multArray = 0) {
			$str = '';
			if(is_array($GLOBALS["_configTable"][$varConfig])) 
				foreach($GLOBALS["_configTable"][$varConfig] as $key=>$value) { 
					if($multArray)			
						$str .= $key.' => '.$value.', ';
					else 
						$str .= $value.', ';
				}
			else
				$str = $GLOBALS["_configTable"][$varConfig];
			return $str;
		}	

		public function configTextToArray($name, $value, $multiArray = 0, $isArray = 1) {
			$array = array();
			if($isArray) {			
				if($multiArray) {
					$value = str_replace(",", "", $value);
					$value = explode(" => ", $value);
					if((count($value)/2) >= 1)
						for($i = 0; $i<=count($value)/2; $i += 2) 
							$array[(string)$value[$i]] =  $value[$i+1];
				}
				else  {
					$array = explode(", ", $value);
				}
			}
			else {
				$array = $value;
			}
			$GLOBALS["_configTable"][$name] = $array;
			$this->system->syncConfiguration();
		}

		public function getStats($table, $data, $value, $groupBy = "") {
			$array = array();
			if($groupBy != "")
				$query = $this->system->database->query("SELECT * FROM ".$table." GROUP BY ".$groupBy." DESC LIMIT 4", true, true); 
			else
				$query = $this->system->database->query("SELECT * FROM ".$table." DESC LIMIT 4", true, true); 
			if($query)	
				while($row = $this->system->database->fetch_assoc($query)) 
					$array[$row[$data]] = $row[$value];
			return $array;
		} 

		public function readLog() {
			return trim(file_get_contents(_LOG_FILE));
		}
		
		public function deleteLog() {
			return unlink(_LOG_FILE);
		}
	}
?>
