<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>YNOTPHP</title>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

        <style>
            html, body {
                width: 100%;
                overflow-x: hidden;
            }
            body {
                background-color: #111114;
            }
            .container {
                padding: 15px;
            }
            .box {
                margin-top: 75px;
            }
            .logo {
                text-align: center;
            }
            .logo img {
                width: 400px;
            }
            .text {
                color: #9aabad;
                font-size: 25px;
                letter-spacing: 0.5px;
                font-family: 'Ubuntu', sans-serif;
                text-align: center;
                max-width: 70%;
                margin-right: auto;
                margin-left: auto;
            }
            .links {
                text-align: center;
            }
            .links a {
                color: #02bed4;
                font-size: 25px;
                letter-spacing: 0.5px;
                font-family: 'Ubuntu', sans-serif;
                text-align: center;
                font-weight: 300;
                letter-spacing: 1px;
                text-decoration: none;
            }
            .links a:nth-child(2) {
                margin-left: 20px;
                margin-right: 20px;
            }
            footer {
                bottom: 0;
                position: absolute;
                width: 100%;
            }
            footer p {
                color: #9aabad;
                text-align: center;
                font-size: 15px;
                letter-spacing: 0.5px;
                font-family: 'Ubuntu', sans-serif;
                text-align: center;
                font-weight: 300;
                letter-spacing: 1px;
            }
            footer p span {
                color: red;
            }
            footer p a {
                color: #02bed4;
                font-family: 'Ubuntu', sans-serif;
                text-decoration: none;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="box">
                <div class="logo">
                    <img src="<?php echo asset('images/logo.png'); ?>" alt="Logo Image" />
                </div>
                <div class="text">
                    <p>YNOTPHP is a developer-friendly lightweight php framework. This framework can be used for any projects and developer can modify it as much as he wants since it has no complicated core. Every element in this project can be modified by developers.</p>
                </div>
                <div class="links">
                    <a href="http://bhaswanth.com/" target="_blank">Author</a>
                    <a href="https://github.com/bhaswanth53/ynotphp" target="_blank">Github Repository</a>
                    <a href="https://github.com/bhaswanth53/ynotphp/blob/master/readme.md" target="_blank">Documentation</a>
                </div>
            </div>
        </div>
        <footer>
            <p>Made with <span>&hearts;</span> by <a href="http://bhaswanth.com/" target="_blank">Bhaswanth Chiruthanuru</a></p>
        </footer>
    </body>
</html>