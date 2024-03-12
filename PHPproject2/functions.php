<?php

function Connection() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=test", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully to database! <br>";
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function insertIntoDatabase($connection, $name, $time, $deadline) {
    try {
        $sql = "INSERT INTO `task manager` (name_task, duration_task, deadline_task) VALUES (:name, :time, :deadline)";
        $stmt = $connection->prepare($sql);

        // Bind parameters to prepared statement
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':deadline', $deadline);
        $stmt->execute();

        echo "Data inserted<br>"; //success
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function retrieveTasksFromDatabase($connection) {
    try {
        $sql = "SELECT * FROM `task manager`";
        $stmt = $connection->prepare($sql);
        $stmt->execute();

        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "Data retrieved! <br>";

        return $tasks;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return [];
    }
}

function displayTasks($tasks) {
    if (empty($tasks)) {
        echo "No tasks to display.";
        return;
    }

    echo "<table border='1'>";
    echo "<tr><th>Task ID</th><th>Task Name</th><th>Description</th><th>Deadline task</th></tr>";

    foreach ($tasks as $task) {
        echo "<tr>";
        echo "<td>" . $task['id'] . "</td>"; 
        echo "<td>" . $task['name_task'] . "</td>";
        echo "<td>" . $task['duration_task'] . "</td>";
        echo "<td>" . $task['deadline_task'] . "</td>"; 
        echo "</tr>";
    }
    echo "</table>";
}