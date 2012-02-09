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
	


	DEFINE('_MULTILANG_ENABLE', true);				// Enable Multilang( require _OB_START = true )
	DEFINE('_MULTILANG_TABLE', 'multilang');		// Database table name
	DEFINE('_MULTILANG_GEOLOC', true);				// Localize the user for load the right languae ( require _GEO_IP_ENABLE = true )
	
	/* Language definitions */
	$_language = array(
		"Italiano" 	=> 	"IT",						// Italian
		"English" 	=> 	"US",						// English
	);

	$GLOBALS["_configTable"]['_NAME_COOKIE_MULTILANG'] = "MultiLang";		// Cookie name for the language
	$GLOBALS["_configTable"]['_DEFAULT_LANG'] = "IT";						// Default language
	$GLOBALS["_configTable"]['_language'] = $_language;						// Languages avaiable
	

?>	
