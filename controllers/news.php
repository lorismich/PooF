<?php
	class news extends Controllers {
		public function index() {
			$this->setView();
			$this->setTitle("News");
			$this->addTemplate("header", 0);
			$this->addTemplate("news", 1);
			$this->addTemplate("footer", 2);
			$this->show();
		}
	}

?>
