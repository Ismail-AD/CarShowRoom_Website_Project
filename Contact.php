<?php
session_start();
include_once('Connect.php');
if (isset($_POST['submit'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $message = $_POST['Desc'];
    $sub = $_POST['Sub'];
    $cid = $_SESSION['customerid'];

    $sql = "INSERT INTO message (CustomerID,username, useremail, subject, description)
            VALUES ( $cid,'$name', '$email', '$sub', '$message')";
    $result = $connect->query($sql);
    if ($result) {
        echo '<script>alert("Message Submitted Successfully !");</script>';
        header("Location:PW.php");
        exit;
    }
}
include_once('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
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

        Body {
            background-color: #F1F2FF;
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

        .NavBar {
            padding-top: 20px;
            background-color: #F1F2FF;
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .image-overlay {
            text-align: center;
        }

        .image-text {
            font-size: 65px;
            color: white;
            font-weight: 600;
        }

        .Main {
            display: flex;
            flex-direction: column;
        }


        h1 {
            opacity: 0.8;
        }

        .title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 60px;
        }

        .MailBody {
            display: flex;
            width: 75%;
            justify-content: space-between;
            padding: 50px;
            margin: 5% auto 0px auto;
            background-color: #DBEBEB;
            border-radius: 20px;
            box-shadow: 0px 6px 14px rgba(0, 0, 0, 0.2);
        }

        .inputs {
            display: flex;
            flex-direction: column;
            width: 62%;
            gap: 20px;
        }

        .rowInput {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .input1 {
            border: 0;
            outline: 0;
            width: 48%;
            padding: 20px;
            border-radius: 6px;
            font-size: 15px;
        }

        .input2 {
            border: 0;
            outline: 0;
            width: 100%;
            padding: 20px;
            border-radius: 6px;
            font-size: 15px;
        }

        .input1::placeholder,
        .input2::placeholder {
            color: rgb(82, 76, 76);
        }

        .btn {
            padding: 10px 32px;
            background-color: #2D2B37;
            color: white;
            font-weight: 500;
            border: 0;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.4s ease-in-out;
            cursor: pointer;
        }

        .btn:hover {
            background-color: white;
            color: #2D2B37;
        }

        .design {
            display: flex;
            flex-direction: column;
            padding: 35px;
            gap: 40px;
            border-radius: 10px;
            background-color: #0A616F;
            width: 30%;
            color: white;
            justify-content: flex-start;
        }

        .bx1 {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .label {
            font-weight: 600;
        }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="Main">
        <div class="ImageHeader">
            <div class="image-overlay">
                <p class="image-text">Contact Us</p>
            </div>
        </div>
        <div class="title">
            <h1>We're Ready to Assist You</h1>
        </div>
        <form method="POST" action="" class="MailBody">
            <div class="inputs">
                <div class="rowInput">
                    <input type="text" name="Name" class="input1" placeholder="Name" required>
                    <input type="email" name="Email" class="input1" placeholder="Email" required>
                </div>
                <div class="Subject">
                    <input type="text" name="Sub" class="input2" placeholder="Subject" required>
                </div>
                <div class="desc">
                    <textarea name="Desc" rows="7" cols="10" wrap="soft" class="input2" placeholder="How can we help you ?" required></textarea>
                </div>
                <div class="button">
                    <input type="submit" value="Send Mesaage" class="btn" name="submit">
                </div>
            </div>

            <div class="design">

                <div class="bx1">
                    <h3 class="label">Address</h3>
                    <p class="des">IBN-E-SINA MARKET RAJA PLAZA, near NADARA OFFICE, Sargodha, 40100, Pakistan</p>
                </div>
                <div class="bx1">
                    <h3 class="label">Phone</h3>
                    <p class="des">+92-314-1032014</p>
                </div>
                <div class="bx1">
                    <h3 class="label">Hours</h3>
                    <p class="des">Mon-Fri: 8am - 5pm (CST)</p>
                </div>

            </div>
        </form>

    </div>

</body>

</html>