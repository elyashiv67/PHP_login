<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>register</title>
<style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
            padding: 20px;
        }

        form {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        label {
            font-weight: 500;
            color: #333;
            font-size: 14px;
            margin-bottom: -4px;
        }

        input {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        input[type="submit"] {
            padding: 11px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }

        input[type="submit"]:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        br {
            display: none;
        }
    </style>
<?php
    function console_log($output) {
    $js_code = 'console.log(' . json_encode($output) . ');';
    echo '<script>' . $js_code . '</script>';
    }
    ?>

<?php
    if(isset($_POST['Register'])){
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '';
        $db_schema = 'php_class';
        $mysqli = new mysqli($db_host, $db_user, $db_pass, $db_schema);
        if($mysqli->connect_errno){
            die("Connection failed: " . $mysqli->connect_error);
        }else{
            console_log("Connected successfully");
        }
    $name = $_POST['name'];
    $username = $_POST['username'];
    $password = md5("salt" . $_POST['password'] . "another_salt");
    $query = "INSERT INTO users (name, user_name, pass) VALUES ('$name', '$username', '$password')";
    $result = mysqli_query($mysqli,$query);
    console_log($result);

    mysqli_close($mysqli);
    }
    ?>
<body>
    <form action="" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" name="Register" value="Register">
    </form>
</body>
</html>