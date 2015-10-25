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
use libchart\object\TextObject;

class PieChartKeys extends LinearChartObjectLayout{
	/** @var PieChart */
	private $main;

	public function __construct(PieChart $main){
		parent::__construct();
		$this->main = $main;
		$this->init();
	}
	protected function init(){
		$this->addObject(TextObject::fromLeftTop(0, 0, "Keys", $this->main->getConfig()->keyTitleFontSize, $this->main->getConfig()->keyTitleColor, FONT_BOLD, 5, 5));
		foreach($this->main->data as $datum){
			$this->addObject(TextObject::fromLeftTop(0, 0, $datum->name . ": " . $datum->value, $this->main->getConfig()->keyTextFontSize, $datum->rgb, FONT_NORM, 5, 5));
		}
		$this->setBorders(true, 10);
	}
}
