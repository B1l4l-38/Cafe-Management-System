<?php
    session_start(); // Start the session

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $username = $_GET["username"];

        // Store the username in the session
        $_SESSION["username"] = $username;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer View</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <style>
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .header{
            background-color: #333;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 3rem 0 3rem;
        }
        .logo{
            cursor: pointer;
            width: 145px;
        }
        .header--logo{
            display: flex;
            justify-content: center;
            align-items: center;
            cursor: pointer;
            user-select: none;
        }
        .header--cta{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
        }
        .header--cta > li > a > img{
            margin-top: 0.5rem;
            filter: grayscale(100%) invert(100%);
            transition: all 0.3s ease-in-out;
        }
        input{
            background-color: white;
            border: none;
            outline: none;
            padding: 1rem 4rem 1rem 2rem;
            width: 100%;
            border-radius: 0.2rem;
            font-size: 1rem;
        }
        input::placeholder{
            font-size: 1rem;
        }
        .header--searchbar{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            width: 45%;
        }
        .search{
            color: white;
            border: 1px solid #ddd;
            padding: 1rem 3rem;
            border-radius: 0.2rem;
            font-weight: bold;
            transition: all 0.1s ease-in-out;
        }
        .search:hover{
            background-color: white;
            color: black;
            transition: all 0.1s ease-in-out;
        }
        .fooditems{
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            padding: 4rem;
        }
      .header--logout{
          color: white;
          border: 1px solid #ddd;
          padding: 1rem 3rem;
          border-radius: 0.2rem;
          font-weight: bold;
          transition: all 0.1s ease-in-out;
      }
      .header--logout:hover{
        background-color: white;
        color: black;
        transition: all 0.1s ease-in-out;
      }
      .card-1{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
            border: 1px solid #ddd;
            border-radius: 0.2rem;
            padding: 2rem;
            box-shadow: 10px 10px 20px -10px rgba(0,0,0,0.5);
            -webkit-box-shadow: 10px 10px 20px -10px rgba(0,0,0,0.5);
            -moz-box-shadow: 10px 10px 20px -10px rgba(0,0,0,0.5);
        }
        .item-image{
            height: 12rem;
            width: 12rem;
            object-fit: cover;
            margin-bottom: 1rem;
        }
        .item-description{
            font-size: 1.2rem;
            width: 150px;
            line-height: 1.5rem;
            min-height: 3.5rem;
            text-align: center;
        }
        .item-category{
            font-weight: bold;
            font-size: 1.3rem;
        }
        .add-to-cart{
            background-color: #333;
            color: white;
            font-weight: bold;
            padding: 1rem 3rem;
            font-size: 1.1rem;
            border-radius: 0.2rem;
            transition: all 0.1s ease-in-out;
            cursor: pointer;
        }
        .add-to-cart:hover{
            transform: scale(1.1);
            transition: all 0.1s ease-in-out;
        }
        select{
          outline: none;
          border: 1px solid #ccc;
          background-color: #333;
          color: white;
          font-weight: bold;
          border-right: 16px solid transparent;
          width: fit-content;
          border-radius: 0.1rem;
          font-size: 1rem;
          padding: 1rem 3rem 1rem 1rem;
          margin: 4rem 0 0 2rem;
        }
        .category_button{
            width: 12%;
            text-align: center;
            background-color: white;
            color: black;
            border: 1px solid #333;
            padding: 1rem 3rem;
            border-radius: 0.2rem;
            font-weight: bold;
            transition: all 0.1s ease-in-out;
        }
        .category_button:hover{
            background-color: #333;
            color: white;
            transition: all 0.1s ease-in-out;
            cursor: pointer;
        }
        .search_form{
            width: 100%;
            display: flex;
            gap: 1rem;
        }
        .cart-items{
            filter: grayscale(100%) invert(100%);
            position: relative;
        }
        .badge{
            height: 30px;
            font-weight: bold;
            width: 30px;
            background-color: red;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            cursor: pointer;
        }
    </style>
<body>

    <header class="header">
        <div class="header--logo">
            <?php
               $username = $_SESSION["username"];
               echo '<a href="customer_view.php?username='. $username .'"><img src="../../assets/imgs/logo.png" alt="Cafe" class="logo"></a>';
            ?>
        </div>
        <div class="header--searchbar">
            <?php
               $username = $_SESSION["username"];
               echo '<form action="customer_view.php?username='. $username .'" method="post" class="search_form" autocomplete="off">
               <input type="text" placeholder="Enter your food item name here..." name="search_box">
               <button type="submit" name="search_btn" class="search">Search</button>
           </form>';
            ?>
            
        </div>
        <ul class="header--cta">
        <?php
            if (isset($_SESSION["username"])) {
                $username = $_SESSION["username"];
                
                // Calculate the total cart items
                $totalCartItems = isset($_SESSION["cartItems"]) ? count($_SESSION["cartItems"]) : 0;
                
                echo '<li><a href="order_details.php?username=' . $username . '"><img src="../../assets/icons/time-removebg-preview.png" alt="" style="width: 40px; margin-bottom: 5px; color: #DFDFDF;"></a></li>';
                echo '<li>
                        <a href="./cart_items.php?username=' . $username . '">
                            <div class="badge">' . $totalCartItems . '</div>
                            <div class="cart-items">
                                <img src="../../assets/icons/shopping-cart-icon-shopping-basket-on-transparent-background-free-png.png" alt="" style="width: 45px; margin-bottom: 5px;">
                            </div>
                        </a>
                    </li>';
            } else {
                echo "Username not set.";
            }
        ?>

            
            
            <a href="../../logout.php" class="header--logout">Logout</a>
        </ul>
    </header>

    <?php
        $username = $_SESSION["username"];

        if(!isset($_POST["category"])){
            echo '<form action="customer_view.php?username='. $username .'" method="post" class="category_form">
            <select id="category" class="category" name="category">
            <option value="None" selected>Choose a category</option>
            <option value="Fast">Fast</option>
            <option value="Continental">Continental</option>
            <option value="Chinese">Chinese</option>
            </select>
            <input type="submit" value="Display" class="category_button">
            </form>';
        }
        
        if(isset($_POST["category"])){
            $category = $_POST["category"]; 
            if($category == "Continental"){
                echo '<form action="customer_view.php?username='. $username .'" method="post" class="category_form">
                <select id="category" class="category" name="category">
                <option value="None" selected>Choose a category</option>
                <option value="Fast">Fast</option>
                <option value="Continental" selected>Continental</option>
                <option value="Chinese">Chinese</option>
                </select>
                <input type="submit" value="Display" class="category_button">
                </form>';
            }else if($category == "Fast"){
                echo '<form action="customer_view.php?username='. $username .'" method="post" class="category_form">
            <select id="category" class="category" name="category">
            <option value="None">Choose a category</option>
            <option value="Fast" selected>Fast</option>
            <option value="Continental">Continental</option>
            <option value="Chinese">Chinese</option>
            </select>
            <input type="submit" value="Display" class="category_button">
            </form>';
            }else if($category == "Chinese"){
                echo '<form action="customer_view.php?username='. $username .'" method="post" class="category_form">
            <select id="category" class="category" name="category">
            <option value="None">Choose a category</option>
            <option value="Fast">Fast</option>
            <option value="Continental">Continental</option>
            <option value="Chinese" selected>Chinese</option>
            </select>
            <input type="submit" value="Display" class="category_button">
            </form>';
            }else{
                echo '<form action="customer_view.php?username='. $username .'" method="post" class="category_form">
            <select id="category" class="category" name="category">
            <option value="None" selected>Choose a category</option>
            <option value="Fast">Fast</option>
            <option value="Continental">Continental</option>
            <option value="Chinese">Chinese</option>
            </select>
            <input type="submit" value="Display" class="category_button">
            </form>';
            }
        }
    ?>

<section class="fooditems">
    <?php
        $username = $_SESSION["username"];
        if(isset($_POST["category"]) || isset($_POST["search_box"])){
            if(isset($_POST["category"])){
                include "../../connection/connect.php"; // Include your database connection
                $category = $_POST["category"];
                // Retrieve data from the Fooditem_view table
                if($category == "Fast"){
                    $select_query = "SELECT * FROM Fooditem_view WHERE category = 'Fast'";
                }else if($category == "Continental"){
                    $select_query = "SELECT * FROM Fooditem_view WHERE category = 'Continental'";
                }else if($category == "Chinese"){
                    $select_query = "SELECT * FROM Fooditem_view WHERE category = 'Chinese'";
                }else{
                    $select_query = "SELECT * FROM Fooditem_view";
                }
                $result = $conn->query($select_query);
            
                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="handleCart.php?username='. $username .'" method="post">';
                        echo "<div class='card-1'>";
                        echo "<img src='" . $row["url"] . "'  class='item-image'>";
                        echo "<input type='number' name='itemid' value='" . $row["fid"] . "' style='display: none;'></input>";
                        echo "<p class='item-description'>" . $row["name"] . "</p>";
                        echo "<h3 class='item-category'>" . $row["category"] . "</h3>";
                        echo "<p class='item-price'>₨ " . $row["price"] . "</p>";
                        echo "<input type='submit' value='Add to cart' class='add-to-cart'></input>";
                        echo "</div>";
                        echo "</form>";
                    }
                } else {
                    echo "No records found";
                }
            
                $conn->close(); // Close the database connection
            }
            if(isset($_POST["search_box"])){
                include "../../connection/connect.php"; // Include your database connection

                $search_value = $_POST["search_box"];

                // Retrieve data from the Fooditem table
                $select_query = "SELECT * FROM Fooditem_view WHERE Name LIKE('%$search_value%')";
                $result = $conn->query($select_query);
            
                // Check if there are rows in the result
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<form action="handleCart.php?username='. $username .'" method="post">';
                        echo "<div class='card-1'>";
                        echo "<img src='" . $row["url"] . "'  class='item-image'>";
                        echo "<input type='text' name='itemid' value='" . $row["fid"] . "' style='display: none;'></input>";
                        echo "<p class='item-description'>" . $row["name"] . "</p>";
                        echo "<h3 class='item-category'>" . $row["category"] . "</h3>";
                        echo "<p class='item-price'>₨ " . $row["price"] . "</p>";
                        echo "<input type='submit' value='Add to cart' class='add-to-cart'></input>";
                        echo "</div>";
                        echo "</form>";
                    }
                } else {
                    echo "No records found";
                }
            
                $conn->close(); // Close the database connection
                }                
        }else{
            include "../../connection/connect.php"; // Include your database connection
            
            // Retrieve data from the Fooditem table
            $select_query = "SELECT * FROM Fooditem_view";
            $result = $conn->query($select_query);
        
            // Check if there are rows in the result
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                        echo '<form action="handleCart.php?username='. $username .'" method="post">';
                        echo "<div class='card-1'>";
                        echo "<img src='" . $row["url"] . "'  class='item-image'>";
                        echo "<input type='number' name='itemid' value='" . $row["fid"] . "' style='display: none;'></input>";
                        echo "<p class='item-description'>" . $row["name"] . "</p>";
                        echo "<h3 class='item-category'>" . $row["category"] . "</h3>";
                        echo "<p class='item-price'>₨ " . $row["price"] . "</p>";
                        echo "<input type='submit' value='Add to cart' class='add-to-cart'></input>";
                        echo "</div>";
                        echo "</form>";
                }
            } else {
                echo "No records found";
            }
        
            $conn->close(); // Close the database connection
        }
       
    ?>
</section>

</body>
</html>