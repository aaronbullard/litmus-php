<?php namespace LitmusPHP\Classes;

use GuzzleHttp\Client as Http;
use LitmusPHP\Services\LitmusService;

class LitmusFactory{

	public static function start($username, $password)
	{
		$service = new LitmusService(new Http);
		
		$service->setCredentials($username, $password);

		return $service;
	}

}