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

namespace libchart\object;

use libchart\Canvas;

abstract class PaddedChartObject extends ChartObject{
	/** @var bool */
	private $borders;
	/** @var int */
	private $margin;

	public abstract function getTopPadding();
	public abstract function getBottomPadding();
	public abstract function getLeftPadding();
	public abstract function getRightPadding();
	public abstract function getCoreWidth();
	public abstract function getCoreHeight();
	public abstract function drawCore(Canvas $canvas);
	public function draw(Canvas $canvas){
		$subcanvas = new Canvas($canvas->getPalette(), $canvas->getRealLeftBorder() + $this->getLeftPadding(), $canvas->getRealTopBorder() + $this->getTopPadding());
		$this->drawCore($subcanvas);
	}

	public function getWidth(){
		return $this->getLeftPadding() + $this->getCoreWidth() + $this->getRightPadding();
	}
	public function getHeight(){
		return $this->getTopPadding() + $this->getCoreHeight() + $this->getBottomPadding();
	}
	public function setBorders($on, $margin = 0){
		$this->borders = $on;
		$this->margin = $margin;
	}
}
