<?php 

namespace Primal\Color;

class HSVColor extends Color {
	public $hue = 0;
	public $saturation = 0;
	public $value = 0;
	public $alpha = 1;
	
	function __construct($h = 0, $s = 0, $v = 0, $a=1) {
		$this->hue        = $h;
		$this->saturation = $s;
		$this->value      = $v;
		$this->alpha      = $a;
	}
	
	function toHSV() {
		return clone $this;
	}
	
	function toHSL() {
		return $this->toRGB()->toHSL();
	}
	
	function toCMYK() {
		return $this->toRGB()->toCMYK();
	}
	
	function toRGB() {
		$h = ($this->hue        % 360) / 360;
		$s = ($this->saturation % 101) / 100;
		$v = ($this->value      % 101) / 100;
		$a = $this->alpha;
		
		$i = $h * 6;
		$f = $h * 6 - $i;
		$p = $v * (1 - $s);
		$q = $v * (1 - $f * $s);
		$t = $v * (1 - (1 - $f) * $s);
		switch ($i % 6) {
		case 0:
			$r = $v;
			$g = $t;
			$b = $p;
			break;
		case 1:
			$r = $q;
			$g = $v;
			$b = $p;
			break;
		case 2:
			$r = $p;
			$g = $v;
			$b = $t;
			break;
		case 3:
			$r = $p;
			$g = $q;
			$b = $v;
			break;
		case 4:
			$r = $t;
			$g = $p;
			$b = $v;
			break;
		case 5:
			$r = $v;
			$g = $p;
			$b = $q;
			break;
		}
		return new RGBColor($r * 255, $g * 255, $b * 255, $a);
	}
	
	function toCSS($alpha = null) {
		return (($alpha === true || $this->alpha < 1) && $alpha !== false) ? "hsla({$this->hue}, {$this->saturation}, {$this->value}, {$this->alpha})" : "hsl({$this->hue}, {$this->saturation}, {$this->value})";
	}
	
}

