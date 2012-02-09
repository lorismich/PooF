<?php
	/****
		*	File: users.php
		*	Descrizione: Classe per la gestione degli utenti
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
	class users {
		private $system;
		public $isLog = false;
		public $data = array();

		function __construct(){
			$this->system = system::getInstance(); 		
			$this->system->database->connect();
			$this->dataUser();				
		} 
		
		public function __get($index) {			
			if(isset($this->data[$index]))
				return $this->data[$index];	
			else
				return '';
		}

		public function addGroup($name, $admin=0) {																						// Aggiunge un nuovo gruppo
			if(!$this->system->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE name='$name'"))
				var_dump($this->system->database->query("INSERT INTO "._DB_TABLE_GROUPS." (name, admin) VALUES ('$name', '$admin')", true, true));
		}
		
		public function changeGroup($username, $newGroup) {																					// Funzione per cambiare gruppo ad un utente
			if(!$this->system->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE name='$newGroup'")) {
				if(_ADD_GROUP) {
					$this->addGroup($newGroup);	
					$this->system->log->warning("Gestione utenti: Aggiunto gruppo automaticamente", __LINE__);
				}
				else
					$this->system->log->warning("Gestione utenti: Impossibile aggiornare il gruppo dell'utente", __LINE__);
			}	
			if($this->system->database->query("UPDATE "._DB_TABLE_USERS." SET "._DB_TABLE_USERS.".group='".$newGroup."' WHERE username='$username'", true, true))
				return 1;
			else {
				$this->system->log->warning("Gestione utenti: Impossibile aggiornare il gruppo dell'utente", __LINE__);
				return 0;
			}
		}
		
		public function removeGroup($name) {																								// Elimina un utente
			if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE name='$name'"))
				$this->system->database->query("DELETE FROM "._DB_TABLE_GROUPS." WHERE name='$name'", true, true);
		}
		
		public function addUser($username, $password, $email, $groupName = _DEFAULT_GROUP) {
			if(!$this->system->database->numRows("SELECT * FROM "._DB_TABLE_GROUPS." WHERE name='$groupName'")) {							// controllo che il gruppo esista
				if(_DEFAULT_GROUP == "") {
					$this->system->log->warning("Gestione utenti: Impossibile aggiungere l'utente, gruppo non esistente", __LINE__);
					return -2;
				}
				else {
					if(_ADD_GROUP)
						$this->addGroup($groupName);	
					else
						$this->addGroup(_DEFAULT_GROUP);	
				}
			}
			$group = $this->system->database->query("SELECT id FROM "._DB_TABLE_GROUPS." WHERE name='$groupName'");
			if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username'") != 0) {						// controllo che l'username non esista
				$this->system->log->warning("Gestione utenti: Impossibile aggiungere l'utente, username già esistente", __LINE__);
				return -1;
			}
			if(!$this->system->ValidateEmail($email))																					// controllo che l'email sia valida
				return 0;
			if($this->system->database->query("INSERT INTO "._DB_TABLE_USERS." ("._DB_TABLE_USERS.".username, "._DB_TABLE_USERS.".group, "._DB_TABLE_USERS.".password, "._DB_TABLE_USERS.".email) VALUES ('$username', '$group->id','".$this->cryptPassword($password)."', '$email')", true, true)) 
				return 1;
              
			$this->system->log->error("Gestione utenti: Impossibile registrare l'utente.", __LINE__);
		}
		
		public function removeUser($username) {
			if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username'") == 0) {						// controllo che l'username non esista
				$this->system->log->warning("Gestione utenti: Impossibile rimuovere l'utente, username non esistente", __LINE__);
				return -1;
			}
			if($this->system->database->query("DELETE FROM "._DB_TABLE_USERS." WHERE username='$username'", true, true))
				return 1;
		}
		
		public function changePassword($username, $oldPassword, $newPassword) {					// Funzione per cambiare password a un utente
			if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username'") == 0) {						
				$this->system->log->warning("Gestione utenti: Impossibile cambiare la password, username non esistente", __LINE__);
				return -2;
			}
			if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username' AND password='".$this->cryptPassword($oldPassword)."'" ) == 0) {						
				$this->system->log->warning("Gestione utenti: Impossibile cambiare la password, la vecchia password non coincide", __LINE__);
				return -1;
			}
			if($this->system->database->query("UPDATE "._DB_TABLE_USERS." SET password='".$this->cryptPassword($newPassword)."' WHERE username='$username'", true, true))
				return 1;
		}
		
		public function cryptPassword($password) {											// Funzione per calcolare l'hash della password
			if(function_exists(_USERS_CRYPT_PASSWORD)) {									// Se esiste la funzione definita 
				$pass_funct = _USERS_CRYPT_PASSWORD;
				return $pass_funct($password);
			}
			else if(function_exists("md5"))													// Altrimenti viene usato md5
					return md5($password);
			else 
				return sha1($password);														// ...o sha1
		}

		public function auth($username, $password) {				// Funzione per il login
			if(_LOGIN_ENABLE) {
				if($this->system->database->numRows("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username' AND password='".$this->system->users->cryptPassword($password)."'" ) != 0) {						
					if($user = $this->system->database->query("SELECT * FROM "._DB_TABLE_USERS." WHERE username='$username' AND password='".$this->system->users->cryptPassword($password)."'", true)) {
						$this->log($user["id"]);
						$time = time();
						if(!$this->system->database->query("UPDATE "._DB_TABLE_USERS." SET time='".$time."' WHERE username='$username'", true, true)) 
							$this->system->log->warning("Gestione login: Impossibile memorizzare il campo time", __LINE__);
						if($user_sid = $this->setSid($username)) {
							$this->isLog = true;
							$this->system->callEvent("loginEvent");
							return true;
						}
					}
					else
						$this->system->log->warning("Gestione login: Impossibile eseguire la query di login", __LINE__);
				}
			}	
			else {
				$this->system->log->warning("Gestione login: Login disabilitato", __LINE__);
				return 0;
			}	
		}
		
		public function logout() {									// Funzione per il logout
			unset($_SESSION[_LOGIN_SESSION]);
			if(isset($_SESSION[_LOGIN_SESSION]) and $_SESSION[_LOGIN_SESSION] != "") {
				$this->system->log->warning("Gestione login: Impossibile eseguire il logout", __LINE__);
				return 0;
			}	
			$this->isLog = false;
			return 1;
		}
		
		public function setSid($username) {					// Funzione per generare un sid casuale
			$user_sid = md5($username.rand());				
			if($this->system->database->query("UPDATE "._DB_TABLE_USERS." SET sid='".$user_sid."', time='".time()."' WHERE username='$username'", true, true)) { 
				$_SESSION[_LOGIN_SESSION] = $user_sid;
				$this->dataUser();
				return $user_sid;
			}	
			else {
				$this->system->log->warning("Gestione login: Impossibile generare il sid", __LINE__);
				return 0;
			}	
		}
		
		public function dataUser() {							// Recupero le informazioni dell'utente
			if(isset($_SESSION[_LOGIN_SESSION]) and  $_SESSION[_LOGIN_SESSION] != "") {
				$this->isLog = true;
				$sid = $_SESSION[_LOGIN_SESSION];
				if(!$user = $this->system->database->query("SELECT * FROM "._DB_TABLE_USERS." WHERE sid='$sid'", true)) 
					$this->system->log->warning("Gestione login: Impossibile recuperare i dati dell'utente, sid non trovato", __LINE__);
				else {						
					$this->data = $user;
					$this->refreshSid($user["username"]);
					return 1;
				}	
			}
		}
		
		private function refreshSid($username) {				// Aggiorno il SID
			if($this->time == "") {
				$this->system->log->warning("Gestione login: Impossibile rinnovare il sid", __LINE__);
				return 0;
			}		
			if((time()-$this->time)/60 > _REFRESH_SID) { 
				if($this->setSid($username))
					$this->dataUser();
					return 1;
			}			
		}	
		
		private function log($id) {									// Log per il controllo dei login
			if(_LOG_MAX != 0 and $this->system->database->numRows("SELECT * FROM "._LOG_LOGIN_TABLE) > _LOG_MAX) {
				if($this->system->database->query("DELETE FROM "._LOG_LOGIN_TABLE, true, true)) {
					$this->system->warning("Gestione login: tabella log accessi svuotata");
				}
			}	
			if(_LOG_LOGIN) {
				$ip = $_SERVER['REMOTE_ADDR']; 
				$time = time();
				if($this->system->database->query("INSERT INTO "._LOG_LOGIN_TABLE." ("._LOG_LOGIN_TABLE.".id_username, "._LOG_LOGIN_TABLE.".time, "._LOG_LOGIN_TABLE.".ip) VALUES ('$id', '$time','$ip')", true, true)) 
					return 1;
				else
					$this->system->log->warning("Gestione log: Impossibile memorizzare il login", __LINE__);
			}
		}
	}
?>
