<?php
session_start();
include('deteb.php');
$status="";
if (isset($_POST['foodname']) && $_POST['foodname']!=""){
$foodname = $_POST['foodname'];
$result = mysqli_query($con,"SELECT * FROM `foodmenu` WHERE `foodname`='$foodname'");
$row = mysqli_fetch_assoc($result);
$name = $row['foodname'];
$price = $row['foodprice'];
$id = $row['id'];
$img = $row['foodimage'];

$cartArray = array(
	$foodname=>array(
	'foodname'=>$name,
	'foodprice'=>$price,
	'id'=>$id,
	'quantity'=>1,
  'foodimage'=>$img,
    )
);

if(empty($_SESSION["shopping_cart"])) {
	$_SESSION["shopping_cart"] = $cartArray;
	$status = "<div class='box'>Product is added to your cart!</div>";
}else{
	$array_keys = array_keys($_SESSION["shopping_cart"]);
	if(in_array($foodname,$array_keys)) {
		$status = "<div class='box' style='color:red;'>
		Product is already added to your cart!</div>";	
	} else {
	$_SESSION["shopping_cart"] = array_merge($_SESSION["shopping_cart"],$cartArray);
	$status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Food Product Card</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body{
      font-family: 'Trebuchet MS', sans-serif;
    }
    .cart_div {
      text-decoration: none;
      float: right;
      height: 20px;
      margin-top: -52px;
      padding-right: 40px;

    }

    .cart-link {
      text-decoration: none;
      padding-bottom: 10px;
    }

    .cart-link i {
      font-size: 30px;
      color: #fff;
    }

    .cart-image {
      width: 60px;
      height: 60px;

    }

    .cart-count {
      color: #fff;
      font-size: 24px;
      float: right;
      margin-right: 15px;
      padding-left: 4px;
      font-weight: bold;
      margin-top: -20px;
    }


    .menu {
      position: fixed;
      top: 0%;
      width: 100%;
      background: radial-gradient(circle at top left, #000, #303234 75%);
      padding: 10px;

    }

    .menu-item {
      text-decoration: none;
      font-size: 25px;
      font-family: 'Trebuchet MS', serif;
      background-color: none;
      color: white;
      margin-left: 35px;
    }

    .main-item {
      font-size: 25px;
      color: white;
      margin-left: 15px;
    }

    .main-item:after {
      content: '';
      position: absolute;
      transform: translateX(-110%);
      height: 4px;
      bottom: 34px;
      width: 50px;
      border-radius: 2px;
      background-color: #ffcc23;
    }

    .button-bar {
      background-color: #C87E4F;
      border: none;
      font-size: 18px;
      color: white;
      padding: 5px;
      padding-top: 15px;
      margin-right: 10px;
      text-decoration: none;
    }

    .button-bar:hover {
      color: #ffcc23;
    }

    .button-class {
      margin-top: 4px;
      margin-left: 6px;
      background: none;
    }
    .container {
      display: column;
      grid-template-columns: repeat(auto-fit, minmax(250px, 2fr));
      gap: 0px;
      padding: 0px;
      font-family: 'Trebuchet MS',serif;
      margin-top: 60px;
      
      
    }
    .card {
        background: radial-gradient(circle at top left, #000 35%, #303234 );
        color: white;
      border-radius: 10px;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.8);
      margin: 30px;
     
      max-width: 300px;
      min-width: 280px;
      max-height:300px;
      min-height:280px;
      align:center;
      float:left;
     
    }
    .card img {
            width: 100%;
            height: 70%;
            object-fit: cover;
            border-radius: 12px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 30px;
            max-width: 300px;
            min-width: 280px;
            max-height:200px;
            min-height:180px;

    }
    .card h3 {
      margin-top: 10px;
      margin-bottom: 5px;
      text-align: center;
    }
    .card p {
      margin-top: 0;
      text-align: center;
    }
    button{
  border: none;
  font-size: 16px;
  width:120px;
  height:35px;
  color: #000;
  padding: 8px 16px;
  background-color:#ffcc23;
  border-radius: 8px;
  margin-left: 35%;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 6px 5px 10px rgba(0, 0, 0., 0.8);
  margin-top: 10px;
  font-family: 'Trebuchet MS',serif;
}
@media screen and (max-width: 1500px) {
    .card{
        margin-left:20%;

    }
}
  </style>
</head>
<body>      
    <div class="menu">
      <a href="menustyle.php" class="menu-item "  style="text-decoration:none" >MENU</a>
      <a href="drinkpage.php" class="menu-item main-item"  >DRINKS</a>
      <a href="barmenu.php" class="menu-item">BAR</a>
      <div class="button-class">
        
          <a href="soda.php" class="button-bar" style="background: none;" >SODA</a>
          <a href="beer.php" class="button-bar" style="background: none;">BEER</a>
          <a href="wine.php" class="button-bar" style="background: none;">WINE</a>
          <a href="cocktail.php" class="button-bar" style="background: none;">COCKTAIL</a>
      </div>
      </div>
      
    <?php
                        
                        $meal = "drink";

                       $result = mysqli_query($con,"SELECT * FROM `foodmenu` WHERE foodtype = '$meal' " );
                       foreach($result as $row){
		               ?>
  <div class="container">
    <div class="card">
       <?php echo '<img  src="data:image/jpeg;base64,'.base64_encode($row['foodimage']).'"/>'; ?>
        <h3><?= $row['foodname']?></h3>
        <p>Sh.<?= $row['foodprice']?></p>
        
        <form method='post' action=''>
            <input type='hidden' name='foodname' value="<?= $row['foodname']?>" />
            <button type='submit' class="button">ORDER</button>
         </form>
      </div>
      <?php
                       }

      ?>
 
  </div>
</body>
</html>
