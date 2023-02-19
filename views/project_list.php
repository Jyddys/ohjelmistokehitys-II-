<?php

require "common.php";
$title = 'Projects list';

ob_start();
require '../views/nav.php';

if (isset($error_message)) {
    echo "<p class='message_error'>$error_message</p>";
}

if (isset($confirm_message)) {
    echo "<p class='message_ok'>$confirm_message</p>";
}

?>

<div class="container center">
  <h1><?php echo $title . " (" . $projectCount . ")" ?></h1>
  <input type="text" id="search" placeholder="Search for project" class="search_input_box">
  <?php if ($projectCount == 0) { ?>
    <div>
      <p>You have not yet added any project </p>
      <p><a  class="add_btn" href='../controllers/project.php'>Add project</a></p>
    </div>
  <?php } else { ?>
    <table class="project_table">
      <thead>
        <tr>
          <th>Project Title</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="results">
        <?php foreach ($searchResults as $project) : ?>
        <tr>
          <td>
            <a class="projects_title" href="../controllers/project.php?id=<?php echo $project['id']; ?>">
              <?php echo escape($project['title']) ?>
            </a>
          </td>
          <td>
            <form method="post">
              <input type="hidden" value="<?php echo $project['id']; ?>" name="delete">
              <input type="submit" value="Delete">
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
        <form action="project_csv.php" method="POST" name="get_to_excel">
            <input type="submit" action="project_csv.php" method="POST" name="Export" value="Export project list to CSV" />
        </form>
        <?php } ?>
</div>
<?php
$content = ob_get_clean();
include 'layout.php'
?>
