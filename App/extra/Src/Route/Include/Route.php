<?php

class Route
{
	static function start()
	{
		$controllerName = 'Main';
		$actionName = 'index';
		$params = null;
		
		$data = Route::urlToArray($_SERVER['REQUEST_URI']);
		$routes = explode('/', $data['url']);

		if ( !empty($routes[1]) ) $controllerName = ucfirst($routes[1]);
		if ( !empty($routes[2]) ) $actionName = ucfirst($routes[2]);
		if ( !empty($routes[3]) ) $params = ucfirst($routes[3]);
		$_GET = $data['get'];

		// Prefix
		$modelName = $controllerName . 'Model';
		$controllerName = $controllerName . 'Controller';
		
		// Imports
		importModel($modelName);
		importController($controllerName);
		
		// Imitation
		$controller = new $controllerName;
		if(class_exists($modelName)) $controller->setModel($modelName);
		if(method_exists($controller, $actionName)) {
			// вызываем действие контроллера
			$controller->$actionName($params);
		} else {
			// здесь также разумнее было бы кинуть исключение
			Route::ErrorPage404();
		}
	
	}

	static function urlToArray(string $url)
    {
        $code = explode('?', $url);
        $result = [];
		if (isset($code[1])) {
			foreach (explode('&', $code[1]) as $param) {
				if ($param) {
					$value = explode('=', $param);
					$result[$value[0]] = $value[1];
				}
			}
		}
        return array('url' => $code[0], 'get' => $result);
    }
	
	static function ErrorPage404()
	{
        header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		Hell::error('404');
	}
}

?>