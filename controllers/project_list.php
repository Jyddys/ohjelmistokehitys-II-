<?php 
require_once("../model/model.php");


if (isset($_POST['delete'])) {
    if(delete_project($_POST['delete'])) {
        header('location: project_list.php?confirm_message=Project+deleted');
        exit;
    } else {
        header('location: project_list.php?error_message=Couldn\'t+delete+the+project');
        exit;
    }
}

if (isset($_GET['error_message'])) {
    $error_message = $_GET['error_message'];
} else if (isset($_GET['confirm_message'])) {
    $confirm_message = $_GET['confirm_message'];
}


$projects = get_all_projects();
$projectCount = get_all_projects_count();
$search = isset($_GET['search']) ? $_GET['search'] : '';
$searchResults = get_projects_by_search($search);

require("../views/project_list.php");

?>

<script>
  document.querySelector('#search').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#results tr');
    rows.forEach(function(row) {
      const title = row.querySelector('.projects_title').textContent.toLowerCase();
      if (title.indexOf(searchTerm) !== -1) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });
</script>