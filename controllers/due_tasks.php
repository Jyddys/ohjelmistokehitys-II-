<?php 

function db_connect()
{
    try {
        
        $host       = "mariadb.vamk.fi";
        $username   = "e2101548";
        $password   = "vWJjdheceS6";
        $dbname     = "e2101548_proman";
        $options    = array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    );        

        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, $options);
    } catch (PDOExpection $err) {
        echo "Database connection error. <br>" . $err->getMessage();
        exit;
    }
    return $connection;
}

function get_due_tasks()
{
    try {
        $connection = db_connect();
        $sql = 'SELECT * FROM tasks WHERE DATE_TASK < CURDATE() OR DATE_TASK BETWEEN CURDATE() AND DATE_ADD(CURDATE(), INTERVAL 2 DAY)';
        $tasks = $connection->query($sql);

        return $tasks;

    } catch (PDOExpection $err) {
        echo $sql . "<br>" . $err->getMessage();
        exit;
    }
}

$due_tasks =  get_due_tasks();

$table = "<div>
            <table cellspacing='0' cellpadding='0' border=''>
                <tr>
                    <th>Task id</th>
                    <th>Title</th>
                    <th>Due date</th>
                </tr>";
                foreach($due_tasks as $task) {
                  $table .= "<tr>";
                  $table .= "<td>" . $task['id'] . "</td>";
                  $table .= "<td>" . $task['title'] . "</td>";
                  $table .= "<td>" . $task['date_task'] . "</td>";
                } 
              $table .= "
              </tr>
              </table>
          </div>";

 // Sends email
function sendEmail($to, $subject, $content, $headers) {
    if(mail($to, $subject, $content, $headers)) {
        return true;
    } else {
        return false;
    }
}

// Email content
$to = "e2101548@edu.vamk.fi";
$subject = "Your tasks has due date";
$content = $table;
$headers = "From: no-reply@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";


if (sendEmail($to, $subject, $content, $headers)) {
    //echo "mail sent!";
} else {
    echo "Error: Mail was not sent!";
}


// 0 5 * * * php ~/public_html/php/proman/controllers/due_tasks.php

// SSH -l e2101548 shell.puv.fi
// CRONTAB -e
// SALASANA
// CONTROL X

?>
