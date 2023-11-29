<?php
// Clear the user_id cookie to log out the user
setcookie('user_id', '', time() - 3600, '/');
header('Location: index.php');
?>
