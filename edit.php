<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "attendance_database";

    $connection = new mysqli($servername, $username, $password, $database);

    $id = "";
    $name = "";
    $email = "";
    $phone = "";
    $address = "";

    $erroMessage = "";
    $successMessage = "";

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
            if(!isset($_GET["id"])) {
                header("location: /attendance_system/mark_attendance.php");
                exit;
            }
            $id = $_GET["id"];

            // Read data of selected id from database
            $sql = "SELECT * FROM students WHERE id=$id";
            $result = $connection->query($sql);
            $row = $result->fetch_assoc();

            if(!$row) {
                header("location: /attendance_system/mark_attendance.php");
                exit;
            }

            $name = $row["name"];
            $email = $row["email"];
            $phone = $row["phone"];
            $address = $row["address"];
    }
    else{
        // POST method: Update the data of the client
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        do {
            if(empty($id) || empty($name) || empty($email) || empty($phone) || empty($address)) {
                $erroMessage = "All the fields are required";
                break;
            }
            $sql = "UPDATE students " . 
                    "SET name = '$name', email = '$email', phone = '$phone', address = '$address'" . 
                    "WHERE id = $id";
            $result = $connection->query($sql);

            if(!$result) {
                $erroMessage = "Invalid query: " . $connection->error;
                break;
            }

            $successMessage = "Student info updated successfully.";

            header("location: /attendance_system/mark_attendance.php");
            exit;
        } while (true);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit student details</title>
    <link rel="stylesheet" href="create.css" />
</head>
<body>
    <div class="error_box">
        <p>
            <?php 
                if(!empty($erroMessage)){
                    echo "<p>$erroMessage</p>";
                };
            ?>
        </p>
    </div>
    <div class="create_titles">
        <h2>Edit student details</h2>
    </div>
    <form method="post" class="create_form">
        <input type="hidden" name="id" value="<?php echo $id ?>">
        <input type="text" name="name" value="<?php echo $name ?>">
        <input type="text" name="email" value="<?php echo $email ?>">
        <input type="text" name="phone" value="<?php echo $phone ?>">
        <input type="text" name="address" value="<?php echo $address ?>">
        <div class="success_box">
            <p>
                <?php 
                    if(!empty($successMessage)){
                        echo "<p>$successMessage</p>";
                    };
                ?>
            </p>
        </div>
        <div class="create_form_btn_box">
            <button type="submit">Submit</button>
            <a href="/attendance_system/mark_attendance.php" role="button">Cancel</a>
       </div>
    </form>
</body>
</html>