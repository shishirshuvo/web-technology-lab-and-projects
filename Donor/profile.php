
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header>
            <nav>
                <ul>
                    <li><a href="profile.php">Profile</a></li> |
                    <li><a href="homepage.php">Home</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>

        <h1>Profile Settings</h1>

        <form action="profile_settings.php" method="post">
            <div class="form-group">
                <label for="new_name">New Name:</label>
                <input type="text" name="new_name" id="new_name" value="<?php echo $user['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" id="new_password" required>
            </div>
            

            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Update Profile">
            </div>
        </form>
    </div>
</body>

</html>
