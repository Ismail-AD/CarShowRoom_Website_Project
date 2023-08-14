<?php
session_start();
if (isset($_GET['id'])) {
    include_once('Connect.php');
    $recordID = $_GET['id'];
    $query = "DELETE FROM cars WHERE CarID = $recordID";
    $result = $connect->query($query);
    if ($result) {
        header("Location:adminPanel.php");
        exit;
    } else {
        echo "Error: " . $connect->error;
    }
} elseif (isset($_GET['ItemID'])) {
    include_once('Connect.php');
    $recordID = $_GET['ItemID'];

    $query = "DELETE FROM cartitem WHERE ItemID = $recordID";
    //TOTAL PRICE
    $customerID = $_SESSION['customerid'];
    $querycart = "SELECT * FROM cart WHERE  CustomerID = $customerID";
    $tp = $connect->query($querycart);
    $pricetotal = $tp->fetch_assoc();

    $sqltotal = "SELECT SUM(Price * Quantity) AS Price FROM cartitem WHERE ItemID = $recordID";
    $resultci = $connect->query($sqltotal);
    $pricetodel = $resultci->fetch_assoc();

    $updatedPrice = $pricetotal['TotalPrice'] - $pricetodel['Price'];
    $queryupdate = "UPDATE cart SET TotalPrice = $updatedPrice WHERE CustomerID = $customerID";
    $connect->query($queryupdate);
    $result = $connect->query($query);

    if ($result) {
        header("Location:addtocart.php");
        exit;
    } else {
        echo "Error: " . $connect->error;
    }
}
