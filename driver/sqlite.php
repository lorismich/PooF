<?php
	/****
		*	File: sqlite.php
		*	Descrizione: Driver per database Sqlite
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

	class sqlite implements databaseDriver {
		/*
		VARS:
			$conn: connection flag
			$db: database connection
			$system: system object
			$lastResult: query last result
			$affectedRows: query affectedRows
			$debug: debug flag

		METHOD:
			__construct(): get system object and connect the database
			__destruct(): close the database connection
			connect(): connect the database and update the database structure
			nonQuery(): execute a database query
			query(): execute a database query and return an array or a object
			write(): write into a table
			read(): read a table
			update(): update a table
			numRows(): query number rows
			fetch_assoc(): fetch assoc query
			refreshDbStruct(): update the database structure. See configuration file
		*/

		public $conn = false;
		public $db = null;
		private $system = null;
		public $lastResult = null;
		public $affectedRows = null;
		public $debug = 0;

		function __construct() {
			$this->system = system::getInstance();
			if(_DB_AUTO_CONN)
				$this->connect();
		}

		function __destruct() {
			if($this->conn)
				@$this->db->close();
			$this->conn = false;
		}

		public function connect($db_file = _DB_FILE) {	
			if(_ENABLE_DATABASE)
				if(!$this->conn) {
					if($this->db = new SQLite3(_DB_PATH . $db_file)) {
						$this->conn = true;
					
						if(_DB_REFRESH_STRUCT)
							$this->refreshDbStruct();
					}
					else
						$this->system->log->error("Driver sqlite: Impossibile connettersi al database ", __LINE__);
				}
		}

		public function nonQuery($query) {
			if(_ENABLE_DATABASE)
				if($this->conn) {
					$result =  $this->db->query($query);
					if($result) {
						if($this->debug)
							echo '<div style="color: green">'. $query .'</div>';
						return $result;
					}
					else {
						if($this->debug)
							echo '<div style="color: red">'. $query .'</div>';
						$this->system->log->error("Driver sqlite: Query errata", __LINE__);
					}
			}
		}

		public function query($query, $returnArray=false, $onlyQuery=false) {
			if(_ENABLE_DATABASE)
				if($this->conn) {
					$result = $this->db->query($query);
					
					if($onlyQuery) {
						if($this->debug)
							echo '<div style="color: green">'. $query .'</div>';
						return $result;
					}
					if(!$result) {
						if($this->debug)
							echo '<div style="color: red">'. $query .'</div>';
						$this->system->log->error("Driver sqlite: Query errata, errore", __LINE__);
					}
					if($returnArray) {
						$result->fetch_array($result);
						$this->lastResult = $result;	
						$this->affectedRows = $this->db->changes();
						return $result;
					}
					$result = $this->fetchObject($result);
					$this->lastResult = $result;
					$this->affectedRows = $this->db->changes();
					return $result;				
				}
				else
					$this->system->log->error("Driver sqlite: Impossibile eseguire la query, connessione non avvenuta", __LINE__);
		}
		
		// http://au2.php.net/manual/en/class.sqlite3result.php#101589 Thanks ;)
		function fetchObject($sqlite3result, $objectType = NULL) {
			$array = $sqlite3result->fetchArray();

			if(is_null($objectType)) {
				$object = new stdClass();
			} else {
				// does not call this class' constructor
				$object = unserialize(sprintf('O:%d:"%s":0:{}', strlen($objectType), $objectType));
			}
		   
			$reflector = new ReflectionObject($object);
			for($i = 0; $i < $sqlite3result->numColumns(); $i++) {
				$name = $sqlite3result->columnName($i);
				$value = $array[$name];
			   
				try {
				    $attribute = $reflector->getProperty($name);
				   
				    $attribute->setAccessible(TRUE);
				    $attribute->setValue($object, $value);
				} catch (ReflectionException $e) {
				    $object->$name = $value;
				}
			}
		   
			return $object;
		}

		public function write($table, $col, $value) {
			if(!is_array($col) or !is_array($value))
				$this->system->log->error("Driver sqlite: Impossibile eseguire la scrittura, array non validi", __LINE__);
			$query = "INSERT INTO $table SET (";
			foreach($col as $val)
				$query .= $val . ", ";
			$query = substr($query, 0, -2);
			$query .= ') VALUES (';
			foreach($value as $val)
				$query .= "'$val'" . ", ";
			$query = substr($query, 0, -2);
			$query .= ');';
			$this->nonQuery($query);
		}

		public function read($table, $col = array('*'), $where = "", $return = 1) {
			if(!is_array($col))
				$this->system->log->error("Driver sqlite: Impossibile eseguire la lettura, array non validi", __LINE__);

			$query = "SELECT ";
			foreach($col as $val)
				$query .= $val . ", ";
			$query = substr($query, 0, -2);
			$query .= " FROM " . $table;

			if($where != "") {
				$query .= " WHERE ".$where;
			}

			if($return == 1)
				return $this->query($query);
			else if($return == 0)
				return $this->query($query, 1);
			else
				return $this->nonQuery($query);
		}

		public function update($table, $col = array(), $value = array(), $where = "") {
			if(!_ENABLE_DATABASE)	return;
			if(!is_array($value) or !is_array($col))
				$this->system->log->error("Driver sqlite: Impossibile eseguire la lettura, array non validi", __LINE__);
			if(count($value) != count($col))
				$this->system->log->error("Driver sqlite: Impossibile eseguire la lettura, valori array non corrispondenti", __LINE__);
			$query = "UPDATE ".$table." SET ";
			for($i = 0; $i<count($col); $i++)
				$query .= $col[$i]."='".$value[$i]."', ";
			$query = substr($query, 0, -2);
			if($where != "")
				$query .= " WHERE ".$where;

			return $this->nonQuery($query);
		}

		public function numRows($query) {
			if(_ENABLE_DATABASE)					
				if($this->conn) {
					// Num rows not implemented in SQLITE3 library :(
					$result = $this->nonQuery($query);										
					if(!$result)
						$this->system->log->error("Driver sqlite: Query errata, errore: ".mysql_error(), __LINE__);
					
					$count = 0;
					while($row = $result->fetchArray())
						$count++;
					
					$this->lastResult = $result;
					return $count;
				}
				else
					$this->system->log->error("Driver mysql: Impossibile eseguire la query, connessione non avvenuta", __LINE__);
			}

		public function fetch_assoc($result) {
			if(!_ENABLE_DATABASE) 
				return;
				
			if(!$result) {
				$this->system->log->warning("Driver mysql: Impossibile eseguire fetch_assoc, query non valida", __LINE__);
				return;
			}
			return $result->fetchArray();
		}

		private function refreshDbStruct() {											
			if(!_ENABLE_DATABASE)	return;
			$res = $this->nonQuery("SELECT name FROM main.sqlite_master WHERE type='table';");
			$table = array();

			while($row = $res->fetchArray())
				$table[] = "$row[0]";

			$tableConf = array();
			$fieldConf = array();

			foreach($GLOBALS["_DB_STRUCT"] as $t=>$st) {
				$fieldConf[$t] = array();
				foreach($st as $key=>$value)
					$fieldConf[$t][] = "$key";
				$tableConf[] = "$t";
			}

			foreach($GLOBALS["_DB_STRUCT"] as $tables => $struct) {
				$query = "";
			
				if($table == "" or !in_array($tables, $table)) {
					
					$query .= "CREATE TABLE "._DB_PREFIX.strtolower($tables)." (";
					foreach($struct as $filed => $type) {
						$query.= "`$filed` $type, ";
					}
					$query = substr($query, 0, -2).');';
					
					// FIX for auto_increment not supported by Sqlite
					// for make an auto increment field in sqlite: CREATE TABLE table (field INTEGER PRIMARY KEY, ... );
					
					// Replace "auto_increment" string
					$query = str_ireplace("auto_increment", "", $query);
					
					// TODO: check the field type
					// if the field if auto_increment the type must me INTEGER not INT(n)
			
					$this->system->log->warning("Query eseguita: $query", __LINE__);
					$this->nonQuery($query);

				}
				else if(in_array($tables, $table)) {
					$res = $this->db->query("PRAGMA table_info($tables)");
					$field_array = array();
				
					while($row = $res->fetchArray()) {
						$field_array[] = $row["name"];
					}	
					
					foreach($struct as $filed => $type) {
						if (!in_array($filed, $field_array)) {
							$query = "ALTER TABLE $tables ADD `$filed` $type NOT NULL;";
							$this->system->log->warning("Query eseguita: $query", __LINE__);
							$this->query($query);
						}
					}
				}
			}
			foreach($table as $key => $tableDb) {
				if(!in_array(strtolower($tableDb), $tableConf)) {
					$res = $this->query("DROP TABLE ".$tableDb);
					if($res)
						$this->system->log->warning("Tabella cancellata: $tableDb", __LINE__);
				}
				else {
					$res = $this->nonQuery("PRAGMA table_info($tableDb)");
					$field = array();
				
					while($row = $res->fetchArray()) {
						$field[] = $row["name"];
					}	

					foreach($field as $key=>$fieldDb) {
						if(!in_array($fieldDb, $fieldConf[$tableDb])) {
							$res = $this->query("ALTER TABLE `$tableDb` DROP `$fieldDb`;");
							if($res)
								$this->system->log->warning("Campo cancellato: $fieldDb nella tabella $tableDb", __LINE__);
						}
					}
				}
			}
		}
	}
?>
