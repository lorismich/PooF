<?php

	/****
		*	File: xml.php
		*	Descrizione: Driver per la lettura/scrittura di file xml
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
	class xml {
		protected $system = null;
		private $document;
		private $element = array();
		
		function __construct() {	
			$this->system = system::getInstance();						// Carico la classe di sistema
		}
		
		private function createElement($name, $value = NULL, $attrs = NULL) {		// Creazione nuovo elemento xml
			$element = ($value != NULL ) ? $this->document->createElement($name, $value) : $this->document->createElement($name);
			if($attrs != NULL ) 
				foreach ($attrs as $attr=>$val)
					$element->setAttribute($attr, $val);	
			return $element;
		}
		
		public function newXML() {													// Nuovo documento xml
			$this->document = new DOMDocument(_XML_VERSION, _XML_ENCODING);
		}
		
		public function newElement($name, $text = '', $appendTo = '', $attrs = NULL) {
			if(!@$this->element[$name] = $this->createElement($name, $text, $attrs))
				$this->system->log->error("Impossibile creare l'elemento XML. Script terminato", __LINE__);
			if($appendTo == '')
				$this->document->appendChild($this->element[$name]);
			else
				if(!$this->element[$appendTo]->appendChild($this->element[$name]))
					$this->system->log->error("Errore nella sintassi XML. Script terminato", __LINE__);
					
			return $this->element[$name];	
		}
	
		public function writeXML($write = _XML_WRITE, $html = _XML_HTML, $exit = _XML_EXIT) {		// Output documento
			if($write)
				if($html)
					echo htmlspecialchars($this->document->saveXML());
				else	
					echo $this->document->saveXML();	
			if($exit)	
				exit;
		}
	}
?>
