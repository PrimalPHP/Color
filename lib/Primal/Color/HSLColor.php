<?php

namespace Primal\Color;

class HSLColor extends Color {
	public $hue = 0;
	public $saturation = 0;
	public $luminance = 0;
	public $alpha = 1;

	public function __construct($h = 0, $s = 0, $l = 0, $a=1) {
		$this->hue        = $h;
		$this->saturation = $s;
		$this->luminance  = $l;
		$this->alpha      = $a;
	}

	/**
	 * {@inheritdoc}
	 */
	public function toHSV() {
		return $this->toRGB()->toHSV();
	}

	/**
	 * {@inheritdoc}
	 */
	public function toHSL() {
		return clone $this;
	}

	/**
	 * {@inheritdoc}
	 */
	public function toCMYK() {
		return $this->toRGB()->toCMYK();
	}

	/**
	 * {@inheritdoc}
	 */
	public function toRGB() {
		$h = ($this->hue        % 360) / 360;
		$s = ($this->saturation % 101) / 100;
		$l = ($this->luminance  % 101) / 100;

		if ($s === 0) {
			return new RGBColor($l * 255, $l * 255, $l * 255, $this->alpha);
		} else {
			$q = $l < 0.5 ? $l * (1 + $s) : $l + $s - $l * $s;
			$p = 2 * $l - $q;
			return new RGBColor(
				static::HueToFactor($p, $q, $h + 1 / 3) * 255,
				static::HueToFactor($p, $q, $h        ) * 255,
				static::HueToFactor($p, $q, $h - 1 / 3) * 255,
				$this->alpha
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

	/**
	 * {@inheritdoc}
	 */
	public function toCSS($alpha = null) {
		return ($alpha === true || $this->alpha < 1) && $alpha !== false
			? sprintf('hsla(%d, %d, %d, %s)', $this->hue, $this->saturation, $this->luminance, number_format($this->alpha, 2, '.', ''))
			: sprintf('hsl(%d, %d, %d)', $this->hue, $this->saturation, $this->luminance);
	}
}

