<?php
session_start();

/* USER LOGIN */

if (isset($_POST["login"])) {

    $_SESSION["username"] = $_POST["username"];

    setcookie(
        "shop_user",
        $_POST["username"],
        time() + (86400 * 30)
    );
}


/* ADD PRODUCT TO CART */

if (isset($_POST["cart"])) {

    $product = $_POST["product"];

    if (!isset($_SESSION["cart"])) {
        $_SESSION["cart"] = [];
    }

    $_SESSION["cart"][] = $product;
}


/* BROWSING HISTORY */

if (isset($_POST["browse"])) {

    $product = $_POST["browse_product"];

    if (!isset($_SESSION["history"])) {
        $_SESSION["history"] = [];
    }

    $_SESSION["history"][] = $product;
}


/* LOGOUT */

if (isset($_POST["logout"])) {

    session_destroy();

    header("Location: shopping.php");
    exit();
}

?>

<!DOCTYPE html>
<html>

<head>

<title>ShopSphere</title>

<style>

body {
    margin: 0;
    font-family: Arial;
    background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
    color: #333;
}

.header {
    background: #111827;
    color: white;
    padding: 20px 8%;
    display: flex;
    justify-content: space-between;
}

.logo {
    font-size: 25px;
    font-weight: bold;
}

.container {
    width: 90%;
    max-width: 1100px;
    margin: 40px auto;
}

.card {
    background: white;
    padding: 30px;
    border-radius: 20px;
    margin-bottom: 25px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.12);
}

.login {
    text-align: center;
}

input, select {
    padding: 13px;
    width: 90%;
    margin: 8px;
    border: 1px solid #ddd;
    border-radius: 10px;
}

button {
    padding: 12px 20px;
    border: none;
    border-radius: 10px;
    background: #111827;
    color: white;
    cursor: pointer;
}

button:hover {
    background: #374151;
}

.columns {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.column {
    flex: 1;
    min-width: 280px;
    background: white;
    padding: 25px;
    border-radius: 18px;
}

.item {
    background: #f3f4f6;
    padding: 12px;
    margin: 8px 0;
    border-radius: 8px;
}

.badge {
    background: #dbeafe;
    color: #1d4ed8;
    padding: 8px 15px;
    border-radius: 20px;
}

</style>

</head>

<body>

<div class="header">

    <div class="logo"> ShopSphere</div>

    <?php if (isset($_SESSION["username"])) { ?>

        <div>
             <?php echo htmlspecialchars($_SESSION["username"]); ?>
        </div>

    <?php } ?>

</div>


<div class="container">


<?php if (!isset($_SESSION["username"])) { ?>

    <div class="card login">

        <h1>Welcome to ShopSphere</h1>

        <p>Login to start shopping</p>

        <form method="post">

            <input
                type="text"
                name="username"
                placeholder="Enter username"
                required
            >

            <br>

            <button name="login">
                 Login
            </button>

        </form>

    </div>

<?php } else { ?>


    <div class="card">

        <h2>
            Hello,
            <?php echo htmlspecialchars($_SESSION["username"]); ?>! 👋
        </h2>

        <p>
            <span class="badge">Online</span>
        </p>

        <form method="post">

            <button name="logout">
                Logout
            </button>

        </form>

    </div>


    <div class="columns">


        <!-- PRODUCTS -->

        <div class="column">

            <h2> Products</h2>

            <form method="post">

                <select name="product">

                    <option>Wireless Headphones</option>

                    <option>Smart Watch</option>

                    <option>Laptop Bag</option>

                    <option>Bluetooth Speaker</option>

                </select>

                <button name="cart">
                    Add to Cart
                </button>

            </form>

        </div>


        <!-- BROWSING -->

        <div class="column">

            <h2> Browse Product</h2>

            <form method="post">

                <select name="browse_product">

                    <option>Wireless Headphones</option>

                    <option>Smart Watch</option>

                    <option>Laptop Bag</option>

                    <option>Bluetooth Speaker</option>

                </select>

                <button name="browse">
                    View Product
                </button>

            </form>

        </div>

    </div>


    <div class="columns" style="margin-top:20px;">


        <!-- CART -->

        <div class="column">

            <h2> Shopping Cart</h2>

            <?php

            if (!empty($_SESSION["cart"])) {

                foreach ($_SESSION["cart"] as $item) {

                    echo "<div class='item'>🛒 "
                    . htmlspecialchars($item)
                    . "</div>";
                }

            } else {

                echo "<p>Your cart is empty.</p>";
            }

            ?>

        </div>


        <!-- HISTORY -->

        <div class="column">

            <h2> Browsing History</h2>

            <?php

            if (!empty($_SESSION["history"])) {

                foreach ($_SESSION["history"] as $item) {

                    echo "<div class='item'> "
                    . htmlspecialchars($item)
                    . "</div>";
                }

            } else {

                echo "<p>No browsing history.</p>";
            }

            ?>

        </div>

    </div>

<?php } ?>

</div>

</body>
</html>