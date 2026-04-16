<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bill</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <style>
      body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #444;
    color: #fff;
}

.container {
    max-width: 800px;
    margin: 6rem auto;
    padding: 20px;
    background-color: #222;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.bill {
    padding: 20px;
}

.bill-info {
    margin-bottom: 20px;
}

.bill-info p {
    margin: 5px 0;
}

.bill-table {
    width: 100%;
    border-collapse: collapse;
}

.bill-table th, .bill-table td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #888;
}

.bill-table th {
    background-color: #222;
}

.bill-table td {
    background-color: #444;
}

.total-bill {
    text-align: right;
    margin-top: 20px;
}

.total-bill p {
    margin: 5px 0;
}

.total-price {
    font-size: 24px;
}

.total-price:before {
    content: '$';
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

.back-button:hover {
    background-color: #444;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

    </style>
</head>
<body>
    <?php

        include "../../connection/connect.php";

        // Fetch customer_id using the username stored in the session
        if (isset($_SESSION['username']) && isset($_SESSION['cartItems'])) {
            $username = $_SESSION['username'];

            // Retrieve customer_id from the customer table based on the username
            $query = "SELECT * FROM customer WHERE username = '$username'";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $customer_id = $row['id'];
                $customer_name = $row['name'];
                // Get the current date and time
                $order_date = date("Y-m-d");
                $order_time = date("H:i:s");

                // Insert the order into the orders table
                $insert_query = "INSERT INTO orders (order_date, order_time, customer_id, manager_id) VALUES ('$order_date', '$order_time', '$customer_id',1)";

                if ($conn->query($insert_query) === TRUE) {
                    $fooditems = isset($_SESSION["cartItems"]) ? $_SESSION["cartItems"] : false;
                    $order_id = $conn->insert_id; 
                    echo '<div class="container">
                        <h1>Order Bill</h1>
                        <div class="bill">
                            <div class="bill-info">
                                <p><strong>Order No:</strong>    '. $order_id .'</p>
                                <p><strong>Customer Name:</strong>    '. $customer_name .'</p>
                                <p><strong>Date:</strong>    '. $order_date .'</p>
                                <p><strong>Time Stamp:</strong>    '. $order_time .'</p>
                            </div>
                            <table class="bill-table">
                                <tr>
                                    <th>Food Item</th>
                                    <th>Price</th>
                                </tr>';
                    $totalprice = 0;
                    if($fooditems){
                        foreach ($fooditems as $fooditemid) {
                            // Query to fetch food item information based on ID
                            $query = "SELECT * FROM fooditem WHERE fid = $fooditemid";
                            $result = $conn->query($query);
                        
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $totalprice = $totalprice + $row['price'];
                                    echo'<tr>
                                    <td>' . $row['name'] . '</td>
                                    <td>Rs ' . $row['price'] . '</td>
                                    </tr>';
                                }
                            }
                        }
                        $insert_query2 = "INSERT INTO `bill`(`tax`, `bill_Date`, `bill_time`, `total_price`, `order_id`) VALUES (" . ($totalprice * 0.10) . ", '$order_date', '$order_time', " . ($totalprice + ($totalprice * 0.10)) . ", $order_id)";


                        $conn->query($insert_query2); 
                        $bill_id = $conn->insert_id; 
                        
                        foreach ($fooditems as $fooditemid) {
                            // Check if the fooditem_id already exists in the table
                            $check_sql = "SELECT * FROM orders_contain_fooditems WHERE order_id = $order_id AND fooditem_id = $fooditemid";
                            $check_result = $conn->query($check_sql);
                        
                            if ($check_result->num_rows > 0) {
                                // If the fooditem_id exists, increment the quantity
                                $update_sql = "UPDATE orders_contain_fooditems SET quantity = quantity + 1 WHERE order_id = $order_id AND fooditem_id = $fooditemid";
                        
                                if ($conn->query($update_sql) === FALSE) {
                                    echo "Error updating data: " . $conn->error;
                                }
                            } else {
                                // If the fooditem_id doesn't exist, insert a new record with quantity 1
                                $insert_sql = "INSERT INTO orders_contain_fooditems (order_id, fooditem_id, quantity) VALUES ($order_id, $fooditemid, 1)";
                                
                                if ($conn->query($insert_sql) === FALSE) {
                                    echo "Error inserting data: " . $conn->error;
                                }
                            }

                            $updatepay = "INSERT INTO pay (manager_id, order_id, bill_id) VALUES(1,$order_id,$bill_id)";
                            $conn->query($updatepay);  

                        }
                        

                    }else{
                        echo "Your cart is empty.";
                    }
                            echo'</table>
                            <div class="total-bill">
                                <p><strong>Order Amount:</strong> Rs ' . $totalprice . '</p>
                                <p><strong>Tax (10%):</strong> Rs ' . $totalprice*0.10 . '</p>
                                <h2>Total Bill Amount: Rs ' . floatval($totalprice*0.10+$totalprice) . '</h2>
                            </div>';
                                $username = $_SESSION["username"];
                                echo '<a href="./customer_view.php?username='. $username .'" class="back-button">
                                Go back to shop
                                </a>';
                            echo'</div>
                            </div>';

                } else {
                    echo "Error creating order: " . $conn->error;
                }
            } else {
                echo "Customer not found.";
            }
        } else {
            $username = $_SESSION["username"];
            header("Location: ./customer_view.php?username=$username");
        }

        unset($_SESSION['cartItems']); // Clear the cart
        $conn->close();
    ?>
    <script>
        // Prevent Ctrl+R or F5 from refreshing the page
        window.addEventListener('keydown', function(event) {
            if (event.ctrlKey && (event.key === 'r' || event.key === 'R' || event.keyCode === 116)) {
                event.preventDefault();
            }
        });
    </script>
</body>
</html>
