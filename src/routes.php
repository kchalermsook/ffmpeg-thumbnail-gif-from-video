<?php

use Slim\Http\Request;
use Slim\Http\Response;

// Routes

$app->get('/convert/', function (Request $request, Response $response) {
	$currentAbs = $request->getUri()->getBaseUrl();
	$currentAbs = str_replace("index.php","gif/", $currentAbs );
	$fileName = microtime(true). ".gif";
	$currentPath = getcwd() ;
	$gifPath = $currentPath. "/gif/";
	$gifPath = $gifPath .$fileName  ;
	
	$allGetVars = $request->getQueryParams();
	$url =$allGetVars['url'];
    shell_exec('/usr/bin/ffmpeg -i ' . $url . ' -vf scale=320:-1 -t 3 ' . $gifPath); // Create GIF from Video
	die($currentAbs . $fileName);
});

$app->get('/test/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
