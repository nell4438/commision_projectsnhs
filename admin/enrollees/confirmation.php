<!DOCTYPE html>
<html>

<head>
    <title>Confirm Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            margin: 50px auto;
            max-width: 500px;
            text-align: center;
            padding: 30px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-size: 28px;
            color: #333;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
            color: #666;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            padding: 12px 24px;
            text-decoration: none;
            transition: background-color 0.3s ease-in-out;
        }

        .button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- <h2>{{ $control }}</h2> -->
        <h1>SNHS MAIN CAMPUS ONLINE ENROLLMENT SYSTEM NOTIFICATION</h1>

        <p>Congratulations <strong><?php echo htmlspecialchars($studName); ?></strong>, you are now <strong style="color:green">Enrolled</strong> in Grade <?php echo htmlspecialchars($studYearLevel) . " " . htmlspecialchars($studSection); ?> at SNHS Main Campus</p>
        <h6>PLEASE DO NOT REPLY</h6>
    </div>
</body>

</html>