<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reviwes</title>
    <style>
        td{
            border: black solid 1px;
            width: 100px;
            height: 20px;
            text-align: center;
        }
    </style>
    <?php
    session_start();
    if(!$_SESSION['is_logged_in']){
        header("Location: Login.php");
    }

    
    $reviews = array();
    $reviews[] = array("name"=>"elyashiv","content"=>"the code is nice","rating"=>5);
    $reviews[] = array("name"=>"yehuda","content"=>"best version so far","rating"=>8);
    if(isset($_GET['submit_btn']) && $_GET['submit_btn']=="1"){
        $name = $_GET['name'];
        $content = $_GET['content'];
        $rating = $_GET['rating'];
        $reviews[] = array("name"=>$name,"content"=>$content,"rating"=>$rating);
    }   
    ?>
</head>
<body>
    <form action="" method="get">
        <lable for="name">name: <input id="name" name="name" type="text"></lable>
        <br>
        <lable for="content">content: <input id="content" name="content" type="text"></lable>
        <br>
        <lable for="rating">rating: <input id="rating" name="rating" type="number"></lable>
        <br>
        <label for="submit_btn"> <button name="submit_btn" value="1">submit</button> </label>
    </form>
    <table>
        <thead>
        <th>name</th>
        <th>reviews text</th>
        <th>rating</th>
        </thead>
        <tbody>
            <?php
            foreach($reviews as $obj => $index){
                echo "<tr>";
                echo "<td>" . $index['name'] . "</td>";
                echo "<td>" . $index['content'] . "</td>";
                echo "<td>" . $index['rating'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>