<?php
	/****
		*	File: model.php
		*	Descrizione: Classe base per i modelli
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
	abstract class Models {
		/*
			VARS:
				$system: system object
				
			METHOD:
				__construct(): get the system object
		*/
	
		protected $system;
		function __construct() {	
			$this->system = system::getInstance();
		}
		
	}
?>
