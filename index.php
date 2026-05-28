<?php
session_start(); 
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$error = "";

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // DB Connection
    $conn = new mysqli("localhost", "root", "", "");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Login Check
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $_SESSION['username'] = $username;
        header("Location: index1.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        form {
            max-width: 400px;
            padding: 20px;
            margin: auto;
            border: 1px solid #ccc;
            border-radius: 10px;
            background: #f2f2f2;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            margin: 12px 0;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Login</h2>

<form action="index.php" method="POST">
    <label>Username:</label>
    <input type="text" name="username" required>

    <label>Password:</label>
    <input type="password" name="password" required>

    <input type="submit" name="login" value="Login">
</form>

<?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

</body>
</html>
