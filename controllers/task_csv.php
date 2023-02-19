<?php
require_once("../model/model.php");
require("common.php");

$data = "";
$filename = '../data/exports/tasks/tasks_'. date("Y-m-d h:i:s") . '.csv';
$tasks = get_all_tasks();
$columns = get_task_columns();

foreach($columns as $column) {
    $data .= $column['Col'] . ";";

}

$data .= "\r";

foreach($tasks as $task) {
     $data .= $task['task_id'] . ";" . $task['title'] . ";" . $task['project'] . ";". $task['date_task'] . ";" . "\r";

}

if (!$fp = fopen($filename, 'x')) {
     echo "Cannot open file ($filename)";
     exit;

}

// Write $data to our opened file.
if (fwrite($fp, $data) === FALSE) {
    echo "Cannot write to file ($filename)";
     exit;

}

header("Location:". $filename);
echo "Success, wrote ($data) to file ($filename)";

fclose($fp);

?>

