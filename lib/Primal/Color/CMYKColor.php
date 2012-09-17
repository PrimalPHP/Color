<?php 

namespace Primal\Color;

class CMYKColor extends Color {
	public $cyan = 0;
	public $magenta = 0;
	public $yellow = 0;
	public $black = 100;
	public $alpha = 1;
	
	function __construct($c = 0, $m = 0, $y = 0, $k = 100, $a=1) {
		$this->cyan    = $c;
		$this->magenta = $m;
		$this->yellow  = $y;
		$this->black   = $k;
		$this->alpha   = $a;
	}
	
	function toHSV() {
		return $this->toRGB()->toHSV();
	}
	
	function toHSL() {
		return $this->toRGB()->toHSL();
	}
	
	function toCMYK() {
		return clone $this;
	}
	
	function toRGB() {
		$c = ((int)$this->cyan    % 100) / 100;
		$m = ((int)$this->magenta % 100) / 100;
		$y = ((int)$this->yellow  % 100) / 100;
		$b = ((int)$this->black   % 100) / 100;
		$a = $this->alpha;
		
		$r = 1 - min(1, $c * (1 - $k) + $k);
		$g = 1 - min(1, $m * (1 - $k) + $k);
		$b = 1 - min(1, $y * (1 - $k) + $k);
		
		return new RGBColor($r * 255, $g * 255, $b * 255);
	}
	
	function toCSS() {
		return "device-cmyk({$this->cyan}, {$this->majenta}, {$this->yellow}, {$this->black})";
	}

	
}

