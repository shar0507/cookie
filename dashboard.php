<?php
// Check if the user is logged in (based on the user_id cookie)
if (!isset($_COOKIE['user_id'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_COOKIE['user_id'];

// You can fetch additional user data from the database if needed
// For simplicity, let's just display the user ID here

echo "Welcome, User ID: $user_id!";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>

<a href="logout.php">Logout</a>

</body>
</html>
