<?php
namespace Tests\Primal\Color;

use Primal\Color\CMYKColor;
use Primal\Color\RGBColor;

class CMYKColorTest extends \PHPUnit_Framework_TestCase
{
	/** @dataProvider RGBProvider */
	public function testToRGB(CMYKColor $cmyk, RGBColor $rgb)
	{
		$rgbActual = $cmyk->toRGB();

		$this->assertEquals($rgb->red, $rgbActual->red, 'Wrong red', 1);
		$this->assertEquals($rgb->green, $rgbActual->green, 'Wrong green', 1);
		$this->assertEquals($rgb->blue, $rgbActual->blue, 'Wrong blue', 1);
		$this->assertEquals($rgb->alpha, $rgbActual->alpha, 'Wrong alpha');
	}

	public function testToCSS()
	{
		$cmyk = new CMYKColor(0, 17, 34, 18);
		$css = $cmyk->toCSS();

		$this->assertEquals('device-cmyk(0%, 17%, 34%, 18%)', $css);
	}

	public function testToCSSWithAlpha()
	{
		$cmyk = new CMYKColor(0, 17, 34, 18, .5);
		$css = $cmyk->toCSS();

		$this->assertEquals('device-cmyk(0%, 17%, 34%, 18%, 0.5)', $css);
	}

	public function RGBProvider()
	{
		return array(array(new CMYKColor(0, 17, 34, 18, .5), new RGBColor(209, 173, 138, .5)));
	}
}
