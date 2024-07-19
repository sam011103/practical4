<?php

include "../connection.php"; // Using database connection file here

session_start();
	

$id = $_SESSION["loggedin"];

$pid = $_GET['id']; // get id through query string

$del = mysqli_query($connect,"DELETE from cart where cart_ID = '$pid' AND cart_CustomerID = '$id'"); // delete query

if($del)
{
    mysqli_close($connect); // Close connection
    header("location:cart.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>