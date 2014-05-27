<?php namespace LitmusPHP\Services;

use InvalidArgumentException;
use GuzzleHttp\Client as Http;

class LitmusService{

	protected $http;

	protected $username;
	protected $password;

	protected static $param_list = ['image', 'callback', 'bbox'];
	protected $params = [];
	protected $response;

	public function __construct(Http $http)
	{
		$this->http = $http;
	}

	public function create(array $params = [])
	{
		foreach($params as $key => $param)
		{
			if( !in_array($key, static::$param_list)){
				throw new InvalidArgumentException($param." is not a valid parameter");
			}
		}

		$this->params = array_merge($this->params, $params);

		return $this;
	}

	public function setCredentials($username, $password)
	{
		$this->username = $username;
		$this->password = $password;
		return $this;
	}

	public function setImagePath($image_path)
	{
		$this->params['image'] = $image_path;
		return $this;
	}

	public function setCallback($callback = NULL)
	{
		$this->params['callback'] = $callback;
		return $this;
	}

	public function setBoundingBox($x1, $y1, $x2, $y2)
	{
		$this->params['bbox'] = [$x1, $y1, $x2, $y2];
		return $this;
	}

	protected function login()
	{
		return $this->http->post('/users', [
				'email'		=> $this->username,
				'password'	=> $this->password
			]);
	}

	protected function sendHttp()
	{
		$image = $this->params['image'];
		
		unset($this->params['image']);

		return $this->http->post('/images')
			->setPostFields($image)
			->addPostFiles(array('image' => $this->params['image']))
			->send()->getBody();
	}

	protected function validateResponseCode($code)
	{
		
	}

	public function send()
	{
		// Get json object (is it still json?)
		$this->response = $this->sendHttp();

		// Check status for errors, and throw exceptions if errors exist
		$this->valdiateResponseCode( $this->response->status );

		// All is well, return response
		return $this->response;
	}
}