<?php
session_start();
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once('Connect.php');
    $BName = $_POST["Brand"];
    $ModelYear = $_POST["year"];
    $Seats = $_POST["seats"];
    $ModelName = $_POST["model"];
    $TransType = $_POST["trans"];
    $Price = $_POST["price"];
    $Vtype = $_POST["Type"];
    $Doors = $_POST["doors"];
    $Airbags = $_POST["airbag"];
    $fuelCap = $_POST["fc"];
    $speed = $_POST["ms"];
    $Engsize = $_POST["es"];
    $Engtype = $_POST["et"];
    $mileage = $_POST["mileage"];
    $Overspec = $connect->real_escape_string($_POST["os"]);
    $image = $_POST["imgpath"];
    $stock = $_POST["stock"];


    $query = "INSERT INTO Cars (BrandID, BName, ModelName, ModelYear, Price, Doors, TypeID, Airbags, Seats, FuelCapacity, MaximumSpeed, Mileage, TransmissionType, EngineSize, EngineType, OverviewSpecs,img_url,stock)
    VALUES ((SELECT BrandID FROM brands WHERE BrandName = '$BName'), '$BName', '$ModelName', '$ModelYear', '$Price', '$Doors', (SELECT TypeID FROM types WHERE TypeName = '$Vtype'), '$Airbags', $Seats, '$fuelCap', '$speed', '$mileage', '$TransType', '$Engsize', '$Engtype', '$Overspec', '$image',$stock)";

    $result = $connect->query($query);

    if ($result) {
        header('Location:adminPanel.php');
        exit();
    } else {
        $error = "Error: " . $connect->error;
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
            list-style-type: none;
            text-decoration: none;
            box-sizing: border-box;
            font-family: 'Barlow', sans-serif;
        }

        .ImageHeader {
            position: relative;
            height: 300px;
            /* Set the desired height */
            background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(icon/insertback.jpg);
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

        .MainBody {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .i1>input {
            border: 0;
            outline: none;
            background: transparent;
            border-bottom: 2px solid #A2A3A2;
            width: 320px;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px;
        }

        .ColHolder {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 40px;
        }

        .makemod {
            display: flex;
            width: 50%;
            justify-content: space-evenly;
        }

        .yearpri {
            display: flex;
            width: 50%;
            justify-content: space-evenly;
        }

        .brandtype {
            display: flex;
            width: 50%;
            justify-content: space-evenly;
            margin-top: 20px;
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

        .Lploc {
            color: black;
            opacity: 0.8;
            font-weight: 600;
            font-size: 16px;
        }

        h1 {
            opacity: 0.8;
        }

        .title {
            display: flex;
            align-items: center;
            justify-content: center;
        }


        .OS {
            display: flex;
            width: 45%;
            justify-content: flex-start;
            align-items: center;
        }

        .ospecs {
            gap: 5px;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        .Os {
            border: 0;
            outline: none;
            background: transparent;
            border: 1px solid #A2A3A2;
            width: 100%;
            max-width: 100%;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px;
            text-align: left;
            word-wrap: break-word;
        }

        .btns {
            display: flex;
            justify-content: space-evenly;
            width: 50%;
            margin-bottom: 20px;
        }

        .profile {
            width: 30%;
            font-weight: 600;
            padding: 12px 32px;
            text-align: center;
            background-color: #5F8CFF;
            border: none;
            border-radius: 7px;
            font-size: 17px;
            color: white;
            cursor: pointer;
            transition: all .5s ease;
        }

        .profile:hover {
            background-color: #2E5EAD;
        }

        .img {
            width: 42%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
        }

        .Carimg {
            font-size: 15px;
            font-weight: 500;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script>
        function updateFilePath() {
            var input = document.getElementById("carimg");
            var file = input.files[0];

            if (file) {
                var imgpath = 'icon/' + file.name;
                document.getElementById("imgpath").value = imgpath;
            }
        }
    </script>
</head>

<body>
    <div class="MainBody">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text" data-aos="fade-up" data-aos-duration="550" >Expand Your Vehicle Inventory</p>
            </div>
        </div>
        <div class="title">
            <h1>Enter Vehicle Information</h1>
        </div>
        <form class="ColHolder" method="post" action="AddData.php">

            <div class="makemod">
                <div class="i1">
                    <label for="text" class="Lploc">Model</label><br>
                    <input type="text" name="model" class="Model" id="model" placeholder="Civic" required>
                </div>
                <div class="i1">
                    <label for="text" class="Lploc">Transmission</label><br>
                    <input type="text" name="trans" class="Trans" id="trans" placeholder="CVT/Automatic" required>
                </div>
            </div>
            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Year</label><br>
                    <input type="number" name="year" class="Year" id="year" placeholder="2020" required>
                </div>
                <div class="i1">
                    <label for="number" class="Lploc">Price</label><br>
                    <input type="number" name="price" class="Price" id="price" placeholder="4.0 Million" required>
                </div>
            </div>

            <div class="brandtype">
                <div class="i1">
                    <select name="Type" id="vtype" class="Seclection" required>
                        <option value="">Select Body Type</option>
                        <option value="Sedan">Sedan</option>
                        <option value="Luxury">Luxury</option>
                        <option value="SUV">SUV</option>
                    </select>
                </div>
                <div class="i1">
                    <select name="Brand" id="cbrand" class="Seclection" required>
                        <option value="">Select Brand</option>
                        <option value="Audi">Audi</option>
                        <option value="Suzuki">Suzuki</option>
                        <option value="Toyota">Toyota</option>
                        <option value="Honda">Honda</option>
                    </select>
                </div>
            </div>
            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Doors</label><br>
                    <input type="number" name="doors" class="Doors" id="doors" placeholder="4" required>
                </div>
                <div class="i1">
                    <label for="number" class="Lploc">AirBags</label><br>
                    <input type="number" name="airbag" class="Airbag" id="airbag" placeholder="6" required>
                </div>
            </div>
            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Fuel Capacity</label><br>
                    <input type="number" name="fc" class="Fc" id="fc" placeholder="12.40L" required>
                </div>
                <div class="i1">
                    <label for="number" class="Lploc">Maximum Speed</label><br>
                    <input type="number" name="ms" class="ms" id="ms" placeholder="210kmh" required>
                </div>
            </div>
            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Engine Size</label><br>
                    <input type="number" name="es" class="Es" id="es" placeholder="1.50 or 1500cc" required>
                </div>
                <div class="i1">
                    <label for="text" class="Lploc">Engine Type</label><br>
                    <input type="text" name="et" class="Et" id="et" placeholder="Petrol" required>
                </div>
            </div>

            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Mileage</label><br>
                    <input type="number" name="mileage" class="Mileage" id="mileage" placeholder="16.50kml" required>
                </div>


                <div class="img">
                    <label for="file" class="Lploc">Car Image</label><br>
                    <div class="brimg">
                        <input type="file" name="carimg" class="Carimg" id="carimg" accept="image/*" onchange="updateFilePath()" required>
                    </div>
                </div>
                <input type="hidden" name="imgpath" id="imgpath" value="">
            </div>
            <div class="yearpri">
                <div class="i1">
                    <label for="number" class="Lploc">Seats</label><br>
                    <input type="number" name="seats" class="seats" id="seats" placeholder="5" required>
                </div>
                <div class="i1">
                    <label for="number" class="Lploc">Stock</label><br>
                    <input type="number" name="stock" class="stock" id="stock" placeholder="2" required>
                </div>
            </div>
            <div class="OS">
                <div class="ospecs">
                    <label for="text" class="Lploc">Overview Specification</label><br>
                    <textarea name="os" rows="14" cols="10" wrap="soft" id="os" class="Os" placeholder="Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit quasi velit quae excepturi officiis, provident vitae beatae doloremque perferendis facilis hic vero eligendi officia libero fugit laboriosam possimus accusamus? Eum!" required></textarea>

                </div>
            </div>
            <div class="btns">
                <input type="submit" value="SUBMIT" class="profile" id="pro">
            </div>


        </form>
    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            delay: 0
        });
    </script>
</body>

</html>