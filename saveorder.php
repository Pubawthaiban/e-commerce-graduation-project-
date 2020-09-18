<? session_start(); require_once('header.php');
		
	$lis = mysql_query("select * from db_order");
	$num = mysql_num_rows($lis);
		$p = date("Y")+543;
		if($num == 0){
			$orid = "$p"."1";	
		}else{
			$sql = mysql_query("select * from db_order order by order_id desc");
			$r = mysql_fetch_array($sql);
			$r1 = substr($r['order_id'],4);
			$r2 = $r1+1;
			$orid = "$p".$r2;
		}
	$date = date("Y-n-d");
	$dateEx = date("Y-n-d", strtotime("+1 day"));
	$sql = mysql_query("insert into db_order(order_id,member_id,order_date,dateEx,delivery,order_total)
								values('$orid','$_SESSION[id]','$date','$dateEx','$_SESSION[add]','$_SESSION[sumtotal]')");
	
	  $Total = 0;
                $SumTotal = 0;
                    for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
                    {
                        if($_SESSION["Product"][$i] != "")
                    {
						mysql_query("insert into db_orderdetail(order_id,product_id,detailnum)
											values('$orid','".$_SESSION[Product][$i]."','".$_SESSION[Productnum][$i]."')");
											
mysql_query("update product set amount = amount - '".$_SESSION[Productnum][$i]."' where product_id = '".$_SESSION[Product][$i]."'");
					}
					}
	if($sql){
			unset($_SESSION["intLine"],$_SESSION["Product"],$_SESSION["Productnum"],$_SESSION['sumtotal'],$_SESSION['add']);
		echo "<script>alert('ยืนยันการสั่งชื้อเรียบร้อยแล้วค่ะ');window.location='help.php?pay=3';</script>";
	}else{
		
		echo	"<script>alert('Nnnnnnn');</script>";
		echo mysql_error();
	}

	?>