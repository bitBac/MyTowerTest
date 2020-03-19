<?php

namespace models;


class Parser
{

	public static function csvToArray($file, $delimeter)
	{
		$csv = file_get_contents($file);
		$array = array_map("str_getcsv", explode($delimeter, $csv));
		return $array;
	}
}