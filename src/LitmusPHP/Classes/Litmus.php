<?php namespace LitmusPHP\Classes;

use GuzzleHttp\Client;
use LitmusPHP\Services\LitmusService;

class Litmus{

	public function __construct($username, $password)
	{
		$service = new LitmusService(new GuzzleHttp\Client);
		
		$service->setCredentials($username, $password);

		return $service;
	}

}