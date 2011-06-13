<?php
	/****
		*	File: multilang.php
		*	Descrizione: Configurazione multilingua
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
	


	DEFINE('_MULTILANG_ENABLE', true);				// Abilitazione multilingua ( richiede _OB_START = true )
	DEFINE('_MULTILANG_TABLE', 'multilang');			// Nome tabella nel database
	DEFINE('_MULTILANG_GEOLOC', true);				// Geolocalizza l'utente per impostare la lingua esatta richiede _GEO_IP_ENABLE = true
	
	/* Definizioni lingue */
	$_language = array(
		"Italiano" 	=> 	"IT",						// Italiano
		"English" 	=> 	"US",						// Inglese
	);
	
	/*if(_MULTILANG_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_MULTILANG_TABLE] =  array(
							//	Nome campo			Tipo
								'id'		=>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'language'	 => 	'VARCHAR(5)',									// Memorizza la lingua
								'text'	 	 =>	'TEXT',										// Testo da sostituire
								'rewrite_to'	 => 	'TEXT',										// Memorizza la traduzione
		);
	}
*/
	$GLOBALS["_configTable"]['_NAME_COOKIE_MULTILANG'] = "MultiLang";		// Nome del cookie per riconoscere la lingua utilizzata
	$GLOBALS["_configTable"]['_DEFAULT_LANG'] = "IT";				// Lingua di default
	$GLOBALS["_configTable"]['_language'] = $_language;				// Lingue disponibili
	

?>	
