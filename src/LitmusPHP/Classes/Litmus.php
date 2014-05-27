<?php namespace LitmusPHP\Classes;

use GuzzleHttp\Client as Http;
use LitmusPHP\Services\LitmusService;

class LitmusFactory{

	protected static $base_url = 'http://api.litmusapi.com';

	public static function start($username, $password)
	{
		$service = new LitmusService(new Http(['base_url' => static::$base_url]));
		
		$service->setCredentials($username, $password);

		return $service;
	}

}