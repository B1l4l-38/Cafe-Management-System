<?php
session_start(); // Start the session

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get the integer value from the form
    $item_id = intval($_POST["itemid"]);

    // Check if the session variable exists
    if (!isset($_SESSION["cartItems"])) {
        $_SESSION["cartItems"] = array(); // Create an empty array to store values
    }

    // Store the new value in the session array
    $_SESSION["cartItems"][] = $item_id;

}
$username = $_SESSION['username'];
header("Location: customer_view.php?username=$username");
?>
