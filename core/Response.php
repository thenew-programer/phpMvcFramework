<?php


namespace app\core;

class Response
{

	public function status(int $code)
	{
		http_response_code($code);
	}

	public function setCookies(
		string $name,
		string $value = '',
		int $expires = 0,
		string $path = '',
		string $domain = '',
		bool $secure = false,
		bool $httpOnly = false
	) {
		setcookie($name, $value, $expires, $path, $domain, $secure, $httpOnly);
	}

	public function render(string $view, string $layout = '') {
		if (empty($layout)) {
			$layout = App::$MAIN_LAYOUT;
		}

		$layoutContent = $this->renderLayout($layout);
		if (empty($layoutContent)) {
			include_once App::$ROOT_DIR . "/views/$view.view.php";
			return;
		}
		$viewContent = $this->renderView($view);
		echo str_replace("{{content}}", $viewContent, $layoutContent);
		exit;
	}

	protected function renderLayout(string $layout) {
		if (empty($layout)) {
			return '';
		}
		ob_start();
		include_once App::$ROOT_DIR . "/views/layouts/$layout.php";
		return ob_get_clean();
	}

	protected function renderView(string $view) {
		ob_start();
		include_once App::$ROOT_DIR . "/views/$view.view.php";
		return ob_get_clean();
	}
}
