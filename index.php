<?php
session_start();
if(isset($_SESSION['public_key']) && isset($_SESSION['loggedin']) ==true){
    header("location: main.php");
  }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>StudiTalk App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-decoration: none;
            font-family: 'Poppins', sans-serif;
        }

        .btn-space {
            margin-left: 8px;
        }

        .container1 {
            width: 65%;
            left: 50%;
            height: 83vh;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            border-radius: 16px;


            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        .box-head {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 40vh;


        }

        .box {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
            height: 10vh;
        }

        .buttons {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 50px;
        }


        .type-box {
            height: 3rem;

            /*This part is important for centering*/
            display: flex;
            /* align-items: center; */
            justify-content: center;
            flex-wrap: wrap;
        }

        .typing-demo {
            width: 22ch;
            animation: typing 2s steps(22), blink .5s step-end infinite alternate;
            white-space: nowrap;
            overflow: hidden;
            border-right: 3px solid;
            font-size: 2em;
            max-width: fit-content;
            display: flex;
            flex-wrap: wrap;
        }

        @keyframes typing {
            from {
                width: 0
            }
        }

        @keyframes blink {
            50% {
                border-color: transparent
            }
        }

        .footer {
            background-color: black;
            height: 3rem;
            width: 100%;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .github a {
            text-decoration: none;
        }

        .github {

            margin: auto;
            width: 30%;
            margin-top: 5%;
        }

        @media screen and (max-width:480px) {
            .container1 {
                width: 100%;
                height: 50vh;
            }

            .box {
                width: 80%;
                text-align: center;
            }

            .github {
                width: 65%;
                margin-top: 15%;
            }
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">StudiTalk</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="termscondition.html">Terms & Conditions</a>
                    </li>
                </ul>
                <div class="d-flex ">
                    <a href="signup.php" class="btn btn-outline-secondary btn-space">Signup</a>

                    <a href="login.php" class="btn btn-outline-secondary btn-space">login</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container1">
        <div class="type-box">
            <div class="typing-demo">
                Welcome to StudiTalk!
            </div>
        </div>
        <div class="box">
            Connect with students according to your preferences!
        </div>
        <div class="buttons">
            <a href="signup.php" class="btn btn-outline-dark btn-space">Signup</a>

            <a href="login.php" class="btn btn-outline-dark btn-space">login</a>
        </div>
        <!-- <div class="github">
            <a href="https://github.com/Aman-tamboli/chatapp" target="_blank"> Follow Our Code On GitHub
                <i class="fab fa-github"></i></a>
        </div> -->
    </div>
    <div class="footer">
        &copy; 2022
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>

</html>