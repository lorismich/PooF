<?php

	/****
		*	File:geoloc.php
		*	Descrizione: Gestione geolocalizzazione
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
	class geoloc {
		protected $system = null;
		public $ip = null;		

		function __construct() {	
			$this->system = system::getInstance();												
		}
		
		private function IP() {
			if(!_GEO_ENABLE) return false;
			if(_GEO_IP_REMOTE) {
				$this->ip = @file_get_contents('http://www.whatismyip.com/automation/n09230945.asp');		
			}
			else
				$this->ip = getenv("REMOTE_ADDR"); 
			return $this->ip;
		}

		public function IpToCountry() {
			$this->IP();	
			if(_ENABLE_DATABASE and $this->ip != "") {
				if($this->system->database->numRows("SELECT * FROM "._GEO_IP_TO_COUNTRY_TABLE) == 0)
					$this->system->log->error("La tabella della conversione è vuota, caricare il file sql (include/resource/sql/ip_to_country_table.sql)", __LINE__);
				$array = explode('.', $this->ip);
				$ip_converted = $array[3]+($array[2]*256)+($array[1]*256*256)+($array[0]*256*256*256);
				$query = $this->system->database->query("SELECT * FROM "._GEO_IP_TO_COUNTRY_TABLE." WHERE IP_FROM < ".$ip_converted." AND IP_TO > ".$ip_converted, true);		
				return $query["COUNTRY"];
			}	
		}
	}
?>
