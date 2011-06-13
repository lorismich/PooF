<?php
	/****
		*	File: log.php
		*	Descrizione: Gestore dei log
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
	
	class log {	
		private $file = null;
		private $system;
		
		function __construct() {
			$this->system = system::getInstance(); 										// Classe di sistema
			if(file_exists(_LOG_FILE) and filesize(_LOG_FILE) > _LOG_MAXSIZE_FILE)		// Controllo grandezza del file di log
				@unlink(_LOG_FILE);														// Cancello i vecchi log
			$this->file = fopen(_LOG_FILE, "a+");										// Apro il file per i log	
		}	
		
		function __destruct() {
			@fclose($this->file);
		}
		
		public function warning($txt, $line) {				// Gestore Warning
			$txt = "WARNING: $txt at line $line \r\n";
			fwrite($this->file, $txt);
			if($this->system->loadobject)
				$this->system->callEvent("warningEvent");		// Evento Warning
		}
		
		public function error($txt, $line) {				// Gestore Error
			$txt = "ERROR!!: $txt at line $line !!\r\n";
			fwrite($this->file, $txt);
			if($this->system->loadobject)
				$this->system->callEvent("errorEvent");			// Evento Error
			$this->CloseAndExit($txt);
		}
		
		private function CloseAndExit($text)
		{
			fclose($this->file);
			echo '<font color="red">'.$text.'</font><br> Contact the administrator';
			exit;
		}
	}
?>
