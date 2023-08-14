<?php
session_start();
$error = "";
include_once('Connect.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
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
    $Overspec = $_POST["os"];
    $image = $_POST["imgpath"];
    $stock = $_POST["stock"];

    if (isset($_SESSION['cid'])) {
        $car_id=$_SESSION['cid'];
        $queryUpdate = "UPDATE cars SET 
        BrandID = (SELECT BrandID FROM brands WHERE BrandName = '$BName'),
        BName = '$BName',
        ModelName = '$ModelName',
        ModelYear = '$ModelYear',
        Price = '$Price',
        Doors = '$Doors',
        TypeID = (SELECT TypeID FROM types WHERE TypeName = '$Vtype'),
        Airbags = '$Airbags',
        Seats = $Seats,
        FuelCapacity = '$fuelCap',
        MaximumSpeed = '$speed',
        Mileage = '$mileage',
        TransmissionType = '$TransType',
        EngineSize = '$Engsize',
        EngineType = '$Engtype',
        OverviewSpecs = '$Overspec',
        img_url = '$image',
        stock = $stock
      WHERE CarID = $car_id";
        $resultUpdate = $connect->query($queryUpdate);
        if ($resultUpdate) {
            header('Location:adminPanel.php');
            exit();
        } else {
            $error = "Error: " . $connect->error;
        }
    }
} elseif (isset($_GET['id'])) {
    $carid = $_GET['id'];
    $_SESSION['cid'] = $carid;
    $query = "SELECT * FROM cars WHERE CarID = $carid";
    $results = $connect->query($query);
    $Bid = $results->fetch_assoc();
    $Brandid = $Bid['BrandID'];
    $Typeid = $Bid['TypeID'];
    $queryBrand = "SELECT *  FROM brands WHERE BrandID = '$Brandid'";
    $queryType = "SELECT * FROM types WHERE TypeID = '$Typeid'";
    $resultbrnd = $connect->query($queryBrand);
    $resultstype = $connect->query($queryType);
    $BN = $resultbrnd->fetch_assoc();
    $TN = $resultstype->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                <p class="image-text">Update Your Vehicle Inventory</p>
            </div>
        </div>
        <div class="title">
            <h1>Update Vehicle Information</h1>
        </div>
        <?php
        if ($results->num_rows > 0) {
            foreach ($results as $res) {
        ?>

                <form class="ColHolder" method="post" action="Update.php">

                    <div class="makemod">
                        <div class="i1">
                            <label for="text" class="Lploc">Model</label><br>
                            <input type="text" name="model" class="Model" id="model" value="<?php echo $res['ModelName'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="text" class="Lploc">Transmission</label><br>
                            <input type="text" name="trans" class="Trans" id="trans" value="<?php echo $res['TransmissionType'] ?>" required>
                        </div>
                    </div>
                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Year</label><br>
                            <input type="number" name="year" class="Year" id="year" value="<?php echo $res['ModelYear'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="number" class="Lploc">Price</label><br>
                            <input type="number" name="price" class="Price" id="price" value="<?php echo $res['Price'] ?>" required>
                        </div>
                    </div>

                    <div class="brandtype">
                        <div class="i1">
                            <select name="Type" id="vtype" class="Seclection" required>
                                <option value="">Select Body Type</option>
                                <option value="Sedan" <?= $TN['TypeName'] == 'Sedan' ? 'selected' : '' ?>>Sedan</option>
                                <option value="Luxury" <?= $TN['TypeName'] == 'Luxury' ? 'selected' : '' ?>>Luxury</option>
                                <option value="SUV" <?= $TN['TypeName'] == 'SUV' ? 'selected' : '' ?>>SUV</option>
                            </select>
                        </div>
                        <div class="i1">
                            <select name="Brand" id="cbrand" class="Seclection" required>
                                <option value="">Select Brand</option>
                                <option value="Audi" <?= $BN['BrandName'] == 'Audi' ? 'selected' : '' ?>>Audi</option>
                                <option value="Suzuki" <?= $BN['BrandName'] == 'Suzuki' ? 'selected' : '' ?>>Suzuki</option>
                                <option value="Toyota" <?= $BN['BrandName'] == 'Toyota' ? 'selected' : '' ?>>Toyota</option>
                                <option value="Honda" <?= $BN['BrandName'] == 'Honda' ? 'selected' : '' ?>>Honda</option>
                            </select>
                        </div>
                    </div>
                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Doors</label><br>
                            <input type="number" name="doors" class="Doors" id="doors" value="<?php echo $res['Doors'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="number" class="Lploc">AirBags</label><br>
                            <input type="number" name="airbag" class="Airbag" id="airbag" value="<?php echo $res['Airbags'] ?>" required>
                        </div>
                    </div>
                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Fuel Capacity</label><br>
                            <input type="number" name="fc" class="Fc" id="fc" value="<?php echo $res['FuelCapacity'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="number" class="Lploc">Maximum Speed</label><br>
                            <input type="number" name="ms" class="ms" id="ms" value="<?php echo $res['MaximumSpeed'] ?>" required>
                        </div>
                    </div>
                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Engine Size</label><br>
                            <input type="number" name="es" class="Es" id="es" value="<?php echo $res['EngineSize'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="text" class="Lploc">Engine Type</label><br>
                            <input type="text" name="et" class="Et" id="et" value="<?php echo $res['EngineType'] ?>" required>
                        </div>
                    </div>

                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Mileage</label><br>
                            <input type="number" name="mileage" class="Mileage" id="mileage" value="<?php echo $res['Mileage'] ?>" required>
                        </div>

                        <style>
                            .Carimg-preview {
                                width: 150px;
                                height: auto;
                            }

                            .brimg {
                                display: flex;
                                align-items: center;
                            }
                        </style>
                        <div class="img">
                            <label for="file" class="Lploc">Car Image</label><br>
                            <div class="brimg">
                                <input type="file" name="carimg" class="Carimg" id="carimg" accept="image/*" onchange="updateFilePath()" required>
                                <?php
                                $imagePath = $res['img_url'];
                                if ($imagePath) {
                                    echo '<img src="' . $imagePath . '" alt="Car Image" class="Carimg-preview">';
                                }
                                ?>
                            </div>
                        </div>
                        <input type="hidden" name="imgpath" id="imgpath" value="">
                    </div>
                    <div class="yearpri">
                        <div class="i1">
                            <label for="number" class="Lploc">Seats</label><br>
                            <input type="number" name="seats" class="seats" id="seats" value="<?php echo $res['Seats'] ?>" required>
                        </div>
                        <div class="i1">
                            <label for="number" class="Lploc">Stock</label><br>
                            <input type="number" name="stock" class="stock" id="stock" value="<?php echo $res['stock'] ?>" required>
                        </div>
                    </div>
                    <div class="OS">
                        <div class="ospecs">
                            <label for="text" class="Lploc">Overview Specification</label><br>
                            <textarea name="os" rows="14" cols="10" wrap="soft" id="os" class="Os" required><?php echo $res['OverviewSpecs'] ?></textarea>

                        </div>
                    </div>
                    <div class="btns">
                        <input type="submit" value="SUBMIT" class="profile" id="pro">
                    </div>


                </form>
            <?php
            }
        } else {
            ?>
            <h4>Not Found !</h4>
        <?php
        }
        ?>

    </div>
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            delay: 0
        });
    </script>
</body>

</html>