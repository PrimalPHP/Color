<?php 

namespace Primal\Color;

class Wheel implements \Iterator, \Countable {
	
	protected $total = 20;
	protected $step = 18;
	protected $startHue = 0;
	protected $startSat = 100;
	protected $lum = 50;
	protected $position = 0;
	
	public $luminance_step = 360;
	public $luminance_pad_left = 0;
	public $luminance_pad_right = 0;
	public $luminance_delta = 1;

	public function __construct($count = null, $start = null) {
		if ($count !== null) $this->setTotalColors($count);
		if ($start !== null) $this->setStartColor($start);
	}
	
	public function setStartColor($input) {
		$col = Parser::Parse($input)->toHSL();
		$this->startHue = $col->hue;
		$this->startSat = $col->saturation;
		$this->lum = $col->luminance;
		
		return $this;
	}
	
	public function setTotalColors($count) {
		$this->total = $count;

		$this->step = ($this->total) 
			? 355 / min($count, $this->luminance_step) //355 instead of 360 so we don't run into the same color from the start
			: 0;
			
		return $this;
	}
	
	public function setLuminanceThreshold($limit = 360, $delta = 1, $pad_left = 0, $pad_right = 0) {
		$this->luminance_step = $limit;
		$this->luminance_delta = $delta;
		$this->luminance_pad_left  = $pad_left;
		$this->luminance_pad_right = $pad_right;

		$this->step = ($this->total) 
			? 355 / min($this->total, $this->luminance_step) //355 instead of 360 so we don't run into the same color from the start
			: 0;

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
		$h = $this->startHue + ($this->step * ($this->position % $this->luminance_step));
		$s = $this->startSat;
		
		$l = (
			$this->lum + 
			$this->luminance_delta * (
				floor(
					$this->position / 
					$this->luminance_step
				) *
				10
			)
		);
		
		if ($l < 0) $l = 100 + $l;
		
		$l = (
			(($l - $this->luminance_pad_left) % (100 - ($this->luminance_pad_right + $this->luminance_pad_left))) + $this->luminance_pad_left
		);
		
		$col = new HSLColor($h, $s, $l);
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
