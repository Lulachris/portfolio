<?php

    require_once('./Controllers/PageController.php');
    
    $ctrl = new PageController();
    $htmlSkeleton = $ctrl->Index();

    $page = isset($_GET['page']) ? $_GET['page'] : 'welcome';

    $route = explode('/', $page);
    $controller = ucfirst($route[0]);
    $action;
    $option;
    if (count($route) > 1) {
        $action = ucfirst($route[1]);
    }

    if (count($route) > 2) {
        $option = $route[2];
    }

    $ctrlToCall = $controller . 'Controller';
    require_once('./Controllers/'.$ctrlToCall.'.php');

    $ctrlContent = new $ctrlToCall();
    if (!isset($action)) {
        $htmlContent = $ctrlContent->Index();
        $jsContent = $ctrlContent->AddJavaScript();

        $htmlSkeleton->find('#content', 0)->innertext = $htmlContent;
        $htmlSkeleton->find('#additionalScript', 0)->innertext = $jsContent;

        echo $htmlSkeleton;
    } else {
        $ctrlContent->$action();
    }

?>