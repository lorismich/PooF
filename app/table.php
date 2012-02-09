<?php
	/****
		*	File: table.php
		*	Descrizione: Astrazione di una tabella del database
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

	class table {
		/*
			Interface with the database driver
		
			VARS:
				$system: system object
				$nameTable: Name of the load table
				
			METHOD:
				__construct(): get the system objec and set the table name
				write(): write a record
				read(): read a record
				read_array(): read a record and return an array
				onlyQuery(): execute a database query
				fetch_assoc(): fetch the result
				update(): update a record
		*/
	
		private $system = null;
		public $nameTable = null;

		function __construct($nameTable) {
			$this->system = system::getInstance();
			$this->nameTable = $nameTable;
		}

		function __destruct() {
		
		}

		public function write($col = array(), $value = array(), $debug = 0) {
			if(!is_array($col) or !is_array($value))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non validi", __LINE__);
			if(count($col) != count($value))
				$this->system->log->error("Database Table: I capi non coincidono con i valori", __LINE__);
			if($debug == 1)
				$this->system->database->debug = 1;
			$this->system->database->write($this->nameTable, $col, $value);
		}

		public function read($col = array(), $where = "") {
			if(!is_array($col))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non validi", __LINE__);
			return $this->system->database->read($this->nameTable, $col, $where);
		}

		public function read_array($col = array(), $where = "") {
			if(!is_array($col))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non validi", __LINE__);
			return $this->system->database->read($this->nameTable, $col, $where, 0);
		}

		public function onlyQuery($col = array(), $where = "") {
			if(!is_array($col))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non validi", __LINE__);
			return $this->system->database->read($this->nameTable, $col, $where, -1);
		}

		public function fetch_assoc($result) {
			return $this->system->database->fetch_assoc($result);
		}

		public function update($col, $value, $where = "") {
			if(!is_array($col) || !is_array($value))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non validi", __LINE__);
			if(count($col) != count($value))
				$this->system->log->error("Database Table: Impossibile eseguire la scrittura, array non corrispondenti", __LINE__);
			return $this->system->database->update($this->nameTable, $col, $value, $where);
		}
	}
