<?php
require "common.php";
$title = 'Task list';

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

    <h1><?php echo $title . " (" . $taskCount . ")" ?></h1>
    <!-- If there's not yet data -->
    <?php if ($taskCount == 0) { ?>
    <div>
        <p>You have not yet added any tasks </p>
        <p><a href='../controllers/task.php' class="add_btn">Add task</a></p>
    </div>
    <?php } else { ?>



    <table>
        <thead>
            <tr>
                <th>Task Title</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($tasks as $task) : ?>
        <tr>
            <td><a  class="projects_title" href="../controllers/task.php?id=<?php echo $task['task_id']; ?>">
            Title: <?php echo escape($task["title"]) ?>
            (Date: <?php echo escape($task["date_task"]) ?>
            Project: <?php echo escape($task["project"]) ?>)
            </a></td>
            <td>
                <form method="post">
                    <input type="hidden" value="<?php echo $task['task_id']; ?>" name="delete">
                    <input type="submit" value="Delete">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <form action="task_csv.php" method="POST" name="get_to_excel">
            <input type="submit" action="task_csv.php" method="POST" name="Export" value="Export task list to CSV" />
        </form>
    <?php } ?>
</div>

<?php
$content = ob_get_clean();
include 'layout.php'

?>

