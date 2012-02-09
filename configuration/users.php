<?php
/****
		*	File: users.php
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
	DEFINE('_USERS_ENABLE', 1);								// Enable users
	DEFINE('_DB_TABLE_USERS', 'users');						// Database table for user
	DEFINE('_DB_TABLE_GROUPS', 'groups');					// Database table for groups
	DEFINE('_LOG_LOGIN_TABLE', "login_log");				// Database table for user's log 
	
	$GLOBALS["_configTable"]['_USERS_CRYPT_PASSWORD'] = "md5";		// PHP crypt method ( DO NOT CHANGHE THIS OPTION WITH REGISTERED USERS! )
	$GLOBALS["_configTable"]['_DEFAULT_GROUP'] = 'default';			// Default gruop 
	$GLOBALS["_configTable"]['_ADD_GROUP'] = true;					// If the group don't exist, create it automaticaly ?

	$GLOBALS["_configTable"]['_LOGIN_ENABLE'] = "1";				// Enable login
	$GLOBALS["_configTable"]['_LOG_LOGIN'] = "1";					// Enable log for login
	$GLOBALS["_configTable"]['_LOG_MAX'] = "100";					// Max log
	$GLOBALS["_configTable"]['_LOGIN_SESSION'] = "sid";				// Session for the login

	if(_USERS_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_LOG_LOGIN_TABLE] =  array(
									'id'		 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
									'name'		 => 	'VARCHAR(50)',
									'admin'		 => 	'TINYINT(1)'											
		);

		$GLOBALS["_DB_STRUCT"][_DB_TABLE_GROUPS] =  array(								
								'id'			 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name'		 => 	'VARCHAR(50)',
								'admin'		 => 	'TINYINT(1)'												
		);
		$GLOBALS["_DB_STRUCT"][_DB_TABLE_USERS] =  array(
								'id'			 => 	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'username'	 => 	'VARCHAR(200)',
								'sid'			 =>	'VARCHAR(50)',										
								'group'		 => 	'VARCHAR(10)',
								'password'	 => 	'VARCHAR(40)',
								'email'		 => 	'VARCHAR(50)',
								'time'		 =>	'INT(10)'
		);
	}
?>
