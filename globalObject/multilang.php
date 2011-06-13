<?php

	/****
		*	File: multilang.php
		*	Descrizione: Gestione multilingua
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
	class  multilang {
		protected $system = null;
		
		function __construct() {	
			$this->system = system::getInstance();						// Carico la classe di sistema
		}
		
		public function changeLang($langID) {
			if(in_array($langID, $GLOBALS["_language"])) {					// Controllo se è ua lingua valida
				$this->system->setCookie(_NAME_COOKIE_MULTILANG, $langID);	// Imposto il cookie per il cambio della lingua
				@header("Location: index.php");							// Reindirizzo alla Home
			}	
		}
	}
?>
