<?php
	/****
		*	File: view.php
		*	Descrizione: Classe per definizione delle view
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
	
	class Views {
		/*
			VARS:
				$vars: (array) view var
				$system: system object
				$orderTemplate: (array) ordered array of template
				$titlePage: Page title
				
			METHOD:
				__construct(): (call event createViewEvent)  get the system object and load the base template
				__destruct: load the base template and flush the output
				insertTemplate(): insert template into the ordertTemplate array
				insertTemplateFromFile(): insert template from file into the ordertTemplate array
				setTitlePage(): set the page title
				show(): render the page
				outputBuffer(): check the buffer and rewrite special word ( See configuration file )
		*/
	
		protected $vars = array();
		protected $system = null;
		public $orderTemplate = array();																			
		private static $titlePage = "";
		
		function __construct($vars, $tpl = "") {
			$this->system = system::getInstance();																	
			$this->system->callEvent("createViewEvent", array("time"=>round(microtime(true) - $this->system->registry->loadTime, 3)));
			
			if(is_array($vars)) {																					
				$this->vars = $vars;
			}	
			else {
				$this->system->log->warning("Assegnazione di array sbagliata", __LINE__);	
			}	
			
			if($tpl != "") {
				$this->orderTemplate[] = $tpl;																		
				self::$titlePage = ' - '.$tpl;	
			}
			
			if(!ob_start("Views::outputBuffer"))																		
					$this->system->log->error("Ob_start fallito", __LINE__);		
					
			include (_BASE_TOP);																				
			
			if(!_OB_START) 	 																					
				ob_end_flush();			
		}
		
		function __destruct() {
			include(_BASE_BOTTOM);																				
			ob_end_flush();
		}
				
		public function insertTemplate($tpl, $pos) {																	
				$tpl = _TEMPLATE_PATH.$tpl.'.php';					   												
				if (!file_exists($tpl)) 																				
				$this->system->log->error("Template non trovato! $tpl", __LINE__);
				$first=array_slice($this->orderTemplate, 0, $pos); 
				$second=array_slice($this->orderTemplate, $pos); 
				$this->orderTemplate = array_merge($first,(array)$tpl, $second); 
		}
			
		public function insertTemplateFromFile($path, $pos) {
			if (!file_exists($path)) 																				
					$this->system->log->error("Template non trovato! $tpl", __LINE__);
			$first=array_slice($this->orderTemplate, 0, $pos); 
			$second=array_slice($this->orderTemplate, $pos); 
			$this->orderTemplate = array_merge($first,(array)$path, $second); 
		}
			
		public function setTitlePage($title) {																			
			self::$titlePage = ' - '.$title;
		}
			
		public function show() {																					
			foreach($this->vars as $key => $value)																	
				$$key = $value;		
			if(count($this->orderTemplate) == 0)
				$this->system->log->error("Vista senza template!", __LINE__);
				
			foreach($this->orderTemplate as $valueTpl) {
				if($valueTpl == null)
					$this->system->log->error("Template non definito!", __LINE__);
				$this->system->callEvent("showEvent", array());		
				include( $valueTpl);																					
			}
		}
		
		public static function outputBuffer($buffer) {															
			$title_page =  str_replace('_',  ' ', _SITE_NAME.' '.ucfirst(self::$titlePage));
			$buffer = str_replace('$_TPage', $title_page , $buffer);													
			if(_REWRITE_OUTPUT) {																		
				foreach($GLOBALS["_rewriteBase"] as $key => $value)
					$buffer = str_replace($key, $value, $buffer);
			}			
			return $buffer; 
		}	
	}
?>
