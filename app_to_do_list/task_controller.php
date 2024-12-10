<?php
    require "../../to_do_list/app_to_do_list/task.model.php";
    require "../../to_do_list/app_to_do_list/task.service.php";
    require "../../to_do_list/app_to_do_list/connection.php";

    echo '<pre>';
    print_r($_POST);
    echo '<pre>';

    $task = new Task();
    $task->__set('task', $_POST['task']);

    $connection = new Connection();
    $taskService = new TaskService($connection, $task);


?>