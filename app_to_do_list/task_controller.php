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

    } elseif ($action == 'update') {
        $task = new Task();
        $task->__set('id', $_POST['id']);
        $task->__set('task', $_POST['task']);
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        if ($taskService->update()) {
            if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
                header('Location: index.php');
            } else {
                header('Location: all_tasks.php');
            }
        }
    } elseif ($action == 'remove') {
        $task = new Task();
        $task->__set('id', $_GET['id']);
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $taskService->remove();
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        } else {
            header('Location: all_tasks.php');
        }
    } elseif ($action == 'markAsDone') {
        $task = new Task();
        $task->__set('id', $_GET['id']);
        $task->__set('id_status', 2);
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $taskService->markAsDone();
        if (isset($_GET['pag']) && $_GET['pag'] == 'index') {
            header('Location: index.php');
        } else {
            header('Location: all_tasks.php');
        }
    } elseif ($action == 'getPendingTasks') {
        $task = new Task();
        $task->__set('id_status', 1);
        $connection = new Connection();
        $taskService = new TaskService($connection, $task);
        $tasks = $taskService->getPendingTasks();
    }
?>