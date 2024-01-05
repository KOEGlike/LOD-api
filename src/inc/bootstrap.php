<?php
$dir=getenv("ROOT_DIR");

// include the controller files
require_once  $dir."/controller/api/base_controller.php";
require_once  $dir."/controller/api/create_controller.php";
require_once  $dir."/controller/api/get_controller.php";
require_once  $dir."/controller/api/vote_controller.php";
require_once  $dir."/controller/file/base_controller.php";
// include the model files
require_once  $dir."/model/database.php";
require_once  $dir."/model/lod_model.php";
require_once  $dir."/model/images_model.php";
?>