<?php
session_start();
include_once('Connect.php');
$empty = "";

if (isset($_SESSION['login']) || $_SESSION['login'] == true) {
    include_once('navbar.php');
    $customerID =  $_SESSION['customerid']; //3

    $sqlCartCheck = "SELECT * FROM cart WHERE CustomerID = $customerID";
    $resCartCheck = $connect->query($sqlCartCheck);
    $totalRows = $resCartCheck->fetch_assoc();
    if($totalRows<=0){
        $TPRICE = 0;
    }
    else{
        $TPRICE = $totalRows['TotalPrice'];
    }

    if ($TPRICE > 0) {
        $cartID = $totalRows['CartID'];
        $price = $totalRows['TotalPrice'];
        $sqlciname = "SELECT ci.Price,ci.Quantity,ci.CartID,ci.CarID,ci.ItemID, c.BName,c.ModelName,c.Price
         FROM cartitem ci
         INNER JOIN cars c ON ci.CarID = c.CarID
         WHERE ci.CartID = $cartID";

        $itemcarname = $connect->query($sqlciname);
    } else {
        $price = 0.00;
        $empty = "No Items Added To Cart";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
            text-decoration: none;
            list-style-type: none;
        }

        .MainBody {
            display: flex;
            flex-direction: column;
            height: 110vh;
            gap: 50px;
        }

        .NavBar {
            padding: 20px 0px 0px 0px;
            background-color: #F1F2FF;
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        body {
            background-color: #F1F2FF;
        }

        .ImageHeader {
            position: relative;
            height: 300px;
            /* Set the desired height */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(icon/grpCars.jpg);
            background-size: cover;
            background-position: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-overlay {
            text-align: center;
        }

        .image-text {
            font-size: 65px;
            color: white;
            font-weight: 600;
        }

        .P2 {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 20%;
            height: 215px;
        }

        .total {
            font-weight: 600;
            color: #34373B;
            font-size: 20px;
        }

        .amount {
            font-size: 20px;
            color: #34373B;
            font-weight: 700;
        }

        .totalbtn {
            display: flex;
            flex-direction: column;
            background-color: #eceff1;
            height: 75%;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
        }

        .heading {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .PTC {
            width: 98%;
            text-align: center;
            font-size: 15px;
            font-weight: 700;
            color: white;
            padding: 15px 20px;
            background-color: #5F8CFF;
            transition: all 0.5s ease;
            cursor: pointer;
        }

        .PTC:hover {
            background-color: #2D52A0;
        }

        .title {
            font-size: 27px;
            font-weight: 600;
            color: #34373B;
            opacity: 0.9;
        }

        .secondLayr {
            display: flex;
            width: 100%;
            padding: 20px 30px 0px 30px;
            justify-content: center;
        }

        .P1 {
            display: flex;
            flex-direction: column;
            width: 60%;
        }

        .admincard {
            width: 70%;
            border-collapse: collapse;
            margin-top: 35px;
        }

        .admincard thead {
            background-color: #34373B;
        }

        .admincard tbody {
            background-color: #eceff1;
        }

        .admincard th,
        .admincard td {
            padding: 12px;
            color: white;
            font-weight: 600;
            text-align: center;
        }

        .admincard td {
            color: black;
            font-weight: 500;
        }

        .admincard .info {
            cursor: pointer;
        }

        .admincard .info:hover {
            color: #2294B0;
        }

        .admincard .act {
            display: flex;
            gap: 7px;
            justify-content: center;

        }

        .admincard .actbtn {
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .admincard .backbtn {
            background-color: #FEEBE7;
            padding: 7px;
            border-radius: 5px;
        }

        .admincard .backbtn1 {
            background-color: #a1e8ff;
            padding: 7px;
            border-radius: 5px;
        }

        .err {
            font-size: 18px;
            opacity: 0.8;
            font-weight: 600;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <script>
        function confirmDelete(ItemID) {
            window.location.href = "delete.php?ItemID=" + ItemID;
        }

        function MovetocheckOut() {
            <?php if ($TPRICE > 0) { ?>
                window.location.href = "checkout.php";
            <?php } else {  ?>
                alert("No Items Available In Cart !");
            <?php } ?>
        }
    </script>

</head>

<body>
    <div class="MainBody">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text" data-aos="fade-up" data-aos-duration="350">Cart</p>
            </div>
        </div>
        <div class="secondLayr">
            <div class="P1" data-aos="fade-right" data-aos-duration="550">
                <h3 class="title">Cart Items</h3>
                <table class="admincard">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($TPRICE > 0) { ?>
                            <?php while ($rowad =  $itemcarname->fetch_assoc()) : ?>
                                <tr class="sdata">
                                    <td class="Car"><?php echo $rowad['BName'] . " " . $rowad['ModelName']; ?></td>
                                    <td class="Price"><?php echo $rowad['Price'] . " " . "Million"; ?></td>
                                    <td class="Quantity"><?php echo $rowad['Quantity']; ?></td>
                                    <td class="act">
                                        <form class="backbtn1" method="post">
                                            <img src="icon/bin.png" alt="" class="actbtn" onclick="confirmDelete(<?php echo $rowad['ItemID']; ?>)">
                                        </form>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="P2" data-aos="fade-left" data-aos-duration="550">
                <h3 class="title">Cart Total</h3>
                <div class="totalbtn">
                    <div class="heading">
                        <h3 class="total">Total</h3>
                        <?php if ($price > 0) : ?>
                            <h3 class="amount"><?php echo "Rs " . $price . " Million"; ?></h3>
                        <?php else : ?>
                            <h3 class="amount"><?php echo "Rs " . $price . " Million"; ?></h3>
                        <?php endif; ?>
                    </div>
                    <button class="PTC" onclick="MovetocheckOut()">PROCEED TO CHECKOUT</button>
                </div>

            </div>
        </div>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            delay: 0
        });
    </script>
</body>

</html>