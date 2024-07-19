<!DOCTYPE html>
<html>
<head>
<title>Aroma Coffee</title>
</head>

<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<body>
<?php include('../include/header.php');?>
<?php include('../include/navigation.php');?>
<?php
	session_start();
    require("env.php");
    if($_SERVER['REQUEST_METHOD']==='POST')
    {
        $conn=mysqli_connect(DBHOST,DBUSER,DBPASSWORD,DBNAME);
        if(!$conn)
            die("Connection Error :".mysqli_connect_error());
        else
        {
			if(isset($_POST['addCart']))
			{
				$proid =$_POST['id'];
				$protype = $_POST['type'];
				$prototal = $_POST['price'];
				$proquantity = $_POST['quantity'];
				$insertquery =  "INSERT INTO `cart`(`cart_Product`, `cart_Type`, `cart_Qty`,`cart_Amount`, `cart_CustomerID`) VALUES ('".$proid."','".$protype."','".$proquantity."','".$prototal."','".$_SESSION['loggedin']."')";
				echo $insertquery;
				if($stmt = mysqli_prepare($conn, $insertquery))
				{
					// Bind variables to the prepared statement as parameters
					// Attempt to execute the prepared statement
					if(mysqli_stmt_execute($stmt))
					{
						// Redirect to login page
						header("location: cart.php");
					}

					else
					{
						echo "Something went wrong. Please try again later.";
					}

					// Close statement
					mysqli_stmt_close($stmt);
				}
				
			}

            if(isset($_POST['cake']))
            {
                $cake=$_POST['cake'];
                $cakeQuery="SELECT * FROM cake WHERE title='$cake' LIMIT 1";
                $cakeResult=mysqli_query($conn,$cakeQuery);
                if(!empty($cakeResult))
                {
                    while($row=mysqli_fetch_assoc($cakeResult))
                    {
                        echo "
                            <form method='POST'>
                                <h1>{$row['id']} {$row['title']}</h1>
                                <img src='img/{$row['image']}' height='400' width='500'>
                                <p>{$row['description']}</p>
                                Price: RM{$row['price']}
                                <br>
                                Quantity: 
                                <input type='number' id='quantity' name='quantity' min='1' max='10'value='1' onchange='calculateTotalPrice(this)'>
                                <br>
                                Total Price: 
                                <input type='text' id='totalPrice' name='totalPrice' value='{$row['price']}' readonly>
                                <br>
                                Remarks:
                                <textarea id='remarks' name='remarks' rows='4' cols='50'></textarea>
                                <br>
                                <input type='submit' id='addCart' name='addCart' value='Add to cart'>
                                <input type='hidden' id='id' name='id' value='{$row['id']}'>
								<input type='hidden' id='type' name='type' value='cake'>
                                <input type='hidden' id='title' name='title' value='{$row['title']}'>
                                <input type='hidden' id='price' name='price' value='{$row['price']}'>
                            </form>
                        ";//hidden is to submit value to session
                    }
                }
            }
            elseif(isset($_POST['coffee']))
            {
                $coffee=$_POST['coffee'];
                $coffeeQuery="SELECT * FROM coffee WHERE title='$coffee' LIMIT 1";
                $coffeeResult=mysqli_query($conn,$coffeeQuery);
                if(!empty($coffeeResult))
                {
                    while($row=mysqli_fetch_assoc($coffeeResult))
                    {
                        echo "
                            <form  method='POST'>
                                <h1>{$row['id']} {$row['title']}</h1>
                                <img src='img/{$row['image']}' height='400' width='500'>
                                <p>{$row['description']}</p>
                                Price 
                                <br>
                                <input type='radio' id='temperature' name='temperature' value='Hot' onclick='setTemperature(this)'>Hot RM{$row['hotPrice']}
                                <br>
                                <input type='radio' id='temperature' name='temperature' value='Cold' onclick='setTemperature(this)'>Cold RM{$row['coldPrice']}
                                <br>
                                Quantity: 
                                <input type='number' id='quantity' name='quantity' min='1' max='10' value='1' onchange='calculateTotalPrice(this)'>
                                <br>
                                Total Price: 
                                <input type='text' id='totalPrice' name='totalPrice' readonly>
                                <br>
                                Remarks:
                                <textarea id='remarks' name='remarks' rows='4' cols='50'></textarea>
                                <br>
                                <input type='submit' id='addCart' name='addCart' value='Add to cart'>
                                <input type='hidden' id='id' name='id' value='{$row['id']}'>
								<input type='hidden' id='type' name='type' value='coffee'>
                                <input type='hidden' id='title' name='title' value='{$row['title']}'>
                                <input type='hidden' id='hotPrice' name='hotPrice' value='{$row['hotPrice']}'>
                                <input type='hidden' id='coldPrice' name='coldPrice' value='{$row['coldPrice']}'>
                                <input type='hidden' id='price' name='price'>
                            </form>
                        ";
                    }
                }
            }
            elseif(isset($_POST['juice']))
            {
                $juice=$_POST['juice'];
                $juiceQuery="SELECT * FROM juice WHERE title='$juice' LIMIT 1";
                $juiceResult=mysqli_query($conn,$juiceQuery);
                if(!empty($juiceResult))
                {
                    while($row=mysqli_fetch_assoc($juiceResult))
                    {
                        echo "
                            <form  method='POST' id='form-desc'>
                                <h1>{$row['id']} {$row['title']}</h1>
                                <img src='img/{$row['image']}' height='400' width='500'>
                                <p>{$row['description']}</p>
                                Price: RM{$row['price']}
                                <br>
                                Quantity: 
                                <input type='number' id='quantity' name='quantity' min='1' max='10'value='1' onchange='calculateTotalPrice(this)'>
                                <br>
                                Total Price: 
                                <input type='text' id='totalPrice' name='totalPrice' value='{$row['price']}' readonly>
                                <br>
                                Remarks:
                                <textarea id='remarks' name='remarks' rows='4' cols='50'></textarea>
                                <br>
                                <input type='submit' id='addCart' name='addCart' value='Add to cart'>
                                <input type='hidden' id='id' name='id' value='{$row['id']}'>
								<input type='hidden' id='type' name='type' value='juice '>
                                <input type='hidden' id='title' name='title' value='{$row['title']}'>
                                <input type='hidden' id='price' name='price' value='{$row['price']}'>
                            </form>
                        ";//hidden is to submit value to session
                    }
                }
            }
        }  
    }
	
	
	
?>

        <script>
            
            function calculateTotalPrice(quantity)
            {
                const price=document.getElementById('price');
                const totalPrice=document.getElementById('totalPrice');
                if(price.value==0)
                    alert("Please select either hot or cold first.")
                else
                    totalPrice.value=quantity.value*price.value;
            }

            function setTemperature(radio)
            {
                const hotPrice=document.getElementById('hotPrice');
                const coldPrice=document.getElementById('coldPrice');
                const price=document.getElementById('price');
                if(radio.value=='Hot')
                    price.value=hotPrice.value;
                else if(radio.value=='Cold')
                    price.value=coldPrice.value;
            }
                
        </script>
        <?php include('../include/footer.php');?>
    </body>
</html>