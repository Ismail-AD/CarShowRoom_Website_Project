<?php
session_start();
include_once('Connect.php');

if (isset($_SESSION['login']) || $_SESSION['login'] == true) {
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
        include_once('navbar.php');
        $carid = $_GET['id']; // 1
        $sqlID = "SELECT Price FROM cars WHERE CarID=$carid";
        $result = $connect->query($sqlID);
        if ($result->num_rows > 0) {
            $rowcar = $result->fetch_assoc();
            $price = $rowcar['Price']; //2
        }

        $customerID =  $_SESSION['customerid']; 

        $sqlCartCheck = "SELECT * FROM cart WHERE CustomerID = $customerID";
        $resCartCheck = $connect->query($sqlCartCheck);

        if ($resCartCheck->num_rows > 0) {
            $cartdata = $resCartCheck->fetch_assoc();
            $cartID = $cartdata['CartID'];
        } else {
            $newCart = "INSERT INTO cart(CustomerID,TotalPrice) VALUES ($customerID,0)";
            $creatingCart = $connect->query($newCart);
            $Cart = "SELECT * FROM cart WHERE CustomerID = $customerID";
            $alreadyCart = $connect->query($Cart);
            if ($alreadyCart->num_rows > 0) {
                $DATA = $alreadyCart->fetch_assoc();
                $cartID = $DATA['CartID'];
            }
        }

        $sqlc = "SELECT * FROM cartitem WHERE CartID = $cartID";
        $cartitemfinal = $connect->query($sqlc);

        while ($row = $cartitemfinal->fetch_assoc()) {
            if ($row['CarID'] == $carid) {
                $existingCartItem = $row;
                break;
            }
        }

        if ($existingCartItem) {
            $existingQuantity = $existingCartItem['Quantity'];
            $newQuantity = $existingQuantity + 1;

            $sql = "UPDATE cartitem SET Quantity = ? WHERE ItemID = ?";
            $injsql = $connect->prepare($sql);
            if ($injsql) {
                $injsql->bind_param("ii", $newQuantity, $existingCartItem['ItemID']);
                $injsql->execute();
                $injsql->close();
            }
        } else {
            $sql = "INSERT INTO cartitem(CartID, CarID, Quantity, Price) VALUES ($cartID, $carid, 1, $price)";
            $connect->query($sql);
        }

        $sqltotal = "SELECT SUM(Price * Quantity) AS TotalPrice FROM cartitem WHERE CartID = $cartID";
        $resultci = $connect->query($sqltotal);

        if ($resultci->num_rows > 0) {
            $rowdata = $resultci->fetch_assoc();
            $totalPrice = $rowdata['TotalPrice'];

            // Update the total price in the Cart table
            $sql = "UPDATE cart SET TotalPrice = $totalPrice WHERE CartID = $cartID";
            $finalcart =  $connect->query($sql);
        }
    }
}
