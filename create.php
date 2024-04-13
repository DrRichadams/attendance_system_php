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

            header("location: /attendance_system/index.php");
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
    <form method="post">
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
        <button type="submit">Submit</button>
        <a href="/attendance_system/index.php" role="button">Cancel</a>
    </form>
</body>
</html>