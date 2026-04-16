<?php
include "../../connection/connect.php"; // Include your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fid = intval($_POST["fid"]);

    // Perform the deletion operation
    $delete_query = "DELETE FROM Fooditem_view WHERE fid = $fid";

    if ($conn->query($delete_query) === TRUE) {
        // Deletion successful
        echo "Food item deleted successfully";
    } else {
        // Deletion failed
        echo "Error deleting food item: " . $conn->error;
    }
}

$conn->close(); // Close the database connection
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Items Table</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <style>
      /* General styles */
      body {
          font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
          margin: 0;
          padding: 0;
          background-color: #f7f7f7;
      }

      body{
        min-height: 100vh;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      input{
        outline: none;
      }
      .header{
        background-color: black;
        padding: 3rem 4rem 2rem 4rem;
        color: white;
        text-align: center;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .header--heading{
        font-size: 1.5rem;
        font-weight: bold;
        cursor: pointer;
      }
      .header--logout{
        background-color: white;
        color: black;
        padding: 1rem 3rem;
        font-weight: bold;
        border-radius: 0.5rem;
        border: 1px solid white;
        transition: all 0.3s ease-in-out;
      }
      .header--logout:hover{
        background-color: black;
        color: white;
        transition: all 0.3s ease-in-out;
      }
      .container {
          max-width: 800px;
          margin: 4rem auto;
          box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
          border-radius: 10px;
          overflow: hidden;
      }

      /* Table styles */
      .food-table {
          width: 100%;
          border-collapse: collapse;
      }

      .food-table th, .food-table td {
          border: 1px solid #ddd;
          padding: 12px;
          text-align: center;
      }

      .food-table th {
          background: linear-gradient(45deg, #e9e9e9, #ffffff);
          font-weight: bold;
          text-transform: uppercase;
          box-shadow: 0 2px 2px rgba(0, 0, 0, 0.1);
          color: #333;
      }

      /* Alternate row colors */
      .food-table tbody tr:nth-child(even) {
          background-color: #f9f9f9;
      }

      /* Styling the delete icon */
      .food-table .delete-icon {
          font-size: 20px;
          cursor: pointer;
          color: #ff6666;
          transition: color 0.2s ease-in-out;
      }

      /* Styling the delete icon on hover */
      .food-table .delete-icon:hover {
          color: #ff0000;
      }

      /* Center align delete icon */
      .food-table .delete-icon {
          display: flex;
          justify-content: center;
          align-items: center;
      }

      /* Add spacing between header cells */
      .food-table th:not(:last-child) {
          margin-right: 5px;
      }

      /* Highlight header on hover */
      .food-table th:hover {
          background: linear-gradient(45deg, #f2f2f2, #ffffff);
      }

    </style>
</head>
<body>
    <header class="header">
      <h2 class="header--heading"><a href="./manager_view.html">Manager</a></h2>
      <a href="../../logout.php" class="header--logout">Logout</a>
    </header>
    <div class="container">
    <?php

        include "../../connection/connect.php"; // Include your database connection

        // Retrieve data from the Fooditem table
        $select_query = "SELECT * FROM Fooditem_view";
        $result = $conn->query($select_query);

        // Check if there are rows in the result
        if ($result->num_rows > 0) {
            echo "<table class='food-table'>";
            echo "<tr><th>ID</th><th>Name</th><th>Price</th><th>Category</th></tr>";

            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["fid"] . "</td>";
                echo "<td>" . $row["name"] . "</td>";
                echo "<td>" . $row["price"] . "</td>";
                echo "<td>" . $row["category"] . "</td>";
                echo "<td>
                        <form action='delete_fooditem.php' method='post'>
                            <input type='hidden' name='fid' value='" . $row['fid'] . "'>
                            <button type='submit' class='delete-icon'>&#10006;</button>
                        </form>
                      </td>";
                echo "</tr>";
            }
            
            
            echo "</table>";
        } else {
            echo "No records found";
        }

        $conn->close(); // Close the database connection
    ?>
    </div>
</body>
</html>
