<?php
    require "../../to_do_list/app_to_do_list/task.model.php";
    require "../../to_do_list/app_to_do_list/task.service.php";
    require "../../to_do_list/app_to_do_list/connection.php";

    $action = isset($_GET['action']) ? $_GET['action'] : $action;

    if($action == 'insert') {
        $task = new Task();
        $task->__set('task', $_POST['task']);

        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $taskService->insert();

        header('Location: new_task.php?included=1');
    } elseif ($action == 'get') {
        $task = new Task();
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $tasks = $taskService->get();

    }
?>