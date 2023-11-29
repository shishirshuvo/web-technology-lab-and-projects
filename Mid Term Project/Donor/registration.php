<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <center>
        <table>
            <tr>
                <th>
                    <header><h1>Orphanage Management</h1></header>
                    <marquee>!!!Donate $1 to Stand Up for Kids!!!</marquee>
                </th>
            </tr>
            <tr>
                <td>
                    <nav> 
                        <h3><b>
                        <center>
                            <a href="homepage.php">Home</a> |
                            <a href="Login.php">Login</a> |
                            <a href="Registration.php">Registration</a> |
                            <a href="contact.php">Contact Us</a> |
                            <a href="about.php">About Us</a> 
                        </center>
                        </b></h3>
                    </nav>
                </td>
            </tr>
            <tr>
                <td>       
<div class="container">
<body>
<center>
        <table>
        <h2>Registration</h2>
   <?php

    if (isset($_POST["submit"])) {
        $error = "" ;
        $fullName = $_POST["fullname"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["repeat_password"];

        $passwordHash = $password;
        $errors = array();

        if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
            array_push($errors, "ALL fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }

        if (strlen($password) < 8) {
            array_push($errors, "Password must be at least 8 characters long");
        }
        if ($password !== $passwordRepeat) {
            array_push($errors, "Password does not match");
        }

        function getConnection() {
            $hostName = "localhost";
            $dbUser =  "root";
            $dbPassword = "";
            $dbname = "donor";
          
            
            $conn = new mysqli($hostName, $dbUser, $dbPassword, $dbname);
          
            
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            return $conn;
          }
        $sql = "SELECT * FROM users WHERE email = ?";
        $conn = getConnection();
        $stmt = mysqli_stmt_init($conn); // Initialize the statement

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $rowCount = mysqli_num_rows($result);
        } else {
            die("Error in prepared statement");
        }

        if ($rowCount > 0) {
            array_push($errors, "Email Already exists");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {
            $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn); // Initialize a new statement

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                header("Location: login.php");
                exit(); 
            } else {
                die("Error in prepared statement");
            }
        }
    }
    ?>
    <form action="registration.php" method="post">
        <div class="form-group">
            <input type="text" class="form-control" name="fullname" placeholder="Full Name">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password">
        </div>
        <div class="form-btn">
            <input type="submit" class="btn btn-primary" value="Register" name="submit">
        </div>
    </form>
    <div>
        <div><p>Already Registered <a href="login.php">Login Here</a></p></div>
    </div>
</div>
<footer>
    <p>© 2023 Orphanage Management System</p>
  </footer>

</body>
</html>
