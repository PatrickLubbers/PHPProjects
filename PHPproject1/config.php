<?php 
        session_start();

        // connect to database
        $conn = mysqli_connect("localhost", "root", "", "Blog");

        if(!$conn) {
            die("Error connecting to database!: " . mysqli_connect_error());
        }


        define('ROOT_PATH', realpath(dirname(__FILE__)));

        //is set to the physical address with respect to OS.

        define('BASE_URL', 'http://localhost/PHPProjects/');
?>