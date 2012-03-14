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
		/***
			Var:
				$file = log file
				$system = system object

			Method:
				__construct(): open log file and check the size
				__destruct(): close log file
				warning(): Manage the warning
				error(): Manage the error
				query(): execute a query and return or an object result or an array result
				CloseAndExit(): close log file, print a message and exit
		***/

		private $file = null;
		private $system;

		function __construct() {
			$this->system = system::getInstance(); 										
			if(file_exists(_LOG_FILE) and filesize(_LOG_FILE) > _LOG_MAXSIZE_FILE)		
				@unlink(_LOG_FILE);														
			$this->file = @fopen(_LOG_FILE, "a+");										
		}	
		
		function __destruct() {
			@fclose($this->file);
		}
		
		public function warning($txt, $line) {				
			$txt = "WARNING: $txt at line $line \r\n";
			@fwrite($this->file, $txt);
			if($this->system->loadobject)
				$this->system->callEvent("warningEvent");		
		}
		
		public function error($txt, $line) {				
			$txt = "ERROR!!: $txt at line $line !!\r\n";
			@fwrite($this->file, $txt);
			if($this->system->loadobject)
				$this->system->callEvent("errorEvent");			
			$this->CloseAndExit($txt);
		}
		
		private function CloseAndExit($text)
		{
			@fclose($this->file);
			echo '<font color="red">'.$text.'</font><br> Contact the administrator';
			exit;
		}
	}
?>
