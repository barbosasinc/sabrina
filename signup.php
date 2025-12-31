<?php
session_start();
/*if (isset($_SESSION["username"]) && $_SESSION["username"] !== "admin") {
    header("Location: index.php");
    exit();
}*/
if (isset($_POST["username"]) && isset($_POST["password"])) {
    require_once 'connect.php';

    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $role = trim($_POST["role"]);
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Hash the password before storing
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Use prepared statement to insert user
    $stmt = $conn->prepare("INSERT INTO tb_usuarios (usuario, email, role, senha) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $username, $email, $role, $hashed_password);
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: login.php");
        exit();
    } else {
        die("Error: " . $stmt->error);
    }
} else if (isset($_POST["username"]) && $_POST["password"]) {
    die("Please fill in all required fields.");
} else if (isset($_POST["email"]) && $_POST["email"]) {
    die("Please fill in all required fields.");
} else if (isset($_POST["role"]) && $_POST["role"]) {
    die("Please fill in all required fields.");
} 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Signup</title>
    </head>
    <body>
        <h1>Signup</h1>
        <form action="signup.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            <br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <br>
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="user">Usuario</option>
                <option value="manager">Gerente</option>
                <option value="admin">Administrador</option>
            </select>
            <br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>
            <button type="submit">Signup</button>
        </form>
    </body>
</html>