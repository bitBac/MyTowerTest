<?php

namespace services;


class Dial
{
	public $path = BASE_DIR . '/resources/countryInfo.json';

	public $data;

	function __construct()
	{
		$data = file_get_contents($this->path);

		$this->data = json_decode($data, 1);

		return $this;
	}

	/**
	 * @param string $phone_number
	 * @return bool
	 */
	public function getContinent($phone_number)
	{

		foreach ($this->data as $record) {

			if ($record["Phone"] == substr($phone_number, 0, 3)) {
				return $record['Continent'];
			}
		}

		return false;
	}
}