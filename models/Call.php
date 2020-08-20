<?php


namespace models;


class Call
{
	/**
	 * @var integer
	 */
	private $customer_id;

	/**
	 * @var string
	 */
	private $date;

	/**
	 * @var integer
	 * @range(0, 7200)
	 */
	private $duration;

	/**
	 * @var string
	 * @length(12)
	 */
	private $phone_number;

	/**
	 * @var string
	 * @length(15)
	 */
	private $customer_ip;


	public function __construct()
	{

	}

	/**
	 * Getters
	 * @return int
	 */
	public function getCustomerId(): int
	{
		return $this->customer_id;
	}

	/**
	 * @return string
	 */
	public function getDate(): string
	{
		return $this->date;
	}

	/**
	 * @return int
	 */
	public function getDuration(): int
	{
		return $this->duration;
	}

	/**
	 * @return string
	 */
	public function getPhoneNumber(): string
	{
		return $this->phone_number;
	}

	/**
	 * @return string
	 */
	public function getCustomerIp(): string
	{
		return $this->customer_ip;
	}

	/**
	 * Setters
	 * @param int $customer_id
	 */
	public function setCustomerId($customer_id)
	{
		$this->customer_id = $customer_id;
	}

	/**
	 * @param $date
	 */
	public function setDate($date)
	{
		$this->date = $date;
	}

	/**
	 * @param int $duration
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * @param string $phone_number
	 */
	public function setPhoneNumber($phone_number)
	{
		$this->phone_number = $phone_number;
	}

	/**
	 * @param string $customer_ip
	 */
	public function setCustomerIp($customer_ip)
	{
		$this->customer_ip = $customer_ip;
	}


	public function validate()
	{
		//some validation logic
		return true;
	}
}