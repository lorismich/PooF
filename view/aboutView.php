<?php
	class aboutView extends Views {
		function __construct($vars, $tpl) {
			parent::__construct($vars, $tpl); 
			$this->insertTemplate("header", 0);
			$this->insertTemplate("footer", 2);
		}
	}
?>