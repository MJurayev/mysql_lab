<?php
$waitTime=6;
header( "refresh:".$waitTime.";url=pupils.php");

?>
<!DOCTYPE html>
<html lang="uz">
    <head>
        <title> DDOS protection</title>
        <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
        <style>
            .wrapper{
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100vh;
                background: black;
            }
            .box{
                display: flex;
                flex-direction: column;
                align-items: center;
                color: white;

                font-size: 38px;
            }
            .box h1{
                color: red;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="box">
                <h1>
                    DDOS protection!!!
                </h1>
                <h4>
                    <span id="timer"><?=$waitTime-2 ?></span> sekunddan keyin sahifaga yo'naltiriladi!
                </h4>
                <h6 id="loader">

                </h6>
            </div>
        </div>
    </body>
    <script>
        var timer = document.getElementById('timer');
        var time = timer.innerHTML;
        var loader = document.getElementById('loader');
        var timer2 = setInterval(()=>{
            timer.innerHTML = time;
            time--;
            if(timer.innerHTML==0){
                clearInterval(timer2);
                loader.innerHTML = "Yo'naltirilmoqda....";
            }
        }, 1000);
    </script>
    <script src="assets/vendor/jquery/jquery.slim.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/vendor/popper/popper.min.js"></script>
</html>