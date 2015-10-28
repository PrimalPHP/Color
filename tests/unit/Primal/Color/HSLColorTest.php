<?php
namespace Tests\Primal\Color;

use Primal\Color\HSLColor;
use Primal\Color\RGBColor;

class HSLColorTest extends \PHPUnit_Framework_TestCase
{
	/** @dataProvider RGBProvider */
	public function testToRGB(HSLColor $hsl, RGBColor $rgb)
	{
		$rgbActual = $hsl->toRGB();

		$this->assertEquals($rgb->red, $rgbActual->red, 'Wrong red', 1);
		$this->assertEquals($rgb->green, $rgbActual->green, 'Wrong green', 1);
		$this->assertEquals($rgb->blue, $rgbActual->blue, 'Wrong blue', 1);
		$this->assertEquals($rgb->alpha, $rgbActual->alpha, 'Wrong alpha');
	}

	public function testToCSS()
	{
		$hsl = new HSLColor(30, 48, 65);
		$css = $hsl->toCSS();

		$this->assertEquals('hsl(30, 48, 65)', $css);
	}

	public function testToCSSWithAlpha()
	{
		$hsl = new HSLColor(30, 48, 65, .5);
		$css = $hsl->toCSS();

		$this->assertEquals('hsla(30, 48, 65, 0.5)', $css);
	}

	public function RGBProvider()
	{
		return array(array(new HSLColor(30, 48, 65, .5), new RGBColor(209, 166, 123, .5)));
	}
}
