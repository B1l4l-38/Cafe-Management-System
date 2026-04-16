<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Cart</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <style>
      body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.container {
    max-width: 800px;
    margin: 6rem auto;
    padding: 4rem 3rem; 
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    text-align: center;
    margin-bottom: 3rem;
    font-size: 2rem;
    font-weight: bold;
}

.bucket {
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 10px;
    margin-bottom: 20px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    border-bottom: 1px solid #ccc;
    padding-bottom: 5px;
}

.item-name {
    font-weight: bold;
}

.total-bill {
    text-align: center;
    margin-bottom: 20px;
}

.total-price {
    font-size: 24px;
}

.checkout-button {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
    padding: 10px 20px;
    text-align: center;
    background-color: #222;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.checkout-button:hover {
    background-color: #222;
}

.back-button {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
    padding: 10px 20px;
    text-align: center;
    background-color: #222;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.back-button:hover {
    background-color: #222;
}


.bucket {
    animation: bounce 1s ease;
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.cart-item:last-child {
    border-bottom: none;
}

.checkout-button {
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.checkout-button:hover {
    background-color: #444;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.back-button {
    margin-top: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.back-button:hover {
    background-color: #444;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
}

.delete-button {
    background-color: #f00;
    color: #fff;
    font-size: 14px;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    cursor: pointer;
    margin-left: 10px;
    transition: background-color 0.3s;
}

.delete-button:hover {
    background-color: #d00;
}

.bucket {
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 10px;
    background-color: #f9f9f9;
    margin-bottom: 20px;
}

.cart-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

.item-name {
    font-weight: bold;
    flex-grow: 1;
}

.total-bill {
    text-align: center;
    margin-bottom: 20px;
}

.delete-button {
    background-color: red;
    color: #fff;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    padding: 8px 16px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
}

.checkout-button {
    display: block;
    width: 100%;
    max-width: 200px;
    margin: 0 auto;
    text-align: center;
}

.delete-button {
    margin-left: 10px;
    width: 30px;
    height: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.delete-button:hover {
    background-color: #ff0000b1;
    transform: scale(1.05);
}

@media (max-width: 600px) {
    .container {
        padding: 10px;
    }

    .bucket {
        border-radius: 0;
    }

    .checkout-button {
        max-width: 100%;
    }
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Food Cart</h1>
        <div class="bucket">
            <?php
                include "../../connection/connect.php";
                $fooditems = isset($_SESSION["cartItems"]) ? $_SESSION["cartItems"] : false;
                if(isset($_POST["fooditemid"])){
                    $valueToRemove = $_POST["fooditemid"];
                    $indexOfTheValue  = array_search($valueToRemove, $fooditems);
                    if ($indexOfTheValue !== false) {
                        // Remove the element at the found index
                        unset($fooditems[$indexOfTheValue]);
                    
                        // Re-index the array if necessary
                        $fooditems = array_values($fooditems);
                    
                        // Update the session with the modified array
                        $_SESSION['cartItems'] = $fooditems;
                    }
                }
                $totalprice = 0;
                if($fooditems){
                    foreach ($fooditems as $fooditemid) {
                        // Query to fetch food item information based on ID
                        $query = "SELECT * FROM fooditem WHERE fid = $fooditemid";
                        $result = $conn->query($query);
                    
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $totalprice = $totalprice + $row['price'];
                                echo '<form action="cart_items.php" method="post">
                                    <div class="cart-item">
                                    <input type="number" name="fooditemid" value=' . $row['fid'] . ' style="display:none;"></input>
                                    <div class="item-name">' . $row['name'] . '</div>
                                    <div class="item-price">Rs ' . $row['price'] . '</div>
                                    <input type="submit" class="delete-button" aria-label="Delete item" value="X"></input>
                                </div>
                                </form>
                                ';
                            }
                        }
                    }     
                }else{
                    echo "Your cart is empty.";
                }                     
                echo '</div>
                        <div class="total-bill">
                        <h2>Total Bill: <span class="total-price">Rs '. $totalprice .'</span></h2>
                    </div>';
        ?>
        <?php
            $username = $_SESSION['username'];
            if($fooditems){
                echo '<a href="customer-bill.php?username='. $username .'" class="checkout-button">Checkout</a>';
            }
            echo '<a href="./customer_view.php?username='. $username .'" class="back-button">
            Go back to shop
            </a>';
        ?>
    </div>
</body>
</html>
