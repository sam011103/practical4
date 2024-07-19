<!DOCTYPE html>
<html>
<head>
<title>Aroma Coffee</title>
</head>

<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<body>
<?php include('../include/header.php');?>
<?php include('../include/navigation.php');?>

<h2>Cake Menu</h2>
<?php
    require('env.php');
    $conn=mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    if(!$conn)
    {
        die("Connection Error :".mysqli_connect_error());
    }
    $cakeQuery="SELECT * FROM cake ORDER BY id";
    $cakeResult=mysqli_query($conn,$cakeQuery);
    if(mysqli_num_rows($cakeResult)>0)
    {
        echo "
            <form action='itemDetails.php' method='POST'>
                <table>
                    <caption>Cake</caption>
                <tr>
                    <th>Id</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Price</th>
                </tr>
            ";

        while(($row=mysqli_fetch_assoc($cakeResult)))
        {
            {
                echo "
                    <tr>
                        <td>{$row['id']}</td>
                        <td><img src='img/{$row['image']}' height='200' width='300'></td> 
                        <td>
                            <input type='submit' name='cake' id='cake' value='{$row['title']}'>
                        </td>
                        <td>RM{$row['price']}</td>
                    <tr>
                ";
            }
        }
        echo "</table>";
    }
    else
        echo "No cake is found.<br>";
?>

<?php include('../include/footer.php');?>
</body>
</html>