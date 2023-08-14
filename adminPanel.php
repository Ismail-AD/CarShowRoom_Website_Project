<?php
session_start();
if (!isset($_SESSION['loginad']) || $_SESSION['loginad'] != true) {
    header('Location:SignIn.php');
    exit;
}
include_once('Connect.php');
$Sqladmin = "SELECT * FROM admin";
$Sql = "SELECT * FROM cars";
$Sqlcustomer = "SELECT * FROM customers";
$result = $connect->query($Sql);
$resultcustomer = $connect->query($Sqlcustomer);
$resultad = $connect->query($Sqladmin);

$sqlname = "SELECT * FROM types";
$restype = $connect->query($sqlname);



if ($result->num_rows > 0 && $resultcustomer->num_rows > 0) {
    $totalcars = $result->num_rows;
    $totalcustomer = $resultcustomer->num_rows;
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
        body {
            background-color: #F7F8F8;
        }

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
            height: 100vh;
        }

        .own {
            color: black;
        }

        .NavBar {
            padding: 13px 40px;
            background-color: #FFFFFF;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .MyLogo {
            font-family: 'League Gothic', sans-serif;
            font-size: 38px;
            color: black;
        }

        .seLayer {
            display: flex;
            height: 100%;
        }

        .sidenav {
            width: 15%;
            display: flex;
            justify-content: center;
            background-color: #FFFFFF;
            padding: 30px;
        }

        .sidenav nav {
            width: 100%;
        }

        .sidenav nav ul {
            gap: 20px;
            display: flex;
            flex-direction: column;
        }

        .pro {
            width: 40px;
        }

        .profileadmin {
            display: flex;
            gap: 15px;
        }

        h3 {
            font-weight: 600;
        }

        .name p {
            opacity: 0.5;
        }


        .title {
            font-size: 27px;
            font-weight: 600;
            color: black;
            opacity: 0.9;
        }

        .titlead {
            font-size: 27px;
            font-weight: 600;
            color: black;
            opacity: 0.9;
            margin-top: 35px;
        }

        .Card {
            display: flex;
            flex-direction: column;
            width: 300px;
            height: 95%;
            border-radius: 15px;
            padding: 20px;
            gap: 15px;
        }

        .Card p {
            font-size: 16px;
            font-weight: 600;
        }

        .Card h2,
        p {
            color: white;
            opacity: 0.9;
        }

        #cars {
            background-image: linear-gradient(to right, #d64c7f, #ee4758);
        }

        #users {
            background-image: linear-gradient(to right, #2294B0, #64CDE5);
        }

        #orders {
            background-image: linear-gradient(to right, #EE7469, #F1957B);
        }

        .allCards {
            display: flex;
            gap: 25px;
            align-items: center;
            width: 100%;
            height: 25%;
            margin-top: 35px;
            justify-content: flex-start;
        }

        .CARS {
            display: flex;
            flex-direction: column;
            background-color: #F7F8F8;
            width: 85%;
            position: relative;
        }

        .opts {
            display: flex;
            gap: 10px;
        }

        .b3 {
            padding: 14px 18px;
            text-align: center;
            background-color: #5F8CFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5s ease;
        }

        .b4 {
            padding: 14px 18px;
            text-align: center;
            font-size: 17px;
            background-color: #5F8CFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: all .5s ease;
            color: white;
            font-weight: 500;
        }

        .b4:hover {
            background-color: #2E5EAD;
        }

        .b3:hover {
            background-color: #2E5EAD;
        }

        .location {
            display: flex;
            border-radius: 20px;
            align-items: center;
            padding: 30px 20px;
            position: relative;
            justify-content: flex-end;
        }

        .cars {
            display: flex;
            padding: 12px;
            width: 100%;
            background-color: #E3E9F0;
            justify-content: space-around;
            align-items: center;
        }


        .cartitle {
            font-size: 27px;
            font-weight: 600;
            color: black;
            opacity: 0.9;
            padding: 20px 0px 0px 20px;
        }

        .home {
            display: flex;
            flex-direction: column;
            background-color: #F7F8F8;
            padding: 20px;
            width: 85%;
        }


        .active {
            background-color: #FEEBE7;
            border-radius: 5px;
            color: #F98D73;
            opacity: 1.0;
        }

        .sidenav nav ul li a {
            width: 100%;
            display: flex;
            color: black;
            opacity: 0.5;
            font-weight: 400;
            padding: 10px;
            transition: all .5s ease;
        }

        .sidenav nav ul li a:hover {
            background-color: #FEEBE7;
            border-radius: 5px;
            color: #F98D73;
            opacity: 1.0;
        }

        .backbtn2 {
            background-color: #EAEBF8;
            /* padding: 0px; */
            border-radius: 5px;
            width: 0;
            transition: all 0.3s;
            overflow: hidden;

        }

        .backbtn2.show {
            width: 38px;
            padding: 7px;
        }

        .carsd {
            width: 100%;
            border-collapse: collapse;
        }

        .carsd thead {
            background-color: #E3E9F0;
        }

        .carsd th,
        .carsd td {
            padding: 12px;
            color: #80868D;
            font-weight: 600;
            text-align: center;
        }

        .carsd td {
            color: black;
            font-weight: 500;
        }

        .carsd .info {
            cursor: pointer;
        }

        .carsd .info:hover {
            color: #2294B0;
        }

        .carsd .act {
            display: flex;
            gap: 7px;
            justify-content: center;

        }

        .carsd .actbtn {
            width: 25px;
            height: 25px;
            cursor: pointer;
        }

        .carsd .backbtn {
            background-color: #FEEBE7;
            padding: 7px;
            border-radius: 5px;
        }

        .carsd .backbtn1 {
            background-color: #EAEBF8;
            padding: 7px;
            border-radius: 5px;
        }

        .admincard {
            width: 70%;
            border-collapse: collapse;
            margin-top: 35px;
        }

        .admincard thead {
            background-color: #E3E9F0;
        }

        .admincard th,
        .admincard td {
            padding: 12px;
            color: #80868D;
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
            background-color: #EAEBF8;
            padding: 7px;
            border-radius: 5px;
        }
    </style>
    <script>
        function filterToNextScreen() {
            window.location.href = "AddData.php";
        }


        function gotodes(id) {
            window.location.href = "CarDesc.php?id=" + id;
        }

        function gotoEdit(Id) {
            window.location.href = "Update.php?id=" + Id;
        }

        function confirmDelete(ID) {
            // Send an AJAX request to the server
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "check_order_item.php?id=" + ID, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = xhr.responseText;
                        if (response === "ok") {
                            if (confirm("Are you sure you want to delete this record?")) {
                                window.location.href = "delete.php?id=" + ID;
                            }
                        } else {
                            alert("This record is in an order item and cannot be deleted.");
                        }
                    }
                }
            };

            xhr.send();
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

</head>

<body>


    <div class="MainBody">
        <div class="NavBar">
            <a class="MyLogo" href="#">WheelsOnDemand</a>
            <div class="profileadmin">
                <img src="icon/profile.png" alt="" class="pro">
                <div class="name">
                    <h3><?php echo $_SESSION['adminname']; ?></h3>
                    <p class="own">Owner</p>
                </div>

            </div>
        </div>
        <div class="seLayer">
            <div class="sidenav">
                <nav>
                    <ul>
                        <li><a href="#" class="homebtn">DashBoard</a></li>
                        <li><a href="#" class="carsbtn">Vehicles</a></li>
                        <li><a href="logout.php" class="Sign Up Page">Login</a></li>
                    </ul>
                </nav>
            </div>

            <div class="home" id="Home">
                <h3 class="title">DashBoard</h3>
                <div class="allCards">
                    <div class="Card" id="cars">
                        <p class="tctitle">Total Vehicles </p>
                        <h2 class="tc"><?php echo $totalcars ?></h2>
                    </div>
                    <div class="Card" id="users">
                        <p class="tctitle">Total Customers</p>
                        <h2 class="tc"><?php echo $totalcustomer ?></h2>

                    </div>
                    <div class="Card" id="orders">
                        <p class="tctitle">Orders Placed</p>
                        <h2 class="tc">5</h2>
                    </div>
                </div>
                <h4 class="titlead">Admins</h4>
                <table class="admincard">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rowad = $resultad->fetch_assoc()) : ?>
                            <tr class="sdata">
                                <td class="Name"><?php echo $rowad['Name']; ?></td>
                                <td class="Email"><?php echo $rowad['Email']; ?></td>
                                <td class="Contact"><?php echo $rowad['Phone']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>


            </div>

            <div class="CARS" id="Carz">
                <span class="overlay"></span>

                <h3 class="cartitle">Vehicles</h3>
                <div class="location">
                    <button class="b4" onclick="filterToNextScreen()">ADD CAR</button>
                </div>
                <table class="carsd">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Price</th>
                            <th>Year</th>
                            <th>Info</th>
                            <th>Body</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()) : ?>
                            <?php
                            $typeName = "";
                            $restype->data_seek(0);
                            while ($typeRow = $restype->fetch_assoc()) {
                                if ($typeRow['TypeID'] == $row['TypeID']) {
                                    $typeName = $typeRow['TypeName'];
                                    break; // Exit the loop once the matching type name is found
                                }
                            }  ?>

                            <tr class="sdata">
                                <td class="make"><?php echo $row['BName']; ?></td>
                                <td class="model"><?php echo $row['ModelName']; ?></td>
                                <td class="price"><?php echo $row['Price'] . " Million"; ?></td>
                                <td class="year"><?php echo $row['ModelYear']; ?></td>
                                <td class="info" onclick="gotodes(<?php echo $row['CarID']; ?>)">Info</td>


                                <td class="body"><?php echo $typeName; ?></td>

                                <td class="stock"><?php echo $row['stock']; ?></td>
                                <td class="act">
                                    <div class="backbtn">
                                        <img src="icon/edit.png" alt="" class="actbtn" onclick="gotoEdit(<?php echo $row['CarID']; ?>)">
                                    </div>
                                    <div class="backbtn1">
                                        <img src="icon/bin.png" alt="" class="actbtn" onclick="confirmDelete(<?php echo $row['CarID']; ?>)">
                                    </div>

                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <script>
            const homeBtn = document.querySelector('.homebtn');
            const carsBtn = document.querySelector('.carsbtn');

            const homeDiv = document.getElementById('Home');
            const carsDiv = document.getElementById('Carz');

            homeBtn.addEventListener('click', () => {
                homeDiv.style.display = 'block';
                carsDiv.style.display = 'none';
                toggleLinkColor(homeBtn);
            });

            carsBtn.addEventListener('click', () => {
                homeDiv.style.display = 'none';
                carsDiv.style.display = 'block';
                toggleLinkColor(carsBtn);
            });
            homeDiv.style.display = 'block';
            carsDiv.style.display = 'none';
            toggleLinkColor(homeBtn);


            function toggleLinkColor(selectedLink) {
                const links = document.querySelectorAll('.sidenav nav ul li a');
                links.forEach(link => {
                    if (link === selectedLink) {
                        link.classList.add('active');
                    } else {
                        link.classList.remove('active');
                    }
                });
            }
        </script>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            delay: 0
        });
    </script>
</body>

</html>