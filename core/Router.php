<?php

namespace app\core;


class Router {

	protected array $routes = [];
	public Request $req;
	public Response $res;

	public function __construct(Request $req,Response $res ) {
		$this->req = $req;
		$this->res = $res;
	}

	public function get(string $path, $callback) {
		$this->routes['get'][$path] = $callback;
	}

	public function post(string $route, $callback) {

		$this->routes['post'][$route] = $callback;
	}

	public function put(string $path, $callback) {
		$this->routes['put'][$path] = $callback;
	}

	public function delete(string $path, $callback) {
		$this->routes['delete'][$path] = $callback;
	}

	public function patch(string $path, $callback) {
		$this->routes['patch'][$path] = $callback;
	}

	public function resolve() {
		// Getting all the info needed from the req header
		$this->req->resolve();
		$method = $this->req->method;
		$path = $this->req->path;
		$callback = $this->routes[$method][$path] ?? false;

		// If the route isn't there render 404
		if ($callback === false) {
			$this->res->status(400);
			include_once App::$ROOT_DIR . '/views/NOT_FOUND.view.php';
			return;
		}

		// Calling the callback function given by the user.
		return call_user_func($callback, $this->req, $this->res);
	}
}
