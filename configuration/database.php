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


	include _SITE_PATH . '/configuration/' . 'struct_database.php';			        // Definizione dela struttura del database

	DEFINE(	'_DB_HOST', 	"127.0.0.1");									// HOST
	DEFINE(	'_DB_NAME', 	"poof");									// NOME DATABASE
	DEFINE(	'_DB_USER', 	"root");									// USERNAME
	DEFINE(	'_DB_PSWD', 	"root");									// PASSWORD
	DEFINE(	'_DB_TYPE', 	"mysql");									// TIPO DATABASE
	DEFINE(	'_DB_PREFIX', 	"");									// PREFISSO TABELLE
	DEFINE(	'_DB_REFRESH_STRUCT', 1);									// ABILITAZIONE CREAZIONE STRUTTURA DATABASE
	DEFINE(	'_DB_AUTO_CONN', true);										// ABILITAZIONE AUTOCONNESSIONE
?>
