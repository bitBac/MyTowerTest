<?php

namespace models;


class DialChecker
{
	public static $path = BASE_DIR.'/resources/countryInfo.json';

	public static function getDialData(){
		$data = file_get_contents(self::$path);

		return json_decode($data,1);
	}

	public static function getContinent($phone_number){
		$data = self::getDialData();

		foreach ($data as $record){

			if($record["Phone"] == substr($phone_number,0,3)){
				return $record;
			}
		}

		return false;
	}
}