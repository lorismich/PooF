<?php
	/****
		*	File: index.php
		*	Descrizione: Punto di accesso per il sito web
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

	ob_start();							// Buffering output
	$site_path = realpath(dirname(__FILE__));			// Definisco la posizione del sito
	$site_path = str_replace("\\", "/", $site_path); 
	
	DEFINE('_SITE_PATH', $site_path);				// Definisco la costante che identifica la posizione /
	include 'include/boot.php';					// Includo il file di boot
		
	$_system->registry->router = new router();			// Creo un nuovo router
	$_system->registry->router->load();				// Interpreto la richiesta 
	
?>
