<?php
session_start();
include_once('Connect.php');
if (!isset($_SESSION['loginad']) || $_SESSION['loginad'] != true) {
    include_once('navbar.php');
    $id = $_GET['id'];
    $sqlID = "SELECT * FROM cars WHERE CarID=$id";
    $result = $connect->query($sqlID);
    $rows = mysqli_fetch_assoc($result);
    $sqlname = "SELECT cars.TypeID,types.TypeName
            FROM cars
            INNER JOIN types ON cars.TypeID = types.TypeID
            WHERE cars.CarID = $id";
    $restype = $connect->query($sqlname);
    $Tname = mysqli_fetch_assoc($restype);
} elseif (isset($_SESSION['loginad']) || $_SESSION['loginad'] == true) {
    $id = $_GET['id'];
    $sqlID = "SELECT * FROM cars WHERE CarID=$id";
    $result = $connect->query($sqlID);
    $rows = mysqli_fetch_assoc($result);
    $sqlname = "SELECT cars.TypeID,types.TypeName
            FROM cars
            INNER JOIN types ON cars.TypeID = types.TypeID
            WHERE cars.CarID = $id";
    $restype = $connect->query($sqlname);
    $Tname = mysqli_fetch_assoc($restype);
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
        }

        body {
            background-color: #F1F2FF;
        }

        .MainDiv {
            display: flex;
            flex-direction: column;
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

        .namepri {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .car {
            display: flex;
            flex-direction: column;
            width: 65%;
            gap: 15px;
        }

        .restimg {
            display: flex;
        }

        .SecondLayer {
            display: flex;
            padding: 10% 12%;
            gap: 35px;
        }

        .ct {
            font-size: 32px;
            font-weight: 700;
        }

        .otitle {
            font-size: 36px;
            font-weight: 700;
        }

        .pri {
            font-size: 32px;
            font-weight: 700;
            color: #592E6D;
        }

        .specs {
            display: flex;
            flex-direction: column;
            width: 35%;
            gap: 15px;
        }

        .ATC {
            width: 90%;
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

        .details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: white;
            width: 90%;
            border-radius: 7px;
        }

        .sd {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 20px;
        }

        .pvalue {
            font-weight: 600;

        }

        .line {
            height: 1px;
            width: 90%;
            color: gray;
            background-color: black;
            opacity: 0.1;
            align-self: center;
        }

        .Overall {
            gap: 20px;
            display: flex;
            flex-direction: column;
            margin-top: 30px;
        }

        .ospecs {
            color: #777777;
            line-height: 30px;
        }
    </style>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

    <script>
        function Cart(ID) {

            var xhttp = new XMLHttpRequest();
            var url = "asyncAddToCart.php?id=" + ID;
            xhttp.open('GET', url, true);

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    alert("Added To Cart Successfully");
                }
            };
            xhttp.send();

        }
    </script>

</head>


<body>

    <div class="MainDiv">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text" data-aos="fade-up" data-aos-duration="350">Product Details</p>
            </div>
        </div>
        <div class="SecondLayer">
            <?php
            if ($rows > 0) {
            ?>
                <div class="car" data-aos="fade-right" data-aos-duration="450">

                    <div class="namepri">
                        <h3 class="ct"><?php echo $rows['BName'] . " " . $rows['ModelName'] ?></h3>
                        <h3 class="pri"><?php echo "PKR " . $rows['Price'] . " Million" ?></h3>
                    </div>
                    <hr style="height:1px;width:100%;border-width:0;color:gray;background-color:gray; opacity: 0.3;">
                    <img src="<?php echo $rows['img_url'] ?>" alt="" style="border-radius: 5px;">

                    <div class="Overall">
                        <h3 class="otitle">
                            Overall Specifications
                        </h3>
                        <p class="ospecs">
                            <?php echo $rows['OverviewSpecs'] . "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugiat veritatis numquam accusamus enim rerum quibusdam maiores dolores obcaecati quasi reiciendis quos mollitia alias aliquid consequuntur deleniti omnis dolorem doloremque, itaque incidunt! Autem nihil ut fugiat, ducimus voluptatibus, non porro modi, quae nemo magnam repellendus neque. Cumque assumenda consequatur non neque, aliquam rerum similique atque. Minus, fugiat! Eos blanditiis vero repudiandae laudantium quaerat porro iusto consequatur, placeat ducimus hic iure. Placeat voluptate ratione non! Corrupti esse doloribus inventore reprehenderit fugit error. Rerum esse laboriosam suscipit temporibus recusandae illum ducimus possimus eius, quas voluptates officiis maxime doloremque, porro odit consectetur magni." ?>
                        </p>
                    </div>
                </div>

                <style>

                </style>
                <div class="specs">
                    <?php 
                    if (!isset($_SESSION['loginad']) || $_SESSION['loginad'] != true){
                        echo '<button class="ATC" onclick="Cart(' . $rows['CarID'] . ')" data-aos="fade-down" data-aos-duration="450">ADD TO CART</button>';
                    }
                    ?>
                    <div class="details" data-aos="fade-left" data-aos-duration="450">
                        <div class="sd">
                            <p class="pname">Transmission</p>
                            <p class="pvalue" id="auto-man"><?php echo $rows['TransmissionType'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Body Type</p>
                            <p class="pvalue" id="btype"><?php echo $Tname['TypeName'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Engine Size</p>
                            <p class="pvalue" id="engsize"><?php echo $rows['EngineSize'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Seats</p>
                            <p class="pvalue" id="seats"><?php echo $rows['Seats'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Fuel Capacity</p>
                            <p class="pvalue" id="fc"><?php echo $rows['FuelCapacity'] . "L" ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Maximum Speed</p>
                            <p class="pvalue" id="speed"><?php echo $rows['MaximumSpeed'] . "kmh" ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Mileage</p>
                            <p class="pvalue" id="mileage"><?php echo $rows['Mileage'] . "kml" ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Doors</p>
                            <p class="pvalue" id="doors"><?php echo $rows['Doors'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Engine Type</p>
                            <p class="pvalue" id="engtype"><?php echo $rows['EngineType'] ?></p>
                        </div>
                        <hr class="line">
                        <div class="sd">
                            <p class="pname">Safety Airbags</p>
                            <p class="pvalue" id="bags"><?php echo $rows['Airbags'] ?></p>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
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