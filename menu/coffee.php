<!DOCTYPE html>
<html>
<head>
<title>Aroma Coffee</title>
</head>

<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<body>
<?php include('C:/wamp64/www/AromaCoffee/include/header.php');?>
<?php include('C:/wamp64/www/AromaCoffee/include/navigation.php');?>

<h2>Coffee Menu</h2>
<?php
    require('env.php');
    $conn=mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    if(!$conn)
    {
        die("Connection Error :".mysqli_connect_error());
    }
    $coffeeQuery="SELECT * FROM coffee ORDER BY id";
    $coffeeResult=mysqli_query($conn,$coffeeQuery);

    if(mysqli_num_rows($coffeeResult)>0)
    {
        echo"
            <form action='itemDetails.php' method='POST'>
                <table>
                    <caption>Coffee</caption>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            ";

        while(($row=mysqli_fetch_assoc($coffeeResult)))
        {
            echo"
                <tr>
                    <td>{$row['id']}</td>
                    <td><img src='img/{$row['image']}' height='200' width='300'></td>  
                    <td>
                        <input type='submit' name='coffee' id='coffee' value='{$row['title']}'>
                    </td>
                    <td>
                        <ul style='background-color: #dfc7b9;'>
                            <li>RM{$row['hotPrice']} (Hot)</li>
                            <li>RM{$row['coldPrice']} (Cold)</li>
                        </ul>
                    </td>
                <tr>
            ";
        }
        echo "
            </table>
        </form>
        ";

    }
    else
        echo "No coffee is found.<br>";
?>
<?php include('C:/wamp64/www/AromaCoffee/include/footer.php');?>
</body>
</html>