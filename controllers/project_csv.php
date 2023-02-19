<?php
require_once("../model/model.php");
require("common.php");

// $filename = '../data/exports/projects.csv' . date('Ymd') . ".csv";
$data = "";
$filename = '../data/exports/projects/projects_'. date("Y-m-d h:i:s") . '.csv';
$projects = get_all_projects();
$columns = get_project_columns();

foreach($columns as $column) {
    $data .= $column['Col'] . ";";

}

$data .= "\r";

foreach($projects as $project) {
     $data .= $project['id'] . ";" . $project['title'] . ";" . $project['category'] . ";" . "\r";

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

