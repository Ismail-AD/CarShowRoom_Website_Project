<?php
include_once('Connect.php');
session_start();
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $mail = $_POST["mail"];
    $pass = $_POST["pass"];

    $Sql = "SELECT * FROM customers WHERE Email = ? AND pass = ?";
    $Sqlad = "SELECT * FROM admin WHERE Email = ? AND adminpass = ?";

    $stmt = $connect->prepare($Sqlad);
    $stmt->bind_param('ss', $mail, $pass);
    $stmt->execute();
    $resultad = $stmt->get_result();

    $stmt = $connect->prepare($Sql);
    $stmt->bind_param('ss', $mail, $pass);
    $stmt->execute();
    $result = $stmt->get_result();



    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['login'] = true;
        $_SESSION['customerid'] = $row['CustomerID'];
        $_SESSION['customername'] = $row['FirstName'];
        header('Location:PW.php');
        exit();
    } elseif ($resultad->num_rows > 0) {
        $rowad = $resultad->fetch_assoc();
        // var_dump($rowad);
        // die;
        $_SESSION['loginad'] = true;
        $_SESSION['adminid'] = $rowad['AdminID'];
        $_SESSION['adminname'] = $rowad['Name'];
        header('Location:adminPanel.php');
        exit();
    } else {
        $error = "Incorrect password or email !";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .Main {
            display: flex;
            height: 100vh;
            justify-content: space-between;
            overflow: hidden;
        }

        body {
            background-color: #F1F2FF;
        }

        .Login {
            width: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .Lcard {
            width: 70%;
            height: 85%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border-radius: 10px;
            padding: 10px 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            background-color: white;
        }

        .i1>input {
            border: 0;
            background: transparent;
            border-bottom: 2px solid #A2A3A2;
            width: 320px;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px 12px 12px 29px;
            background-repeat: no-repeat;
            background-position: 2px center;
            background-size: 20px;
        }

        .PassInput {
            width: 320px;
            position: relative;
        }

        #pass {
            border: 0;
            background: transparent;
            border-bottom: 2px solid #A2A3A2;
            width: 100%;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px 36px 12px 0px;
        }

        .PassInput img {
            position: absolute;
            top: 7px;
            right: 0px;
            cursor: pointer;
        }

        #mail {
            background-image: url(icon/mail\(1\).png);
        }
        .i1 p {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            color: red;
            font-weight: 500;
            margin-top: 5px;
        }

        #emerr {
            display: none;
        }

        input:focus {
            outline: none;
        }

        .ColHolder {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .Rows {
            display: flex;
            gap: 25px;
        }


        .Lploc {
            color: #A2A3A2;
            font-size: 13px;
        }

        .Rowcheck {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 13px;
        }

        .Fpass {
            font-size: 13px;
            font-family: 'Roboto', sans-serif;
            font-weight: 600;
            color: #36454F;
            opacity: 0.8;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .Fpass:hover {
            color: black;
        }

        .inbtn {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            padding: 12px 42px;
            text-align: center;
            border: none;
            background-color: #E6E6FC;
            color: black;
            border-radius: 50px;
            font-size: 17px;
            cursor: pointer;
            transition: all .4s ease;
            box-shadow: 0 2px 4px rgba(230, 230, 252, 0.4);
            width: 60%;
        }

        .inbtn:hover {
            color: white;
            background-color: #5F8CFF;
            box-shadow: 0px 15px 20px rgba(95, 140, 255, 0.4);
        }


        .CarA {
            background-position: center;
            border-radius: 90px;
            display: flex;
            align-items: center;
            width: 45%;
            height: 100%;
            background-color: #E6E6FC;
            border-radius: 0% 100% 100% 0% / 30% 0% 100% 70%;

        }

        .BUG {
            margin-left: -150pX;
            width: 950px;
        }

        .starter {
            width: 93%;
            gap: 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding-left: 7px;
            margin-bottom: 25px;
        }

        .LogoS {
            font-family: 'League Gothic', sans-serif;
            font-size: 27px;
            word-spacing: 4px;
            margin-bottom: 30px;
        }


        .RowBtn {
            display: flex;
            flex-direction: column;
            margin-top: 15px;
            align-items: center;
            gap: 20px;
            margin-top: 45px;
        }

        .google {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .google p {
            font-family: 'Roboto', sans-serif;
            font-size: 15px;
            opacity: 0.8;
        }

        .google span {
            color: black;
            font-weight: 500;
            font-family: 'Roboto', sans-serif;
            font-size: 16px;
            cursor: pointer;
        }

        .google span:hover {
            color: gray;
        }


        .ORline {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .or,
        hr {
            color: #36454F;
            opacity: 0.3;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var InputVal = $("#pass");
            $("#closeEye").click(function() {
                if (InputVal.attr('type') === 'password') {
                    InputVal.attr('type', 'text');
                    $(this).attr('src', 'icon/eye.png');
                } else {
                    InputVal.attr('type', 'password');
                    $(this).attr('src', 'icon/closeeye.png');
                }
            });
            var InputVal2 = $("#pass1");
            $("#closeEye1").click(function() {
                if (InputVal2.attr('type') === 'password') {
                    InputVal2.attr('type', 'text');
                    $(this).attr('src', 'icon/eye.png');
                } else {
                    InputVal2.attr('type', 'password');
                    $(this).attr('src', 'icon/closeeye.png');
                }
            });
        });
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
</head>


<body>
    <div class="Main">
        <div class="CarA" data-aos="fade-right" data-aos-duration="750">
            <img src="icon/bugattiCar.png" alt="" class="BUG">
        </div>
        <div class="Login">
            <div class="Lcard" data-aos="fade-left" data-aos-duration="750">

                <div class="starter">
                    <p class="LogoS">WheelsOnDemand</p>
                </div>
                <form action="SignIn.php" method="post" class="ColHolder">
                    <div class="i1">
                        <label for="email" class="Lploc">Email</label><br>
                        <input type="email" name="mail" class="Email" id="mail" placeholder="example@example.com">
                        <p id="emerr">ERROR</p>
                    </div>
                    <div class="i1">
                        <label for="password" class="Lploc">Password</label><br>
                        <div class="PassInput">
                            <input type="password" name="pass" class="pass" id="pass" placeholder="*******">
                            <img src="icon/closeeye.png" alt="" width="23px" id="closeEye">
                            <?php
                            if (!empty($error)) { ?>
                                <p><?php echo $error; ?></p>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="RowBtn">
                        <input type="submit" class="inbtn" value="Sign In">
                        <div class="ORline">
                            <hr style="height:2px;width: 80px; border-width:0;color:gray;background-color:gray">
                            <p class="or">or</p>
                            <hr style="height:2px;width: 80px;border-width:0;color:gray;background-color:gray">
                        </div>
                        <div class="google">
                            <p>Don't Have An Account ? <span onclick="window.location.href='SignUp.php'">Sign Up</span></p>
                        </div>
                    </div>
                </form>
            </div>
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