<?php
/**
 * Copyright (c) 2017 University of Illinois, NCSA.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the
 * University of Illinois/NCSA Open Source License
 * which accompanies this distribution, and is available at
 * http://opensource.ncsa.illinois.edu/license.html
 */

// cronjob

$tempfile = tmpfile();

if (file_exists ("syncflag.txt") == true){
  include 'sync.php';

	$line = date("Y-m-d H:i:s") . "File found";
}
else
{
	$line = date("Y-m-d H:i:s") . "File doesn't exist";
}

fwrite($tempfile, $line);

$configfile = fopen("syscron.log", "a+");

rewind($tempfile);

while (($buffer=fgets($tempfile))!== false) {
  fwrite($configfile,$buffer);
}

fclose($tempfile); // remove tempfile

?>
