<?php

	/****
		*	File:newsletter.php
		*	Descrizione: Gestione newsletter
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
	class newsletter {
		protected $system = null;
		
		function __construct() {	
			$this->system = system::getInstance();						// Carico la classe di sistema
		}
		
		public function addNewletter($name, $surname, $email) {
			if(!$this->system->database->query("INSERT INTO "._NEWSLETTER_TABLE." (name, surname, email) VALUES ('".$name."', '".$surname."', '".$email."')", true, true))
				$this->system->log->error("Impossibile inserire la registrazione", __LINE__);
		}
		
		public function emailAtAll($subject, $htmlEmail) {
			$query = $this->system->database->query("SELECT * FROM "._NEWSLETTER_TABLE, true, true);
			while($user = $this->system->database->fetch_assoc($query)) {
				$header = "";
				$header .= "From: "._NEWSLETTER_AMIN_EMAIL."\r\n";
				$header .= "Reply-To: "._NEWSLETTER_AMIN_EMAIL."\r\n";
				$header .= "X-Mailer: "._NEWSLETTER_X_MAILER."\n\n";
				$header .= "MIME-Version: 1.0\n";
				$header .= "Content-Type: text/html; charset=\"iso-8859-1\"\n";
				$header .= "Content-Transfer-Encoding: 7bit\n\n";
				if(!mail($user["email"],$subject,$htmlEmail,$header))
					$this->system->log->error("Impossibile inviare le email", __LINE__);
			}
		}
	}
?>
