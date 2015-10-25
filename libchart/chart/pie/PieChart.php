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

use libchart\chart\Chart;
use libchart\Datum;

class PieChart extends Chart{
	/** @var PieChartConfig */
	private $config;
	/** @var Datum[] */
	public $data;

	public function __construct(PieChartConfig $config){
		parent::__construct();
		$this->config = $config;
		$this->init();
	}
	protected function init(){
		parent::init();
		$this->addObject(new PieChartBody($this));
	}
	/**
	 * @return PieChartConfig
	 */
	public function getConfig(){
		return $this->config;
	}
	public function addDatum(Datum $datum){
		$this->data[] = $datum;
	}
}
