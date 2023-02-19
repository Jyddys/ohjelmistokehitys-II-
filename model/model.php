<?php 
// model/model.php
require "connection.php";

$connection = db_connect();

// --- PROJECTS ---

function get_all_projects()
{
    try {
        global $connection;

        $sql = 'SELECT * FROM projects ORDER BY title';
        $projects = $connection->query($sql);

        return $projects;
    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_all_projects_count()
{
    try {
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM projects';
        $statement = $connection->query($sql)->fetch();

        $projectCount = $statement['nb'];

        return $projectCount;
    } catch (PDOExpetion $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

// --- TASKS ---

function get_all_tasks()
{
    try {
        global $connection;

        $sql = 'SELECT ta.id AS task_id, ta.title AS title, DATE_FORMAT(ta.date_task, "%d.%m.%y") AS date_task, ta.time_task as time_task, ta.project_id AS project_id, ta.date_task AS ttime, pr.title AS project
                FROM tasks ta
                LEFT JOIN projects pr ON ta.project_id = pr.id';
        $tasks = $connection->query($sql);
        return $tasks;
    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_all_tasks_count()
{
    try {
        global $connection;

        $sql = 'SELECT COUNT(id) AS nb FROM tasks';
        $statement = $connection->query($sql)->fetch();

        $taskCount = $statement['nb'];

        return $taskCount;
    } catch (PDOExpetion $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

// --- ADD PROJECT ---

function add_project($title, $category, $id) 
{
    try {
        global $connection;

        if ($id) {
            $sql = 'UPDATE projects SET title = ?, category = ? WHERE id = ?';
        } else {
            $sql = 'INSERT INTO projects(title, category) VALUES(?,?)';
        }

        $statement = $connection->prepare($sql);
        $new_project = array($title, $category);

        if ($id) {
            $new_project = array($title, $category, $id);
        }

        $affectedLines = $statement->execute($new_project);

        return $affectedLines;
    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function add_task($project_id, $task_title, $date_task, $time_task, $id)
{
    try {
        global $connection;

        if($id) {
            $sql = 'UPDATE tasks SET project_id = ?, title = ?, date_task = ?, time_task = ? WHERE id = ?';
        } else {
            $sql = 'INSERT INTO tasks(project_id, title, date_task, time_task) VALUES (?,?,?,?)';
        }

        $statement = $connection->prepare($sql);
        $new_task = array($project_id, $task_title, $date_task, $time_task);

        if ($id) {
            $new_task = array($project_id, $task_title, $date_task, $time_task, $id);
        }

        $affectedLines = $statement->execute($new_task);

        return $affectedLines;
    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function titleExists($table, $title)
{
    try {
        global $connection;

        $sql = 'SELECT title FROM ' . $table . ' WHERE title = ?';
        $statement = $connection->prepare($sql);
        $statement->execute(array($title));

        if ($statement->rowCount() > 0) {
            return true;
        }
    } catch (PDOException $expection) {
        echo $sql . "<br>" . $expection->getMessage();
        exit;
    }
}

function get_project($id) 
{
    try {
        global $connection;

        $sql = 'SELECT * FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return $project->fetch();
    } catch (PDOExpection $expection) {
        echo $sql . "<br>" . $expection->getMessage();
        exit;
    }
}

function get_task($id)
{
    try {
        global $connection;

        $sql = 'SELECT * FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();
        
        return $task->fetch();
        
    } catch (PDOExpection $expection) {
        echo $sql . "<br>" . $expection->getMessage();
        exit;
    }
}

function delete_task($id)
{
    try {
        global $connection;
        $sql = 'DELETE FROM tasks WHERE id = ?';
        $task = $connection->prepare($sql);
        $task->bindValue(1, $id, PDO::PARAM_INT);
        $task->execute();

        return true;
    } catch (PDOExpection $expection) {
        echo $sql . "<br>" . $expection->getMessage();
        exit;
    }
}


function delete_project($id) 
{
    try {
        global $connection;
        $sql = 'DELETE FROM projects WHERE id = ?';
        $project = $connection->prepare($sql);
        $project->bindValue(1, $id, PDO::PARAM_INT);
        $project->execute();

        return true;
    } catch (PDOExpection $expection) {
        echo $sql . "<br>" . $expection->getMessage();
        exit;
    }
}

function get_projects_by_search($search)
 {
    try {
        global $connection;
        $query = "SELECT * FROM projects WHERE title LIKE :search";
        $statement = $connection->prepare($query);
        $statement->bindValue(':search', '%' . $search . '%');
        $statement->execute();
        
        return $statement->fetchAll();

    }  catch (PDOExpection $err) {
    echo $sql . "<br>" . $err->getMessage();
    exit;
}
}


function get_project_columns()
{
    try {
        global $connection;
        $sql = "SELECT `COLUMN_NAME` as Col FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='e2101548_proman' AND `TABLE_NAME`='projects';";
        $projects = $connection->query($sql);

        return $projects;

    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

function get_task_columns()
{
    try {
        global $connection;
        $sql = "SELECT `COLUMN_NAME` as Col FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='e2101548_proman' AND `TABLE_NAME`='export_task';";
        $projects = $connection->query($sql);

        return $projects;

    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

// --- LOGIN ---

function get_username()
{
    session_start();
  
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    header('Location: index.php');
    exit;
  }
  
  if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === 'testi1' && $password === '123') {
      $_SESSION['logged_in'] = true;
      header('Location: index.php');
      exit;
    } else {
      echo "<p class='message_error center'>Wrong username or password</p>"; }
  }
}





?>