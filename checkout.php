<?php
session_start();
$err = "";
$cid = $_SESSION['customerid'];

ob_start(); //Store output in buffer
include_once('Connect.php');
include_once('navbar.php');
if ((isset($_SESSION['login']) || $_SESSION['login'] == true) && $_SERVER['REQUEST_METHOD'] != 'POST') {
    $query = "SELECT * FROM customers WHERE CustomerID= ?";
    $sql = $connect->prepare($query);
    $sql->bind_param('i', $cid);
    $sql->execute();
    $resultCustomer = $sql->get_result();
    $rowCust = $resultCustomer->fetch_assoc();
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && $_SESSION['login'] == true) {
    $address = $_POST['add'];  //ADDRESS
    $paymethod = $_POST['Pay']; //PAYMENTMETHOD
    $status = 'Pending';
    $sqlquery = "SELECT * FROM cart WHERE CustomerID= $cid";
    $sql = $connect->query($sqlquery);
    $resultCart = $sql->fetch_assoc();
    $tprice = $resultCart['TotalPrice'];  //PRICE
    $CARTID = $resultCart['CartID'];  //cartID

    //GET CART ITEMS 
    $sqlci = "SELECT * FROM cartitem WHERE CartID = $CARTID";
    $res = $connect->query($sqlci);
    if ($res->num_rows <= 0) {
        $err = "No Items Found In Cart";
    } else {
        $insertOrderQuery = "INSERT INTO orders (CustomerID, TotalPrice, Status, OrderDate, BillingAddress, PaymentMethod) 
            VALUES ($cid, $tprice, '$status', NOW(), '$address', '$paymethod')";
        $result = $connect->query($insertOrderQuery);
        $fetchOrderQuery = "SELECT * FROM orders WHERE CustomerID = $cid ORDER BY OrderDate DESC LIMIT 1";
        $FD = $connect->query($fetchOrderQuery);
        if ($FD->num_rows > 0) {
            $OData = $FD->fetch_assoc();
            $orderId = $OData['OrderID'];
        }

        //CART ITEMS INTO VARIABLES THEN INSERT IN ORDER ITEMS
        foreach ($res as $r) {
            $carid = $r['CarID'];
            $carprice = $r['Price'];
            $quantity = $r['Quantity'];
            $sqlcar = "SELECT stock FROM cars WHERE CarID = $carid";
            $call = $connect->query($sqlcar);
            $rowst = $call->fetch_row();
            $avaliablestock = $rowst[0];

            if ($avaliablestock >= $quantity) {
                $insertOrderItemQuery = "INSERT INTO orderitem (OrderID, CarID, Quantity, Price)
                    VALUES ($orderId, $carid, $quantity, $carprice)";
                $connect->query($insertOrderItemQuery);
                $newstock = $avaliablestock - $quantity;
                $sqls = "UPDATE cars SET stock=$newstock WHERE CarID=$carid";
                $success = $connect->query($sqls);
            } else {
                echo '<script>alert("Stock is not sufficient");</script>';
                header('Location:addtocart.php');
                exit;
            }
        }
        //DELETE ALL DATA OF CART ITEMS AGAINST LOGIN USER
        if ($success) {
            $deletcartitem = "DELETE FROM cartitem WHERE CartID=$CARTID";
            $deleteioncommand = $connect->query($deletcartitem);
            if ($deleteioncommand) {
                $status = 'Confirmed';
                $UpdateOrderstatus = "UPDATE orders SET Status='$status' WHERE CustomerID = $cid";
                $Movback = $connect->query($UpdateOrderstatus);
                if ($Movback) {
                    $sqlupdateCart = "UPDATE cart SET TotalPrice = 0.0 WHERE CustomerID = $cid";
                    $connect->query($sqlupdateCart);
                    header("Location:PW.php");
                    exit;
                }
            }
        }
    }
}
ob_end_flush(); //Now show output to the browser
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
            text-decoration: none;
            list-style-type: none;
        }

        body {
            background-color: #F1F2FF;
        }

        .ImageHeader {
            position: relative;
            height: 300px;
            /* Set the desired height */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(icon/backforsrch.jpg);
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

        .Main {
            display: flex;
            flex-direction: column;
            height: 200vh;
            gap: 50px;
        }

        .title {
            font-size: 30px;
            font-weight: 700;
            color: #34373B;
            opacity: 1;
            padding-right: 24px;
        }

        .ColHolder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 50px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>


<body>
    <div class="Main">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text">CheckOut</p>
            </div>
        </div>
        <style>
            .secLayer {
                display: flex;
                flex-direction: column;
                gap: 55px;
                width: 100%;
                justify-content: center;
                align-items: center;
            }

            .i1>input {
                border: 0;
                outline: none;
                background: transparent;
                border-bottom: 2px solid #babbba;
                width: 320px;
                font-size: 15px;
                font-family: 'Roboto', sans-serif;
                padding: 12px;
            }

            .i1>input::placeholder {
                color: #34373B;
                opacity: 0.4;
            }


            .Lploc {
                color: #34373B;
                opacity: 0.8;
                font-weight: 600;
                font-size: 16px;
            }

            .inputCol {
                display: flex;
                gap: 50px;
            }

            .Seclection {
                padding: 17px 20px;
                background-color: #eceff1;
                border-radius: 5px;
                border: 0;
                text-align: start;
                width: 320px;
                font-size: 15px;
                font-weight: 500;
            }

            .ATC {
                width: 47%;
                text-align: center;
                font-size: 15px;
                font-weight: 700;
                color: white;
                padding: 15px 20px;
                background-color: #5F8CFF;
                transition: all 0.5s ease;
                cursor: pointer;
            }

            .ATC:hover {
                background-color: #2D52A0;
            }
        </style>
        <div class="secLayer">
            <h2 class="title">Billing Details</h2>
            <form class="ColHolder" method="post" action="">

                <div class="inputCol">
                    <div class="i1">
                        <label for="text" class="Lploc">Name</label><br>
                        <input type="text" name="name" class="Name" id="name" value="<?php echo $rowCust['FirstName'] . " " . $rowCust['LastName'];  ?>" readonly>
                    </div>
                    <div class="i1">
                        <label for="number" class="Lploc">Contact</label><br>
                        <input type="number" name="model" class="Model" id="model" value="<?php echo $rowCust['Phone']; ?>" readonly>
                    </div>
                </div>
                <div class="inputCol">
                    <div class="i1">
                        <label for="text" class="Lploc">Address</label><br>
                        <input type="text" name="add" class="add" id="add" placeholder="House number and Street name" required>
                    </div>
                    <div class="i1">
                        <label for="text" class="Lploc">Email</label><br>
                        <input type="email" name="email" class="email" id="email" value="<?php echo $rowCust['Email'];  ?>" readonly>
                    </div>
                </div>
                <div class="i1">
                    <select name="Pay" id="pm" class="Seclection" required>
                        <option value="">Select Payment Method</option>
                        <option value="CashOnDelivery">Cash On Delivery</option>
                        <option value="DirectBankTransfer">Direct Bank Transfer</option>
                    </select>
                </div>
                <?php if (!empty($err)) { ?>
                    <h3 class="err" style="display: block;"><?php echo $err ?></h3>
                <?php } else {  ?>
                    <h3 class="err" style="display: none;"></h3>
                <?php } ?>

                <input type="submit" value="PLACE ORDER" class="ATC">
            </form>
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