<?php
	/****
		*	File: news.php
		*	Descrizione: Classe per la gestione delle news
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
	class news_go {
		private $system;
		
		function __construct(){ 
			$this->system = system::getInstance();
		}
		
		public function addNews($title, $text, $autor = _NEWS_DEFAULT_AUTOR, $img= "") {
			if(!$this->system->database->query("INSERT INTO "._NEWS_TABLE." (title, text, author, time, img) VALUES ('".htmlentities(htmlspecialchars($title))."', '".htmlentities(htmlspecialchars($text))."', '".htmlentities(htmlspecialchars($autor))."', '".time()."', '".$img."')", true, true))
				$this->system->log->error("News: Impossibile inserire la news", __LINE__);
		}
		
		public function deleteNews($id) {
			if($this->system->database->numRows("SELECT * FROM "._NEWS_TABLE." WHERE id='$id'"))
				if(!$this->system->database->query("DELETE FROM "._NEWS_TABLE." WHERE id='$id'", true, true))
					$this->system->log->error("News: Impossibile cancellare la news", __LINE__);
		}
		
		public function getNews($numNews = _NEWS_GETNUM, $offset = 0) {
			$newsArray = array();
			$result = $this->system->database->query("SELECT * FROM "._NEWS_TABLE." ORDER BY time DESC LIMIT ".$offset.", ".$numNews, true, true);
			if(!$result)
				return false;
			while($news = $this->system->database->fetch_assoc($result)) {
				if(strlen($news["text"])>_NEWS_MAXCHAR){
					$strcut = substr($news["text"], 0, _NEWS_MAXCHAR);
					$space = strrpos($strcut," ");
					$text_cut = substr($strcut, 0,$space);
					$newsArray[] = array("id" => $news["id"], "title" => htmlspecialchars($news["title"]), "text" => htmlspecialchars($news["text"]), "text_cut" => htmlspecialchars($text_cut.'...'), "autor" => htmlspecialchars($news["author"]), "time" => $news["time"], "img" => $news["img"]); 
				}
				else {
					$newsArray[] = array("id" => $news["id"], "title" => htmlspecialchars($news["title"]), "text" => htmlspecialchars($news["text"]), "text_cut" => htmlspecialchars($news["text"]), "autor" => htmlspecialchars($news["author"]), "time" => $news["time"], "img" => $news["img"]); 
				}
			}
			return $newsArray;
		}
		
		public function getNewsById($id) {
			$newsArray = array();
			$result = $this->system->database->query("SELECT * FROM "._NEWS_TABLE." WHERE id=".$id);
			if(!$result)
				return false;
			else
				return $result;
		}
		
		public function getNumNews() {
			$result = $this->system->database->numRows("SELECT * FROM "._NEWS_TABLE);
			return $result;
		}
	}
?>	
