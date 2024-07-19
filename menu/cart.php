<?php 
include("../connection.php");

$prod_cod = "";
$qty = "";
session_start();

/*store session user id into a variable*/

$id = $_SESSION["loggedin"];


///*update quantity product in cart after change quntity*/
//if (isset($_POST['action']) && $_POST['action']=="change")
//{
//	$pid = $_POST["Prod_ID"];
//	$sql_qty = mysqli_query($connect,"SELECT * FROM cart WHERE Part_ID = '$pid' OR PC_ID = '$pid' AND Customer_ID = '$pid' AND Payment_ID IS NULL");	
//
//    $result_qty = mysqli_fetch_assoc($sql_qty);
//  
//	$qty = $_POST["quantity"];
//
//	mysqli_query($connect,"UPDATE cart SET Qty = $qty WHERE Customer_ID = '$id' AND Part_ID = '$pid' OR PC_ID = '$pid' AND Payment_ID IS NULL");
//
//}

?>
<link href= '/AromaCoffee/style/mystyle.css' rel='stylesheet' type='text/css'>

<!DOCTYPE html>
<html lang="en">
<head>
<!-- basic -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- mobile metas -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">
<!-- site metas -->
<title>Cart</title>
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="author" content="">
<!-- site icons -->
<link rel="icon" href="images/JIT logo-light.png" type="image/gif" />
<!-- bootstrap css -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<!-- Site css -->
<link rel="stylesheet" href="css/style.css" />
<!-- responsive css -->
<link rel="stylesheet" href="css/responsive.css" />
<!-- colors css -->
<link rel="stylesheet" href="css/colors1.css" />
<!-- wow Animation css -->
<link rel="stylesheet" href="css/animate.css" />
<!-- zoom effect -->
<link rel='stylesheet' href='css/hizoom.css'>
<!-- end zoom effect -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>
<body id="default_theme" class="it_serv_shopping_cart shopping-cart">

<!-- header -->
<header id="default_header" class="header_style_1">
  <!-- header top -->
  <div class="header_top">
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <div class="full">
            <div class="topbar-left">
            </div>
          </div>
        </div>

<?php
/* if user login show user profile and log out*/
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true)
{
	
?>
	<div class="col-md-4 right_section_header_top">
	<div class="float-right">
	<div class="make_appo">
	<a  href="../login.php" ><button class="btn white_btn"><b>Log in here</b></button></a> 
	</div>
	</div>
	</div>
<?php
}

else
{
	
?>
	<div class="col-md-4 right_section_header_top">
	<div class="float-right">
	<div class="make_appo">

	</div>
	</div>
	</div>
<?php				
}
?>
			
      </div>
    </div>
  </div>
  <!-- end header top -->
  <!-- header bottom -->
  <div class="header_bottom">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
          <!-- logo start -->
          <div class="logo"> <a href="index.php"><img src="../logo.png" alt="logo" style="height:90px;"/></a> </div>
          <!-- logo end -->
        </div>
        <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
          <!-- menu start -->
          <div class="menu_side">
            <div id="navbar_menu">
			<ul class="first-ul">
			
				<?php
				/*count item in cart that belongs to this customer*/
				$num = mysqli_query($connect,"SELECT * FROM cart WHERE cart_CustomerID = '$id'  AND Payment_ID is null");
				$num_cart =  mysqli_num_rows($num);
				$cart_count = 0;
				if($cart_count!=0)
				{
					
				?>
			    <a href="../cart.php"><img src="images/cart.png" style="width:50px;">Cart<span><?php echo $cart_count; ?></span></a>
			   <?php
				}
				?>
				
				
            </ul>
            </div>
          </div>
          <!-- menu end -->
        </div>
      </div>
    </div>
  </div>
  <!-- header bottom end -->
</header>
<!-- end header -->
<!-- inner page banner -->
<div id="inner_banner" class="section inner_banner_section">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="full">
          <div class="title-holder">
            <div class="title-holder-cell text-left">
              <h1 class="page-title">Shopping Cart</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- end inner page banner -->
<div class="section padding_layout_1 Shopping_cart_section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 col-md-12">
        <div class="product-table">
	
          <table class="table">
            <thead>
              <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th class="text-center">Price</th>
				<th class="text-center">Remark</th>
                <th class="text-center">Total</th>
                <th> </th>
              </tr>
            </thead>

            <tbody>
			<?php		
			
				$total_price = 0;
				$total_pricepc = 0;
				$result = mysqli_query($connect,"SELECT * FROM cart WHERE cart_CustomerID = '$id' AND Payment_ID is null");
				/*show part select by customer*/
				while($result_cart = mysqli_fetch_assoc($result))
				{
					$prod_cod = $result_cart["cart_Product"];
					$prod_type = $result_cart["cart_Type"];
					$find_part = mysqli_query($connect,"SELECT * FROM $prod_type WHERE id = '$prod_cod' ");
					$row = mysqli_fetch_assoc($find_part);
					
				?>
              <tr>
                <td class="col-sm-8 col-md-6">
				<div class="media"> 
				<img class="media-object" src="img/<?php echo $row["image"]; ?>" style="width:150px; high:100px;/">
                    <div class="media-body">
                      <h4 class="media-heading"><?php echo $row["title"]; ?></h4>
                    </div>
                  </div>
				</td>
                <td class="col-sm-1 col-md-1" style="text-align: center">
				<form method='post' action=''>
				<input type='hidden' name='Prod_ID' value="<?php echo $row["id"]; ?>" />
				<input type='hidden' name='action' value="change" />
				
				</select>
			
				
				</form>
                </td>
				<td class="col-sm-1 col-md-1 text-center"><p class="price_table"><?php echo $result_cart["cart_Qty"]; ?></p></td>
                <td class="col-sm-1 col-md-1 text-center"><p class="price_table"><mark style="background-color: #CACFD2;"><?php echo "RM". number_format($result_cart["cart_Amount"],2); ?></mark></p></td>
                <td class="col-sm-1 col-md-1 text-center"><p class="price_table"><mark style="background-color: #CACFD2;"><?php echo "RM". number_format($result_cart["cart_Qty"] * $result_cart["cart_Amount"],2); ?></mark></p></td>
				 <td class="col-sm-1 col-md-1 text-center"><p class="price_table"><mark style="background-color: #CACFD2;"><?php echo $result_cart["cart_Remark"]; ?></mark></p></td>
                <td class="col-sm-1 col-md-1">
				
				<td><a href='../delete.php' ><button type="button" class="bt_main" id="<?php echo $result_cart["cart_ID"]; ?>">Remove</button></a></td>
				
				</td>
              </tr>
				<?php
				$total_price += (number_format($result_cart["cart_Qty"] * $result_cart["cart_Amount"],2));
				}
				
				?>
             
            </tbody>
          </table>
          <table class="table">
            <tbody>
              <tr class="cart-form">
                <td class="actions"><div class="coupon">
                    
                  </div>
                 
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shopping-cart-cart">
          <table>
            <tbody>
              <tr>
                <td><h3>Total</h3></td>
                <td class="text-right"><h4><?php echo "RM".number_format($total_price,2); ?></h4></td>
              </tr>
			  <?php
			  if($total_price == 0)
			  {
			  ?>
			  <tr>
                <td><a href="../index.php"><button type="button" class="button" >Continue Shopping</button><a></td>
			  </tr>
			  <?php
			  }
			  else
			  {
			  ?>
              <tr>
                <td><a href="../index.php"><button type="button" class="button" >Continue Shopping</button><a></td>
				        <td><a href="../order_process.php"><button class="button">Checkout</button></a></td>				  
              </tr>
			  <?php
			  }
			  ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- section -->

<script>
        $('.hi1').hiZoom({
            width: 300,
            position: 'right'
        });
        $('.hi2').hiZoom({
            width: 400,
            position: 'right'
        });
</script>

</body>
</html>
