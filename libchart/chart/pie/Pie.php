<?php

/*
 * legionpvp.eu
 *
 * Copyright (C) 2015 PEMapModder
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

namespace libchart\chart\pie;

use libchart\Canvas;
use libchart\object\PaddedChartObject;

class Pie extends PaddedChartObject{
	/** @var PieChart */
	private $main;
	public function __construct(PieChart $main){
		parent::__construct();
		$this->main = $main;
	}
	public function getTopPadding(){
		return 10;
	}
	public function getBottomPadding(){
		return 10;
	}
	public function getLeftPadding(){
		return 10;
	}
	public function getRightPadding(){
		return 10;
	}
	public function getCoreWidth(){
		return $this->main->getConfig()->radius * 2;
	}
	public function getCoreHeight(){
		return $this->main->getConfig()->radius * 2;
	}
	public function drawCore(Canvas $canvas){
		$data = $this->main->data;
		$sum = 0;
		foreach($data as $datum){
			$sum += $datum->value;
		}
		$angle = 0;
		foreach($data as $datum){
			$start = $angle;
			$angle += 360 * $datum->value / $sum;
			$end = $angle;
			$canvas->drawSector($this->main->getConfig()->radius, $this->main->getConfig()->radius, $this->main->getConfig()->radius, $start, $end, $datum->rgb);
		}
	}
}
