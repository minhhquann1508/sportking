<?php
    $controller = isset($_GET['controller']) && $_GET['controller'] ? $_GET['controller'] : 'home';
    $action = isset($_GET['action']) && $_GET['action'] ? $_GET['action'] : 'index';

    $controllerName = ucwords($controller) . 'Controller';
    $controllerFile = '../app/controllers/' . $controllerName . '.php';
    // Kiểm tra xem có file controller hay không
    if (file_exists($controllerFile)) {
        include_once $controllerFile;
        $controllerObject = new $controllerName();
        // Sau đó kiểm tra xem có action đó trong controller hay không
        if(method_exists($controllerObject, $action)) {
            $controllerObject->$action();
        } else {
            echo "Không tìm thấy action: $action";
        }
    } else {
        echo "Không tìm thấy file: $controllerFile";
    }
?>