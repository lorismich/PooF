<?php

	/****
		*	File: photogallery.php
		*	Descrizione: Gestione della photogallery
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
	class  photogallery {
		protected $system = null;
		
		function __construct() {	
			$this->system = system::getInstance();						// Carico la classe di sistema
		}
		
		public function addPhoto($name, $url, $album = 0, $author = _PHOTO_AUTHOR_DEFAULT) {
			if(!$this->system->database->query("INSERT INTO "._PHOTO_DATABASE_TABLE." (name_img, author, url_img, time, album) VALUES ('".$name."', '".$author."', '".$url."',".time().", '".$album."')", true, true))
				$this->system->log->error("Photogallery: Impossibile inserire la foto", __LINE__);
		}
		
		public function removePhoto($id) {
			if($this->system->database->numRows("SELECT * FROM "._PHOTO_DATABASE_TABLE." WHERE id='$id'"))
				if(!$this->system->database->query("DELETE FROM "._PHOTO_DATABASE_TABLE." WHERE id='$id'", true, true))
					$this->system->log->error("Photogallery: Impossibile cancellare l'immagine", __LINE__);
		}
		
		public function getPhoto() {
			$photoArray = array();
			$result = $this->system->database->query("SELECT * FROM "._PHOTO_DATABASE_TABLE." ORDER BY time DESC", true, true);
			if(!$result)
				return false;
			while($photo = $this->system->database->fetch_assoc($result)) {
					$photoArray[] = array("id" => $photo["id"], "url" =>$photo["url_img"], "author" => $photo["author"], "time" => $photo["time"], "name" => $photo["name_img"]); 
			}
			return $photoArray;
		}
		
		public function getPhotoInAlbum($album) {
			$photoArray = array();
			$result = $this->system->database->query("SELECT * FROM "._PHOTO_DATABASE_TABLE." WHERE album=".$album." ORDER BY time DESC", true, true);
			if(!$result)
				return false;
			while($photo = $this->system->database->fetch_assoc($result)) {
					$photoArray[] = array("id" => $photo["id"], "url" =>$photo["url_img"], "author" => $photo["author"], "time" => $photo["time"], "name" => $photo["name_img"]); 
			}
			return $photoArray;
		}
		
		public function uploadPhoto($nameImg = array(), $numUpload = 1, $author = _PHOTO_AUTHOR_DEFAULT, $album = 0, $field = _PHOTO_UPLOAD_FIELD) {
			for($i=1; $i<=$numUpload; $i++) {
				if (is_uploaded_file($this->system->registry->FILES[$field.$i]['tmp_name'])) {
					$ext =  substr($this->system->registry->FILES[$field.$i]['name'], -4);
					if ($this->system->registry->FILES[$field.$i]['size'] > _PHOTO_UPLOAD_MAXSIZE) 
						$this->system->log->error("Grandezza dell'immagine superata", __LINE__);
					list($width, $height, $type, $attr) = getimagesize($this->system->registry->FILES[$field.$i]['tmp_name']);
					
					if (($type!=1) && ($type!=2) && ($type!=3)) 
						$this->system->log->error("Fomato immagine sconosciuto", __LINE__);
					$name = md5_file($this->system->registry->FILES[$field.$i]['tmp_name']);
					if (file_exists(_PHOTO_DIR_UPLOAD.'/'.$name.$ext)) 
						$this->system->log->error("Immagine già esistente", __LINE__);
					if (!move_uploaded_file($this->system->registry->FILES[$field.$i]['tmp_name'], _PHOTO_DIR_UPLOAD.'/'.$name.$ext))
						$this->system->log->error("Errore nel caricamento dell'immagine", __LINE__);				
					$this->addPhoto($nameImg[$i-1], _PHOTO_DIR_UPLOAD.$name.$ext, $album);
					//return  _PHOTO_DIR_UPLOAD.$name.$ext;
				}
			}
		}
		
		public function uploadAlbumPhoto($nameImg = array(), $numUpload = 1, $author = _PHOTO_AUTHOR_DEFAULT, $album = 0, $field = _PHOTO_UPLOAD_FIELD) {
			for($i=1; $i<=$numUpload; $i++) {
				if (is_uploaded_file($this->system->registry->FILES[$field.$i]['tmp_name'])) {
					$ext =  substr($this->system->registry->FILES[$field.$i]['name'], -4);
					if ($this->system->registry->FILES[$field.$i]['size'] > _PHOTO_UPLOAD_MAXSIZE) 
						$this->system->log->error("Grandezza dell'immagine superata", __LINE__);
					list($width, $height, $type, $attr) = getimagesize($this->system->registry->FILES[$field.$i]['tmp_name']);
					
					if (($type!=1) && ($type!=2) && ($type!=3)) 
						$this->system->log->error("Fomato immagine sconosciuto", __LINE__);
					$name = md5_file($this->system->registry->FILES[$field.$i]['tmp_name']).time();
					if (file_exists(_PHOTO_DIR_UPLOAD.'/'.$name.$ext)) 
						$this->system->log->error("Immagine già esistente", __LINE__);
					if (!move_uploaded_file($this->system->registry->FILES[$field.$i]['tmp_name'], _PHOTO_DIR_UPLOAD.'/'.$name.$ext))
						$this->system->log->error("Errore nel caricamento dell'immagine", __LINE__);				
					$this->addPhoto($nameImg[$i-1], _PHOTO_DIR_UPLOAD.$name.$ext, $album);
					return  _PHOTO_DIR_UPLOAD.$name.$ext;
				}
			}
		}
	}
?>
