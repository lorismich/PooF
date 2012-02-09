<?php
	include("adminModel.php");

	class admin extends Controllers {
		public function index() {
			if(isset($this->system->registry->POST["admin_user"]) and $this->system->registry->POST["admin_user"] != "") {
				$model = new adminModel();
				$this->args[_SID_GET_VAR] = $model->loginAdmin($this->system->registry->POST["admin_user"], $this->system->registry->POST["admin_pass"]);
			}
			$this->system->setLanguage("english");
		//	$this->system->database->write("prova", array("col1", "col2"), array("val1", "val2"));
		//	$this->system->loadTable("users");
		//	$query = $this->system->databaseTable["users"]->onlyQuery(array('*'));
		//	while($obj = $this->system->databaseTable["users"]->fetch_assoc($query))
		//		print_r($obj);	
		//	$this->system->databaseTable["users"]->update(array("username"), array("Loris"), "username='admin'");

			$this->securePage($this->args[_SID_GET_VAR], 1);
			$this->setView();
			$this->setTitle("Administration");
			$this->addTemplateFromFile('admin/adminMenu.php', 0);
			$this->addTemplateFromFile('admin/adminTpl.php', 1);
			$this->show();
		}

		public function generalConfig() {
			$this->system->setLanguage("english");
			$this->securePage($this->args[_SID_GET_VAR], 1);
			$this->SID = $this->args[_SID_GET_VAR];
			$adminModel = new adminModel();
			
			if(isset($this->system->registry->POST["submit"]) and $this->system->registry->POST["submit"] == "Change Configuration") {
				$adminModel->configTextToArray("_SITE_NAME", $_POST["_SITE_NAME"], 0, 0);
				$adminModel->configTextToArray("_DEFAULT_CONTROLLER", $_POST["_DEFAULT_CONTROLLER"], 0, 0);
				$adminModel->configTextToArray("_CONTROLLER_404", $_POST["_CONTROLLER_404"], 0, 0);
				$adminModel->configTextToArray("_IMG_PATH", $_POST["_IMG_PATH"], 0, 0);
				$adminModel->configTextToArray("_NAME_COOKIE_MULTILANG", $_POST["_NAME_COOKIE_MULTILANG"], 0, 0);
				$adminModel->configTextToArray("_OB_START", $_POST["_OB_START"], 0, 0);
				$adminModel->configTextToArray("_GET_PAGE_NAME", $_POST["_GET_PAGE_NAME"], 0, 0);
				$adminModel->configTextToArray("_MULTILANG_FILE", $_POST["_MULTILANG_FILE"], 0, 0);
				$adminModel->configTextToArray("_MULTILANG_DEFAULT", $_POST["_MULTILANG_DEFAULT"], 0, 0);
				$adminModel->configTextToArray("_REFRESH_SID", $_POST["_REFRESH_SID"], 0, 0);
				$adminModel->configTextToArray("_DEFAULT_LANG", $_POST["_DEFAULT_LANG"], 0, 0);
				$adminModel->configTextToArray("_REWRITE_OUTPUT", $_POST["_REWRITE_OUTPUT"], 0, 0);
			}

			if(isset($this->system->registry->POST["submit_router"]) and $this->system->registry->POST["submit_router"] == "Change Router Configuration") {
				$adminModel->configTextToArray("_router_deviation", $_POST["_router_deviation"], 1);
				$adminModel->configTextToArray("_router_bans_ip", $_POST["_router_bans_ip"], 0);
			}
						
			$this->txt_router_deviation = $adminModel->configArrayToText("_router_deviation", 1);
			$this->txt_router_bans_ip = $adminModel->configArrayToText("_router_bans_ip");
			$this->txt_path_router = $adminModel->configArrayToText("_CONTROLLER_PATH_ROUTER");

			$this->setView();
            $this->setTitle("Administration - Configuration");
			$this->addTemplateFromFile('admin/adminMenu.php', 0);
            $this->addTemplateFromFile('admin/adminGeneralConfigTpl.php', 1);
            $this->show();
		}

		public function statistics() {
			$this->system->setLanguage("english");
			$this->securePage($this->args[_SID_GET_VAR], 1);
			$this->SID = $this->args[_SID_GET_VAR];
			$adminModel = new adminModel();

			$stats_controller = $adminModel->getStats("stats_page", "controller", "number_visit", "controller");
			$this->txt_controller = "<dt>Controller</dt><dd>Visits</dd><br>";
			foreach($stats_controller as $key=>$value) 
				$this->txt_controller .= "<dt>$key:</dt><dd>$value</dd>";
			
			$stats_error = $adminModel->getStats("stats_error", "type", "number", "type");
			$this->txt_error = "<dt>Type</dt><dd><b>Number</b></dd><br>";
			foreach($stats_error as $key=>$value) 
				$this->txt_error .= "<dt>$key:</dt><dd>$value</dd>";
			
			$stats_login = $adminModel->getStats("stats_login", "day", "number_login", "day");
			$this->txt_login = "<dt>Day</dt><dd><b>Number</b></dd><br>";
			foreach($stats_login as $key=>$value) 
				$this->txt_login .= "<dt>".date('d-m-Y',$key*60*60*24) .":</dt><dd>$value</dd>";

			$stats_browser = $adminModel->getStats("stats_browser", "browser", "number", "browser");
			$this->txt_browser = "<dt>Browser</dt><dd><b>Number</b></dd><br>";
			foreach($stats_browser as $key=>$value) 
				$this->txt_browser .= "<dt>".$key.":</dt><dd>$value</dd>";

			$this->setView();
                        $this->setTitle("Administration - Statistics");
			$this->addTemplateFromFile('admin/adminMenu.php', 0);
                        $this->addTemplateFromFile('admin/adminTplStatistics.php', 1);
                        $this->show();
		}

		public function log() {
			$this->system->setLanguage("english");
			$this->securePage($this->args[_SID_GET_VAR], 1);
			$this->SID = $this->args[_SID_GET_VAR];
			$adminModel = new adminModel();
			$this->message = "";
			if(isset($this->system->registry->POST["Delete_Log"]) and $this->system->registry->POST["Delete_Log"] == "Delete Log") {
				if(@$adminModel->deleteLog())
					$this->message = "Log Deleted!";
				else {
					$this->system->log->warning("Impossibile eliminare il file di log, permesso negato", __LINE__);
					$this->message = "An error occurred...";
				}
			}
			
			$this->log_txt = $adminModel->readLog();
			
			$this->setView();
           		$this->setTitle("Administration - Log File");
			$this->addTemplateFromFile('admin/adminMenu.php', 0);
            		$this->addTemplateFromFile('admin/adminLogTpl.php', 1);
            		$this->show();
		}
		
		public function ImageController() {
			$adminModel = new adminModel();
			$stats_controller = $adminModel->getStats("stats_page", "controller", "number_visit", "controller");
			
			$x = array();
			$y = array();

			foreach($stats_controller as $key=>$value) {
				$x[] = $key;
				$y[] = $value;
			}
			
			$this->system->graphics->newImage("320", "200", "white");
			$this->system->graphics->graphBar($y, $x);
			$this->system->graphics->show();
		}
		
		public function ImageError() {
			$adminModel = new adminModel();
			$stats_controller = $adminModel->getStats("stats_error", "type", "number", "type");
			
			$x = array();
			$y = array();

			foreach($stats_controller as $key=>$value) {
				$x[] = $key;
				$y[] = $value;
			}
			
			$this->system->graphics->newImage("300", "200", "white");
			$this->system->graphics->graphPie($y, $x);
			$this->system->graphics->show();
		}

		public function ImageBrowser() {
			$adminModel = new adminModel();
			$stats_browser = $adminModel->getStats("stats_browser", "browser", "number", "browser");
			
			$x = array();
			$y = array();

			foreach($stats_browser as $key=>$value) {
				$x[] = $key;
				$y[] = $value;
			}
			
			$this->system->graphics->newImage("300", "200", "white");
			$this->system->graphics->graphPie($y, $x);
			$this->system->graphics->show();
		}

		public function ImageLogin() {
			$adminModel = new adminModel();
			$stats_login = $adminModel->getStats("stats_login", "day", "number_login", "day");
			
			$x = array();
			$y = array();

			foreach($stats_login as $key=>$value) {
				$x[] = date('d-m-Y',$key*60*60*24);
				$y[] = $value;
			}
			
			$this->system->graphics->newImage("350", "200", "white");
			$this->system->graphics->graphLine($y, $x);
			$this->system->graphics->show();
		}

		public function login() {	
			$this->sid = $this->args[_SID_GET_VAR];
			$this->setView();
			$this->setTitle("Administration Login");
			$this->addTemplateFromFile('admin/adminLoginTpl.php', 0);
			$this->show();
		}

		public function logout() {
			$model = new adminModel();
			$model->logout();
		}
	}

?>

