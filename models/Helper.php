<?php

namespace models;


class Helper
{

	public static function groupCallsByCustomer($data)
	{
		$formated_data = [];

		foreach ($data as $row){
			if($row[0] == null)
				continue;

			$formated_data[$row[0]][] =[$row[1],$row[2],$row[3],$row[4]];
		}

		return $formated_data;
	}
	public static function getResults($data)
	{
		$formated_data = Helper::groupCallsByCustomer($data);
		$results = [];
		foreach ($formated_data as $client=>$c_data){
			$result['customer_id'] = $client;
			$result['total_calls'] = count($c_data);
			$result['total_calls_within_continent'] = 0;
			$result['total_calls_dur_within_continent'] = 0;
			$result['total_calls_dur'] = 0;
			foreach ($c_data as $record) {
				$result['total_calls_dur']+= $record[1];

				$ip_data = IpChecker::getCountryCodeByIp($record[3]);
				if ($ip_data['success'] === false) {
					continue;
				}

				$phone_data = DialChecker::getContinent($record[2]);
				if (!isset($phone_data['Continent'])) {
					continue;
				}

				if ($phone_data['Continent'] == $ip_data['continent_code']) {
					$result['total_calls_dur_within_continent']+= $record[1];
					$result['total_calls_within_continent']++;
				}
			}

			$results[] = $result;
		}

		return $results;
	}
}