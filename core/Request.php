<?php

namespace app\core;

class Request
{

	public string $path;
	public string $method;
	public array $params = [];
	public array $body = [];
	public array $cookies = [];


	private function getPath() {
		$route = $_SERVER['REQUEST_URI'] ?? '/';
		$position = strpos($route, '?');
		if ($position === false) {
			return $route;
		}
		$route = substr($route, 0, $position);
		return $route;
	}

	private function getMethod() {
		$method = $_SERVER['REQUEST_METHOD'];
		return strToLower($method);
	}


	private function getParams() {
		$params = [];
		if (empty($_GET)) return $params;

		foreach ($_GET as $key => $value) {
			$key = htmlspecialchars($key);
			$params[$key] = htmlspecialchars($value);
		}
		return $params;
	}

	private function getBody() {
		$body = [];
		if (empty($_POST)) return $body;

		foreach ($_POST as $key => $value) {
			$key = htmlspecialchars($key);
			$body[$key] = htmlspecialchars($value);
		}
		return $body;
	}

	private function getCookie() {
		$cookies = [];
		if (empty($_COOKIE)) return $cookies;

		foreach ($_COOKIE as $key => $value) {
			$key = htmlspecialchars($key);
			$cookies[$key] = htmlspecialchars($value);
		}
		return $cookies;
	}

	public function resolve() {
		$this->path = $this->getPath();
		$this->method = $this->getMethod();
		$this->params = $this->getParams();
		$this->cookies = $this->getCookie();
		if ($this->method === 'post') $this->body = $this->getBody();
	}
}
