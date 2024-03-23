<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REST API</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            color: #333;
        }

        /* Navbar Styles */
        .navbar {
            background: linear-gradient(to right, #4e54c8, #8f94fb);
            display: flex;
            justify-content: space-between;
            align-items: center;
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

        /* Main Header Styles */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding: 20px;
            background: linear-gradient(to right, #8a2387, #e94057, #f27121);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Main Container Styles */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .container p {
            margin-bottom: 20px;
        }

        .container .button {
            display: block;
            width: 200px;
            margin: 0 auto;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #4e54c8;
            color: #fff;
            font-size: 16px;
            text-align: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .container .button:hover {
            background-color: #8f94fb;
        }

        /* Footer Styles */
        .footer {
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px 0;
            margin-top: 20px;
        }

        .footer p {
            margin-bottom: 10px;
        }

        .footer .social-icons a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 20px;
            transition: color 0.3s ease;
        }

        .footer .social-icons a:hover {
            color: #8f94fb;
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

    <header class="header">
        <h1>REST API</h1>
    </header>

    <div class="container">
        <p>Welcome to our REST API service. We offer a modern, sleek, and efficient way to handle your API needs. Browse our site to learn more about what we can offer you.</p>
        <button class="button">Get Started</button>
    </div>

    <footer class="footer">
        <p>© 2024. All rights reserved.</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
        </div>
    </footer>
</body>

</html>
