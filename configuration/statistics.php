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
	
	DEFINE('_STATISTICS_ENABLE', true);							// Abilitazione analisi statistica
	DEFINE('_STATISTICS_LOGIN_TABLE', 'stats_login');					// Tabella nel database che momorizza gli accessi giornarlieri
	DEFINE('_STATISTICS_PAGE_TABLE', 'stats_page');						// Tabella nel database che momorizza le visite sui controller
	DEFINE('_STATISTICS_ERROR_TABLE', 'stats_error');					// Tabella nel database che momorizza errori/warning
	DEFINE('_STATISTICS_LOADPAGETMP_TABLE', 'stats_tmp_loadpage');				// Tabella provvisoria per memorizzare i tempi di caricamento delle pagine
	DEFINE('_STATISTICS_LOADPAGE_TABLE', 'stats_loadpage');					// Tabella per memorizzare i tempi di caricamento delle pagine ogni giorno
	DEFINE('_STATISTICS_TIMEVISTTMP_TABLE', 'stats_tmp_timevist');				// Tabella provvisoria per memorizzare i tempi di visita
	DEFINE('_STATISTICS_TIMEVIST_TABLE', 'stats_timevist');					// Tabella dove vengono memorizzati i tempi di vista degli utenti
	DEFINE('_STATISTICS_BROWSER_TABLE', 'stats_browser');					// Tabella dovebrowser utilizzato
	
	$_statistics_browser = array(								// Array che associa il nome del browser con il suo id
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
	
	$GLOBALS["_configTable"]['_STATISTICS_LASTVIST_SESSION_VALIDE'] = serialize(300);				// Validità della sessione ( minuti )
	$GLOBALS["_configTable"]['_STATISTICS_LASTVIST_SESSION'] = serialize('lastVist');				// Sessione dove viene memorizzato il time() della visita

	if(_STATISTICS_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOGIN_TABLE] =  array(
							//	Nome campo			Tipo
								'id'		 	 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'INT(10)',										// Memorizza il giorno
								'number_login'	 => 	'INT(10)',										// Memorizaz numero login
		);
		
		$GLOBALS["_DB_STRUCT"][_STATISTICS_PAGE_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'controller'	 => 	'VARCHAR(50)',									// Memorizza il controller
								'number_visit' 	=> 	'INT(10)',										// Memorizza il numero di visite
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_BROWSER_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'browser'	 	=> 	'VARCHAR(50)',									// Memorizza il browser utilizzato
								'number' 		=> 	'INT(10)',										// Memorizza quante volte è stato utilizzato
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_TIMEVIST_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'INT(10)',										// Memorizza il giorno della misurazione
								'time_visit' 	=> 	'FLOAT(10)',									// Memorizza il tempo medio di visita giornaliero
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_TIMEVISTTMP_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'INT(10)',										// Memorizza il giorno della misurazione
								'hour'		 => 	'INT(10)',										// Memorizza l'ora della misurazione
								'time_visit' 	 => 	'FLOAT(10)',									// Memorizza il tempo della visita 
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOADPAGE_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'		 	 => 	'double',										// Memorizza il giorno della misurazione
								'time'		 => 	'FLOAT(10)',									// Memorizza quanto tempo la pagina ci ha messo a caricare 
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_LOADPAGETMP_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'day'			 => 	'double',										// Memorizza il giorno della misurazione
								'hour'		 => 	'INT(10)',										// Memorizza l'ora della misurazione
								'time'		 => 	'FLOAT(10)',									// Memoizza quanto tempo la pagina ci ha messo a caricare 
		);
		$GLOBALS["_DB_STRUCT"][_STATISTICS_ERROR_TABLE] =  array(
							//	Nome campo			Tipo
								'id'		 	=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'type'		=> 	'VARCHAR(50)',
								'number'	 	=> 	'INT(10)',
		);
	}
?>
