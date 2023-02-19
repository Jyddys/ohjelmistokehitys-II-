<?php

if (!empty($_GET['id'])) {
    $title = 'Update task';
} else {
    $title  = 'Add task';
}


ob_start();
require '../views/nav.php';
?>


<div class="container center">

    <h1><?php echo $title ?></h1>

    <?php
    if (isset($error_message)) {
        echo "<p class='message_error'>$error_message</p>";
    }

    if (isset($confirm_message)) {
        echo "<p class='message_ok'>$confirm_message</p>";
    }
    ?>

    <!-- Create new project -->
    <form method="post" enctype="multipart/form-data">
        <label for="project">
            <span>Project:</span>
        </label>
        <select name="project" id="project" required>
            <option value="">Select a project</option>
            <?php foreach ($projects as $project) { ?>
            <option value="<?php echo $project['id'];?>" <?php if(!empty($_GET['id']) && $project['id'] === $project_id) {echo ' selected';}?>>
            <?php echo $project ['title'] ?></option>
            <?php } ?>
            </select>

            <label for="title">
            <span>Title:</span>
            <strong><abbr title="required">*</abbr></strong>
            </label>
            <input type="text" id="title" name="title"
            value="<?php if(!empty($_GET['id'])) {
                echo $task_title; }?>" required>
            
        </label>
        <label for="date_task">
            <span>Date:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
            <input type="date" name="date_task" id="date_task"
            value="<?php if(!empty($_GET['id'])) {
                echo $date_task; }?>" required>
            
            <br>
        <label for="time_task">
            <span>Time:</span>
            <strong><abbr title="required">*</abbr></strong>
        </label>
            <input type="text" id="time_task" name="time_task"
            value="<?php if(!empty($_GET['id'])) {
                echo $time_task; }?>" required>
            <br>
        <label for="image"><span>Upload File:</span></label>
                <input type="file" name ="image" accept="image/*" id="image">
            <br>
            <?php if(!empty($task_id)) { ?>
            <input type="hidden" name="id" value="<?php $task_id ?>" />
            <?php } ?>
            <input type="submit" name="submit"
            value="<?php echo (isset($task_id) and (!empty($task_id))) ? "Update" : "Add"; ?>">
    </form>
</div>

<?php
$content = ob_get_clean();
include 'layout.php';
?>
           