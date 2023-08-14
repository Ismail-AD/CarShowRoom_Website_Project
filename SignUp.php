<?php
$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include_once('connect.php');
    $firstname = $_POST["namef"];
    $lastname = $_POST["namel"];
    $number = $_POST["number"];
    $umail = $_POST["umail"];
    $upass = $_POST["upass"];
    $confirmpassword = $_POST["pass1"];

    if ($confirmpassword == $upass) {
        $Sql = "INSERT INTO customers (FirstName, LastName,Phone, Email, pass) VALUES('$firstname','$lastname','$number','$umail',$upass)";
        $SqlcheckEmail = "SELECT * FROM customers WHERE Email = '$umail' ";
        $resultcheckmail = $connect->query($SqlcheckEmail);
        if ($resultcheckmail->num_rows > 0) {
            echo "<script>alert('User Already Exist With Same Email Retry With Other email !')</script>";
        } else {
            $result = $connect->query($Sql);
            if ($result) {
                header('Location:PW.php');
                exit();
            } else {
                $error = "Error: " . $connect->error;
            }
        }
    } else {
        $error = "Passwords do not match.";
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
            align-items: center;
            justify-content: center;
        }

        .Lcard {
            width: 74%;
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
            border-bottom: 2px solid rgba(165, 42, 42, 0.5);
            width: 90%;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px 12px 12px 29px;
            background-repeat: no-repeat;
            background-position: 2px center;
            background-size: 20px;
        }

        .PassInput {
            width: 93%;
            position: relative;
        }

        #upass {
            border: 0;
            background: transparent;
            border-bottom: 2px solid rgba(165, 42, 42, 0.5);
            width: 100%;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px 36px 12px 0px;

        }

        #pass1 {
            border: 0;
            background: transparent;
            border-bottom: 2px solid rgba(165, 42, 42, 0.5);
            width: 100%;
            font-size: 15px;
            font-family: 'Roboto', sans-serif;
            padding: 12px 39px 12px 0px;
        }

        .PassInput img {
            position: absolute;
            top: 7px;
            right: 0px;
            cursor: pointer;
        }


        #namel {
            background-image: url(icon/user.png);
        }

        #namef {
            background-image: url(icon/user.png);
        }

        #number {
            background-image: url(icon/call\(1\).png);
        }

        #umail {
            background-image: url(icon/mail\(1\).png);
        }

        .i1 p {
            font-family: 'Roboto', sans-serif;
            font-size: 12px;
            color: red;
            font-weight: 500;
            margin-top: 5px;
        }

        #umerr {
            display: none;
        }

        #fnerr {
            display: none;
        }

        #lnerr {
            display: none;
        }

        #pnerr {
            display: none;
        }

        #cperr {
            display: none;
        }

        input:focus {
            outline: none;
        }

        .ColHolder {
            display: flex;
            flex-direction: column;
            gap: 45px;
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
            gap: 6px;
        }


        .upbtn {
            font-family: 'Roboto', sans-serif;
            font-weight: 500;
            padding: 12px 32px;
            text-align: center;
            border: none;
            background-color: #E6E6FC;
            color: black;
            border-radius: 50px;
            font-size: 17px;
            cursor: pointer;
            transition: all .4s ease;
            box-shadow: 0 2px 4px rgba(230, 230, 252, 0.4);
            width: 50%;
        }

        .upbtn:hover {
            color: white;
            background-color: #5F8CFF;
            box-shadow: 0px 15px 20px rgba(95, 140, 255, 0.4);
        }

        .RowBtn {
            display: flex;
            flex-direction: column;
            margin-top: 15px;
            align-items: center;
            gap: 15px;
            margin-top: 15px;
            margin-right: 12px;
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

        .CarB {
            background-position: center;
            border-radius: 90px;
            display: flex;
            align-items: center;
            background-color: #E6E6FC;
            height: 100%;
            width: 45%;
            border-radius: 0% 100% 0% 100% / 0% 0% 100% 100%;
        }

        .SUV {
            width: 950px;
            margin-left: -70px;
        }

        .starter {
            width: 93%;
            gap: 3px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            padding-left: 4px;
            margin-bottom: 35px;
        }


        .Welcome {
            font-weight: 600;
            font-size: 27px;
            color: #36454F;
        }

        .LetsStart {
            font-family: 'Roboto', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: #36454F;
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var InputVal = $("#upass");
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

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>

</head>

<body>

    <div class="Main">
        <div class="Login">
            <div class="Lcard" data-aos="fade-right" data-aos-duration="750">

                <div class="starter">
                    <p class="Welcome">WELCOME</p>
                    <p class="LetsStart">Lets get started !</p>
                </div>
                <form action="SignUp.php" method="post" class="ColHolder">
                    <div class="Rows">
                        <div class="i1">
                            <label for="text" class="Lploc">First
                                Name</label><br>
                            <input type="text" name="namef" class="Ploc5" id="namef" placeholder="David" required>
                            <p id="fnerr">ERROR</p>
                        </div>
                        <div class="i1">
                            <label for="text" class="Lploc">Last
                                Name</label><br>
                            <input type="text" name="namel" class="Lname" id="namel" placeholder="Johnson" required>
                            <p id="lnerr">ERROR</p>
                        </div>
                    </div>
                    <div class="Rows">
                        <div class="i1">
                            <label for="text" class="Lploc">Phone
                                Number</label><br>
                            <input type="text" name="number" class="Number" id="number" placeholder="123-456-7890" required>
                            <p id="pnerr">ERROR</p>
                        </div>
                        <div class="i1">
                            <label for="text" class="Lploc">Email</label><br>
                            <input type="text" name="umail" class="Email" id="umail" placeholder="example@example.com" required>
                            <p id="umerr">ERROR</p>
                        </div>
                    </div>
                    <div class="Rows">

                        <div class="i1">
                            <label for="password" class="Lploc">Password</label><br>
                            <div class="PassInput">
                                <input type="password" name="upass" class="pass" id="upass" placeholder="*******" required>
                                <img src="icon/closeeye.png" alt="" width="23px" id="closeEye">
                                <?php
                                if (!empty($error)) { ?>
                                    <p><?php echo $error; ?></p>
                                <?php } ?>

                            </div>

                        </div>
                        <div class="i1">
                            <label for="password" class="Lploc">Confirm Password</label><br>
                            <div class="PassInput">
                                <input type="password" name="pass1" class="pass" id="pass1" placeholder="******" required>
                                <img src="icon/closeeye.png" alt="" width="23px" id="closeEye1">
                                <p id="cperr">ERROR</p>
                            </div>
                        </div>

                    </div>


                    <div class="RowBtn">
                        <input type="submit" class="upbtn" value="Sign Up">
                        <div class="ORline">
                            <hr style="height:2px;width: 80px; border-width:0;color:gray;background-color:gray">
                            <p class="or">or</p>
                            <hr style="height:2px;width: 80px;border-width:0;color:gray;background-color:gray">
                        </div>
                        <div class="google">
                            <p>Already Have An Account ? <span onclick="window.location.href='SignIn.php'">Sign Up</span></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="CarB" data-aos="fade-left" data-aos-duration="750">
            <img src="icon/signupSUV.png" alt="" class="SUV">
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