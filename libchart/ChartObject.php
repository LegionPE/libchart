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

use IllegalStateException;

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
}