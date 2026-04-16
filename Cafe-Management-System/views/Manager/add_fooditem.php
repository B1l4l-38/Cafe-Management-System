<?php

include "../../connection/connect.php";

// Function to sanitize and validate input
function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fid = intval($_POST["id"]);
    
    // Validate and sanitize input
    $name = sanitize_input($_POST["fname"]);
    $price = floatval($_POST["price"]);
    $category = sanitize_input($_POST["category"]);
    $url = sanitize_input($_POST["image"]);

    // Validate name
    if (empty($name)) {
        $errors["name"] = "Name is required";
    }

    // Validate price
    if ($price <= 0) {
        $errors["price"] = "Price must be a positive number";
    }

    // Insert data into the specified table if no errors
    if (empty($errors)) {
        $sql = "INSERT INTO Fooditem (fid, name, price, category, url) VALUES ($fid, '$name', $price, '$category', '$url')";
        $sql2 = "INSERT INTO Fooditem_view (fid, name, price, category, url) VALUES ($fid, '$name', $price, '$category', '$url')";

        if ($conn->query($sql) === TRUE && $conn->query($sql2) === TRUE) {
            echo "New record added successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>
