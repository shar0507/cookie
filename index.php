<?php
$conn = new mysqli("localhost", "root", "", "user_auth", 4306);

if(!$conn){
    die(mysqli_error($conn));
}

// Registration logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // $stmt = $conn->prepare('INSERT INTO users (username, password) VALUES (?, ?)');
    // $stmt->bind_param('ss', $username, $password);
    
    // if ($stmt->execute()) {
    //     echo 'Registration successful! Please log in.';
    // } else {
    //     echo 'Registration failed.';
    // }

    // $stmt->close();
    $sql = "INSERT INTO users (`username`, `password`) VALUES ('$username', '$password')";
    $result = mysqli_query($con, $sql);

if ($result) {
    echo 'Registration successful! Please log in.';
} else {
    echo 'Registration failed.';
}

}

// Login logic
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare('SELECT id, password FROM users WHERE username = ?');
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);

    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        // Set a cookie to store the user's session
        setcookie('user_id', $user_id, time() + 3600, '/'); // Cookie expires in 1 hour
        header('Location: dashboard.php');
    } else {
        echo 'Login failed. Please check your username and password.';
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>
</head>
<body>

<h2>Registration</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit" name="register">Register</button>
</form>

<h2>Login</h2>
<form method="post" action="">
    <label for="username">Username:</label>
    <input type="text" name="username" required>

    <label for="password">Password:</label>
    <input type="password" name="password" required>

    <button type="submit" name="login">Login</button>
</form>

</body>
</html>
