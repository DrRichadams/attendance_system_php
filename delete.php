<?php
    if ( isset($_GET["id"]) ) {
        $id= $_GET["id"];

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "attendance_database";

        $connection = new mysqli($servername, $username, $password, $database);

        $sql = "DELETE FROM students WHERE id=$id";
        $connection->query($sql);
    }

    header("location: /attendance_system/index.php");
    exit;
?>