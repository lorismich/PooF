<?php
	/****
		*	File: databaseDriver.php
		*	Descrizione: Interfaccia Driver Database
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

	interface databaseDriver {	
		function __construct();
		function __destruct();		
		
		public function connect();
		public function nonQuery($query);
		public function query($query, $returnArray=false);
		public function write($table, $col, $value);
		public function read($table, $col = array('*'), $where = "");
		public function update($table, $value = array(), $where = "");
		public function numRows($query);
		public function fetch_assoc($result);
	}
	
?>
