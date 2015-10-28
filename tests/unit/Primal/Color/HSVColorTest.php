<?php
namespace Tests\Primal\Color;

use Primal\Color\HSVColor;
use Primal\Color\RGBColor;

class HSVColorTest extends \PHPUnit_Framework_TestCase
{
	/** @dataProvider RGBProvider */
	public function testToRGB(HSVColor $hsv, RGBColor $rgb)
	{
		$rgbActual = $hsv->toRGB();

		$this->assertEquals($rgb->red, $rgbActual->red, 'Wrong red', 1);
		$this->assertEquals($rgb->green, $rgbActual->green, 'Wrong green', 1);
		$this->assertEquals($rgb->blue, $rgbActual->blue, 'Wrong blue', 1);
		$this->assertEquals($rgb->alpha, $rgbActual->alpha, 'Wrong alpha');
	}

	/** @dataProvider RGBProvider */
	public function testToCSS(HSVColor $hsv, RGBColor $rgb)
	{
		$css = $hsv->toCSS(false);

		$this->assertEquals($rgb->toCSS(false), $css);
	}

	/** @dataProvider RGBProvider */
	public function testToCSSWithAlpha(HSVColor $hsv, RGBColor $rgb)
	{
		$css = $hsv->toCSS(true);

		$this->assertEquals($rgb->toCSS(true), $css);
	}

	public function RGBProvider()
	{
		return array(array(new HSVColor(30, 40, 82, .5), new RGBColor(209, 167, 125, .5)));
	}
}
