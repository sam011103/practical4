<?php
$connect = mysqli_connect("localhost", "root", "", "aromacoffee");

if($connect)
{
	$output = "<script>console.log('Connect successfully!');</script>";
}
echo($output);
?>
