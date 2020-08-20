<?php
/**
 * Created by PhpStorm.
 * User: bombaBanana
 * Date: 19.03.2020
 * Time: 13:44
 */

namespace services;


use models\Call;

class FileManager
{
	public $file;
	public $basename;
	public $extension;
	public $path;

	protected $validation_errors = [];

	function __construct($file)
	{
		$this->file = $file;

		$this->path = $this->file['tmp_name'];

		$path_parts = pathinfo($this->file['name']);

		$this->basename = $path_parts['extension'];

		$this->extension = $path_parts['extension'];

	}

	public function isFileCsv()
	{
		if ($this->extension == 'txt' || $this->extension == 'csv') {
			return true;
		} else {
			$this->validation_errors[] = 'File is not CSV!';
		}

		return false;
	}

	public function validate()
	{
		if ($this->isFileCsv() === true) {
			return true;
		}

		return false;
	}

	public function getValidationErrors()
	{
		return $this->validation_errors;
	}

	/**
	 * @return Call[]
	 */
	public function extractData()
	{
		$csv = file_get_contents($this->path);
		$array = array_map("str_getcsv", explode("\n", $csv));
		$calls_models = [];

		foreach ($array as $call_info) {
			$call = new Call();
			$call->setCustomerId((int)$call_info[0]);
			$call->setDate($call_info[1]);
			$call->setDuration((int)$call_info[2]);
			$call->setPhoneNumber($call_info[3]);
			$call->setCustomerIp($call_info[4]);

			if ($call->validate()) {
				$calls_models[] = $call;
			}
		}

		return $calls_models;
	}
}