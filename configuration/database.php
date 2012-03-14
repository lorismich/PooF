<?php
	/* 
		File configurazione database

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
	*/


	include _SITE_PATH . '/configuration/' . 'struct_database.php';			        // Database Structure

	DEFINE(	'_DB_HOST', 	"127.0.0.1");									// Database Host
	DEFINE(	'_DB_NAME', 	"poof");										// Database name
	DEFINE(	'_DB_USER', 	"root");										// Database username
	DEFINE(	'_DB_PSWD', 	"root");										// Database password
	DEFINE(	'_DB_TYPE', 	"sqlite");										// Database type (VALUES: mysql or sqlite)
	DEFINE(	'_DB_PREFIX', 	"");											// Table prefix
	DEFINE(	'_DB_REFRESH_STRUCT', 1);										// Enable refresh structure
	DEFINE(	'_DB_AUTO_CONN', true);											// Enable autoconnect
	
	// Sqlite
	DEFINE(	'_DB_FILE', "database");										// Sqlite database file
	DEFINE( '_DB_PATH', _SITE_PATH . "/include/database/");					// Sqlite database directory
	
?>
