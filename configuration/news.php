<?php
/****
		*	File: news.php
		*	Descrizione: File di configurazione delle news
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
	DEFINE('_NEWS_ENABLE', true);								// Abilitazione news
	DEFINE('_NEWS_TABLE', "news");								// Tabella per memorizzare le news
	
	if(_NEWS_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_NEWS_TABLE] =  array(
							//	Nome campo			Tipo
								'id'			 =>	'INT(10) NOT NULL AUTO_INCREMENT PRIMARY KEY',
								'author'		 => 	'VARCHAR(50)',									// Memorizza l'autore della news
								'time'	 	 =>	'INT(10)',										// Timestamp dell'inserimento
								'img'			 => 	'VARCHAR(255)',								// Memorizza l'immagine della news
								'title' 		 => 	'VARCHAR(50)',									// Memorizza il titolo della news
								'text' 		 => 	'TEXT',										// Memorizza il testo della news
		);
	}

	$GLOBALS["_configTable"]['_NEWS_DEFAULT_AUTOR'] = "Administrator";		// Autore di default
	$GLOBALS["_configTable"]['_NEWS_GETNUM'] = "5";				// Numero di news da scrivere
	$GLOBALS["_configTable"]['_NEWS_MAXCHAR'] ="30";				// Numero massimo di caratteri per il testo in forma contratta 
	
?>
