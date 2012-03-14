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
	
	DEFINE('_PHOTO_ENABLE', true);									// Enable Photogallery 
	DEFINE('_PHOTO_DATABASE_TABLE', "photogallery");				// Database table for the image
	DEFINE('_PHOTO_ALBUM_DATABASE_TABLE', "photogallery_album");	// Database table for album

	if(_PHOTO_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_PHOTO_DATABASE_TABLE] =  array(
								'id'		 =>	'INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name_img'	 => 	'TEXT',										// Image name
								'url_img'	 => 	'TEXT',										// Image URL
								'author'	 =>	'VARCHAR(255)',									// Image author
								'time'		 => 	'INT(10)',									// Image timestamp
								'album'		 =>  'INT(10)',										// Album
		);
		$GLOBALS["_DB_STRUCT"][_PHOTO_ALBUM_DATABASE_TABLE] =  array(
				
								'id'		=>	'INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'name'		=> 	'TEXT',										// Memorizza il nome dell'album
								'url_image'	=>  'TEXT',										// Memorizza la copertina dell'album
		);
	}

	$GLOBALS["_configTable"]['_PHOTO_AUTHOR_DEFAULT'] = "Administrator";		// Deafult author for the image
	$GLOBALS["_configTable"]['_PHOTO_ENABLE_UPLOAD'] = true;					// Enable uplad
	$GLOBALS["_configTable"]['_PHOTO_DIR_UPLOAD'] = 'include/image/upload/';	// Uplad directory for image
	$GLOBALS["_configTable"]['_PHOTO_UPLOAD_FIELD'] = "file";					// Form field for the file
	$GLOBALS["_configTable"]['_PHOTO_UPLOAD_MAXSIZE'] = 2097152;				// Max size of the file ( byte )
?>
