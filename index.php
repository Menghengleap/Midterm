<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1e1e2e;
            color: #c2c2d6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }

        .navbar {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            display: flex;
            justify-content: space-between;
            padding: 15px 50px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .navbar a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            transition: color 0.3s ease;
        }

        .navbar a:hover {
            color: #a4b0f5;
        }

        h1 {
            background: linear-gradient(to right, #8a2387, #e94057, #f27121);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #292940;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .footer {
            background: #242634;
            color: #68697f;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        .button {
            background-color: #8f94fb;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #a4b0f5;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Contact</a>
    </nav>

    <h1>REST API</h1>

    <div class="container">
        <p>Welcome to our REST API service. We offer a modern, sleek, and efficient way to handle your API needs. Browse our site to learn more about what we can offer you.</p>
        <button class="button">Get Started</button>
    </div>

    <footer class="footer">
        © 2024. All rights reserved.
    </footer>
</body>

</html>
