<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "../connection/connect.php";

    $username = trim($_POST["username"]);
    $name = trim($_POST["name"]);
    $password = $_POST["password"];
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($name)) {
        $errors[] = "Name is required.";
    }

    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "<a href='../signup.html'>Go back to signup form</a>";
    }

    if (empty($errors)) {
        $sql = "INSERT INTO Customer (name, passkey, username) VALUES ('$name', '$password', '$username')";

        if ($conn->query($sql) === TRUE) {
            header("Location: ../login.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}


?>