<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Special Question</title>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            text-align: center;
            position: relative;
            max-width: 600px;
        }

        h1 {
            margin-bottom: 40px;
            font-family: 'Dancing Script', cursive;
            font-size: 2.5em;
        }

        .btn {
            cursor: pointer;
            border: none;
            outline: none;
            width: 150px;
            padding: 15px;
            border-radius: 25px;
            font-size: 20px;
            margin: 20px;
            position: relative;
            z-index: 2;
        }

        .btn-yes {
            background-color: #4CAF50;
            color: white;
        }

        .btn-no {
            background-color: #f44336;
            color: white;
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Will you be my girlfriend?</h1>
        <button class="btn btn-yes" onclick="replyYes()">Yes</button>
        <button class="btn btn-no" id="noButton">No</button>
    </div>

    <script>
        function replyYes() {
            alert("I love you, emeii!");
        }

        const noBtn = document.getElementById('noButton');
        noBtn.onclick = function() {
            const newX = Math.random() * (window.innerWidth - this.clientWidth);
            const newY = Math.random() * (window.innerHeight - this.clientHeight);
            this.style.transform = `translate(${newX}px, ${newY}px)`;
        };
    </script>
</body>
</html>
