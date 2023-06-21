<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\core\App;
use app\core\Request;
use app\core\Response;



$App = new App(dirname(__DIR__), 'main');

$App->router->get('/home', function ($_, Response $res) {
	$res->status(200);
	$res->render('home');
});

$App->router->get('/contact', function ($_, Response $res) {
	$res->setCookies('name', 'value');
	$res->status(200);
	$res->render('contact');
});

$App->router->get('/show', function () {
	echo 'Show Me page';
});

$App->router->get('/params', function (Request $req) {
	echo '<pre>';
	var_dump($req->params);
	var_dump($req->body);
	var_dump($req->cookies);
	echo '</pre>';
});

$App->router->post('/post', function (Request $req) {
	echo '<pre>';
	var_dump($req->params);
	var_dump($req->body);
	var_dump($req->cookies);
	echo '</pre>';
});


$App->run();
// echo '<pre>';
// var_dump($_SERVER);
// echo '</pre>';
//
// echo '<pre>';
// var_dump($_GET);
// echo '</pre>';
//
// echo '<pre>';
// var_dump($_POST);
// echo '</pre>';
//
// echo '<pre>';
// var_dump($_COOKIE);
// echo '</pre>';
//
// echo '<pre>';
// var_dump($_REQUEST);
// echo '</pre>';
