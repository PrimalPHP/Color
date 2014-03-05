<?php 

namespace Primal\Color;

class RGBColor extends Color {
	public $red = 0;
	public $green = 0;
	public $blue = 0;
	public $alpha = 1;
	
	function __construct($r = 0, $g = 0, $b = 0, $a=1) {
		$this->red   = $r;
		$this->green = $g;
		$this->blue  = $b;
		$this->alpha = $a;
	}
	
	function toHSV() {
		$r = ((int)$this->red   % 256) / 255;
		$g = ((int)$this->green % 256) / 255;
		$b = ((int)$this->blue  % 256) / 255;
		$a = $this->alpha;
		
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		$d = $max - $min;

		$h = 0;
		$s = ($max === 0) ? 0 : $d / $max;
		$v = $max;
		
		if ($max !== $min) {
			switch ($max) {
			case $r:
				$h = ($g - $b) / $d + (($g < $b) ? 6 : 0);
				break;
			case $g:
				$h = ($b - $r) / $d + 2;
				break;
			case $b:
				$h = ($r - $g) / $d + 4;
			}
			$h = $h / 6;
		}
		
		return new HSVColor($h*360, $s*100, $v*100, $a);
	}
	
	function toHSL() {
		$r = ((int)$this->red   % 256) / 255;
		$g = ((int)$this->green % 256) / 255;
		$b = ((int)$this->blue  % 256) / 255;
		$a = $this->alpha;
		
		$max = max($r, $g, $b);
		$min = min($r, $g, $b);
		
		$l = ($max + $min ) / 2;
		if ($max === $min) {
			$h = $s = 0;
		} else {
			$d = $max - $min;
			$s = ($l > 0.5) ? ($d / (2-$max-$min)) : ($d / ($max + $min));
			switch ($max) {
			case $r:
				$h = ($g - $b) / $d + (($g < $b) ? 6 : 0);
				break;
			case $g:
				$h = ($b - $r) / $d + 2;
				break;
			case $b:
				$h = ($r - $g) / $d + 4;
			}
			$h = $h / 6;
		}
		
		return new HSLColor($h*360, $s*100, $l*100, $a);
	}
	
	function toCMYK() {
		$r = ((int)$this->red   % 256) / 255;
		$g = ((int)$this->green % 256) / 255;
		$b = ((int)$this->blue  % 256) / 255;
		$a = $this->alpha;

		if ($r === 0 && $g === 0 && $b===0) {
			return new CMYKColor(0,0,0,1);
		}

		$k = min(1 - $r, 1 - $g, 1 - $b);
		$c = (1 - $r - $k) / (1 - $k);
		$m = (1 - $g - $k) / (1 - $k);
		$y = (1 - $b - $k) / (1 - $k);
		
		return new CMYKColor($c*100, $m*100, $y*100, $k*100, $a);
	}
	
	function toRGB() {
		return clone $this;
	}
	
	function toCSS($alpha = null) {
		return (($alpha === true || $this->alpha < 1) && $alpha !== false) ? "rgba({$this->red}, {$this->green}, {$this->blue}, {$this->alpha})" : "rgb({$this->red}, {$this->green}, {$this->blue})";
	}
	
	function toHex() {
		$stack = array('#');
		$stack[] = str_pad(dechex(min(255, round($this->red  ))), 2, '0', STR_PAD_LEFT);
		$stack[] = str_pad(dechex(min(255, round($this->green))), 2, '0', STR_PAD_LEFT);
		$stack[] = str_pad(dechex(min(255, round($this->blue ))), 2, '0', STR_PAD_LEFT);
		
		return implode('', $stack);
	}
	
}

