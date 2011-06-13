<?php
	/****
		*	File: config.php
		*	Descrizione: Configurazione generale
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
	
	DEFINE('_CONTROLLER_PATH', _SITE_PATH . '/controllers/');					// Cartella di default per i controller
	DEFINE('_TEMPLATE_PATH' ,  _SITE_PATH . '/template/');						// Cartella di default per i template
	DEFINE('_VIEW_PATH' ,  _SITE_PATH . '/view/');							// Cartella di default per le viste
	DEFINE('_MODELS_PATH',  _SITE_PATH . '/models/');						// Cartella di default per i modelli
	DEFINE('_GLOBAL_OBJECT_PATH' ,  _SITE_PATH . '/globalObject/');					// Cartella di default per i globalObject

	/**** 
		*
		*	Elenco configurazione di base
		* 
		*	Questa configurazione è quella di default che verrà salvata nel database, 
		*	modificabile poi dall'amministrazione.
	****/
	$_configTable = array(
		// Configurazione Generale
		'_SITE_NAME' => ':PooF',								// Nome del sito
		'_OB_START'=> 1,								// Abilitazione buffer output
		'_REWRITE_OUTPUT' => true,								// Abilitazione riscrittura buffer output ( richiede _OB_START = true)		
		'_IMG_PATH' =>'include/image/',							// Cartella di default per le immagini
		'_MULTILANG_FILE' => _SITE_PATH . '/include/resource/language/',			// Cartella resource multilingua
		'_MULTILANG_DEFAULT' =>'default',							// File multilingua default	
		'_GET_PAGE_NAME' => 'p',								// Parametro GET che identifica il contoller
		'_DEFAULT_CONTROLLER' => 'home',							// Default controller
		'_CONTROLLER_404' => 'not_found',							// Controller per errore 404
		'_SAFE_POST' => true,								// Controllo array POST
		'_DEFAULT_COOKIE_VALUE' => null,							// Valore di default per i cookie ( null per non impostare niente )
		
	);

	include _SITE_PATH . '/configuration/' . 'router.php';				// Carico la configurazione del router
	include _SITE_PATH . '/configuration/' . 'database.php';			// Carico la configurazione del database
	include _SITE_PATH . '/configuration/' . 'rewrite_base.php';			// Carico la configurazione per la sostituzione di stringe nelle basi html	
	include _SITE_PATH . '/configuration/' . 'multilang.php';			// Carico la funzione shutodown	
	include _SITE_PATH . '/configuration/' . 'newsletter.php';			// Carico la configurazione per la newsletter
	include _SITE_PATH . '/configuration/' . 'photogallery.php';			// Carico la configurazione per la gestione della photogallery
	include _SITE_PATH . '/configuration/' . 'news.php';				// Carico la configurazione per le news
	include _SITE_PATH . '/configuration/' . 'events.php';				// Carico la configurazione per gestire gli eventi
	include _SITE_PATH . '/configuration/' . 'statistics.php';			// Carico la configurazione per l'analisi statistica
	include _SITE_PATH . '/configuration/' . 'users.php';				// Carico la configurazione per la gestione degli utenti
	include _SITE_PATH . '/configuration/' . 'xml.php';				// Carico la configurazione per la gestione xml
	include _SITE_PATH . '/configuration/' . 'graphics.php';			// Carico la configurazione per la libreria grafica
	include _SITE_PATH . '/configuration/' . 'geoloc.php';				// Carico la configurazione per la geolocalizzazione
	include _SITE_PATH . '/configuration/' . 'shutdown.php';			// Carico la funzione shutodown
	
	/**** 
		*
		*	Elenco globalObject
		*	Forma: nome oggetto => nome della classe
		* 
		*	I GlobalObject saranno inclusi nella classe system.
		*	es: il driver per il database sarà ritracciabile usando $this->system->database in quasiasi classe.
	****/		
	$_globalObject = array(
					'statistics' => "statistics",						// Analisi statistica
					'users' => "users",							// Gestione utenti e login
					'xml' => "xml",								// XML
					'graphics' => "graphics",						// Libreria grafica		
					'news' => "news_go",							// Gestione news
					"photo" => "photogallery",						// Gestione della photogallery
					"newsletter" => "newsletter",						// Gestione della newsletter
					"geoloc" => "geoloc",							// Geolocalizzazione
	);
	
	DEFINE('_POOF_VERSION', '1.0');											// Versione framework											
	DEFINE('_ENABLE_DATABASE', 1);										// Abilitazione database
	DEFINE('_ENABLE_ERROR', E_ALL);											// Abilitazione errori
	
	DEFINE('_LOG_FILE', _SITE_PATH . '/log/log.txt');								// File log errori
	DEFINE('_LOG_MAXSIZE_FILE', 1024);										// Grandezza massima file di log (byte)
	
	
	DEFINE('_LOAD_ARGS_INTO_VARS', true);								// Carica le variabili GET nell array VARS del controller
	
	DEFINE('_GLOBAL_OBJECT', 1);											// Abilitazione Global Object

	DEFINE('_BASE_TOP', _SITE_PATH . '/include' . '/base_html/' . 'base_top.tpl');					// Posizione Template Top
	DEFINE('_BASE_BOTTOM', _SITE_PATH . '/include' . '/base_html/' . 'base_bottom.tpl');				// Posizione Template Bottom

	
	//Modulo per le pagine protette
	
	DEFINE('_SID_VALIDATE_ADMIN', true);					// Il valore del sid deve corrispondere all'admin
	DEFINE('_SID_GET_VAR', 'sid');						// Nome della variabile GET che identifica il sid
	DEFINE('_SECURE_TEMPLATE', _TEMPLATE_PATH.'violationSid.php');		// Vista per accesso con un sid scaduto ( null per non caricare nessuna vista )
	$GLOBALS["_configTable"]['_REFRESH_SID'] = "60";		// Abilitazione aggiornamento sid ( in minuti )
	
	// Modulo per le virtual function

	DEFINE('_VIRTUAL_FUNCTION_ENABLE', true);					// Abilitazione delle funzioni virtuali ( funzioni memorizzate nel database ) 
	DEFINE('_VIRTUAL_FUNCTION_DB_TABLE', "virtual_function");			// Tabella che memorizza le funzioni
	
	if(_VIRTUAL_FUNCTION_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_VIRTUAL_FUNCTION_DB_TABLE] =  array(
				//	Nome campo		Tipo
				'id'		 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'name'	 	 => 	'VARCHAR(255)',							 // Nome della funzione			
				'args'		 => 	'VARCHAR(255)',							// Argomenti della funzione			
				'code'	 	 =>	'TEXT',								// Codice della funzione
		);
	}

	/* 
		Configurazione amministrazione
	*/
	DEFINE('_ADMIN_DEVIATION_NAME', 'admin');							// Nome deviazione amministrazione
	DEFINE('_ADMIN_DEVIATION_FILE', 'admin/admin.php');						// Controller amministrazione
	

	//	Dynamic Configuration
	DEFINE('_DYNAMIC_CONFIGURATION_TABLE', 'config');						// Nome tabella della configurazione
	$GLOBALS["_DB_STRUCT"][_DYNAMIC_CONFIGURATION_TABLE] =  array(
				'conf_name'	=>	'VARCHAR(50) NOT NULL PRIMARY KEY',		// Nome variabile di configurazione
				'conf_value'	=> 	'TEXT',				 		// Valore della configurazione									// Codice della funzione
	);

	$GLOBALS["_configTable"]['_DB_STRUCT'] = $_DB_STRUCT;	

	// Database Registry
	DEFINE('_REGISTRY_DATABASE_TABLE', 'registry');
	$GLOBALS["_DB_STRUCT"][_REGISTRY_DATABASE_TABLE] =  array(
				'conf_name'	=>	'VARCHAR(50) NOT NULL PRIMARY KEY',		
				'conf_value'	=> 	'TEXT',				 										// Codice della funzione
	);
?>
