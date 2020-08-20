<?php

namespace services;


class IP
{

	const KEY = "d9f000dbc0237078dfb39bf8033d244c";


	public function getIpInfo($ip){
		$data = file_get_contents("http://api.ipstack.com/$ip?access_key=".self::KEY);
		return json_decode($data,1);
	}

	public function getCountryCodeByIp($ip){
		$ip_info = $this->getIpInfo($ip);
		if($ip_info['success'] === false ){
			return false;
		}

		return $ip_info['continent_code'];
	}
}