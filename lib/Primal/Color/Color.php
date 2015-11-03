<?php 

namespace Primal\Color;

abstract class Color {
	
	/**
	 * @return HSVColor
	 */
	abstract function toHSV();
	
	/**
	 * @return HLSColor
	 */
	abstract function toHSL();
	
	/**
	 * @return RGBColor
	 */
	abstract function toRGB();
	
	/**
	 * @return CMYKColor
	 */
	abstract function toCMYK();
	
	/**
	 * @return string
	 */
	abstract function toCSS();
}

