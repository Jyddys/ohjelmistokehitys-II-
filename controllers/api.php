<?php
require_once("../model/model.php");

$tasks =  get_all_tasks();
$projects = get_all_projects();

$tasksArray = array();
$projectsArray = array();


    foreach($tasks as $task) {
        array_push($tasksArray, "task id: " . $task['task_id'] . " task name: " .  $task['title'] . " project name: " . $task['project'] .  " date: " . $task['date_task']);
    }

    foreach($projects as $project) {
        array_push($projectsArray, $project['id'] . $project['title'] . $project['category'] );
    }

    if(empty($tasks)) {
        $response=['error' => true, 'message' => 'No tasks found'];
        echo json_encode($response);
        exit;
    }

    if(empty($projects)) {
        $response=['error' => true, 'message' => 'No projects found'];
        echo json_encode($response);
        exit;
    }

        if(isset($_GET['tasks'])) {
            echo json_encode($tasksArray, JSON_FORCE_OBJECT);
        } else if(isset($_GET['projects'])) {
            echo json_encode($projectsArray, JSON_FORCE_OBJECT);
        } else {
            $response=['error' => true, 'message' => 'No parameter found'];
            echo json_encode($response);
            exit;
        }


?>
