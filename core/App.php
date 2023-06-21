<?php

namespace app\core;


class App
{
	public static string $ROOT_DIR;
	public static string $MAIN_LAYOUT;
	public static App $app;
	public Router $router;
	public Request $req;
	public Response $res;

	public function __construct(string $rootPath, string $mainLayout = '') {
		$this->req = new Request();
		$this->res = new Response;
		$this->router = new Router($this->req, $this->res);
		self::$ROOT_DIR = $rootPath;
		self::$app = $this;
		self::$MAIN_LAYOUT = $mainLayout;
	}

	public function run() {
		$this->router->resolve();
	}
}
