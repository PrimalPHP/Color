<?php 

namespace Primal\Color;

class Wheel implements \Iterator, \Countable {
	
	protected $total = 20;
	protected $step = 18;
	protected $startHue = 0;
	protected $startSat = 100;
	protected $lum = 50;
	protected $position = 0;

	public function __construct($count = null, $start = null) {
		if ($count !== null) $this->setTotalColors($count);
		if ($start !== null) $this->setStartColor($start);
	}
	
	public function setStartColor($input) {
		$col = Parser::Parse($input)->toHSL();
		$this->startHue = $col->hue;
		$this->startSat = $col->saturation;
		$this->lum = $col->luminance;
	}
	
	public function setTotalColors($count) {
		$this->total = $count;
		$this->step = 360 / $count;
	}
	
	public function getArray() {
		$results = array();
		foreach ($this as $color) $results[] = $color;
		return $results;
	}
	
/**
	Iterator
*/
	
	function rewind() {
		$this->position = 0;
	}

	function current() {
		$col = new HSLColor($this->startHue + ($this->step * $this->position), $this->startSat, $this->lum);
		return $col->toRGB()->toHex();
	}

	function key() {
		return $this->position;
	}

	function next() {
		$this->position++;
	}

	function valid() {
		return $this->position >= 0 && $this->position < $this->total;
	}
	
	function count() {
		return $this->total;
	}
	
	
}
