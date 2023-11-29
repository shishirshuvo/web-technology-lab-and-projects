<?php

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

function add_education($full_name, $pnumber, $amount)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO education (full_name, pnumber, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $pnumber, $amount);

    $status = $stmt->execute();

    return $status;
}


function add_financial($full_name, $pnumber, $amount)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO financial (full_name, pnumber, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $pnumber, $amount);

    $status = $stmt->execute();

    return $status;
}


function add_health($full_name, $pnumber, $amount)
{
    $conn = getConnection();
    $stmt = $conn->prepare("INSERT INTO health (full_name, pnumber, amount) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $full_name, $pnumber, $amount);

    $status = $stmt->execute();

    return $status;
}



$donation_option_err = $donor_name_err = $phone_number_err = $amount_err = "";

$donation_option = $full_name = $pnumber = $amount = "";

$status = "";

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate donation option
    if (empty($_POST["donation_option"])) {
        $donation_option_err = "Donation option is required";
    } else {
        $donation_option = $_POST["donation_option"];
    }

 
    if (empty($_POST["full_name"])) {
        $donor_name_err = "Donor name is required";
    } else {
        $full_name = $_POST["full_name"];
    }


    if (empty($_POST["phone_number"])) {
        $phone_number_err = "Phone number is required";
    } else {
        $pnumber = $_POST["phone_number"];
    }


    if (empty($_POST["amount"])) {
        $amount_err = "Amount is required";
    } else {
        $amount = $_POST["amount"];
    }


    if (empty($donation_option_err) && empty($donor_name_err) && empty($phone_number_err) && empty($amount_err)) {
        $conn = getConnection();

        if ($donation_option == "financial") {
            $status = add_financial($full_name, $pnumber, $amount, $conn);
        } elseif ($donation_option == "educational") {
            $status = add_education($full_name, $pnumber, $amount, $conn);
        } elseif ($donation_option == "healthcare") {
            $status = add_health($full_name, $pnumber, $amount, $conn);
        }

    
        if ($status) {
            $status = "<div class='success'>Thank You For Your Donation!</div>";
        } else {
            $status = "<div class='error'>Error Occurred. Please try again later.</div>";
        }
    }
}
?>
<?php 
session_start();
if (isset($_SESSION["user"]))
{

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
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
<div class="container">
  
<body>
<center>
        <table>


    </form>
    
</body>
</html>

        <?php echo $status; ?>

        <h1>Welcome to Donation BOX</h1>
        <p>Please fill this form to make a donation.</p>

        <!-- Add the form opening tag -->
        <form action="" method="post">
            <!-- Donation Option -->
            <div class="form-group">
                <label class="label">Donation Option:</label>
                <select name="donation_option" id="donation_option" class="input">
                    <option value="financial">Financial Support</option>
                    <option value="educational">Educational Support</option>
                    <option value="healthcare">Healthcare</option>
                </select>
                
                <span class="error"><?php echo $donation_option_err; ?></span>
            </div>

            
            <div class="form-group">
                <label class="label">Donor Name:</label>
                <input type="text" name="full_name" id="full_name" class="input" value="<?php echo $full_name; ?>">
                <!-- Display error message for donor name -->
                <span class="error"><?php echo $donor_name_err; ?></span>
            </div>

    
            <div class="form-group">
                <label class="label">Phone Number:</label>
                <input type="text" name="phone_number" id="phone_number" class="input" value="<?php echo $pnumber; ?>">
                <span class="error"><?php echo $phone_number_err; ?></span>
            </div>

            <div class="form-group">
                <label class="label">Amount:</label>
                <input type="text" name="amount" id="amount" class="input" value="<?php echo $amount; ?>">
            
                <span class="error"><?php echo $amount_err; ?></span>
            </div>

        
            <div class="form-group">
                <input type="submit" value="Submit" name="Submit" class="submit"> 
                <a href="logout.php" class="btn btn warning">Logout</a>
            </div>
        </form> 
    </div>
    <footer>
    <p>© 2023 Orphanage Management System</p>
  </footer>

</body>
</html>
<?php
}
else
{
    echo"Please Login" ;
   echo'<a href="login.php">Click To Login</a>';

}

?>