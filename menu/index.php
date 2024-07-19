<!DOCTYPE html>
<html>
<head>
<title>Aroma Coffee</title>
</head>

<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<body>
<?php include('C:/wamp64/www/AromaCoffee/include/header.php');?>
<?php include('C:/wamp64/www/AromaCoffee/include/navigation.php');?>



<br><br>
<article>
    <b><i>
       Menu
</b></i>
<br><br><br>
<?php
    require("env.php");
    $conn=mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME);
    if(!$conn)
    {
        die("Connection Error :".mysqli_connect_error());
    }
    $self=htmlspecialchars($_SERVER["PHP_SELF"]);
    echo "
        <form action='$self' method='POST' id='form-filter'>
            Search :
            <input type='text' name='search' id='search'>
            <input type='submit' name='filter' value='Search'>
        </form>
        <br>
    ";
    if(isset($_POST['search']))
            $search=$_POST['search'];
    if(!empty($_POST['addCart']))
    {
        session_start();
        if(isset($_POST['id']))
            $_SESSION['cart']['id']=$_POST['id'];
        if(isset($_POST['title']))
            $_SESSION['cart']['title']=$_POST['title'];
        if(isset($_POST['price']))
            $_SESSION['cart']['price']=$_POST['price'];
        if(isset($_POST['quantity']))
            $_SESSION['cart']['quantity']=$_POST['quantity'];
        if(isset($_POST['totalPrice']))
            $_SESSION['cart']['totalPrice']=$_POST['totalPrice'];
        if(isset($_POST['remarks']))
            $_SESSION['cart']['remarks']=$_POST['remarks'];
        if(isset($_POST['temperature']))
            $_SESSION['cart']['temperature']=$_POST['temperature'];
        if(empty($_SESSION['cart']['temperature']))
            echo "{$_SESSION['cart']['title']} X {$_SESSION['cart']['quantity']} is added into cart.";
        else
            echo "{$_SESSION['cart']['title']} ({$_SESSION['cart']['temperature']}) X {$_SESSION['cart']['quantity']} is added into cart.";
    }
    elseif(!empty($search)) 
    {
        echo "<form action='itemDetails.php' method='POST'>";
        $searchCakeQuery="SELECT * FROM cake WHERE id=? OR title=? OR price=? ORDER BY id";
        $searchCakeStmt=mysqli_prepare($conn,$searchCakeQuery);
        mysqli_stmt_bind_param($searchCakeStmt,"sss",$search,$search,$search);
        if(mysqli_stmt_execute($searchCakeStmt))
        {
            $searchCakeResult=mysqli_stmt_get_result($searchCakeStmt);
            if(mysqli_num_rows($searchCakeResult)>0)
            {
                echo "
                        <table>
                            <caption>Cake</caption>
                        <tr>
                            <th>Id</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Price</th>
                        </tr>
                    ";

                while(($row=mysqli_fetch_assoc($searchCakeResult)))
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
                echo "</table>";
            }
        }
              
        $searchCoffeeQuery="SELECT * FROM coffee WHERE id=? OR title=? OR hotPrice=? OR coldPrice=? ORDER BY id";
        $searchCoffeeStmt=mysqli_prepare($conn,$searchCoffeeQuery);
        mysqli_stmt_bind_param($searchCoffeeStmt,"ssss",$search,$search,$search,$search);
        if(mysqli_stmt_execute($searchCoffeeStmt))
        {
            $searchCoffeeResult=mysqli_stmt_get_result($searchCoffeeStmt);
            if(mysqli_num_rows($searchCoffeeResult)>0)
            {
                echo"
                    <table>
                        <caption>Coffee</caption>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                    </tr>
                ";

                while(($row=mysqli_fetch_assoc($searchCoffeeResult)))
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
                echo "</table>";
            }
        }

        $searchJuiceQuery="SELECT * FROM juice WHERE id=? OR title=? OR price=? ORDER BY id";
        $searchJuiceStmt=mysqli_prepare($conn,$searchJuiceQuery);
        mysqli_stmt_bind_param($searchJuiceStmt,"sss",$search,$search,$search);
        if(mysqli_stmt_execute($searchJuiceStmt))
        {
            $searchJuiceResult=mysqli_stmt_get_result($searchJuiceStmt);
            if(mysqli_num_rows($searchJuiceResult)>0)
            {
                echo"
                    <table>
                        <caption>Juice</caption>
                    <tr>
                        <th>Id</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Price</th>
                    </tr>
                ";

                while(($row=mysqli_fetch_assoc($searchJuiceResult)))
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
                echo "</table>";
            }
            echo "</form>";
        }    
    }
    elseif(empty($search))
    {
        echo "Please enter some keywords (Eg. title, id, or price) or select category to search.<br>";
    }          
?>
<?php include('C:/wamp64/www/AromaCoffee/include/footer.php');?>
</body>
</html>