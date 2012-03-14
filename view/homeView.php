<?php
	/****
		*	File: home.php
		*	Descrizione: View Home
		*
		*	Author: D4ng3R <mich.loris@gmail.com>
	*****/
	class homeView extends Views {
		function __construct($vars, $tpl) {
			parent::__construct($vars, $tpl); 
			$this->insertTemplate("header", 0);
			$this->insertTemplate("footer", 2);
		}
	
	}
?>