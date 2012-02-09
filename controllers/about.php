<?php
	/****
		*	File: homeController.php
		*	Descrizione: Controller Home Page
		*
		*	Author: D4ng3R <mich.loris@gmail.com>
	*****/
	
	class about extends Controllers {
		public function index() {
			//$this->system->graphics->newImage(300, 100, "white");
			//$this->system->graphics->graphPie(array(20, 200, 100, 5 , 400));
			//$this->system->graphics->show();
			
			$this->setView();
			$this->setTitle("About");
			$this->addTemplate("header", 0);
			$this->addTemplate("about", 1);
			$this->addTemplate("footer", 2);
			$this->show();
		}
	}
?>
