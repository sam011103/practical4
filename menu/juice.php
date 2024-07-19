<!DOCTYPE html>
<html>
<head>
<title>Aroma Coffee</title>
</head>

<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<body>
<?php include('C:/wamp64/www/AromaCoffee/include/header.php');?>
<?php include('C:/wamp64/www/AromaCoffee/include/navigation.php');?>

<h2>Juice Menu</h2>
<?php
    require('env.php');
    $conn=mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    if(!$conn)
    {
        die("Connection Error :".mysqli_connect_error());
    }
    $juiceQuery="SELECT * FROM juice ORDER BY id";
    $juiceResult=mysqli_query($conn,$juiceQuery);

    if(mysqli_num_rows($juiceResult)>0)
    {
        echo"
            <form action='itemDetails.php' method='POST'>
                <table>
                    <caption>Juice</caption>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            ";

        while(($row=mysqli_fetch_assoc($juiceResult)))
        {
            echo"
                <tr>
                    <td>{$row['id']}</td>
                    <td><img src='img/{$row['image']}' height='200' width='300'></td> 
                    <td>
                        <input type='submit' name='juice' id='juice' value='{$row['title']}'>
                    </td>
                    <td>RM{$row['price']}</td>
                <tr>
            ";
        }
        echo "
            </table>
        </form>
        ";

    }
    else
        echo "No juice is found.<br>";
?>
<?php include('C:/wamp64/www/AromaCoffee/include/footer.php');?>
</body>
</html>