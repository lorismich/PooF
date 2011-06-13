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
		protected $vars = array();
		protected $system = null;
		public $orderTemplate = array();																			// Array con i template usati in ordine
		private static $titlePage = "";
		
		function __construct($vars, $tpl = "") {
			$this->system = system::getInstance();																	// Classe di sistema
			$this->system->callEvent("createViewEvent", array("time"=>round(microtime(true) - $this->system->registry->loadTime, 3)));
			
			if(is_array($vars)) {																					// Controllo che le variabili del controller siano in un array
				$this->vars = $vars;
			}	
			else {
				$this->system->log->warning("Assegnazione di array sbagliata", __LINE__);	
			}	
			
			if($tpl != "") {
				$this->orderTemplate[] = $tpl;																		// Imposto il template di base
				self::$titlePage = ' - '.$tpl;	
			}
			
			if(!ob_start("Views::outputBuffer"))																		// Abilitazione output buffer
					$this->system->log->error("Ob_start fallito", __LINE__);		
					
			include (_BASE_TOP);																				// Base html
			
			if(!_OB_START) 	 																					// Se non è disattivato ob_start lo disattivo
				ob_end_flush();			
		}
		
		function __destruct() {
			include(_BASE_BOTTOM);																				// Base html
			ob_end_flush();
		}
				
		public function insertTemplate($tpl, $pos) {																	// Metodo per la gestione dei template
				$tpl = _TEMPLATE_PATH.$tpl.'.php';					   												// Cerco il template
				if (!file_exists($tpl)) 																				// Controllo esistenza del template
					$this->system->log->error("Template non trovato! $tpl", __LINE__);
				$first=array_slice($this->orderTemplate, 0, $pos); 
				$second=array_slice($this->orderTemplate, $pos); 
				$this->orderTemplate = array_merge($first,(array)$tpl, $second); 
		}
			
		public function insertTemplateFromFile($path, $pos) {
			if (!file_exists($path)) 																				// Controllo esistenza del template
					$this->system->log->error("Template non trovato! $tpl", __LINE__);
			$first=array_slice($this->orderTemplate, 0, $pos); 
			$second=array_slice($this->orderTemplate, $pos); 
			$this->orderTemplate = array_merge($first,(array)$path, $second); 
		}
			
		public function setTitlePage($title) {																			// Metodo per impostare il titolo della pagina 
			self::$titlePage = ' - '.$title;
		}
			
		public function show() {																					// Metodo per fare il rendering della pagina	
			foreach($this->vars as $key => $value)																	// Assegno le variabili
				$$key = $value;		
			if(count($this->orderTemplate) == 0)
				$this->system->log->error("Vista senza template!", __LINE__);
				
			foreach($this->orderTemplate as $valueTpl) {
				if($valueTpl == null)
					$this->system->log->error("Template non definito!", __LINE__);
				$this->system->callEvent("showEvent", array());		
				include( $valueTpl);																					// Includo il template
			}
		}
		
		public static function img($id, $img, $echo = true, $mouseOver = "", $mouseOut = "") {
			if(!is_file(_IMG_PATH.$img))
				return;
			if($echo)
				echo '<img id="'.$id.'" src="'._IMG_PATH.$img.'" onmouseover="'.$mouseOver.'" onmouseout="'.$mouseOut.'">';
			else
				return '<img id="'.$id.'" src="'._IMG_PATH.$img.'" onmouseover="'.$mouseOver.'" onmouseout="'.$mouseOut.'">';
		}
		
		public static function a($href = "", $label = "", $mouseOver = "", $mouseOut = "") {
			if($href != "" and $label != "")
				echo '<a href="'.$href.'" onmouseover="'.$mouseOver.'" onmouseout="'.$mouseOut.'">'.$label.'</a>';
		}
		
		public static function outputBuffer($buffer) {															// Funzione per il controllo del buffer
			$title_page =  str_replace('_',  ' ', _SITE_NAME.' '.ucfirst(self::$titlePage));
			$buffer = str_replace('$_TPage', $title_page , $buffer);												// Imposto il titolo della pagina	
			if(_REWRITE_OUTPUT) {																		// Sostiuisco le parole speciali in rewrite_base.php
				foreach($GLOBALS["_rewriteBase"] as $key => $value)
					$buffer = str_replace($key, $value, $buffer);
			}			
			return $buffer; 
		}	
	}
?>
