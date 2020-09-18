<?php session_start();?>
<?php include_once('header.php');?>
			<style>
				table th{
						background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
						background:-moz-linear-gradient(top,#f9f9f9, #ececec);
					}
					table td{
						text-align:center;	
						border-top:#dfdfdf 1px solid;
					}
			</style>
<div class="container">
	<div class="row">
    	<div class="well" align="center">
        <div style="border:solid 1px;width:700px;padding:6px;margin-bottom:0px;background-color:#666;"><font color="#FFFFFF";>ตะกร้าสินค้า</font></div>
         <? if(!empty($_SESSION['Product'])){?>
        <form action="up.php" method="post" name="form">
<table width="650px" align="center" cellpadding="9" cellspacing="9" style="border:solid 1px #333333;margin-bottom:6px">
<tr>
	<th>รหัส</th>
    <th width="130px" align="center">รูปสินค้า</th>
	<th>ชื้อสินค้า</th>
	<th>ราคา(บาท)</th>
	<th>จำนวน</th>
	<th>ราค่ารวม(บาท)</th>
	<th>ลบ</th>
</tr>

	<?
$Total = 0;
$SumTotal = 0;
	for($i=0;$i<=(int)$_SESSION["intLine"];$i++)
	{
		if($_SESSION["Product"][$i] != "")
	{
			$objQuery = mysql_query("SELECT * FROM product WHERE product_id = '".$_SESSION["Product"][$i]."'")or die(mysql_error());
			$objResult = mysql_fetch_array($objQuery);
			
				if($objResult['discount'] == 0){
					$price = $objResult['product_price'];
			$Total = $_SESSION["Productnum"][$i] * $price;
				}else{
					$sumpro = ($objResult['product_price']/100)*$objResult['discount'];
					$SumTotalpro = $objResult['product_price'] - $sumpro;
					$price = $SumTotalpro;
					$Total = $_SESSION['Productnum'][$i] * $SumTotalpro;
				}
			$SumTotal = $SumTotal + $Total;
	?>
	<tr>
		<td><?=$_SESSION["Product"][$i];?></td>
        <td><img src="img/<?=$objResult['image'];?>" style="height:130px;width:100px;"></td>
		<td><?=$objResult["product_name"];?></td>
        <? if($objResult['discount'] == 0){ ?>
		<td><?=$price;?></td>
        <? } else { ?>
        <td><del><?=$objResult['product_price'];?></del><br><?=$price;?></td>
        <? } ?>
		<td><input type="text" name="amount[]" value="<?=$_SESSION["Productnum"][$i];?>" style="width:40px"></td>
		<td><?=number_format($Total,2);?></td>
		<td bgcolor="#FFFFFF"><a href="deletecart.php?dell=<?=$i;?>"><i class="icon-trash" title="ลบสินค้าออก" style="width:18px;height:18px"></i></a></td>
	</tr>
		<?
        }
        }
        ?>
        <tr>
        <td colspan="7" align="right">ยอดรวมทั้งหมด : <span class="total"><?=number_format($SumTotal,2);?></span> บาท</td>
        </tr>
        </table>
        
        <input type="button" value="เลือกชื้อสินค้าต่อ" onclick="window.location='index.php';" class="btn"/><input type="submit" value="คำนวณสินค้าใหม่" class="btn"><input type="hidden" name="cal"><input type="submit" name="con" value="ยืนยันการสั่งชื้อ" class="btn">
        </form>
        </div>
			<? }else{ ?>
            	<table width="70%" height="300px" border="1" align="center" cellpadding="3">
            	<th>
            	<span><font color="#FF0000">คุณไม่มีสินค้าในตะกร้า</font></span><br>
                <a href="index.php" class="btn">กลับไปเลือกชื้อสินค้าต่อ</a>
            	</th>
            	</table>
            <? }?>
	</div>

    
    	 <? /* for($i=0;$i<=(int)$_SESSION['intLine'];$i++){
			 									echo $i;
												echo $_SESSION['Product'][$i];
												echo $_SESSION['Productnum'][$i];
												echo '<br>';
									}
									*/?>
    	</div>
        
        