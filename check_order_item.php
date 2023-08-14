<?php
include_once('Connect.php');
if (isset($_GET['id'])) {
    $recordID = $_GET['id'];
    $queryToCheckOrder = "SELECT * FROM orderitem WHERE CarID = $recordID";
    $resOforderItem = $connect->query($queryToCheckOrder);
    if ($resOforderItem->num_rows <= 0) {
        echo "ok";  // Record is not in orderitem table
    } else {
        echo "order_item";  // Record is in orderitem table
    }
}
?>