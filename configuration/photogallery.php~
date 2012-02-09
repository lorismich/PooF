<?php
	/****
		*	File: photogallery.php
		*	Descrizione: Configurazione della photogallery
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
	
	DEFINE('_PHOTO_ENABLE', true);							// Abilitazione photogallery
	DEFINE('_PHOTO_DATABASE_TABLE', "photogallery");				// Tabella nel database per memorizzare le immagini 
	DEFINE('_PHOTO_ALBUM_DATABASE_TABLE', "photogallery_album");			// Tabella nel database per memorizzare album

	if(_PHOTO_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_PHOTO_DATABASE_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name_img'	 => 	'TEXT',										// Memorizza il nome dell'immagine
								'url_img'		 => 	'TEXT',										// Memorizza l'url dell'immagine
								'author'	 	 =>	'VARCHAR(255)',								// Memorizza l'autore
								'time'		 => 	'INT(10)',										// Memorizza l'ora dell inserimento
								'album'		 =>  'INT(10)',										// Memorizza l'album di appartenenza
		);
		$GLOBALS["_DB_STRUCT"][_PHOTO_ALBUM_DATABASE_TABLE] =  array(
							//	Nome campo		Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name'		 => 	'TEXT',										// Memorizza il nome dell'album
								'url_image'	 =>  'TEXT',										// Memorizza la copertina dell'album
		);
	}

	$GLOBALS["_configTable"]['_PHOTO_AUTHOR_DEFAULT'] = "Administrator";		// Autore di default per le immagini
	$GLOBALS["_configTable"]['_PHOTO_ENABLE_UPLOAD'] = true;			// Abilitazione upload 
	$GLOBALS["_configTable"]['_PHOTO_DIR_UPLOAD'] = 'include/image/upload/';	// Cartella per l'upload delle immagini
	$GLOBALS["_configTable"]['_PHOTO_UPLOAD_FIELD'] = "file";			// Campo del form che identifica il file
	$GLOBALS["_configTable"]['_PHOTO_UPLOAD_MAXSIZE'] = 2097152;			// Dimensione massima del file ( byte )
?>
