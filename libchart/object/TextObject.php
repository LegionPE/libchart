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

class TextObject extends PaddedChartObject{
	/**
	 * @var int
	 */
	private $centerX;
	/**
	 * @var int
	 */
	private $topBorder;
	/**
	 * @var string
	 */
	private $text;
	/**
	 * @var int
	 */
	private $size;
	/** @var int */
	private $color;
	/**
	 * @var string
	 */
	private $font;
	/**
	 * @var float
	 */
	private $angle;
	/**
	 * @var int
	 */
	private $vertPadding;
	/**
	 * @var int
	 */
	private $horizPadding;
	/**
	 * @param int $centerX
	 * @param int $topBorder
	 * @param string $text
	 * @param int $size
	 * @param int $color
	 * @param string $font
	 * @param float $angle
	 * @param int $vertPadding
	 * @param int $horizPadding
	 */
	public function __construct($centerX, $topBorder, $text, $size, $color, $font = FONT_NORM, $vertPadding, $horizPadding, $angle = 0.0){
		parent::__construct();
		$this->centerX = $centerX;
		$this->topBorder = $topBorder;
		$this->text = $text;
		$this->size = $size;
		$this->color = $color;
		$this->font = $font;
		$this->angle = $angle;
		$this->vertPadding = $vertPadding;
		$this->horizPadding = $horizPadding;
	}
	public static function fromCenterCenter($centerX, $centerY, $text, $size, $color, $font = FONT_NORM, $vertPadding, $horizPadding, $angle = 0.0){
		ChartUtils::getTextDimensions($w, $height, $text, $size, $font, $angle);
		return new TextObject($centerX, $centerY - $height / 2, $text, $size, $color, $font, $vertPadding, $horizPadding, $angle);
	}
	public static function fromCenterBottom($centerX, $bottomBorder, $text, $size, $color, $font = FONT_NORM, $vertPadding, $horizPadding, $angle = 0.0){
		ChartUtils::getTextDimensions($w, $height, $text, $size, $font, $angle);
		return new TextObject($centerX, $bottomBorder - $height, $text, $size, $color, $font, $vertPadding, $horizPadding, $angle);
	}
	public static function fromLeftTop($leftBorder, $topBorder, $text, $size, $color, $font = FONT_NORM, $vertPadding, $horizPadding, $angle = 0.0){
		ChartUtils::getTextDimensions($width, $h, $text, $size, $font, $angle);
		return new TextObject($leftBorder + $width / 2, $topBorder, $text, $size, $color, $font, $vertPadding, $horizPadding, $angle);
	}
	public function getTopPadding(){
		return $this->vertPadding;
	}
	public function getBottomPadding(){
		return $this->vertPadding;
	}
	public function getLeftPadding(){
		return $this->horizPadding;
	}
	public function getRightPadding(){
		return $this->horizPadding;
	}
	public function getCoreWidth(){
		ChartUtils::getTextDimensions($width, $height, $this->text, $this->size, $this->font, $this->angle);
		return $width;
	}
	public function getCoreHeight(){
		ChartUtils::getTextDimensions($width, $height, $this->text, $this->size, $this->font, $this->angle);
		return $height;
	}
	public function drawCore(Canvas $canvas){
		$canvas->writeTextWithCenterTop($this->centerX, $this->topBorder, $this->text, $this->size, $this->color, $this->font, $this->angle);
	}
}
