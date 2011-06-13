<?php
	/****
		*	File: Language.php
			Gestione multilingua			
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
	
	class language {
		 private $system = null;
		 public $language = null;
   		 private $storage = array();

		 public function __construct() {
			$this->system = system::getInstance();						
		 }

		 public function __get($root) {
			if($this->language == null) {
				$this->setLang(_MULTILANG_DEFAULT);
			}
			if(isset($this->storage[$root]))
				return $this->storage[$root];
			else 
				return null;		    
		 }

		 public function setLang($language) {
			$this->language = $language;
			$this->load();
		 }
			
		 private function load() {
			$location = _MULTILANG_FILE . $this->language . '.php';
			if(file_exists($location)) {
			     require_once $location;
			     if(isset($lang)) {
				 $this->storage = $lang;
				 unset($lang);
			     }
			}
			else {
				$location = _MULTILANG_FILE . _MULTILANG_DEFAULT . '.php';
				if(file_exists($location)) {
			    	require_once $location;
			    	if(isset($lang)) {
					$this->storage = (object)$lang;
					unset($lang);
				     }
				}
				else
					$this->system->log->error("Resource language non trovata! ".$location, __LINE__);	
			}	
		 }
	 }
?>
