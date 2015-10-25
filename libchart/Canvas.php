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

namespace libchart;

class Canvas{
	/** @var resource */
	private $img;
	/** @var Palette */
	private $palette;
	/** @var int */
	private $x, $y;

	public function __construct(Palette $palette, $leftBorder, $topBorder){
		$this->img = $palette->getImage();
		$this->palette = $palette;
		$this->x = $leftBorder;
		$this->y = $topBorder;
	}
	public function writeTextWithCenterCenter($centerX, $centerY, $text, $size, $rgb, $font = FONT_NORM, $angle = 0.0){
		ChartUtils::getTextDimensions($width, $height, $text, $size, $font, $angle);
		imagettftext($this->img, $size, $angle, $this->x + $centerX - $width / 2, $this->y + $centerY + $height / 2, $this->palette->findColorRgb($rgb), $font, $text);
	}
	public function writeTextWithLeftTop($leftBorder, $topBorder, $text, $size, $rgb, $font = FONT_NORM, $angle = 0.0){
		ChartUtils::getTextDimensions($width, $height, $text, $size, $font, $angle);
		imagettftext($this->img, $size, $angle, $this->x + $leftBorder, $this->y + $topBorder + $height, $this->palette->findColorRgb($rgb), $font, $text);
	}
	public function writeTextWithCenterTop($centerX, $topBorder, $text, $size, $rgb, $font = FONT_NORM, $angle = 0.0){
		ChartUtils::getTextDimensions($width, $height, $text, $size, $font, $angle);
		imagettftext($this->img, $size, $angle, $this->x + $centerX - $width / 2, $this->y + $topBorder + $height, $this->palette->findColorRgb($rgb), $font, $text);
	}

	public function getRealImage(){
		return $this->img;
	}
	public function getPalette(){
		return $this->palette;
	}
	public function getRealLeftBorder(){
		return $this->x;
	}
	public function getRealTopBorder(){
		return $this->y;
	}
}
