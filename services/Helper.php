<?php

namespace services;

use models\Call;


class Helper
{

	/**
	 * @var Dial
	 */
	public $dial;

	/**
	 * @var IP
	 */
	public $ip;

	public function __construct()
	{
		$this->dial = new Dial();
		$this->ip = new IP();
	}

	/**
	 * @param Call[] $calls
	 * @return array
	 */
	public function getResults($calls)
	{
		$results = [];

		foreach ($calls as $call) {
			$customer_id = $call->getCustomerId();

			if (!isset($results[$customer_id])) {
				$results[$customer_id]['customer_id'] = $customer_id;
				$results[$customer_id]['total_calls'] = 0;
				$results[$customer_id]['total_calls_within_continent'] = 0;
				$results[$customer_id]['total_calls_dur_within_continent'] = 0;
				$results[$customer_id]['total_calls_dur'] = 0;
			}

			$results[$customer_id]['total_calls']++;
			$results[$customer_id]['total_calls_dur'] += $call->getDuration();

			$ip_data = $this->ip->getCountryCodeByIp($call->getCustomerIp());

			$phone_data = $this->dial->getContinent($call->getPhoneNumber());

			if ($ip_data === false || $phone_data === false) {
				continue;
			}

			if ($phone_data == $ip_data) {
				$results[$customer_id]['total_calls_dur_within_continent']++;
				$results[$customer_id]['total_calls_within_continent']++;
			}
		}

		return $results;
	}
}