<?php
/****
		*	File: users.php
		*	Descrizione: File di configurazione per la gestione degli utenti
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
	DEFINE('_USERS_ENABLE', 1);					// Tabella nel database dedicata agli utenti
	DEFINE('_DB_TABLE_USERS', 'users');				// Tabella nel database dedicata agli utenti
	DEFINE('_DB_TABLE_GROUPS', 'groups');				// Tabella nel database per i gruppi
	DEFINE('_LOG_LOGIN_TABLE', "login_log");			// Tabella nel database per memorizzare i log degli accessi	
	
	$GLOBALS["_configTable"]['_USERS_CRYPT_PASSWORD'] = "md5";				// Metodo PHP per crittare password ATTENZIONE!! Non cambiare questa impostazione con utenti già registrati!	
	$GLOBALS["_configTable"]['_DEFAULT_GROUP'] = 'default';				// Gruppo di default 
	$GLOBALS["_configTable"]['_ADD_GROUP'] = true;					// Se un gruppo non esiste viene aggiunto automaticamente

	$GLOBALS["_configTable"]['_LOGIN_ENABLE'] = "1";		// Abilitazione login
	$GLOBALS["_configTable"]['_LOG_LOGIN'] = "1";		// Abilitazione dei log degli accessi
	$GLOBALS["_configTable"]['_LOG_MAX'] = "100";		// Numero massimo di log
	$GLOBALS["_configTable"]['_LOGIN_SESSION'] = "sid";		// Sessione impostata al login

	if(_USERS_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_LOG_LOGIN_TABLE] =  array(
								//	Nome campo			Tipo
									'id'		 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
									'name'		 => 	'VARCHAR(50)',
									'admin'		 => 	'TINYINT(1)'										// Diritti amministrativi	
		);

		$GLOBALS["_DB_STRUCT"][_DB_TABLE_GROUPS] =  array(
							//	Nome campo			Tipo								
								'id'			 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name'		 => 	'VARCHAR(50)',
								'admin'		 => 	'TINYINT(1)'												// Memorizaz numero login
		);
		$GLOBALS["_DB_STRUCT"][_DB_TABLE_USERS] =  array(
							//	Nome campo			Tipo
								'id'			 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'username'	 => 	'VARCHAR(200)',
								'sid'			 =>	'VARCHAR(50)',										// Sid impostato al momento del login
								'group'		 => 	'VARCHAR(10)',
								'password'	 => 	'VARCHAR(40)',
								'email'		 => 	'VARCHAR(50)',
								'time'		 =>	'INT(10)'
		);
	}
?>
