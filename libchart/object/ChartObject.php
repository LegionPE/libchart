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

use IllegalStateException;
use libchart\Canvas;
use libchart\Palette;

abstract class ChartObject{
	private static $nextId = 0;
	private static function getNextId(){
		return self::$nextId++;
	}

	private $objectId;

	public function __construct(){
		$this->objectId = self::getNextId();
	}
	/**
	 * @return int
	 */
	public abstract function getWidth();
	/**
	 * @return int
	 */
	public abstract function getHeight();
	/**
	 * @param Canvas $canvas
	 */
	public abstract function draw(Canvas $canvas);
	public function notReady(){
		throw new IllegalStateException("Object not ready");
	}

	/**
	 * @return int
	 */
	public function getObjectId(){
		return $this->objectId;
	}

	/**
	 * @param int $bg
	 * @return resource
	 */
	public function plot($bg){
		$img = imagecreatetruecolor($this->getWidth(), $this->getHeight());
		$canvas = new Canvas($palette = new Palette($img), 0, 0);
		imagefill($img, 0, 0, $palette->findColorRgb($bg));
		$this->draw($canvas);
		return $img;
	}

	/**
	 * @param int $bg
	 * @return string
	 */
	public function getPNG($bg){
		ob_start();
		$img = $this->plot($bg);
		imagepng($img);
		imagedestroy($img);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}

	public function __toString(){
		return get_class($this) . "($this->objectId)";
	}
}
