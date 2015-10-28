<?php
namespace Tests\Primal\Color;

use Primal\Color\CMYKColor;
use Primal\Color\HSLColor;
use Primal\Color\HSVColor;
use Primal\Color\RGBColor;

class RGBColorTest extends \PHPUnit_Framework_TestCase
{
	/** @dataProvider HSVProvider */
	public function testToHSV(RGBColor $rgb, HSVColor $hsv)
	{
		$hsvActual = $rgb->toHSV();

		$this->assertEquals($hsv->hue, $hsvActual->hue, 'Wrong hue', 1);
		$this->assertEquals($hsv->saturation, $hsvActual->saturation, 'Wrong saturation', 1);
		$this->assertEquals($hsv->value, $hsvActual->value, 'Wrong value', 1);
		$this->assertEquals($hsv->alpha, $hsvActual->alpha, 'Wrong alpha');
	}

	/** @dataProvider HSLProvider */
	public function testToHSL(RGBColor $rgb, HSLColor $hsl)
	{
		$hslActual = $rgb->toHSL();

		$this->assertEquals($hsl->hue, $hslActual->hue, 'Wrong hue', 1);
		$this->assertEquals($hsl->saturation, $hslActual->saturation, 'Wrong saturation', 1);
		$this->assertEquals($hsl->luminance, $hslActual->luminance, 'Wrong luminance', 1);
		$this->assertEquals($hsl->alpha, $hslActual->alpha, 'Wrong alpha');
	}

	/** @dataProvider CMYKProvider */
	public function testToCMYK(RGBColor $rgb, CMYKColor $cmyk)
	{
		$cmykActual = $rgb->toCMYK();

		$this->assertEquals($cmyk->cyan, $cmykActual->cyan, 'Wrong cyan', 1);
		$this->assertEquals($cmyk->magenta, $cmykActual->magenta, 'Wrong magenta', 1);
		$this->assertEquals($cmyk->yellow, $cmykActual->yellow, 'Wrong yellow', 1);
		$this->assertEquals($cmyk->black, $cmykActual->black, 'Wrong black', 1);
		$this->assertEquals($cmyk->alpha, $cmykActual->alpha, 'Wrong alpha');
	}

	public function testToCSS()
	{
		$rgb = new RGBColor(209, 167, 125);
		$css = $rgb->toCSS();

		$this->assertEquals('rgb(209, 167, 125)', $css);
	}

	public function testToCSSWithAlpha()
	{
		$rgb = new RGBColor(209, 167, 125, .5);
		$css = $rgb->toCSS(true);

		$this->assertEquals('rgba(209, 167, 125, 0.5)', $css);
	}

	public function testToHex()
	{
		$rgb = new RGBColor(209, 167, 125);
		$hex = $rgb->toHex();

		$this->assertEquals('#d1a77d', $hex);
	}

	public function HSVProvider()
	{
		return array(array(new RGBColor(209, 167, 125, .5), new HSVColor(30, 40, 82, .5)));
	}

	public function HSLProvider()
	{
		return array(array(new RGBColor(209, 167, 125, .5), new HSLColor(30, 47, 65, .5)));
	}

	public function CMYKProvider()
	{
		return array(array(new RGBColor(209, 167, 125, .5), new CMYKColor(0, 20, 40, 18, .5)));
	}
}
