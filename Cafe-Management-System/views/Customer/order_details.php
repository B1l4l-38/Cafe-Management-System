<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order History - Cafe Management System</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
  }

  .header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
  }

  .container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 2rem;
    background-color: #fff;
    box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
  }

  .order {
    border-bottom: 1px solid #ccc;
    padding: 1rem 0;
  }

  .order:last-child {
    border-bottom: none;
  }

  .order-details {
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .order-id {
    font-weight: bold;
  }

  .order-date {
    color: #777;
  }
  .back-button {
    display: block;
    width: 100%;
    max-width: 200px;
    margin-top: 20px;
    padding: 10px 20px;
    text-align: center;
    background-color: #222;
    color: #fff;
    text-decoration: none;
    border: 1px solid #888;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s, box-shadow 0.3s;
  }
  .orderItems {
    margin-top: 10px;
    width: 60%;
  }

  .back-button:hover {
    background-color: #444;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
  }
  .totalprice{
    margin-top: 10px;
  }
</style>
</head>
<body>
  <div class="header">
    <h1>Order History</h1>
  </div>
  <div class="container">
  <?php
include "../../connection/connect.php";
$username = $_SESSION['username'];

$query = "SELECT o.order_id, b.total_price
          FROM customer AS c
          JOIN orders AS o ON c.id = o.customer_id
          JOIN bill AS b ON o.order_id = b.order_id
          WHERE c.username = '$username'";
$result = $conn->query($query);

if ($result === false) {
    echo "Error: " . $conn->error;
} else {
    // Fetch the results and store them in an array
    $orderIds = array();
    $totalPrices = array();
    while ($row = $result->fetch_assoc()) {
        $orderIds[] = $row['order_id'];
        $totalPrices[] = $row['total_price'];
    }

    $combinedArray = array_combine($orderIds, $totalPrices);

    foreach ($combinedArray as $orderId => $totalPrice) {
        // The SQL query
        $query = "SELECT fooditem.name, orders.ORDER_date, orders_contain_fooditems.quantity
        FROM orders 
        JOIN customer ON orders.customer_id = customer.id 
        JOIN orders_contain_fooditems ON orders_contain_fooditems.order_id = orders.ORDER_id 
        JOIN fooditem ON fooditem.fid = orders_contain_fooditems.fooditem_id 
        WHERE customer.username = '$username' AND orders.ORDER_id = $orderId";

        // Execute the query
        $result = $conn->query($query);

        // Check if the query was successful
        if ($result === false) {
            echo "Error: " . $conn->error;
        } else {
            // Fetch the food item names and order date
            $foodItems = array();
            $orderDate = "";
            while ($row = $result->fetch_assoc()) {
                if($row["quantity"] > 1){
                  $foodItems[] = $row['name'] . " (x" . $row['quantity'] . ")";
                }else{
                  $foodItems[] = $row['name'];
                }
                $orderDate = date("F j, Y", strtotime($row['ORDER_date']));
            }

            echo '<div class="order">
                    <div class="order-details">
                        <div class="order-id">Order ID: ' . $orderId . '</div>
                        <div class="order-date">Date: ' . $orderDate . '</div>
                    </div>
                    <div class="orderItems">Items: ' . implode(", ", $foodItems) . '</div>
                    <div class="totalprice">Total: <span style="font-weight: bold;">Rs ' . $totalPrice . '</span></div>
                </div>';
        }
    }

    // Close the connection
    $conn->close();

    echo '<a href="./customer_view.php?username=' . $username . '" class="back-button">
    Go back to shop
    </a>';
}
?>
    <!-- Add more orders here -->
  </div>
</body>
</html>
