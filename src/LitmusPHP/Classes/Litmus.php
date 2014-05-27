<?php namespace LitmusPHP\Classes;

use GuzzleHttp\Client as Http;
use LitmusPHP\Services\LitmusService;

class Litmus{

	public function __construct($username, $password)
	{
		$service = new LitmusService(new Http);
		
		$service->setCredentials($username, $password);

		return $service;
	}

}