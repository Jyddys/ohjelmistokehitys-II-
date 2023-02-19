<?php 
require_once("../model/model.php");

if (isset($_POST['delete'])) {
    if(delete_task($_POST['delete'])) {
        // header('location: task_list.php?confirm_message=Task+deleted');
        // exit;
    } else {
        header('location: task_list.php?error_message=Couldn\'t+delete+the+task');
        exit;
    }
}

if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
} else if (isset($_GET['confirm_message'])) {
    $confirm_message = $_GET['confirm_message'];
}

$tasks = get_all_tasks();
$taskCount = get_all_tasks_count();

require("../views/task_list.php");

?>