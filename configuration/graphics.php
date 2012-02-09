<?php
	/****
		*	File: graphics.php
		*	Descrizione: Configurazione libreria grafica
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

	$_colors = array(
					"white" 	=> 	array("255", "255", "255"),			// White
					"black" 	=> 	array("0", "0", "0"),				// Black
					"blue" 		=> 	array("0", "0", "255"),				// Blue
					"green" 	=>	array("0", "255", "0"),				// Green
					"red" 		=> 	array("255", "0", "0"),				// Red
					"grey" 		=> 	array("190", "190", "190"),			// Grey
					"line"		=>	array("120", "120", "120"),			// Grid color on grapihcs
					"txt"		=>	array("255", "0", "0"),				// Text color on grapihcs
					"point"		=>	array("0", "0", "255"),				// Point color on grapihcs
					);

	$GLOBALS["_configTable"]['_MIME_TYPE'] = "Content-type: image/png";		// Image MIME type
	$GLOBALS["_configTable"]['_TYPE_IMG'] = "png";							// Image type (png or jpg)
	
	
?>
