<?php 

namespace Primal\Color;

abstract class Color {
	
	abstract function toHSV();
	
	abstract function toHSL();
	
	abstract function toRGB();
	
	abstract function toCMYK();
	
	abstract function toCSS();
}

