<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance System</title>
    <link rel="stylesheet" href="styles.css" />
</head>
<body>
    <div class="title">
        <h1>Attendance System</h1>
        <div>
            <a href="/attendance_system/create.php" class="add_student_btn">ADD NEW STUDENT</a>
        </div>
    </div>
    <div class="title_offset"></div>
    <div class="students_container">
        <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "attendance_database";

            $connection = new mysqli($servername, $username, $password, $database);

            if($connection -> connect_error) {
                die("Connection failed: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM students";
            $result = $connection->query($sql);
            if(!$result) {
                die("Invalid query: " . $connection.error);
            };
            while($row = $result->fetch_assoc()) {
                echo "
                    <div class='student_box'>
                        <div class='student_details'>
                            <div>$row[name]</div>
                            <div>$row[email]</div>
                            <div>$row[phone]</div>
                            <div>$row[address]</div>
                            <div>$row[created_at]</div> 
                        </div>
                        <div class='btns_container'>
                            <a href='/attendance_system/edit.php?id=$row[id]'>Edit</a>
                            <a href='/attendance_system/present.php?id=$row[id]'>Present</a>
                            <a href='/attendance_system/absent.php?id=$row[id]'>Absent</a>
                        </div>
                        <a href='delete.php' class='close_icon'><img src='./icons/cross.png'/></a>
                    </div>
                ";
            }
        ?>
    </div>
</body>
</html>