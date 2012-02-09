<?php
	/****
		*	File: statistics.php
		*	Descrizione: Configurazione analisi statistica
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
	
	DEFINE('_STATISTICS_ENABLE', true);								// Enable statiscts
	DEFINE('_STATISTICS_LOGIN_TABLE', 'stats_login');				// Database table for login data
	DEFINE('_STATISTICS_PAGE_TABLE', 'stats_page');					// Database table for controller data
	DEFINE('_STATISTICS_ERROR_TABLE', 'stats_error');				// Database table for error & wariong data
	DEFINE('_STATISTICS_LOADPAGETMP_TABLE', 'stats_tmp_loadpage');	// Database table for the load page time ( tmp )
	DEFINE('_STATISTICS_LOADPAGE_TABLE', 'stats_loadpage');			// Database table for the load page time everyday
	DEFINE('_STATISTICS_TIMEVISTTMP_TABLE', 'stats_tmp_timevist');	// Database table for visit time ( tmp )
	DEFINE('_STATISTICS_TIMEVIST_TABLE', 'stats_timevist');			// Database table for visit time
	DEFINE('_STATISTICS_BROWSER_TABLE', 'stats_browser');			// Database table for users's browser
	
	$_statistics_browser = array(					
			"Internet Explorer" => "MSIE",
			"Firefox" => "Firefox",
			"Google Chrome" => "Chrome",
			"Lynx" => "Lynx",
			"Opera" => "Opera",
			"WebTV" => "WebTV",
			"Konqueror" => "Konqueror",
			"Bot" => "bot|Google|slurp|scooter|spider|infoseek",
			"Netscape" => "Nav|Gold|x11|Netscape"
	);	
	
	$GLOBALS["_configTable"]['_STATISTICS_LASTVIST_SESSION_VALIDE'] = serialize(300);		// Valid sessione ( minute )
	$GLOBALS["_configTable"]['_STATISTICS_LASTVIST_SESSION'] = serialize('lastVist');		// Sessione for visit time()

	if(_STATISTICS_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOGIN_TABLE] =  array(
								'id'		 	 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'INT(10)',										
								'number_login'	 => 	'INT(10)',									
		);
		
		$GLOBALS["_DB_STRUCT"][_STATISTICS_PAGE_TABLE] =  array(
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'controller'	=> 	'VARCHAR(50)',									
								'number_visit' 	=> 	'INT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_BROWSER_TABLE] =  array(
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'browser'	 	=> 	'VARCHAR(50)',									
								'number' 		=> 	'INT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_TIMEVIST_TABLE] =  array(
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			=> 	'INT(10)',										
								'time_visit' 	=> 	'FLOAT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_TIMEVISTTMP_TABLE] =  array(
	
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			=> 	'INT(10)',										
								'hour'		 	=> 	'INT(10)',										
								'time_visit' 	=> 	'FLOAT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOADPAGE_TABLE] =  array(
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'		 	=> 	'double',										
								'time'		 	=> 	'FLOAT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOADPAGETMP_TABLE] =  array(
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'double',										
								'hour'		 => 	'INT(10)',									
								'time'		 => 	'FLOAT(10)',									
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_ERROR_TABLE] =  array(
								'id'		 	=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'type'		=> 	'VARCHAR(50)',
								'number'	 	=> 	'INT(10)',
		);
	}
?>
