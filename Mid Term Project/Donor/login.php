<?php
      $error = "";
    if (isset($_POST["submit"])) {
        $email = $_POST["email"];
        $password = $_POST["password"];

        $errors = array();
    

        if (empty($email) || empty($password)) {
            array_push($errors, "ALL fields are required");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $conn = new mysqli("localhost", "root", "","donor");
        $result = mysqli_query($conn, $sql);

        
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            
        
            if ($password =  $user['password'])
             {
                session_start();
                $_SESSION["user"] = "yes";
                header("Location: index.php");
                exit(); 
            } else {
                array_push($errors, "Wrong password");
            }
        } else {
            array_push($errors, "No user found with this email");
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
            
                $error ;
            }
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
    <div class="container">
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

    <h2>Login</h2>
    <h4><?php echo $error ?></h4>
    <form action="login.php" method="post">
        <div>
            <input type="email" name="email" placeholder="Email">
        </div>
        <div>
            <input type="password" name="password" placeholder="Password">
        </div>
        <div>
            <input type="submit" value="Login" name="submit">
        </div>
    </form>
    <footer>
    <p>© 2023 Orphanage Management System</p>
  </footer>
</body>
</html>