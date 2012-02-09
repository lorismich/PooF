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
	
	DEFINE('_CONTROLLER_PATH', _SITE_PATH . '/controllers/');					// Controller default path
	DEFINE('_TEMPLATE_PATH' ,  _SITE_PATH . '/template/');						// Template default path
	DEFINE('_VIEW_PATH' ,  _SITE_PATH . '/view/');								// View default path
	DEFINE('_MODELS_PATH',  _SITE_PATH . '/models/');							// Model default path
	DEFINE('_GLOBAL_OBJECT_PATH' ,  _SITE_PATH . '/globalObject/');				// GlobalObject default path

	/**** 
		*
		*	General Configuration
		* 
		*	This is the default configuration. 
		*	This configuration will save into database.
	****/
	$_configTable = array(
		'_SITE_NAME' => ':PooF',											// Site Name
		'_OB_START'=> 1,													// Enable buffer output
		'_REWRITE_OUTPUT' => true,											// Enable rewrite buffer ( require _OB_START = true)		
		'_IMG_PATH' =>'include/image/',										// Default image path
		'_MULTILANG_FILE' => _SITE_PATH . '/include/resource/language/',	// Multilan dictionary
		'_MULTILANG_DEFAULT' =>'default',									// Default language dictionary
		'_GET_PAGE_NAME' => 'p',											// GET paramater that identify the controller
		'_DEFAULT_CONTROLLER' => 'home',									// Default controller
		'_CONTROLLER_404' => 'not_found',									// 404 controller
		'_SAFE_POST' => true,												// Check POST array
		'_DEFAULT_COOKIE_VALUE' => null,									// Deafult value for the cookie ( null for nothing )
		
	);

	include _SITE_PATH . '/configuration/' . 'router.php';				// Load router configuration
	include _SITE_PATH . '/configuration/' . 'database.php';			// Load database configuration
	include _SITE_PATH . '/configuration/' . 'rewrite_base.php';		// Load rewrite word configuration	
	include _SITE_PATH . '/configuration/' . 'multilang.php';			// Load multilang function
	include _SITE_PATH . '/configuration/' . 'newsletter.php';			// Load newsletter configuration
	include _SITE_PATH . '/configuration/' . 'photogallery.php';		// Load photogallery configuration
	include _SITE_PATH . '/configuration/' . 'news.php';				// Load news configuration
	include _SITE_PATH . '/configuration/' . 'events.php';				// Load event configuration
	include _SITE_PATH . '/configuration/' . 'statistics.php';			// Load statistics configuration
	include _SITE_PATH . '/configuration/' . 'users.php';				// Load user configuration
	include _SITE_PATH . '/configuration/' . 'xml.php';					// Load xml configuration
	include _SITE_PATH . '/configuration/' . 'graphics.php';			// Load graphics configuration
	include _SITE_PATH . '/configuration/' . 'geoloc.php';				// Load GeoLoc configuration
	include _SITE_PATH . '/configuration/' . 'shutdown.php';			// Load shutdown function
	
	/**** 
		*
		*	Global Object Array
		*	Example: global object name => class name
		*	
	****/		
	$_globalObject = array(
					'statistics' => "statistics",				// Statistics
					'users' => "users",							// User and login
					'xml' => "xml",								// XML
					'graphics' => "graphics",					// Graphics library		
					'news' => "news_go",						// News
					"photo" => "photogallery",					// Photogallery
					"newsletter" => "newsletter",				// Newsletter
					"geoloc" => "geoloc",						// Geoloc
	);
	
	DEFINE('_POOF_VERSION', '1.2');											// Framework versione										
	DEFINE('_ENABLE_DATABASE', 1);											// Enable database
	DEFINE('_ENABLE_ERROR', E_ALL);											// Enable error print
	
	DEFINE('_LOG_FILE', _SITE_PATH . '/log/log.txt');						// Log file
	DEFINE('_LOG_MAXSIZE_FILE', 1024);										// Max size log file
	
	
	DEFINE('_LOAD_ARGS_INTO_VARS', true);									// Load GET vars into VARS array controller?
	
	DEFINE('_GLOBAL_OBJECT', 1);											// Enable Global object 

	DEFINE('_BASE_TOP', _SITE_PATH . '/include' . '/base_html/' . 'base_top.tpl');					// Base Template Top
	DEFINE('_BASE_BOTTOM', _SITE_PATH . '/include' . '/base_html/' . 'base_bottom.tpl');			// Base Template Bottom

	
	// Protected pages module
	
	DEFINE('_SID_VALIDATE_ADMIN', true);							// The SID value mus be the same of the admin's SID ?
	DEFINE('_SID_GET_VAR', 'sid');									// GET name that identify the SID
	DEFINE('_SECURE_TEMPLATE', _TEMPLATE_PATH.'violationSid.php');	// View for violation SID ( null for show nothing )
	$GLOBALS["_configTable"]['_REFRESH_SID'] = "60";				// Enable refresh SID ( in minute )
	
	// Virtual function module

	DEFINE('_VIRTUAL_FUNCTION_ENABLE', true);						// Enable virtual function
	DEFINE('_VIRTUAL_FUNCTION_DB_TABLE', "virtual_function");		// Virtual function table
	
	if(_VIRTUAL_FUNCTION_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_VIRTUAL_FUNCTION_DB_TABLE] =  array(
				'id'		 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
				'name'	 	 => 	'VARCHAR(255)',							 	// Name of the function		
				'args'		 => 	'VARCHAR(255)',								// Args of the function	
				'code'	 	 =>	'TEXT',											// Code of the function
		);
	}


	/* 
		Configuration Administration 
	*/
	DEFINE('_ADMIN_DEVIATION_NAME', 'admin');							// Admin deviation name
	DEFINE('_ADMIN_DEVIATION_FILE', 'admin/admin.php');					// Admin controller
	

	//	Dynamic Configuration
	DEFINE('_DYNAMIC_CONFIGURATION_TABLE', 'config');					// Configuration table
	$GLOBALS["_DB_STRUCT"][_DYNAMIC_CONFIGURATION_TABLE] =  array(
				'conf_name'	=>	'VARCHAR(50) NOT NULL PRIMARY KEY',		
				'conf_value'	=> 	'TEXT',				 				
	);

	$GLOBALS["_configTable"]['_DB_STRUCT'] = $_DB_STRUCT;	

	// Database Registry
	DEFINE('_REGISTRY_DATABASE_TABLE', 'registry');
	$GLOBALS["_DB_STRUCT"][_REGISTRY_DATABASE_TABLE] =  array(
				'conf_name'	=>	'VARCHAR(50) NOT NULL PRIMARY KEY',		
				'conf_value'	=> 	'TEXT',				 						
	);
?>
