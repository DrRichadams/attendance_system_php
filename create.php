<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "attendance_database";

    $connection = new mysqli($servername, $username, $password, $database);

   $name = "";
   $email = "";
   $phone = "";
   $address = "";

   $erroMessage = "";
   $successMessage = "";

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST["name"] ;
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        do {
            if(empty($name) || empty($email) || empty($phone) || empty($address)) {
                $erroMessage = "All the fields are required";
                break;
            }

            //Add student to database
            $sql = "INSERT INTO students (name, email, phone, address)" . 
                    "VALUES ('$name', '$email', '$phone', '$address')";
            $result = $connection->query($sql);

            if (!$result) {
                $erroMessage = "Invalid query: " . $connection->error;
                break;
            }

            $name = "";
            $email = "";
            $phone = "";
            $address = "";
            // $erroMessage = "";

            $successMessage = "Student added successfully";

            header("location: /attendance_system/mark_attendance.php");
            exit;

        } while(false);
   };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="create.css" />
</head>
<body>
    <div class="error_box">
        <p>
            <?php 
                if(!empty($erroMessage)){
                    echo "<p style='color: red'>$erroMessage</p>";
                };
            ?>
        </p>
    </div>
    <div class="create_titles">
        <h2>Add new student</h2>
    </div>
    <form method="post" class="create_form">
        <input type="text" name="name" value="<?php echo $name ?>" placeholder="Fullname">
        <input type="text" name="email" value="<?php echo $email ?>" placeholder="Email">
        <input type="text" name="phone" value="<?php echo $phone ?>" placeholder="Phone">
        <input type="text" name="address" value="<?php echo $address ?>" placeholder="Address">
        <div class="success_box">
            <p>
                <?php 
                    if(!empty($successMessage)){
                        echo "<p style='color: green'>$successMessage</p>";
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