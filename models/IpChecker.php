<?php

namespace models;


class IpChecker
{

	private static $key = 'd9f000dbc0237078dfb39bf8033d244c';


	public static function getIpInfo($ip){
		$data = file_get_contents("http://api.ipstack.com/$ip?access_key=".self::$key);
		return json_decode($data,1);
	}

	public static function getCountryCodeByIp($ip){
		$ip_info = self::getIpInfo($ip);
		if($ip_info['success'] === false ){
			return $ip_info;
		}

		return ['ip' => $ip, 'continent_code'=>$ip_info['continent_code']];
	}
}