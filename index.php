<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Be My Girlfriend?</title>
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
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
        }

        .btn {
            cursor: pointer;
            border: none;
            outline: none;
            width: 100px;
            padding: 10px;
            border-radius: 5px;
            font-size: 18px;
            margin: 10px;
        }

        .btn-yes {
            background-color: #4CAF50;
            color: white;
        }

        .btn-no {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Will you be my girlfriend?</h1>
        <button class="btn btn-yes" onclick="replyYes()">Yes</button>
        <button class="btn btn-no" onclick="replyNo()">No</button>
    </div>

    <script>
        function replyYes() {
            alert("I love you, emeii!");
        }

        function replyNo() {
            alert("Bann ai mnus akrok");
        }
    </script>
</body>
</html>
