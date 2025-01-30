<?php

    session_start();

    require_once '../vendor/autoload.php';

    require_once '../src/app/core/Core.php';
    require_once '../src/app/router/Router.php';
    require_once '../src/app/connection/connection.php';

    require_once '../src/app/controller/AdminController.php';
    require_once '../src/app/controller/HomeController.php';
    require_once '../src/app/controller/AuthController.php';
    require_once '../src/app/controller/EmployeeController.php';
    require_once '../src/app/controller/ErrorController.php';

    require_once '../src/app/model/User.php';
    require_once '../src/app/model/Admin.php';
    require_once '../src/app/model/Employee.php';

    $template = file_get_contents('../src/app/template/template.html');

    ob_start();

        $core = new Core;

        $core->start_app($_GET);

        $result = ob_get_contents();

    ob_end_clean();

    $page = str_replace('{{template}}', $result, $template);

    echo $page;


