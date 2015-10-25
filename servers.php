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

use libchart\chart\pie\PieChart;
use libchart\chart\pie\PieChartConfig;
use libchart\Datum;
use const libtheta\QUERY_ALL;
use function libtheta\query;

require_once "/var/www/libtheta/libtheta.php";
require_once "/var/www/html/charts/libchart/libchart.php";

$result = query("SELECT class, COUNT(*) AS cnt, SUM(max_players) AS max, SUM(online_players) AS used FROM server_status WHERE unix_timestamp()-last_online < 5 GROUP BY class", QUERY_ALL);

$classes = [
	CLASS_HUB => "Hub",
	CLASS_KITPVP => "KitPvP",
	CLASS_PARKOUR => "Parkour",
	CLASS_SPLEEF => "Spleef",
	CLASS_INFECTED => "Infected",
	CLASS_CLASSICAL => "Classic PvP"
];

$config = new PieChartConfig;
$config->title = "Server Status";
$config->titleFontSize = 48;
$config->titleRgb = 0xFFFFFF;
$config->bgRgb = 0x000000;
$config->leftPadding = 20;
$config->rightPadding = 20;
$config->titleTopPadding = 20;
$config->titleBodyPadding = 20;
$config->bottomPadding = 20;
$config->radius = 150;
$config->keyTitleColor = 0xFFFFFF;
$config->keyTitleFontSize = 36;
$config->keyTextFontSize = 24;

$chart = new PieChart($config);
$colors = [
	0 => 0xFF6400,
	1 => 0x64FF00,
	2 => 0xFF0064,
	3 => 0x0064FF,
];
$i = 0;
foreach($result as $row){
	$datum = new Datum;
	$datum->name = $classes[(int) $row["class"]];
	$datum->value = (int) $row["used"];
	$datum->rgb = $colors[($i++) & 3];
	$chart->addDatum($datum);
}
$startPlot = microtime(true);
$chart->init();
$png = $chart->getPNG(0x808000);
$endPlot = microtime(true);
header("Content-Type: image/png");
header("X-libchart-Generation-Time: " . ($endPlot - $startPlot));
echo $png;
