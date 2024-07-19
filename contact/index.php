<!DOCTYPE HTML>
<html>  
<head>
<title>Contact Us
</title>


</head>
<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<style>
  p{
    margin-bottom:20px;
    text-align:center;
    
  }
  form{
    margin-left :550px;
    width: 320px;
    border : 2px solid brown;
    
    
  }
</style>

<body>
<?php include('C:/wamp64/www/AromaCoffee/include/header.php'); ?>
<?php include('C:/wamp64/www/AromaCoffee/include/navigation.php'); ?>
<h1 style="text-align:center">Contact Us</h1>
    <p>Find us at Sungai Long or call us at 012-369852147</p>
    <p ><strong>Ask for today's special or just send us a message:</strong></p>
    <form action="post-message.php" target="_blank">
      <p style="text-align:left;">Name        :<input  type="text" placeholder="Name" name="Name"></p>
      <p style="text-align:left;">Phone       :<input  type="text" placeholder="PhoneNo." name="Phone"></p>
      Gender:
      <input  type="radio" name="gender" value="male">Male
      <input  type="radio" name="gender" value="female">Female
      <p style="text-align:left;">Email       :<input  type="text" placeholder="Email" name="Email"></p>

      <p style="text-align:left;">Message:<input  type="text" placeholder="Left something for us" required name="Message"></p>
      <p><button type="submit">SEND MESSAGE</button></p>
    </form>
    <br>
<?php include('C:/wamp64/www/AromaCoffee/include/footer.php'); ?>
</body>
</html>