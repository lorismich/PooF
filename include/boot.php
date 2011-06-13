<?php
	/****
		*	File: boot.php
		*	Descrizione: File di inizializzazione della configurazione 
		*
		*	Author: D4ng3R <mich.loris@gmail.com>
	*****/	
	include _SITE_PATH . '/configuration/' . 'config.php';					// Carico la configurazione 
	include _SITE_PATH . '/app/' . 'system.php';						// Carico la classe system
	include _SITE_PATH . '/app/' . 'language.php';						// Carico modulo multilingua
	include _SITE_PATH . '/app/' . 'controller.php';					// Carico il controller
	include _SITE_PATH . '/app/' . 'registry.php';						// Carico il registro
	include _SITE_PATH . '/app/' . 'router.php';						// Carico il router
	include _SITE_PATH . '/app/' . 'model.php';						// Carico il model
	include _SITE_PATH . '/app/' . 'view.php';						// Carico view
	include _SITE_PATH . '/app/' . 'log.php';						// Carico il gestore dei log
	include _SITE_PATH . '/app/' . 'databaseDriver.php';					// Carico l'interfaccia per il driver database
	include _SITE_PATH . '/app/' . 'table.php';						// Carico il gestore delle tabelle
	
	error_reporting(_ENABLE_ERROR);									// Visualizzazione errori
	session_start();										// Avvio la sessione
	register_shutdown_function('_shutdown');							// Registro la shutodwn function
	
	$_system = system::getInstance(); 									// Nuovo oggetto di sistema (Singleton)	
	$_system->loadDatabase();										// Carico il database
	$_system->loadConfiguration();										// Carico la configurazione
	$_system->registry->loadTime = microtime(true);				    				// Analizza il tempo di caricamento della pagina
	$_system->setPOSTonRegistry($_POST);									// Salvattaggio dati POST nel registro
	$_system->setCOOKIEonRegistry($_COOKIE);								// Salvattaggio COOKIE nel registro
	$_system->setFILESonRegistry($_FILES);									// Salvattaggio FILES nel registro
	$_system->loadGlobalObject();										// Caricamento globalOject
	$_system->loadVirtualFunction();									// Caricamento virtualFunction
	$_system->loadLanguage();										// Caricamento multilingua
		
	$_system->callEvent("bootEvent", array("idbrowser" => $_SERVER['HTTP_USER_AGENT']));			// Richiamo l'evento associato al boot per fare l'analisi statistica
	
	if(_STATISTICS_ENABLE and  _STATISTICS_ENABLE == true) {
		if(isset($_SESSION[_STATISTICS_LASTVIST_SESSION]) and $_SESSION[_STATISTICS_LASTVIST_SESSION] != "") {
			if((((time() - $_SESSION[_STATISTICS_LASTVIST_SESSION])/60)/60) <= _STATISTICS_LASTVIST_SESSION_VALIDE) {
				$_system->callEvent("timeVisit", array("timeVisit" => (time() - $_SESSION[_STATISTICS_LASTVIST_SESSION])));	// Ricavo il tempo di visita dell'utente
			}
		}
		$_SESSION[_STATISTICS_LASTVIST_SESSION] = time();															// Memorizzao ora della visita nella sessione
	}
	
	/** Classe autoLoad 
	*		permette di caricare i file delle classi solo quando vengono richiamate
	**/	
	function __autoload($class_name) {	
		$filename = $class_name.'.php';
		if (in_array($class_name, $GLOBALS["_globalObject"])) {
			$file = _GLOBAL_OBJECT_PATH.$filename;
			include ($file);
			return;
		}
		else {
			$file = _MODELS_PATH.$filename;
			if (file_exists($file)) {
				include ($file);
				return;
			}
			
			$file = _GLOBAL_OBJECT_PATH.$filename;
			if (file_exists($file)) {
				include ($file);
				return;
			}			
		}	
		$GLOBALS["_system"]->log->error("Boot: Modello o Gloabal Object non trovato ($file)", __LINE__);
	}	

?>
