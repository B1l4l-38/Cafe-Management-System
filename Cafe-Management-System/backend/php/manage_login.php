<?php
include "../connection/connect.php"; // Make sure you include the connection file
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $username = trim($_GET["username"]);
    $password = $_GET["password"];
    $role = $_GET["role"];
    $errors = [];

    if (empty($username)) {
        $errors[] = "Username is required.";
    }

    if (empty($password)) {
        $errors[] = "Password is required.";
    }

    if (empty($role)) {
        $errors[] = "Role is required.";
    }

    if (!empty($errors)) {
        echo '<div class="error-container">';
        foreach ($errors as $error) {
            echo "<p class='error-message'>$error</p>";
        }
        echo "<a href='../login.php'>Go back to login form</a>";
        echo '</div>';
    } else {
        switch ($role) {
            case "Manager":
                if ($username === "admin" && $password === "admin") {
                    header("Location: ../views/Manager/manager_view.html");
                } else {
                    echo '<div class="error-container"><button class="error-button">Incorrect username and password</button></div>';
                }
                break;
            case "Customer":
                $query = "SELECT passkey FROM customer WHERE username = '$username'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    $row = mysqli_fetch_assoc($result);

                    if ($row) {
                        $storedPassword = $row['passkey'];

                        // Compare the stored password with the entered password
                        if ($storedPassword === $password) {
                            $url = "../views/Customer/customer_view.php?username=" . urlencode($username);
                            header("Location: $url");
                        } else {
                            echo '<div class="error-container"><button class="error-button">Incorrect password</button></div>';
                        }
                    } else {
                        echo '<div class="error-container"><button class="error-button">User not found</button></div>';
                    }
                } else {
                    echo '<div class="error-container"><button class="error-button">Database query error: ' . mysqli_error($conn) . '</button></div>';
                }
                break;
        }
    }
}
?>
<style>
    .error-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .error-button {
        padding: 10px 20px;
        background-color: #f8d7da; 
        border: none;
        border-radius: 5px;
        color: red;
        font-weight: bold;
        cursor: pointer;
    }

    .error-button:hover {
        background-color: #dc3545; 
        color: white;
    }
</style>
