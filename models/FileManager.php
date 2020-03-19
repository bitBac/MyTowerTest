<?php
/**
 * Created by PhpStorm.
 * User: bombaBanana
 * Date: 19.03.2020
 * Time: 13:44
 */

namespace models;


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
}