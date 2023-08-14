<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carRoom";

$connect = new mysqli($servername, $username, $password, $dbname);

if ($connect->connect_error) {
    die("ERROR :" . $connect->connect_error);
}

$sql = "SELECT * FROM cars";
$result = $connect->query($sql);

// if ($rows > 0) {
// $data = $result->fetch_assoc();
//     $brname = $data["BName"];
//     $mname = $data["ModelName"];
//     $cprice = $data["Price"];

// while ($data = $result->fetch_assoc()) {
//     $brname = $data["BName"];
//     $mname = $data["ModelName"];
//     $cprice = $data["Price"];
//     echo "<p class='titcar'>$brname $mname</p>";
//     echo "<p class='PriceCar'>$cprice Million</p>";
// }
// }
// $connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PW</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            list-style-type: none;
        }

        body {
            background-color: #eceff1;
            overflow-x: hidden;
            display: flex;
            flex-direction: column;
        }


        .NavBar {
            padding: 20px 20px 0px 0px;
            background-color: #F1F2FF;
            display: flex;
            align-items: center;
            justify-content: space-evenly;
        }

        .NavBar nav ul {
            display: flex;
            flex-direction: row;
            gap: 40px;
        }

        .NavBar nav ul li {
            font-size: 18px;
        }

        .NavBar nav ul li a {
            font-family: 'Roboto', sans-serif;
            position: relative;
            font-weight: 500;
            color: black;
        }

        .NavBar nav ul li a::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            border-radius: 4px;
            background-color: #592e6d;
            bottom: -3px;
            left: 0;
            transform-origin: right;
            transform: scaleX(0);
            transition: transform .3s ease-in-out;
        }

        .NavBar nav ul li a:hover::before {
            transform-origin: left;
            transform: scaleX(1);
        }

        .MyLogo {
            font-family: 'League Gothic', sans-serif;
            font-size: 38px;
            color: black;
        }

        .b1 {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            padding: 12px 32px;
            text-align: center;
            border: none;
            background-color: transparent;
            color: black;
            border-radius: 50px;
            font-size: 17px;
            cursor: pointer;
            transition: 250ms ease;
        }

        .b2 {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            padding: 12px 32px;
            text-align: center;
            background-color: #592e6d;
            border: none;
            border-radius: 50px;
            font-size: 17px;
            color: white;
            cursor: pointer;
            transition: 250ms ease;
        }

        .b1:hover {
            background-color: #592e6d;
            border-radius: 50px;
            color: white;
        }

        .b1:hover+.b2 {
            background-color: transparent;
            color: black;
        }

        /*-------------------SECOND LAYER-------------------*/

        .MidLayer {
            display: flex;
            flex-direction: column;
            background-color: #F1F2FF;
            /* margin: 40px 70px 0px 70px; */
            /* align-items: center; */
        }

        .F1 {
            margin-top: 65px;
            display: flex;
            justify-content: space-between;
        }

        .Text4Mid {
            width: 48%;
            display: flex;
            flex-direction: column;
            padding: 0px 70px;
            align-items: center;
            justify-content: center;
        }

        .mlines {
            font-size: 45px;
            color: black;
            font-weight: bolder;
            font-family: 'Roboto Slab', serif;
        }

        .mslines {
            margin-top: 20px;
            color: #4f4f4f88;
        }

        .midImg {
            width: 45%;
            border-radius: 90px;
            height: 550px;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            background-position: center;
            border-radius: 10% 0% 0% 10% / 10% 10% 10% 10%;
            background-color: #E7E6FB;
        }

        .mainimg {
            width: 950px;
        }

        .location {
            display: flex;
            border-radius: 20px;
            align-items: center;
            background-color: white;
            justify-content: space-evenly;
            padding: 20px 20px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.05);
            margin: -60px 12%;
            position: relative;
        }

        .i1>input {
            border: 1px solid #ccc;
            width: 90%;
            border-radius: 12px;
            margin-top: 10px;
            padding: 12px 39px;
            background-repeat: no-repeat;
            background-position: 10px center;
            background-size: 20px;
        }

        .Ploc1 {
            background-image: url(placeholder.png);
        }

        .Ploc2 {
            background-image: url(placeholder.png);
        }

        .Ploc3 {
            background-image: url(calendar.png);
        }

        .Ploc4 {
            background-image: url(calendar.png);
        }

        .datepicker-container {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .datepicker-container.show {
            opacity: 1;
        }


        .i1>input::placeholder {
            color: #666;
        }


        .location {
            display: flex;
            border-radius: 20px;
            align-items: center;
            background-color: white;
            justify-content: space-evenly;
            padding: 30px 20px;
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.05);
            margin: -60px 12%;
            position: relative;
        }

        .Ctype {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 86%;
        }

        .Byc {
            font-size: 35px;
            color: black;
            font-weight: bolder;
            font-family: 'Roboto Slab', serif;
        }

        .opts {
            display: flex;
            gap: 20px;
        }

        .Seclection {
            padding: 17px 20px;
            background-color: #eceff1;
            border-radius: 5px;
            border: 0;
            text-align: start;
            width: 190px;
        }

        .b3 {
            font-weight: 500;
            padding: 14px 32px;
            text-align: center;
            background-color: #5F8CFF;
            border: none;
            border-radius: 5px;
            font-size: 17px;
            color: white;
            cursor: pointer;
            transition: all .5s ease;
        }

        .b3:hover {
            color: #5F8CFF;
            background-color: #eceff1;
        }

        /*HOW IT WORKS 3RD LAYER*/

        .How {
            display: flex;
            align-items: center;
            flex-direction: column;
            justify-content: center;
            margin-top: 200px;
            margin-left: 40px;
            margin-right: 40px;
        }

        .HowTitle {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 70px;
            margin-left: 30px;
        }

        .hiw {
            margin-top: 15px;
            font-size: 18px;
            color: #4f4f4fbb;
            font-family: 'Roboto Slab', serif;
            margin-bottom: 18px;
        }

        .follow {
            font-size: 30px;
            color: black;
            font-weight: bolder;
            font-family: 'Roboto Slab', serif;
        }

        .allCards {
            display: flex;
            align-items: center;
            margin-right: 50px;
        }

        .Scard {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin: 0px 40px;
            text-align: center;
        }

        .cardBack {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 80px;
            height: 80px;
            background-color: #eceff1;
            border: 2px solid white;
            border-radius: 10px;
            padding: 5px;
            box-shadow: 0px 11px 18px rgba(0, 0, 0, 0.15);
        }

        .himg {
            width: 40px;
        }

        .htitle {
            margin-top: 45px;
            font-weight: 500;
            font-size: 21px;
            font-family: 'Roboto', sans-serif;
        }

        .hdesc {
            margin-top: 15px;
            font-size: 15px;
            color: #4f4f4fbb;
        }


        /*---------------------CARS LAYER----------------------*/

        .Cars {
            display: flex;
            align-items: center;
            flex-direction: column;
            margin-top: 220px;
        }



        .collection {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 100px;
            gap: 25px;
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
            transition: all .5s ease;
        }

        .RentIt:hover {
            color: #5F8CFF;
            background-color: #eceff1;
        }

        .latest {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 85%;
        }

        .titlecol {
            font-weight: 600;
            font-size: 31px;
            font-family: 'Roboto Slab', serif;
        }


        .c1 {
            width: 95%;
            height: 100%;
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
            font-weight: 600;
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

        .DirectionBtn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .previous {
            background-color: #5F8CFF;
            height: 50px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all .3s ease;
        }

        .next {
            background-color: #5F8CFF;
            height: 50px;
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all .3s ease;
        }

        .dirimg {
            width: 45%;
        }

        .previous:hover img {
            content: url(bchange.png);
        }

        .previous:hover {
            background-color: #eceff1;
            border: 1px solid #592e6d;
        }

        .next:hover img {
            content: url(fchange.png);
        }

        .next:hover {
            background-color: #eceff1;
            border: 1px solid #592e6d;
        }

        /*------------------SERVICES--------------------------*/
        .Services {
            display: flex;
            align-items: center;
            margin-top: 200px;
            gap: 20px;
            background-color: #F1F2FF;
        }

        .Serdesc {
            display: flex;
            justify-content: flex-start;
            flex-direction: column;
            width: 35%;
            margin-left: 20px;
        }

        .Sertitle {
            font-size: 18px;
            color: #4f4f4fbb;
            font-family: 'Roboto Slab', serif;
            margin-bottom: 14px;
        }

        .SetBtitle {
            font-size: 30px;
            color: black;
            font-weight: bolder;
            font-family: 'Roboto Slab', serif;
        }

        .cards4Ser {
            display: flex;
            gap: 30px;
        }

        .AllSerCards {
            display: flex;
            flex-direction: column;
            margin-top: 50px;
            gap: 35px;
            margin-left: 14px;
        }

        .des4cards {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .SImage {
            display: flex;
            width: 50%;
        }

        .SImage img {
            width: 100%;
        }


        /*---------------------FOOTER--------------------*/

        .Footer {
            background-color: #592e6d;
            display: flex;
            align-items: center;
            margin-top: 200px;
            padding: 50px 50px;
            justify-content: space-evenly;
            gap: 20px;
        }

        .WebInfoandSocial {
            display: flex;
            flex-direction: column;
            justify-content: center;
            width: 30%;
            gap: 20px;
        }

        .FLogo {
            font-family: 'League Gothic', sans-serif;
            font-size: 23px;
            color: white;
            letter-spacing: 0.5px;
        }

        .Fdesc {
            font-size: 11px;
            color: white;
            opacity: 0.9;
        }

        .socialDiv {
            display: flex;
            gap: 10px;
        }

        .social {
            /* border-radius: 50%; */
            width: 15px;
            height: 15px;
            cursor: pointer;
        }

        .socialBack {
            background-color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
        }

        .Menu {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .Menu a {
            font-size: 12px;
            color: white;
        }

        .Mtitle {
            font-family: 'Roboto Slab', sans-serif;
            font-weight: 600;
            color: white;
        }

        .Branches {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .Branches a {
            font-size: 12px;
            color: white;
        }

        .Btitle {
            font-family: 'Roboto Slab', sans-serif;
            font-weight: 600;
            color: white;
        }

        .Contact {
            display: flex;
            flex-direction: column;
            gap: 18px;
            width: 30%;
        }

        .EachInfo {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .EIback {
            background-color: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 1px solid white;
        }

        .EIlogo {
            height: 15px;
            width: 15px;
            cursor: pointer;
        }

        .EachInfo p {
            color: white;
            font-size: 12px;
            width: 90%;
        }

        .Ctitle {
            font-family: 'Roboto Slab', sans-serif;
            font-weight: 600;
            color: white;
        }

        .copy {
            background-color: #592e6d;
            width: 100%;
            display: flex;
            justify-content: center;
        }

        .copyri8 {
            font-size: 12px;
            color: white;
            opacity: 0.9;
        }

        .ui-datepicker select.ui-datepicker-month,
        .ui-datepicker select.ui-datepicker-year {
            font-family: 'Roboto Slab', serif;
            font-size: 15px;
        }

        .ui-datepicker-current-day .ui-state-active {
            background: #5F8CFF;
        }

        .ui-datepicker-current-day {
            border: 1px solid black;
        }

        .ui-datepicker-today .ui-state-highlight {
            background: #616161;
            color: white;
            border: 1px solid black;
        }
    </style>
    <script>
        function goTo(id) {
            var targetElement = document.getElementById(id);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: "smooth"
                });
            }
        }

        function navigateToNextScreen() {
            window.location.href = "CarDesc.html"; // Example of redirecting to a new URL
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>

    <script>
        // $(document).on("click", ".RentIt", function () {
        //     // Assuming your content div has an id of "content"
        //     $(".Parent").load("CarDesc.html");
        //     history.pushState(null, null, "another.html");
        // });
    </script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Gothic&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400;600&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script>
        $(function() {
            $('#header').load('navbar.html');
        });
    </script>
</head>

<body>
    <header>
        <div id="header">

        </div>
    </header>
    <!-- <div class="NavBar">
        <a class="MyLogo" href="#">WheelsOnDemand</a>
        <nav class="navf">
            <ul>
                <li><a onclick="goTo('HowItWorks')" style="cursor: pointer;">How it works</a></li>
                <li><a onclick="goTo('CCars')" style="cursor: pointer;">Cars</a></li>
                <li><a onclick="goTo('service')" style="cursor: pointer;">Services</a></li>
                <li><a onclick="goTo('contact')" style="cursor: pointer;">Contacts</a></li>
            </ul>
        </nav>
        <div class="BtnF1">
            <button class="b1">Sign Up</button>
            <button class="b2">Sign In</button>
        </div>
    </div> -->
    <div class="Parent">

        <div class="MidLayer">
            <div class="F1">
                <div class="Text4Mid">
                    <p class="mlines">Find Your Perfect Ride on Our Website !</p>
                    <p class="mslines">Say goodbye to traditional dealership visits and hello to effortless car shopping
                        online. WheelsOnDemand offers a user-friendly platform, streamlined processes, and a wide range
                        of vehicles to cater to your unique preferences. Get behind the wheel with just a few clicks!
                    </p>
                </div>
                <div class="midImg">
                    <img src="realone.png" alt="" class="mainimg">
                </div>
            </div>
            <div class="location">

                <div class="opts">
                    <select name="Price" id="cprice" class="Seclection">
                        <option value="">Price</option>
                        <option value="L2H">Low-to-High</option>
                        <option value="H2L">High-to-Low</option>
                    </select>
                    <select name="Brand" id="cBrand" class="Seclection">
                        <option value="">Brand</option>
                        <option value="SU">Suzuki</option>
                        <option value="TY">Toyota</option>
                        <option value="ADI">Audi</option>
                        <option value="HND">Honda</option>
                    </select>
                    <select name="Type" id="vtype" class="Seclection">
                        <option value="">Type</option>
                        <option value="Standard">Standard</option>
                        <option value="Luxury">Luxury</option>
                        <option value="SUV">SUV</option>
                    </select>
                    <select name="Year" id="year" class="Seclection">
                        <option value="">Year</option>
                        <option value="Icity">Current 2023</option>
                        <option value="Ocity">Below 2023</option>
                    </select>
                </div>

                <button class="b3">Search Car</button>

            </div>

        </div>

        <div id="HowItWorks" class="How">
            <div class="HowTitle">
                <p class="hiw">HOW IT WORKS</p>
                <p class="follow">WheelsOnDemand Following 3 Working Steps</p>
            </div>
            <div class="allCards">
                <div class="Scard">
                    <div class="cardBack">
                        <img src="racing.png" alt="" class="himg">
                    </div>
                    <p class="htitle">Explore our Extensive Vehicle Inventory</p>
                    <p class="hdesc">Explore our wide selection of vehicles, filter by preferences, and find your ideal
                        match.</p>
                </div>
                <div class="Scard">
                    <div class="cardBack" style=" background: linear-gradient(#592e6d, #b27cbf); border: none;">
                        <img src="check-list.png" alt="" class="himg" style="margin-left: 5px;">
                    </div>
                    <p class="htitle">Detailed Car Listings</p>
                    <p class="hdesc">Access comprehensive vehicle details to make informed decisions about your ideal
                        car.</p>
                </div>
                <div class="Scard">
                    <div class="cardBack">
                        <img src="add-to-cart.png" alt="" class="himg">
                    </div>
                    <p class="htitle">Seamless Checkout Process</p>
                    <p class="hdesc"> Add your chosen car to the cart or make a purchase with a few simple steps.</p>
                </div>
            </div>
        </div>

        <div class="Services" id="service">

            <div class="SImage">
                <img src="seviceImage1.png" alt="">
            </div>

            <div class="Serdesc">
                <p class="Sertitle">Best Services</p>
                <p class="SetBtitle">Feel the best experience with our car deals</p>

                <div class="AllSerCards">

                    <div class="cards4Ser">
                        <div class="cardBack" style="width: 110px; height: 72px;">
                            <img src="truck.png" alt="" class="himg" style="width: 35px; height: 35px;">
                        </div>
                        <div class="des4cards">
                            <p class="htitle" style="margin-top: 0px;">Free Shipping</p>
                            <p class="hdesc" style="margin-top: 0px;">Enjoy the freedom of free shipping on all vehicle
                                purchases, delivered right to your doorstep!</p>
                        </div>
                    </div>
                    <div class="cards4Ser">
                        <div class="cardBack" style="width: 74px; height: 72px;">
                            <img src="competitive.png" alt="" class="himg" style="width: 30px; height: 30px;">
                        </div>
                        <div class="des4cards">
                            <p class="htitle" style="margin-top: 0px;">Competitive Pricing</p>
                            <p class="hdesc" style="margin-top: 0px;">Unbeatable prices, ensuring you get the best deal
                                in town!</p>
                        </div>
                    </div>
                    <div class="cards4Ser">
                        <div class="cardBack" style="width: 92px; height: 72px;">
                            <img src="help.png" alt="" class="himg" style="width: 30px; height: 30px;">
                        </div>
                        <div class="des4cards">
                            <p class="htitle" style="margin-top: 0px;">24/7 Help Center</p>
                            <p class="hdesc" style="margin-top: 0px;">"Round-the-clock assistance, providing peace of
                                mind whenever you need.</p>
                        </div>
                    </div>


                </div>

            </div>
        </div>

        <div class="Cars" id="CCars">

            <div class="latest">
                <p class="titlecol">Latest Collection</p>
                <div class="DirectionBtn">
                    <a href="#collection" class="previous" id="back"><img src="back.png" alt="" class="dirimg"></a>
                    <a href="#collection" class="next" id="forward"><img src="forward.png" alt="" class="dirimg"></a>
                </div>
            </div>
            <style>
                .cardCar {
                    max-width: 350px;
                    display: flex;
                    display: relative;
                    margin-left: 12px;
                    gap: 4px;
                    flex-direction: column;
                    padding: 10px;
                    background-color: white;
                    border-radius: 10px;
                    height: 410px;
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
                }
            </style>
            <div class="collection">
                <?php
                while ($rows = mysqli_fetch_assoc($result)) :
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
                                    <img src="carS.png" alt="">
                                </div>
                                <p class="f1">5 Seats</p>
                            </div>
                            <div>
                                <div class="features">
                                    <img src="gearbox.png" alt="">
                                </div>
                                <p class="f1">Manual</p>
                            </div>
                            <div>
                                <div class="features">
                                    <img src="gasstation1.png" alt="">
                                </div>
                                <p class="f1">Fuel</p>
                            </div>
                        </div>

                        <button class="RentIt" onclick="navigateToNextScreen()">View Details</button>
                    </div>
                <?php
                endwhile;
                ?>
            </div>
        </div>



    </div>
    <div class="Footer">
        <div class="WebInfoandSocial">
            <p class="FLogo">WheelsOnDemand</p>
            <p class="Fdesc">We prioritize your safety and satisfaction. Our modern
                and well-equipped cars are regularly inspected and serviced, guaranteeing a smooth and worry-free
                journey. With competitive prices and exceptional customer service, we make renting a car a breeze.
            </p>
            <div class="socialDiv">
                <div class="socialBack">
                    <img src="youtube.png" alt="" class="social">
                </div>
                <div class="socialBack">
                    <img src="insta.png" alt="" class="social">
                </div>
                <div class="socialBack">
                    <img src="twitter.png" alt="" class="social">
                </div>
                <div class="socialBack">
                    <img src="linkedin.png" alt="" class="social">
                </div>
            </div>
        </div>

        <div class="Menu">
            <p class="Mtitle">Menu</p>
            <a onclick="goTo('HowItWorks')" style="cursor: pointer;">How it works</a>
            <a onclick="goTo('CCars')" style="cursor: pointer;">Cars</a>
            <a onclick="goTo('service')" style="cursor: pointer;">Services</a>
            <a href="#">Contacts</a>
        </div>
        <div class="Branches">
            <p class="Btitle">Locations</p>
            <a onclick="goTo('HowItWorks')" style="cursor: pointer;">Lahore</a>
            <a onclick="goTo('CCars')" style="cursor: pointer;">Sargodha</a>
            <a onclick="goTo('service')" style="cursor: pointer;">Islamabad</a>
            <a href="#">Karachi</a>
        </div>
        <div class="Contact" id="contact">
            <p class="Ctitle">Contacts</p>
            <div class="EachInfo">
                <div class="EIback">
                    <img src="call.png" alt="" class="EIlogo">
                </div>
                <p class="EInum">+92-314-1032014</p>
            </div>
            <div class="EachInfo">
                <div class="EIback">
                    <img src="mail.png" alt="" class="EIlogo">
                </div>
                <p class="EImail">WheelsOnDemand@gmail.com</p>
            </div>
            <div class="EachInfo">
                <div class="EIback">
                    <img src="pin.png" alt="" class="EIlogo">
                </div>
                <p class="EIloc">IBN-E-SINA MARKET RAJA PLAZA, near NADARA OFFICE, Sargodha, 40100, Pakistan</p>
            </div>
        </div>
    </div>
    <div class="copy">
        <a href="#" class="copyri8">Copyright © 2019 WheelsOnDemand. All rights reserved.</a>
    </div>
    <script src="script.js"></script>
</body>

</html>