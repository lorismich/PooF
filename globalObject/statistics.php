<?php
	/****
		*	File: statistics.php
		*	Descrizione: Classe per analizzare i dati statistici del sito
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
	
	class statistics {
		private $enable = false;
		protected $system;
		
		function __construct(){
			$this->system = system::getInstance(); 	
			if(_STATISTICS_ENABLE)
				$this->enable = true;
			$this->system->database->connect();						// Mi connetto al database
		}
		
		public function med($array) {									// Funzione calcolo della media
			$sum = 0;
			foreach($array as $num)
				$sum += $num;
			return $sum/count($array);	
		}
		
		
		
		public function statsLogin() {								// Funzione per raccogliere il numero di login giornalieri
			if($this->enable) {
				$time = round((((time())/60)/60)/24);
				if($this->system->database->numRows("SELECT * FROM "._STATISTICS_LOGIN_TABLE." WHERE day='".$time."'") == 0) {
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_LOGIN_TABLE." (day, number_login) VALUES ('".$time."', '1')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire il numero di login", __LINE__);
				}
				else {
					if(!$day = $this->system->database->query("SELECT * FROM "._STATISTICS_LOGIN_TABLE." WHERE day='".$time."'"))
						$this->system->log->error("Statistiche: Impossibile recuperare il giorno", __LINE__);
					if(!$this->system->database->query("UPDATE "._STATISTICS_LOGIN_TABLE." SET "._STATISTICS_LOGIN_TABLE.".number_login='".(($day->number_login)+1)."' WHERE day='".$time."'", true, true))
						$this->system->log->error("Statistiche: Impossibile incrementare il numero di login", __LINE__);
				}
			}
		}
		
		public function statsPage($page) {							// Funzione per memorizzare i controlleri visitati
			if($this->enable) {
				if($this->system->database->numRows("SELECT * FROM "._STATISTICS_PAGE_TABLE." WHERE controller='".$page."'") == 0) {
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_PAGE_TABLE." (controller, number_visit) VALUES ('".$page."', '1')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire la visita al controller", __LINE__);
				}
				else {
					if(!$visit = $this->system->database->query("SELECT * FROM "._STATISTICS_PAGE_TABLE." WHERE controller='".$page."'"))
						$this->system->log->error("Statistiche: Impossibile recuperare le visite del controller", __LINE__);
					if(!$this->system->database->query("UPDATE "._STATISTICS_PAGE_TABLE." SET "._STATISTICS_PAGE_TABLE.".number_visit='".(($visit->number_visit)+1)."' WHERE controller='".$page."'", true, true))
						$this->system->log->error("Statistiche: Impossibile incrementare il numero di visite", __LINE__);
				}
			}
		}
		
		public function warningStats() {							// Funzione per memorizzare il numero di warning generati
			if($this->enable) {
				if($this->system->database->numRows("SELECT * FROM "._STATISTICS_ERROR_TABLE." WHERE type='warning'") == 0) { 
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_ERROR_TABLE." (type, number) VALUES ('warning', '1')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire l'errore", __LINE__);
				}	
				else {
					if(!$warning = $this->system->database->query("SELECT * FROM "._STATISTICS_ERROR_TABLE." WHERE type='warning'"))
						$this->system->log->error("Statistiche: Impossibile recuperare gli errori", __LINE__);
					if(!$this->system->database->query("UPDATE "._STATISTICS_ERROR_TABLE." SET "._STATISTICS_ERROR_TABLE.".number='".(($warning->number)+1)."' WHERE type='warning'", true, true))
						$this->system->log->error("Statistiche: Impossibile incrementare il numero di error", __LINE__);
				}				
			}
		}
		
		public function errorStats() {								// Funzione per memorizzare il numero di errori generati
			if($this->enable) {
				if($this->system->database->numRows("SELECT * FROM "._STATISTICS_ERROR_TABLE." WHERE type='error'") == 0) { 
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_ERROR_TABLE." (type, number) VALUES ('error', '1')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire l'errore", __LINE__);
				}	
				else {
					if(!$error = $this->system->database->query("SELECT * FROM "._STATISTICS_ERROR_TABLE." WHERE type='error'"))
						$this->system->log->error("Statistiche: Impossibile recuperare gli errori", __LINE__);
					if(!$this->system->database->query("UPDATE "._STATISTICS_ERROR_TABLE." SET "._STATISTICS_ERROR_TABLE.".number='".(($error->number)+1)."' WHERE type='error'", true, true))
						$this->system->log->error("Statistiche: Impossibile incrementare il numero di error", __LINE__);
				}				
			}
		}
		
		public function TTLPage($timeLoad) {						// Funzione per memorizzare il tempo di caricamento medio delle pagine
			if($this->enable) {
				$day = (((time())/60)/60)/24;
				$hour = round(((time())/60)/60);
				$numTTLDay = $this->system->database->numRows("SELECT * FROM "._STATISTICS_LOADPAGETMP_TABLE." WHERE ROUND(day)='".round($day)."'");
				$allRows = $this->system->database->numRows("SELECT * FROM "._STATISTICS_LOADPAGETMP_TABLE);
				if($allRows != 0 and $numTTLDay == 0) {
					$med = 0;
					$sum = 0;
					$i = 0;
					$result = mysql_query("SELECT * FROM "._STATISTICS_LOADPAGETMP_TABLE); 
					while($time = $this->system->database->fetch_assoc($result)) {			// Calcolo la media dei valori giornalieri
						$sum += $time["time"];
						$i++;
					}
					$med = $sum/$i;
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_LOADPAGE_TABLE." (day, time) VALUES ('".$day."', '".$med."')", true, true)) // BUG: Fix Mesta
						$this->system->log->error("Statistiche: Impossibile inserire il tempo di caricamento della pagina", __LINE__);
					if(!$this->system->database->query("DELETE FROM "._STATISTICS_LOADPAGETMP_TABLE, true, true))			// Svuoto la tabella delle misurazioni giornaliere
						$this->system->log->error("Statistiche: Impossibile svuotare la tabella temporanea", __LINE__);
				}
				else {
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_LOADPAGETMP_TABLE." (day, hour, time) VALUES ('".$day."', '".$hour."', '".$timeLoad."')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire il tempo di caricamento della pagina", __LINE__);
				}
			}
		}
		
		public function visitTime($time) {							// Funzione per memorizzare il tempo di visita dfell'utente
			if($this->enable) {
				$day = round((((time())/60)/60)/24);
				$hour = round(((time())/60)/60);
				$numVistTimeDay = $this->system->database->numRows("SELECT * FROM "._STATISTICS_TIMEVISTTMP_TABLE." WHERE day='".$day."'");
				$allRows = $this->system->database->numRows("SELECT * FROM "._STATISTICS_TIMEVISTTMP_TABLE);
				if($allRows != 0 and $numVistTimeDay == 0) {
					$med = 0;
					$sum = 0;
					$i = 0;
					$result = mysql_query("SELECT * FROM "._STATISTICS_TIMEVISTTMP_TABLE);
					while($visit = $this->system->database->fetch_assoc($result)) {			// Calcolo la media dei valori giornalieri
						$sum += $visit["time_visit"];
						$i++;
					}
					$med = $sum/$i;
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_TIMEVIST_TABLE." (day, time_visit) VALUES ('".$day."', '".$med."')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire il tempo di vista giornaliero", __LINE__);
					if(!$this->system->database->query("DELETE FROM "._STATISTICS_TIMEVISTTMP_TABLE, true, true))			// Svuoto la tabella delle misurazioni temporanee
						$this->system->log->error("Statistiche: Impossibile svuotare la tabella temporanea", __LINE__);	
				}	
				else {
					if(!$this->system->database->query("INSERT INTO "._STATISTICS_TIMEVISTTMP_TABLE." (day, hour, time_visit) VALUES ('".$day."', '".$hour."', '".$time."')", true, true))
						$this->system->log->error("Statistiche: Impossibile inserire il tempo di visita", __LINE__);
				}
			}
		}
		
		public function browserStats($IDbrowser) {					// Funzione per memorizzare il browser utilizzato dall'utente
			if($this->enable) {
				$userBrowser = null;
				foreach($GLOBALS["_statistics_browser"] as $browser => $id) 
					if(strpos($IDbrowser, $id ))
						$userBrowser = $browser;
				if($userBrowser != null) {
					if($this->system->database->numRows("SELECT * FROM "._STATISTICS_BROWSER_TABLE." WHERE browser='".$userBrowser."'") == 0) { 
						if(!$this->system->database->query("INSERT INTO "._STATISTICS_BROWSER_TABLE." (browser, number) VALUES ('".$userBrowser."', '1')", true, true))
							$this->system->log->error("Statistiche: Impossibile inserire il browser utilizzato", __LINE__);
						}	
					else {
						if(!$browser = $this->system->database->query("SELECT * FROM "._STATISTICS_BROWSER_TABLE." WHERE browser='".$userBrowser."'"))
							$this->system->log->error("Statistiche: Impossibile recuperare i browser", __LINE__);
						if(!$this->system->database->query("UPDATE "._STATISTICS_BROWSER_TABLE." SET "._STATISTICS_BROWSER_TABLE.".number='".(($browser->number)+1)."' WHERE browser='".$userBrowser."'", true, true))
							$this->system->log->error("Statistiche: Impossibile incrementare il browser", __LINE__);
					}	
				}
			}
		}		
	}
?>
