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
		
	function loginEvent($system, $args) {							// When user log in
		$system->statistics->statsLogin();
	}
	
	function getControllerEvent($system, $args) {					// When router found the controller
		$system->statistics->statsPage($args["page"]);
	}
	
	function warningEvent($system, $args) {							// When warning log
		$system->statistics->warningStats();
	}
	
	function errorEvent($system, $args) {							// When error log
		$system->statistics->errorStats();
	}
	
	function showEvent($system, $args) {							// When the view execute show() function
	
	}
	
	function bootEvent($system, $args) {							// When boot the framework
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
	
	function loadVirtualFunctEvent($system, $args) {					// When virtual function load
	
	}

?>
