<?php

use models\Helper;
use models\Parser;
use models\FileManager;

define('BASE_DIR', __DIR__);

require_once BASE_DIR . '/vendor/ClassAutoLoader.php';

$ClassAutoLoader = new ClassAutoLoader();
$ClassAutoLoader->register();


$results = [];

if(isset($_FILES["fileToUpload"])){
	$file = new FileManager($_FILES["fileToUpload"]);

	if($file->validate()){
		$data = Parser::csvToArray($file->path, "\n");
		$results = Helper::getResults($data);
	}else{
		var_dump($file->getValidationErrors());
	}

}

require_once BASE_DIR . '/views/home.php';
?>

