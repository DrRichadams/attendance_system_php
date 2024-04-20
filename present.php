<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "attendance_database";

    $connection = new mysqli($servername, $username, $password, $database);

    $status = "present";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if(!isset($_GET["id"])) {
            header("location: /attendance_system/mark_attendance.php");
            exit;
        }
        $id = $_GET["id"];

        if (!empty($id)) {
            $sql = "UPDATE students " . 
                    "SET status = '$status'" . 
                    "WHERE id = $id";
            $result = $connection->query($sql);

            if(!$result) {
                echo "Error updating";
            }

            header("location: /attendance_system/mark_attendance.php");
            exit;
        }
    }
    
?>