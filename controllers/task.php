<?php 

require_once "../model/model.php";
require "common.php";

$projects = get_all_projects();

//  $task_id;
//  $task_title;
//  $date_task;
//  $time_task;
//  $project_id;

if (isset($_GET['id'])) {
    list($task_id, $task_title, $date_task, $time_task, $project_id) = get_task($_GET['id']);
}

// echo $project_id;

if(isset($_POST['submit'])) {
    $task_id = null;

    if(isset($_POST['id'])) {
        $task_id = $_POST['id'];
    }

    $project_id = escape(trim($_POST['project']));
    $task_title = escape( $_POST['title']);
    $date_task = escape($_POST['date_task']);
    $time_task = escape($_POST['time_task']);

    if (empty($project_id) || empty($task_title) || empty($date_task) || empty($time_task)) {
        $error_message = "project or title empty";
    } else {

        if (titleExists("tasks", $task_title)) {
            $error_message = "I'm sorry, but looks like \"" . $task_title . "\" already exists";
         } else {
            if(add_task($project_id, $task_title, $date_task, $time_task, $task_id)) {
                header('Refresh:4; url=task_list.php');
                if(!empty($task_id)) {
                    $confirm_message = escape($task_title) . ' updated successfully';
                } else {
                    $confirm_message = escape($task_title) . ' added successfully';
                }
            } else {
                $error_message = "There's something wrong";
            }
        }  
    }
}

require "../views/task.php";
?>

