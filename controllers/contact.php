<?php
	class contact extends Controllers {
		public function index() {
			$this->setView();
			$this->setTitle("Contact");
			$this->addTemplate("header", 0);
			$this->addTemplate("contact", 1);
			$this->addTemplate("footer", 2);
			$this->show();
		}
	}
?>
