<?php

use services\Helper;
use services\FileManager;

define('BASE_DIR', __DIR__);

require_once BASE_DIR . '/vendor/ClassAutoLoader.php';

$ClassAutoLoader = new ClassAutoLoader();
$ClassAutoLoader->register();


$results = [];

if(isset($_FILES["fileToUpload"])){
	$file = new FileManager($_FILES["fileToUpload"]);

	if($file->validate()){
		$calls = $file->extractData();
		$helper = new Helper();
		$results = $helper->getResults($calls);
	}else{
		var_dump($file->getValidationErrors());
	}

}

require_once BASE_DIR . '/views/home.php';

