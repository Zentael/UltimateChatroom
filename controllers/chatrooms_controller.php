<?php
require_once('../models/Chatroom.class.php');
//demarrage session
session_start();

try{
    $action = isset($_GET['action']) ? $_GET['action'] : '';
    $chatroom = new Chatroom();

    switch ($action) {
        case 'create':
            if ($chatroom->create($_POST)){
                $_SESSION['errors'] = [];
                header('Location: ../views/user_profile.php');
                die;
            }
            $_SESSION['errors'] = $chatroom->errors;
            header('Location: ../views/index.php');
            break;
        case 'update':

            break;
        case 'list':

            break;
        default:

            break;
    }

} catch (Exception $e) {
        echo('chatroom exception');
        print_r($e);
    }
?>