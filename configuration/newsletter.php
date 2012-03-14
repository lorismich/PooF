<?php
/****
		*	File: newsletter.php
		*	Descrizione: File di configurazione della newsletter
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


	DEFINE('_NEWSLETTER_ENABLE', true);						// Enable Newsletter
	DEFINE('_NEWSLETTER_TABLE', "newsletter");				// Table of newsletter user

	if(_NEWSLETTER_ENABLE) {
		$GLOBALS["_DB_STRUCT"][_NEWSLETTER_TABLE] =  array(
					'id'		=>	'INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY',
					'name'	 	=> 	'TEXT',										
					'surname'	=> 	'TEXT',										
					'email'	 	=>	'VARCHAR(255)',
		);
	}

	$GLOBALS["_configTable"]['_NEWSLETTER_AMIN_NAME'] = "Amministratore";		// Administrator name
	$GLOBALS["_configTable"]['_NEWSLETTER_AMIN_EMAIL'] = "admin@hackgame.it";	// Email address
	$GLOBALS["_configTable"]['_NEWSLETTER_X_MAILER'] = "hackgame.it";			// Domain
		
?>
