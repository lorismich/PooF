<?php
/****
		*	File: events.php
		*	Descrizione: Configurazione per definire eventi
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
		
	function loginEvent($system, $args) {							// Evento richiamato al login di un utente
		$system->statistics->statsLogin();
	}
	
	function getControllerEvent($system, $args) {						// Evento richiamato quando il router identifica il controller da richiamare
		$system->statistics->statsPage($args["page"]);
	}
	
	function warningEvent($system, $args) {							// Evento richiamato quando viene genreato un warning
		$system->statistics->warningStats();
	}
	
	function errorEvent($system, $args) {							// Evento richiamato quando si verfica un errore
		$system->statistics->errorStats();
	}
	
	function showEvent($system, $args) {							// Evento richiamato quando la vista esegue le funzione show()
	
	}
	
	function bootEvent($system, $args) {							// Evento richiamato in fase di boot
		if(isset($args["idbrowser"]) and $args["idbrowser"] != "")
			$system->statistics->browserStats($args["idbrowser"]);	
	}
	
	function timeVisit($system, $args) {
		if(isset($args["timeVisit"]) and $args["timeVisit"] != "")
			$system->statistics->visitTime($args["timeVisit"]);
	}
	
	function createViewEvent($system, $args) {
		$system->statistics->TTLPage($args["time"]);	
	}
	
	function loadVirtualFunctEvent($system, $args) {					// Evento richiamato al caricamento delle Virtual Function
	
	}

?>
