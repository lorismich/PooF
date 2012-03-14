<?php
	/****
		*	File: homeController.php
		*	Descrizione: Controller Home Page
		*
		*	Author: D4ng3R <mich.loris@gmail.com>
	*****/
	
	class home extends Controllers {

		public function index() {
			//$this->showView("home");
		
			$this->setView();
			$this->setTitle("Home");
			$this->addTemplate("header", 0);
			$this->addTemplate("home", 1);
			$this->addTemplate("footer", 2);
			$this->show();
		}

	}

?>

