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

use libchart\object\LinearChartObjectLayout;

class PieChartBody extends LinearChartObjectLayout{
	/** @var PieChart */
	private $main;
	public function __construct(PieChart $main){
		parent::__construct(self::ORIENTATION_HORIZONTAL);
		$this->main = $main;
		$this->init();
	}
	protected function init(){
		$this->addObject(new Pie($this->main));
	}
}
