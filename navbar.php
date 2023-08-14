<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            text-decoration: none;
            list-style-type: none;
        }

        html {
            scroll-behavior: smooth;
        }

        .navf{
            padding-right: 19%;
        }

        .NavBar {
            padding-top: 20px;
            background-color: #F1F2FF;
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 20px;
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
            background-color: #5F8CFF;
            border: none;
            border-radius: 50px;
            font-size: 17px;
            color: white;
            cursor: pointer;
            transition: 250ms ease;
        }

        .b1:hover {
            background-color: #5F8CFF;
            border-radius: 50px;
            color: white;
        }

        .b1:hover+.b2 {
            background-color: transparent;
            color: black;
        }
    </style>



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

</head>

<body>
    <div class="NavBar">
        <a class="MyLogo" href="#">WheelsOnDemand</a>
        <nav class="navf">
            <ul>
                <li><a href="PW.php#HowItWorks" style="cursor: pointer;">How it works</a></li>
                <li><a href="PW.php#CCars" style="cursor: pointer;">Cars</a></li>
                <li><a href="PW.php#service" style="cursor: pointer;">Services</a></li>
                <li><a href="Contact.php" style="cursor: pointer;">Contacts</a></li>
            </ul>
        </nav>
        <div class="BtnF1">
            <?php
            if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
                echo '<button class="b1" id="b1" onclick="window.location.href=\'SignUp.php\'">Sign Up</button>';
                echo '<button class="b2" id="b2" onclick="window.location.href=\'SignIn.php\'">Sign In</button>';
            } else {
                echo '<button class="b1" id="b3" onclick="window.location.href=\'addtocart.php\'">Cart</button>';
                echo '<button class="b2" id="b4" onclick="window.location.href=\'logout.php\'">Logout</button>';
            }
            ?>

        </div>


    </div>
</body>

</html>