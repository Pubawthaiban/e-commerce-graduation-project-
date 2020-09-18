<?php session_start(); require_once('connect.php');?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>
        <? 
				for($i=0;$i<=(int)$_SESSION["intLine"];$i++){
					$_SESSION["Productnum"][$i] = $amount[$i];
				}
				for($i=0;$i<=(int)$_SESSION["intLine"];$i++){
							 		$sql1 = mysql_query("select * from product where product_id = '".$_SESSION["Product"][$i]."'");
									$check = mysql_fetch_array($sql1);
									$check1 = $check['amount'] - $_SESSION["Productnum"][$i];
									if($check1 < 0){
			echo "<script>alert('$check[product_name] จำนวนในสต๊อกไม่เพียงพอ ! จำนวนคงเหลือตอนนี้ $check[amount] ชิ้น');window.location='show.php';</script>"; exit();				
						 }
				}
			if($_POST['con']){
		echo "<script>window:location='cart_address.php'</script>";	
		}
		echo "<script>window:location='show.php'</script>";
		?>
      <body>
</body>
</html>