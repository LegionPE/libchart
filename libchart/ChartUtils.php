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
}
