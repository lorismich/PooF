<?php
	/****
		*	File: controller.php
		*	Descrizione: Classe astratta per definizione dei controller
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

	abstract class Controllers {
		/*
			VARS:
				$system: system object
				$view: controller's view
				$vars: (array) global var for the view
				$args: (array) URL var
				$securePage: flag for secure page (must be define a SID on the URL page)
				
			METHOD:
				abstract index()
			
				__construct(): get the system object and the SID (if defined)
				__set(): set var for the view
				__get(): get var
				showView() && show(): render the page
				setView(): set a view for the controller
				setTitle(): set page title
				addTemplate(): if you don't use a view you can use a template. Add template
				addTemplateFromFile(): add template from file
				securePage(): validate SID.
		*/
	
		protected $system = null;
		protected $view = null;
		protected $vars = array();
		protected $args = array();
		protected $securePage = false;
		
		function __construct($args=array()) {					
			$this->system = system::getInstance();						
			$this->args = $args;									
			if(!isset($this->args[_SID_GET_VAR]))						
				$this->args[_SID_GET_VAR] = "";								
		}

		public function __set($index, $value) {
			$this->vars[$index] = $value;
		}

		public function __get($index) {											
			if(isset($this->vars[$index]))
				return $this->vars[$index];
			else
				return '';
		}
		
		protected function showView($view) {										
			$path = _VIEW_PATH.$view.'View.php';
			if (!file_exists($path)) 			                              	
				$this->system->log->error("Vista non trovata! $view", __LINE__);
			include($path);
			$class = $view . 'View';
			$obj = new $class($this->vars, $view);
			$obj->show();
		}
		
		protected function setView() {
			$this->view = new Views($this->vars);
		}
		
		protected function setTitle($title) {
			$this->view->setTitlePage($title);
		}
		
		protected function addTemplate($template, $index) {
			if($this->view == null)
				$this->system->log->error("Template non inserito in un'istanza della vista", __LINE__);
			$this->view->insertTemplate($template, $index);
		}
		
		protected function addTemplateFromFile($path, $index) {
			if($this->view == null)
				$this->system->log->error("Template non inserito in un'istanza della vista", __LINE__);
			$this->view->insertTemplateFromFile($path, $index);
		}
		
		protected function show() {
			if($this->view == null)
				$this->system->log->error("Nessuna vista definita", __LINE__);
			$this->view->show();
		}

		protected function securePage($sid = null, $admin = 0) {										
			$this->securePage = true;
			if($sid == null)			
				$sid = $this->args[_SID_GET_VAR];
			if($this->system->sidValidate($this->args[_SID_GET_VAR], $admin)) 
				return 1;
			if(_SECURE_TEMPLATE != null) 										
				@include(_SECURE_TEMPLATE);
			exit;													
		}
		
		abstract public function index();								
	}
?>
