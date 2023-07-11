<?php
    
        if(isset($_GET['route']))
    {
        if($_GET['route'] === "users")
        {
            $controller->index();
        }
        else if($_GET['route'] === "user-create")
        {
            // $controller->render("create", []);
            $controller->create($_POST);
        }
        else if($_GET['route'] === "user-edit")
        {
            $controller->edit($_POST);
        }
        else
        {
            $controller->index();
        }
    }
    // $route = $_GET['route'] ?? 'users'; // Récupère la valeur de la variable $_GET['route'] ou utilise 'users' par défaut

    // switch ($route) {
    //     case 'users':
    //         UserController::index();
    //         break;
    
    //     case 'user-create':
    //         UserController::create();
    //         break;
    
    //     case 'user-edit':
    //         UserController::edit();
    //         break;
    
    //     default:
    //         UserController::index();
    //         break;
    // }
?>