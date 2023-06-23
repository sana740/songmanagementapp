<?php

session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    $action = 'login';
}

require_once 'app/controllers/UserController.php';
require_once 'app/controllers/SongController.php';


$userController = new UserController();
$songController = new SongController();

if ($action === 'login') {
    $userController->login();
} elseif ($action === 'register') {
    $userController->register();
} elseif ($action === 'logout') {
    $userController->logout();
} elseif($action == 'create') {
    $songController->create();
} elseif($action == 'addSong') {
    $songController->addSong();
} elseif($action == 'edit') {
    $songController->editSong();
} elseif($action == 'update') {
    $songController->updateSong();
} elseif($action == 'delete') {
    $songController->delete();
} else {
    echo $songController->index();
}



// require_once 'app/controllers/SongController.php';

// $controller = new SongController();
// $controller->index();

// // Routing
// if (isset($_GET['action'])) {
//     $action = $_GET['action'];
//     switch ($action) {
//         case 'create':
//             $controller->create();
//             break;
//         case 'edit':
//             $controller->editSong();
//             break;
//         case 'update':
//             $controller->updateSong();
//             break;
//         case 'delete':
//             $controller->delete();
//             break;
//         default:
//             $controller->index();
//             break;
//     }
// } else {
//     $action = 'addSong';
// }
// if ($action === 'addSong') {
//     $controller->addSong();
// } else {
//     echo "Invalid action!";
// }
?>
