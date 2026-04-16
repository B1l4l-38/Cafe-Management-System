<?php

include "../../connection/connect.php"; // Include your database connection

// Function to sanitize and validate input
function sanitize_input($input) {
    return htmlspecialchars(stripslashes(trim($input)));
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fid = intval($_POST["fid"]);

    // Validate and sanitize input
    $name = sanitize_input($_POST["name"]);
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

    // Construct the update query
    $update_fields = [];
    if (!empty($name)) {
        $update_fields[] = "name = '$name'";
    }
    if ($price > 0) {
        $update_fields[] = "price = $price";
    }
    if (!empty($category)) {
        $update_fields[] = "category = '$category'";
    }
    if (!empty($url)) {
        $update_fields[] = "url = '$url'";
    }

    if (!empty($update_fields)) {
        $update_query = "UPDATE Fooditem SET " . implode(', ', $update_fields) . " WHERE fid = $fid";
        $update_query2 = "UPDATE Fooditem_view SET " . implode(', ', $update_fields) . " WHERE fid = $fid";

        if ($conn->query($update_query) === TRUE && $conn->query($update_query2) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        echo "No valid fields provided for update";
    }
}

$conn->close(); // Close the database connection
?>

<!-- HTML form -->
<!-- Your HTML form remains unchanged -->
