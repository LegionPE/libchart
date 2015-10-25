<?php

/*
 * legionpvp.eu
 *
 * Copyright (C) 2015 PEMapModder and contributors
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author PEMapModder
 */

spl_autoload_register(function($class){
	$dir = __DIR__ . "/../";
	$file = $dir . str_replace("\\", DIRECTORY_SEPARATOR, $class) . ".php";
	if(is_file($file)){
		require_once $file;
	}
}, true, true);

define("FONT_NORM", realpath(__DIR__ . "/norm.ttf"));
define("FONT_BOLD", realpath(__DIR__ . "/bold.ttf"));
