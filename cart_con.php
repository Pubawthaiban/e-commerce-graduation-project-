<? session_start(); require_once('header.php');?>
				<style>
				table th{
						background:-webkit-gradient(linear,left top,left bottom,from(#f9f9f9),to(#ececec));
						background:-moz-linear-gradient(top,#f9f9f9, #ececec);
					}
					table td{
						border-top:#dfdfdf 1px solid;	
					}
				</style>
			<div class="container">
            	<div class="row">
                	<div class="well" align="center">
                        <div style="border:solid 1px;width:700px;padding:6px;margin-bottom:0px;background-color:#666;"><font color="#FFFFFF";>ตะกร้าสินค้า</font></div>
                         <? if(!empty($_SESSION['Product'])){?>
                        <form action="saveorder.php" method="post">
                <table width="650px"align="center" cellpadding="9" cellspacing="9" style="border:#333 1px outset">
                <tr>
                    <th>รหัส</th>
                    <th width="130px" align="center">รูปสินค้า</th>
                    <th>ชื้อสินค้า</th>
                    <th>ราคา(บาท)</th>
                    <th>จำนวน</th>
                    <th>ราค่ารวม(บาท)</th>
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
							$sum = $sum + $Total;
							$ship = $sum + $_POST['add'];
                            $SumTotal = $ship;
							$_SESSION['sumtotal'] = $SumTotal;
							$_SESSION['add'] = $_POST['add'];
                    ?>
                    <tr>
                        <td align="center"><?=$_SESSION["Product"][$i];?></td>
                        <td align="center"><img src="img/<?=$objResult['image'];?>" style="height:130px;width:100px;"></td>
                        <td align="center"><?=$objResult["product_name"];?></td>
                        <? if($objResult['discount'] == 0){ ?>
                        <td align="center"><?=$price;?></td>
                        <? } else { ?>
                        <td align="center"><del><?=$objResult['product_price'];?></del><br><?=$price;?></td>
                        <? } ?>
                        <td align="center"><?=$_SESSION["Productnum"][$i];?></td>
                        <td align="center"><?=number_format($Total,2);?></td>
                    </tr>
                <?
                }
                }
                ?>
                <tr>
                <td colspan="7" align="right">ยอดรวม : <span class="total"><?=number_format($sum,2);?></span> บาท</td>
                </tr>
                <tr>
                <td colspan="7" align="right">ค่าจัดส่ง : <? echo number_format($_POST['add'],2);?> บาท </td>
                </tr>
                <tr>
                <td colspan="7" align="right">ยอดรวมทั้งหมด : <span><?=number_format($SumTotal,2);?></span> บาท</td>
                </tr>
                </table>
                <input type="button" value="ย้อนกลับ" onclick="history.back(0);" class="btn"/> <input type="submit" value="ยืนยันการสั่งชื้อ" class="btn">
                </form>
                </div>
                   
				   <? } ?>
                        </div>
                             </div>
                             </div>
                             <?
								if($_POST['edit'] === "edit"){
							 	mysql_query("update member set mem_add = '$_POST[editadd]' where member_id = '$_SESSION[id]'");
								}
							 ?>