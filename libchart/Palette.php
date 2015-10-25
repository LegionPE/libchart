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

class Palette{
	/** @var resource */
	private $img;
	/** @var int[] */
	private $colors = [];

	/**
	 * @param resource $img
	 */
	public function __construct($img){
		$this->img = $img;
	}

	/**
	 * @param $r
	 * @param $g
	 * @param $b
	 * @param int $maxError
	 * @return int
	 */
	public function findColor($r, $g, $b, $maxError = 10){
		$hash = ChartUtils::colorHash($r, $g, $b);
		if(isset($this->colors[$hash])){
			return $this->colors[$hash];
		}
		foreach($this->colors as $rgb => $color){
			if(ChartUtils::rgbColorDelta($rgb, $r, $g, $b) <= $maxError){
				return $color;
			}
		}
		return $this->colors[$hash] = imagecolorallocate($this->img, $r, $g, $b);
	}
	public function findColorRgb($rgb, $maxError = 10){
		ChartUtils::colorUnhash($rgb, $r, $g, $b);
		return $this->findColor($r, $g, $b, $maxError);
	}

	/**
	 * @return resource
	 */
	public function getImage(){
		return $this->img;
	}
}
