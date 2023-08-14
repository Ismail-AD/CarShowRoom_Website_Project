<?php
session_start();
include_once('Connect.php');
include_once('navbar.php');
if (isset($_SESSION['login']) || $_SESSION['login'] == true) {
    if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
        $price = $_GET['Price'];
        $brand = $_GET['Brand'];
        $type = $_GET['Type'];
        $year = $_GET['Year'];
        $filterquery = "SELECT * FROM cars WHERE 1 = 1";


        $brandQuery = "SELECT BrandID FROM brands WHERE BrandName = '" . $brand . "'";
        $brandResult = $connect->query($brandQuery);
        if ($brandResult->num_rows > 0) {
            $Brow = mysqli_fetch_assoc($brandResult);
            $BrandID = $Brow['BrandID'];
        }
        $typeQuery = "SELECT TypeID FROM types WHERE TypeName = '" . $type . "'";
        $typeResult = $connect->query($typeQuery);
        if ($typeResult->num_rows > 0) {
            $Trow = mysqli_fetch_assoc($typeResult);
            $TypeID = $Trow['TypeID'];
        }

        if (!empty($brand)) {
            $filterquery .= " AND BrandID = " . $BrandID;
        }

        if (!empty($type)) {
            $filterquery .= " AND TypeID = " . $TypeID;
        }

        if (!empty($year)) {
            if ($year == "more23") {
                $filterquery .= " AND ModelYear = 2023";
            } elseif ($year == "less23") {
                $filterquery .= " AND ModelYear < 2023";
            }
        }
        if (!empty($price)) {
            if ($price == "L2H") {
                $filterquery .= " ORDER BY price ASC";
            } elseif ($price == "H2L") {
                $filterquery .= " ORDER BY price DESC";
            }
        }
    } else {
        $filterquery = "SELECT * FROM cars WHERE 1 = 1";
    }
    $res = $connect->query($filterquery);


    if ($res->num_rows > 0) {
        $totalCars = $res->num_rows;
    } else {
        $totalCars = "No";
    }
} else {
    header('Location:SignIn.php');
    exit;
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

        .MainBody {
            display: flex;
            flex-direction: column;
            margin-top: 20px;
            /* height: 200vh; */
            gap: 100px;
            overflow-x: hidden;
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

        .singlecar {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .carrows {
            display: flex;
            gap: 30px;
        }

        .image-overlay {
            text-align: center;
        }

        .image-text {
            font-size: 65px;
            color: white;
            font-weight: 600;
        }

        .CarsBody {
            display: flex;
            flex-direction: column;
            width: 70%;
            gap: 20px;
            align-self: center;
        }

        .totalcars {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .RentIt {
            font-weight: 500;
            padding: 10px 32px;
            text-align: center;
            border: none;
            background-color: transparent;
            color: #eceff1;
            border-radius: 10px;
            font-size: 17px;
            cursor: pointer;
            background-color: #5F8CFF;
            font-family: 'Poppins', sans-serif;
            transition: all .5s ease;
        }

        .cardCar {
            max-width: 325px;
            display: flex;
            display: relative;
            gap: 4px;
            flex-direction: column;
            padding: 10px;
            background-color: white;
            border-radius: 10px;
            height: 400px;
            --tw-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
            cursor: pointer;
        }

        .carback {
            background-color: #eceff1;
            border-radius: 10px;
            display: flex;
            height: 60%;
            align-items: center;
            overflow: hidden;
        }

        .RentIt:hover {
            color: #5F8CFF;
            background-color: #eceff1;
        }

        .tcars {
            font-size: 24px;
        }

        .opts {
            display: flex;
        }

        .Selection {
            padding: 17px 20px;
            border-radius: 2px;
            background: transparent;
            border: 2px solid #C9CAD5;
            text-align: start;
            font-size: 16px;
            font-weight: 500;
            width: 190px;
            opacity: 0.5;
        }

        .c1 {
            width: 100%;
            height: 100%;
            border-radius: 13px;
        }

        .PriceCar {
            font-size: 21px;
            color: #592e6d;
            font-family: 'Barlow', sans-serif;
            font-weight: 600;
        }


        .all-f {
            display: flex;
            justify-content: space-around;
            align-items: center;
            gap: 4px;
            padding: 14px 0;
        }

        .features img {
            width: 65%;
            height: 65%;
        }

        .all-f>div {
            display: flex;
            flex-direction: column;
            gap: 4px;
            align-items: center;
            justify-content: center;
        }

        .cardprice {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px;
        }

        .PriceCar {
            font-size: 21px;
            color: #592e6d;
            font-family: 'Barlow', sans-serif;
            font-weight: 700;
        }

        .titcar {
            font-weight: 700;
            font-size: 21px;
            font-family: 'Barlow', sans-serif;
        }

        .f1 {
            text-align: center;
            opacity: 0.6;
            font-size: small;
            color: #616161;
        }

        .features {
            width: 50px;
            padding: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50px;
            background-color: #EFF3FF;
            border-radius: 15px;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script>
        function navigateToNextScreen(Id) {
            window.location.href = "CarDesc.php?id=" + Id; // Example of redirecting to a new URL
        }
    </script>
</head>

<body>
    <div class="MainBody">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text" data-aos="fade-up" data-aos-duration="350">Vehicle Listings</p>
            </div>
        </div>
        <div class="CarsBody">
            <div class="totalcars" data-aos="fade-right" data-aos-duration="550">

                <h4 class="tcars"><?php
                                    if ($totalCars < 1) {
                                        echo $totalCars . " Car Found";
                                    } else {
                                        echo $totalCars . " Cars Found";
                                    } ?></h4>
            </div>

            <div class="singlecar" data-aos="fade-up" data-aos-duration="550">
                <?php
                $counter = 0;
                while ($rows = $res->fetch_assoc()) :
                    if ($counter % 3 == 0) {
                        echo '<div class="carrows">'; // Start a new row every 3rd car
                    }
                ?>
                    <div class="cardCar">
                        <div class="carback">
                            <img src="<?php echo $rows['img_url'] ?>" alt="" class="c1">
                        </div>

                        <div class="cardprice">
                            <p class="titcar"><?php echo $rows['BName'] . " " . $rows['ModelName'] ?></p>
                            <p class="PriceCar"><?php echo "PKR " . $rows['Price'] . " Million" ?></p>
                        </div>

                        <div class="all-f">
                            <div>
                                <div class="features">
                                    <img src="icon/carS.png" alt="">
                                </div>
                                <p class="f1"><?php echo $rows['Seats'] . " Seats" ?></p>
                            </div>
                            <div>
                                <div class="features">
                                    <img src="icon/gearbox.png" alt="">
                                </div>
                                <p class="f1"><?php echo $rows['TransmissionType'] ?></p>
                            </div>
                            <div>
                                <div class="features">
                                    <img src="icon/gasstation1.png" alt="">
                                </div>
                                <p class="f1"><?php echo $rows['EngineType'] ?></p>
                            </div>
                        </div>

                        <button class="RentIt" onclick="navigateToNextScreen(<?php echo $rows['CarID']; ?>)">View Details</button>
                    </div>
                <?php
                    $counter++;
                    if ($counter % 3 == 0) {
                        echo '</div>'; // End the row after displaying 3 cars
                    }
                endwhile;
                ?>
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