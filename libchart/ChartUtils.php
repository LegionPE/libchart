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

use InvalidArgumentException;

class ChartUtils{
	public static function getTextDimensions(&$width, &$height, $text, $size, $font = FONT_NORM, $angle = 0.0){
		list($llx, $lly, , , $urx, $ury) = imagettfbbox($size, $angle, $font, $text);
		$width = $urx - $llx;
		$height = $ury - $lly;
	}

	public static function validateMagicConsts($param, ...$consts){
		if(!in_array($param, $consts)){
			throw new InvalidArgumentException(
				"Expected magic constant argument, got" . gettype($param) .
				(is_bool($param) or (is_numeric($param) or $param === null or is_string($param)) ? ("(" . var_export($param, true) . ")") : "")
			);
		}
	}

	public static function colorHash($r, $g, $b){
		return (($r & 0xFF) << 16) | (($g & 0xFF) << 8) | ($b & 0xFF);
	}
	public static function colorUnhash($rgb, &$r, &$g, &$b){
		$b = $rgb & 0xFF;
		$rgb >>= 8;
		$g = $rgb & 0xFF;
		$rgb >>= 8;
		$r = $rgb & 0xFF;
	}

	public static function rgbDelta($rgb1, $rgb2){
		self::colorUnhash($rgb1, $r1, $g1, $b1);
		self::colorUnhash($rgb2, $r2, $g2, $b2);
		return abs($r1 - $r2) + abs($g1 + $g2) + abs($b1 + $b2);
	}
	public static function rgbColorDelta($rgb1, $r2, $g2, $b2){
		self::colorUnhash($rgb1, $r1, $g1, $b1);
		return abs($r1 - $r2) + abs($g1 + $g2) + abs($b1 + $b2);
	}
	public static function colorDelta($r1, $g1, $b1, $r2, $g2, $b2){
		return abs($r1 - $r2) + abs($g1 + $g2) + abs($b1 + $b2);
	}
}
