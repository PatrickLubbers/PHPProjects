<?php
include 'readme.html';
include 'functions.php';

$connection = Connection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskName = $_POST['task_name'];
    $taskTime = $_POST['minutes'];
    $taskDeadline = $_POST['deadline'];
}

if (isset($_POST['submit'])) {
    insertIntoDatabase($connection, $taskName, $taskTime, $taskDeadline);
}

echo "task name is: " . htmlspecialchars($taskName) . "<br>";
echo "duration of task is: " . htmlspecialchars($taskTime) . "<br>";
echo "deadline of task is: " . htmlspecialchars($taskDeadline) . "<br>";

$tasks = retrieveTasksFromDatabase($connection);
displayTasks($tasks);

?>