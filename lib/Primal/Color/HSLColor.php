<?php 

namespace Primal\Color;

class HSLColor extends Color {
	public $hue = 0;
	public $saturation = 0;
	public $luminance = 0;
	public $alpha = 1;
	
	function __construct($h = 0, $s = 0, $l = 0, $a=1) {
		$this->hue        = $h;
		$this->saturation = $s;
		$this->luminance  = $l;
		$this->alpha      = $a;
	}
	
	public function toHSV() {
		return $this->toRGB()->toHSV();
	}
	
	public function toHSL() {
		return clone $this;
	}
	
	function toCMYK() {
		return $this->toRGB()->toCMYK();
	}
	
	public function toRGB() {
		$h = ($this->hue        % 360) / 360;
		$s = ($this->saturation % 101) / 100;
		$l = ($this->luminance  % 101) / 100;
		$a = $this->alpha;
		
		if ($s === 0) {
			return new RGBColor($l * 255, $l * 255, $l * 255);
		} else {
			$q = ($l < 0.5) ? $l * (1 + $s) : $l + $s - $l * $s;
			$p = 2 * $l - $q;
			return new RGBColor(
				static::HueToFactor($p, $q, $h + 1 / 3) * 255,
				static::HueToFactor($p, $q, $h        ) * 255,
				static::HueToFactor($p, $q, $h - 1 / 3) * 255
			);
		}
	}
	
	protected static function HueToFactor($p, $q, $t) {
		if ($t < 0) $t += 1;
		if ($t > 1) $t -= 1;
		if ($t < 1 / 6) return $p + ($q - $p) * 6 * $t;
		if ($t < 1 / 2) return $q;
		if ($t < 2 / 3) return $p + ($q - $p) * (2/3 - $t) * 6;
		return $p;
	}
	
	public function toCSS($alpha = null) {
		return (($alpha === true || $this->alpha < 1) && $alpha !== false) ? "hsla({$this->hue}, {$this->saturation}, {$this->luminance}, {$this->alpha})" : "hsl({$this->hue}, {$this->saturation}, {$this->luminance})";
	}
}

