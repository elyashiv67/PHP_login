<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        .wrapper {
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 320px;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .wrapper label {
            display: flex;
            flex-direction: column;
            gap: 6px;
            font-weight: 500;
            color: #333;
            font-size: 14px;
        }

        .wrapper input {
            padding: 10px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .wrapper input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .wrapper button {
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

        .wrapper button:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.4);
        }

        .wrapper button:active {
            transform: translateY(0);
        }
    </style>
<?php
    function console_log($output) {
    $js_code = 'console.log(' . json_encode($output) . ');';
    echo '<script>' . $js_code . '</script>';
    }
    ?>
<?php
    if(isset($_GET['send'])){
    session_start();
    $err_log = (isset($_SESSION['err_log'])) ? $_SESSION['err_log'] : 0;
    $err_msg = "you are locked out";
        $_SESSION['err_log'] = $err_log;
        $name = addslashes($_GET['name']);
    $password = md5("salt" . $_GET['password'] . "another_salt");
        
        //פתיחה והתחברות למסד נתונים
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

        //שליחת פקודה למסד נתונים
        $query = "SELECT * FROM users WHERE name = '$name' AND pass = '$password'";

        //קבלת התשובה
        $result = mysqli_query($mysqli,$query);

        //המידע שביקשתי ישמר במערך אסוציאטיבי במשתנה הזה
        $row = mysqli_fetch_assoc($result);
        console_log($row);
        if($row == null){
            console_log('not logged in');
            if($err_log >= 3){
               console_log($err_msg);
            }
            $err_log++;
            $_SESSION['err_log'] = $err_log;
        }else if($name == $row['name'] && $password == $row['pass']){
            console_log('logged in');
            $_SESSION['err_log'] = 0;
        }
        console_log($err_log);
        //סגירת החיבור למסד נתונים
        mysqli_close($mysqli);
     }

    ?>
</head>
<body>
    <form action="">
        <div class="wrapper">
            <label for="name">Name
                <input type="text" id="name" name="name" placeholder="Enter your name">
            </label>
            <label for="password">Password
                <input type="password" id="password" name="password" placeholder="Enter your password">
            </label>
            <button name="send" type="submit" id="loginBtn">Login</button>
        </div>
    </form>
</body>
</html>