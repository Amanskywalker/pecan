<?php
/**
 * Copyright (c) 2017 University of Illinois, NCSA.
 * All rights reserved. This program and the accompanying materials
 * are made available under the terms of the
 * University of Illinois/NCSA Open Source License
 * which accompanies this distribution, and is available at
 * http://opensource.ncsa.illinois.edu/license.html
 */

// to select the host from the sync need to be done alternatively to set the server_url
include_once('../common.php');

include 'page.template.php';

open_database();

$stmt = $pdo->prepare("SELECT id, hostname, sync_host_id FROM machines;",array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));

if (!$stmt->execute()) {
?>
  <div class="alert alert-danger" role="alert"> <?php echo 'Invalid query : [' . error_database() . ']'  . $pdo->errorInfo();?> </div>
<?php
  die();
}

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row == false) {
  // no data present in the machine table
?>
  <div class="alert alert-danger" role="alert"> No details are present in Machine tables </div>
<?php
}
?>
<form class="form-horizontal" role="form" id="formnext" method="POST" action="<?php echo"syncselect.php";?>" enctype="multipart/form-data">
  <div class="form-group">
  <label for="sel1">Select the host:</label>
  <select class="form-control" id="host" name="host">
<?php
foreach ($row as $value) {
?>
    <option value="<?php echo $value['id']; ?>"><?php echo $value['hostname']; ?></option>
<?php
}
?>
  </select>
  </div>
</form>
<?php
include 'pagefooter.template.php';
?>
