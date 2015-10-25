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
use libchart\ChartUtils;

class LinearChartObjectLayout extends PaddedChartObject{
	const ORIENTATION_VERTICAL = 0;
	const ORIENTATION_HORIZONTAL = 1;

	/** @var int */
	private $orientation;
	/** @var ChartObject[] */
	private $objects = [];

	private $topPadding = 20, $bottomPadding = 20, $leftPadding = 20, $rightPadding = 20;

	public function __construct($orientation = self::ORIENTATION_VERTICAL){
		parent::__construct();
		ChartUtils::validateMagicConsts($orientation, self::ORIENTATION_VERTICAL, self::ORIENTATION_HORIZONTAL);
		$this->orientation = $orientation;
	}
	public function addObject(ChartObject $object){
		$this->objects[$object->getObjectId()] = $object;
	}

	public function drawCore(Canvas $canvas){
		$palette = $canvas->getPalette();
		$x = $canvas->getRealLeftBorder();
		$y = $canvas->getRealTopBorder();
		$myWidth = $this->getWidth();
		$myHeight = $this->getHeight();
		foreach($this->objects as $object){
			$width = $object->getWidth();
			$height = $object->getHeight();
			if($this->orientation === self::ORIENTATION_VERTICAL){
				$centerX = $x + $myWidth / 2;
				$canvasX = $centerX - $width / 2;
				$canvasY = $y;
				$y += $height;
			}else{
				$canvasX = $x;
				$centerY = $y + $myHeight / 2;
				$canvasY = $centerY - $height / 2;
				$x += $width;
			}
			$object->draw(new Canvas($palette, $canvasX, $canvasY));
		}
	}
	public function getCoreWidth(){
		$width = 0;
		foreach($this->objects as $object){
			if($this->orientation === self::ORIENTATION_HORIZONTAL){
				$width += $object->getWidth();
			}elseif($width < $object->getWidth()){
				$width = $object->getWidth();
			}
		}
		return $width;
	}
	public function getCoreHeight(){
		$height = 0;
		foreach($this->objects as $object){
			if($this->orientation === self::ORIENTATION_VERTICAL){
				$height += $object->getHeight();
			}elseif($height < $object->getHeight()){
				$height = $object->getHeight();
			}
		}
		return $height;
	}
	/**
	 * @return int
	 */
	public function getTopPadding(){
		return $this->topPadding;
	}
	/**
	 * @param int $topPadding
	 */
	public function setTopPadding($topPadding){
		$this->topPadding = $topPadding;
	}
	/**
	 * @return int
	 */
	public function getBottomPadding(){
		return $this->bottomPadding;
	}
	/**
	 * @param int $bottomPadding
	 */
	public function setBottomPadding($bottomPadding){
		$this->bottomPadding = $bottomPadding;
	}
	/**
	 * @return int
	 */
	public function getLeftPadding(){
		return $this->leftPadding;
	}
	/**
	 * @param int $leftPadding
	 */
	public function setLeftPadding($leftPadding){
		$this->leftPadding = $leftPadding;
	}
	/**
	 * @return int
	 */
	public function getRightPadding(){
		return $this->rightPadding;
	}
	/**
	 * @param int $rightPadding
	 */
	public function setRightPadding($rightPadding){
		$this->rightPadding = $rightPadding;
	}
}
