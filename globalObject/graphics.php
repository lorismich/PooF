<?php
	/****
		*	File: graphics.php
		*	Descrizione: Driver per il disegno utilizzando librerie GD
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
	class graphics {
		protected $system;
		public $image = null;
		private $width = null;
		private $height = null;
		public $color = array();
		
		function __construct() {					
			$this->system = system::getInstance();						// Carico la classe di sistema
		}
		
		public function newImage($width, $height, $bgColor) {				// Funzione per creare una nuova immagine
			if(!$this->image = imagecreatetruecolor($width, $height)) {
				$this->system->log->error("Impossbile creare l'immagine", __LINE__);
			}
			foreach($GLOBALS["_colors"] as $nameColor => $ArrayHex) {		// Carico i colori di default
				$this->color[$nameColor] = imagecolorallocate($this->image, $ArrayHex[0], $ArrayHex[1], $ArrayHex[2]);
			}	
			if(is_array($bgColor) and count($bgColor) == 3) {	
				if(!imagefill($this->image, 0, 0, imagecolorallocate($this->image, $bgColor[0], $bgColor[1], $bgColor[2])))
					$this->system->log->error("Impossbile creare lo sfondo", __LINE__);
			}		
			else
				imagefill($this->image, 0, 0, $this->color[$bgColor]);
			$this->width = $width;
			$this->height = $height;
		}
		
		public function graphBar($array, $label=array(), $hidePercentage = false, $ylabel=20, $typeFont=2, $marginBottom = 20, $marginTop = 20, $heightLine = 15, $widthLine = 10) {
			if(count($array) != count($label))
				$label = null;
			for ($i=1; $i<=(($this->height-$marginBottom)/$heightLine); $i++)									// Linee orizzontali
				@imageline($this->image, 0, $i*$heightLine, $this->width, $i*$heightLine, $this->color["line"]);
			$newArray = array();
			$maxValue = array_sum($array);
			foreach($array as $value)																// Calcolo valori
				$newArray[] = @intval($value / $maxValue * 100);
			$p = @intval($this->width / @count($newArray));
			for ($i=1; $i<=@count($newArray); $i++)													// Linee verticali
				@imageline($this->image, $i*$p, 0, $i*$p, ($this->height -  $marginBottom), $this->color["line"]);	
			for ($i=0; $i<@count($newArray); $i++) {
				$j = @intval($p/2) + $p*$i;
				@imagefilledrectangle($this->image, $j-($widthLine/2), ($this->height -  $marginBottom), $j-($widthLine/2)+$widthLine, ($this->height - $marginBottom)-((($this->height-$marginTop -  $marginBottom)/100)*$newArray[$i]) , $this->color["line"]);
			if($label != null and !$hidePercentage)
				@imagestring($this->image, 2, $j- $ylabel, ($this->height -  $marginBottom)+6,$label[$i].' '.$newArray[$i].'%',$this->color["txt"]);	
			else if($label == null and !$hidePercentage)
				@imagestring($this->image, 2, $j- $ylabel, ($this->height -  $marginBottom)+6,  $newArray[$i].'%',$this->color["txt"]);
			}
		}
		
		public function graphLine($array, $label=array(), $hidePercentage = false, $ylabel=20, $typeFont=2, $marginBottom = 20, $marginTop = 20, $heightLine = 15, $point = 5) {
			if(count($array) != count($label))
				$label = null;
			for ($i=1; $i<=(($this->height-$marginBottom)/$heightLine); $i++)									// Linee orizzontali
				@imageline($this->image, 0, $i*$heightLine, $this->width, $i*$heightLine, $this->color["line"]);
			$newArray = array();
			$lastPoint = array(0, 0,0 ,0);
			$maxValue = array_sum($array);
			foreach($array as $value)																			// Calcolo valori
				$newArray[] = @intval($value / $maxValue * 100);
			$p = @intval($this->width / @count($newArray));
			for ($i=1; $i<=@count($newArray); $i++)																// Linee verticali
				@imageline($this->image, $i*$p, 0, $i*$p, ($this->height -  $marginBottom), $this->color["line"]);	
			for ($i=0; $i<@count($newArray); $i++) {
				$j = @intval($p/2) + $p*$i;
				$x1 = $j-($point/2);
				$y1 = ($this->height - $marginBottom)-((($this->height-$marginTop -  $marginBottom)/100)*$newArray[$i])-($point/2);
				$x2 = $j+($point/2);
				$y2 = ($this->height - $marginBottom)-((($this->height-$marginTop -  $marginBottom)/100)*$newArray[$i])+($point/2);
				@imagefilledrectangle($this->image,$x1, $y1, $x2, $y2, $this->color["point"]);
				if($i !=0 ) 
					imageline($this->image, round(($x1+$x2)/2), round(($y1+$y2)/2), $lastPoint[0],  $lastPoint[1], $this->color["line"]);
				$lastPoint = array(round(($x1+$x2)/2), round(($y1+$y2)/2));
				if($label != null and !$hidePercentage)
					@imagestring($this->image, 2, $j- $ylabel, ($this->height -  $marginBottom)+6,$label[$i],$this->color["txt"]);	
				else if($label == null and !$hidePercentage)
					@imagestring($this->image, 2, $j- $ylabel, ($this->height -  $marginBottom)+6,$newArray[$i].'%',$this->color["txt"]);
			}
		}
		
		public function graphPie($array, $label = array(), $width = 200, $height = 10) {			// Grafico a torta 2D e 3D
			$newArray = array();
			$colorArray = array();
			$colorDarkArray = array();
			$sum = 0;
			$initGrad = 0;
			$y = 0;
			$j = 0;
			if(count($array) != count($label))
				$label = null;
			foreach($array as $value) {
				$sum += $value;
			}	
			foreach($array as $value) {																	// Calcolo valori
				$newArray[] = ($value/$sum);
				$col1 = rand(80, 255);
				$col2 = rand(80, 255);
				$col3 = rand(80, 255);
				$col1dark = $col1-20;	
				$col2dark = $col2-20;
				$col3dark = $col3-20;
				$colorDarkArray[] = imagecolorallocate($this->image, $col1dark, $col2dark, $col3dark);	// Genero i colori 
				$colorArray[] = imagecolorallocate($this->image, $col1, $col2, $col3);
				@imagefilledrectangle($this->image, 5, $y+3, 15, ($y+12) , imagecolorallocate($this->image, $col1, $col2, $col3));
				if($label == null)
					@imagestring($this->image, 5, 20, $y, $value,$this->color["txt"]);
				else
					@imagestring($this->image, 5, 20, $y, $label[$j],$this->color["txt"]);
				$j++;	
				$y+=15;
			}	
			if($height != 0) 																			// Modalità 3D
			{
				for($i = ($this->height/2)+$height; $i>($this->height/2); $i--) {
					$y = 0;
					foreach($newArray as $value) {
						$grad = round($value*360);
						@imagefilledarc($this->image, $this->width/2, $i, ($width/2), ($width/2)-50, $initGrad, $initGrad+$grad, $colorDarkArray[$y], IMG_ARC_PIE);	
						$initGrad+=$grad;
						$y++;
					}
				}
				$initGrad = 0;
				$y = 0;
				foreach($newArray as $value) {
					$grad = round($value*360);				
					@imagefilledarc($this->image, $this->width/2, ($this->height/2), ($width/2), ($width/2)-50, $initGrad, $initGrad+$grad,  $colorArray[$y], IMG_ARC_PIE);	
					$initGrad+=$grad;
					$y++;
				}
			}
			else {																						// Modalità 2D
				$y = 0;
				foreach($newArray as $value) {	
					$grad = round($value*360);
					@imagefilledarc($this->image, $this->width/2, $this->height/2, $width, $width, $initGrad, $initGrad+$grad, $colorArray[$y], IMG_ARC_PIE);	
					$initGrad+=$grad;
					$y++;
				}
			}				
		}	
		
		public function show() {
			ob_clean();
			@header(_MIME_TYPE);
			if(_TYPE_IMG == "jpg")
				@imagejpeg($this->image);
			else
				@imagepng($this->image);
			imagedestroy($this->image);
			ob_end_flush(); 
			exit;
		}
	}	
?>
